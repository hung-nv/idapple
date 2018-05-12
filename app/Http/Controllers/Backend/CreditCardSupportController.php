<?php

namespace App\Http\Controllers\Backend;

use App\Models\CreditCardSupport;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;

class CreditCardSupportController extends Controller
{
	public function download() {
		$dataStorage = CreditCardSupport::select('number')->pluck('number')->toArray();
		$dataStorage = implode("\n", $dataStorage);
		Storage::put('creditCardSupports.txt', $dataStorage);
		return Response::download(storage_path('app/creditCardSupports.txt'));
	}

	public function deleteAll() {
		CreditCardSupport::truncate();
		return redirect()->route('creditCardSupport.index');
	}

	public function insert($number) {
		if(!empty($number)) {
			$creditCardSupport = CreditCardSupport::create(['number' => $number]);
			if($creditCardSupport) {
				echo 'Insert '.$number.' thành công.';
			} else {
				echo 'Fail';
			}
		}
	}

	public function index(Request $request) {
		$data = CreditCardSupport::paginate(20);

		return view('backend.creditCardSupport.index', [
			'data' => $data
		]);
	}

	public function destroy($id) {
		$creditCardSupport = CreditCardSupport::findOrFail($id);
		if ($creditCardSupport->delete()) {
			Session::flash('success_message', 'This credit card support has been delete!');
		} else {
			Session::flash('error_message', 'Fail to delete this credit card support');
		}
		return redirect()->route('creditCardSupport.index');
	}
}
