<?php

namespace App\Http\Controllers\Backend;

use App\Models\Apple;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class AppleController extends Controller
{
	public function getFirstId() {
		$apple = Apple::where('is_used', '0')->first();
		if($apple) {
			$apple->is_used = 1;
			$apple->save();
			echo $apple->apple_id;
		} else {
			echo 'Het hang';
		}
	}

    public function index(Request $request) {
        $data = Apple::where('user_id', \Auth::user()->id)->paginate(20);

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

	public function store( Request $request ) {
		$user_id = \Auth::user()->id;

		$content = trim($request->apple_ids);
		$content = explode("\n", $content);
		$content = array_filter($content, 'trim'); // remove any extra \r characters left behind

		$count = 0;
		foreach ($content as $line) {
			if(Apple::firstOrCreate(['apple_id' => trim($line), 'user_id' => trim($user_id) ])) {
				$count++;
			}
		}

		if($count > 0) {
			Session::flash('success_message', 'Insert your apple ids successful');
		}

		return redirect()->route( 'apple.insert' );
	}
}
