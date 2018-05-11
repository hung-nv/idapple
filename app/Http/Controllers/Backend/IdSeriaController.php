<?php

namespace App\Http\Controllers\Backend;

use App\Models\IdSeria;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;

class IdSeriaController extends Controller
{
	public function download() {
		$dataStorage = IdSeria::select('seria')->pluck('seria')->toArray();
		$dataStorage = implode("\n", $dataStorage);
		Storage::put('idSerias.txt', $dataStorage);
		return Response::download(storage_path('app/idSerias.txt'));
	}

	public function deleteAll() {
		IdSeria::truncate();
		return redirect()->route('idSeria.index');
	}

	public function insert($seria) {
		if(!empty($seria)) {
			$idSeria = IdSeria::create(['seria' => $seria]);
			if($idSeria) {
				echo 'Insert '.$seria.' thành công.';
			} else {
				'Fail';
			}
		}
	}

	public function index(Request $request) {
		$data = IdSeria::paginate(20);

		return view('backend.idSeria.index', [
			'data' => $data
		]);
	}

	public function destroy($id) {
		$idSeria = IdSeria::findOrFail($id);
		if ($idSeria->delete()) {
			Session::flash('success_message', 'This seria has been delete!');
		} else {
			Session::flash('error_message', 'Fail to delete this seria');
		}
		return redirect()->route('idSeria.index');
	}
}
