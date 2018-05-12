<?php

namespace App\Http\Controllers\Backend;

use App\Models\IdSeriaSupport;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use Jenssegers\Agent\Agent;

class IdSeriaSupportController extends Controller
{
	private $agent;

	public function __construct() {
		$this->agent = new Agent();
	}

	public function download() {
		$dataStorage = IdSeriaSupport::select('seria')->pluck('seria')->toArray();
		$dataStorage = implode("\n", $dataStorage);
		Storage::put('idSeriaSupport.txt', $dataStorage);
		return Response::download(storage_path('app/idSeriaSupport.txt'));
	}

	public function deleteAll() {
		IdSeriaSupport::truncate();
		return redirect()->route('idSeriaSupport.index');
	}

	public function insert($seria) {
		if($this->agent->is('iPhone')) {
			if(!empty($seria)) {
				$idSeria = IdSeriaSupport::create(['seria' => $seria]);
				if($idSeria) {
					echo 'Insert '.$seria.' thành công.';
				} else {
					echo 'Fail';
				}
			}
		} else {
			echo 'Bien di';
		}
	}

	public function index(Request $request) {
		$data = IdSeriaSupport::paginate(20);

		return view('backend.idSeriaSupport.index', [
			'data' => $data
		]);
	}

	public function destroy($id) {
		$idSeria = IdSeriaSupport::findOrFail($id);
		if ($idSeria->delete()) {
			Session::flash('success_message', 'This id seria support has been delete!');
		} else {
			Session::flash('error_message', 'Fail to delete this seria');
		}
		return redirect()->route('idSeriaSupport.index');
	}
}
