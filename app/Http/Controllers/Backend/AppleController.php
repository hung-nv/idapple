<?php

namespace App\Http\Controllers\Backend;

use App\Models\Apple;
use App\Models\User;
use App\Repositories\ImageRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use Maatwebsite\Excel\Facades\Excel;
use Validator;

class AppleController extends Controller
{
    protected $image;

    public function __construct(ImageRepository $image)
    {
        $this->image = $image;
    }

    public function index(Request $request) {
        if($request->has('domain')) {
            $data = Apple::where([
                'user_id' => Auth::user()->id,
                'domain' => $request->domain
            ])->paginate(20);
        } else {
            $data = Apple::where('user_id', \Auth::user()->id)->paginate(20);
        }

        return view('backend.apple.index', [
           'data' => $data
        ]);
    }

    public function destroy($id) {
        $apple_id = Apple::findOrFail($id);
        if ($apple_id->delete()) {
            Session::flash('success_message', 'This apple_id has been delete!');
        } else {
            Session::flash('error_message', 'Fail to delete this apple_id');
        }
        return redirect()->route('apple.index');
    }

    public function insert() {
        $total = Apple::count('id');
        $sell = Apple::where('is_used', 1)->count('id');
        return view('backend.apple.create', [
            'total' => $total,
            'sell' => $sell
        ]);
    }

    public function store(Request $request) {
        Validator::make($request->all(), [
            'file' => 'required|mimes:xls,xlsx,txt|max:2048'
        ])->validate();
        $total_before = Apple::count('id');
        if ($request->hasFile('file')) {
            $file = $request->file('file');
            $destinationPath = 'uploads/';
            $fileExtension = $file->getClientOriginalExtension();
            $fileName = md5(time()).'.'.$file->getClientOriginalExtension();
            $file->move($destinationPath, $fileName);

            $message = '';
            $user_id = \Auth::user()->id;

            if($fileExtension == 'txt') {
                $content = file($destinationPath.$fileName);
                if(count($content) < 1) {
                    $message = 'File không có dữ liệu';
                }
                foreach($content as $line) {
                    $ids = explode('|', str_replace('\r\n', '', $line));
                    if(count($ids) < 4) {
                        break;
                    }
                    $domain = explode('@', trim($ids[0]));
                    if(Apple::where('apple_id', trim($ids[0]))->count('id') == 0 ) {
                        Apple::firstOrCreate(['apple_id' => trim($ids[0]),
                            'password' => trim($ids[1]),
                            'answer_first' => trim($ids[2]),
                            'answer_second' => trim($ids[3]),
                            'domain' => trim($domain[1]),
                            'user_id' => trim($user_id)
                        ]);
                    }
                }
            } else {
                Excel::load($destinationPath.$fileName, function($reader) use (&$message, $user_id) {
                    $reader->ignoreEmpty();
                    $results = $reader->get();
                    if(empty($results->toArray())) {
                        $message = 'File không có dữ liệu';
                    } else {
                        $head = ['apple_id', 'password', 'answer_1', 'answer_2'];
                        $headExcel = $results->first()->keys()->toArray();
                        if($head == $headExcel) {
                            foreach($results->toArray() as $row) {
                                $domain = explode('@', $row['apple_id']);
                                if(empty($row['apple_id']) || empty($row['password']) || empty($row['answer_1']) || empty($row['answer_2'])) {

                                } else {
                                    if(Apple::where('apple_id', $row['apple_id'])->count('id') == 0 ) {
                                        Apple::firstOrCreate(['apple_id' => $row['apple_id'],
                                            'password' => $row['password'],
                                            'answer_first' => $row['answer_1'],
                                            'answer_second' => $row['answer_2'],
                                            'domain' => $domain[1],
                                            'user_id' => $user_id
                                        ]);
                                    }
                                }
                            }
                        } else {
                            $message = 'File sai định dạng, xem lại dòng đầu tiên!';
                        }
                    }
                })->get();
            }

            if(empty($message)) {
                $total_after = Apple::count('id');
                $total_insert = $total_after - $total_before;
                if($total_insert == 0) {
                    $message = 'Dữ liệu trong file đã được upload trước đó!';
                } else {
                    return redirect()->route('apple.insert')->with(['success_message' => 'Tổng số ID đã thêm: '.$total_insert]);
                }
            }

            if(!empty($message)) {
                return redirect()->route('apple.insert')->with(['error_message' => $message]);
            }
        }
    }

    public function getFirst() {
        $domains = Apple::select('domain')->where('is_used', 0)->groupBy('domain')->get();
        return view('backend.apple.buyId', [
            'domains' => $domains
        ]);
    }

    public function getFirstId(Request $request) {
        $appleId = Apple::select('apple_id', 'password', 'answer_first', 'answer_second', 'is_used', 'user_id', 'id')->where([
            ['domain', $request->domain],
            ['is_used', 0]
        ])->first();
        if(isset($appleId) && $appleId) {
            $user = \Auth::user();
            $cointResult = $user->coint - $user->rate;
            if($cointResult >= 0) {
                $apple = Apple::findOrFail($appleId->id);
                $apple->is_used = 1;
                $apple->user_id = $user->id;
                $apple->save();

                $user = User::findOrFail($user->id);
                $user->coint = $cointResult;
                $user->total_buy += 1;
                $user->save();

                $appleId =  json_decode($appleId);
                return response()->json([
                    'account' => $appleId,
                    'current_coint' => $cointResult
                ], 200);
            } else {
                return response()->json([
                    'message' => 'Bạn không đủ số dư để mua tiếp. Vui lòng liên hệ administrator!'
                ], 402);
            }
        } else {
            return response()->json([
                'message' => 'Vui lòng chọn domain!'
            ], 402);
        }
    }
}
