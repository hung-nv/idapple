<?php

namespace App\Http\Controllers\Backend;

use App\Models\Seria;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Response;

class SeriaController extends Controller
{
	public function download() {
		$dataStorage = Seria::select('seria')->pluck('seria')->toArray();
		$dataStorage = implode("\n", $dataStorage);
		Storage::put('serias.txt', $dataStorage);
		return Response::download(storage_path('app/serias.txt'));
	}

	public function deleteAll() {
		Seria::truncate();
		return redirect()->route('seria.index');
	}

	public function getFirstId() {
		$seria = Seria::first();
		if($seria) {
			echo $seria->seria;
			$seria->delete();
		} else {
			echo 'Hết hàng';
		}
	}

	public function index(Request $request) {
		$data = Seria::where('user_id', \Auth::user()->id)->paginate(20);

		return view('backend.seria.index', [
			'data' => $data
		]);
	}

	public function destroy($id) {
		$seria = Seria::findOrFail($id);
		if ($seria->delete()) {
			Session::flash('success_message', 'This seria has been delete!');
		} else {
			Session::flash('error_message', 'Fail to delete this seria');
		}
		return redirect()->route('seria.index');
	}

	public function insert() {
		return view('backend.seria.create');
	}

	public function store( Request $request ) {
		$user_id = \Auth::user()->id;

		$content = trim($request->seria_ids);
		$content = explode("\n", $content);
		$content = array_filter($content, 'trim'); // remove any extra \r characters left behind

		$count = 0;
		foreach ($content as $line) {
			if(Seria::create(['seria' => trim($line), 'user_id' => trim($user_id) ])) {
				$count++;
			}
		}

		if($count > 0) {
			Session::flash('success_message', 'Insert your seria successful');
		}

		return redirect()->route( 'seria.insert' );
	}
}
