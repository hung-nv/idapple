<?php

namespace App\Http\Controllers\Backend;

use App\Models\IdSeriaSupport;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;

class IdSeriaSupportController extends Controller {
	public function download() {
		$dataStorage = [];
		$id_serias = IdSeriaSupport::select( 'seria', 'may' )->get();
		foreach ( $id_serias as $item ) {
			$dataStorage[] = $item->may . '|' . $item->seria;
		}
		$dataStorage = implode( "\n", $dataStorage );
		Storage::put( 'idSeriaSupport.txt', $dataStorage );

		return Response::download( storage_path( 'app/idSeriaSupport.txt' ) );
	}

	public function deleteAll() {
		IdSeriaSupport::truncate();

		return redirect()->route( 'idSeriaSupport.index' );
	}

	public function insert( $may, $seria ) {
		$idSeria = IdSeriaSupport::create( [ 'seria' => $seria, 'may' => $may ] );
		if ( $idSeria ) {
			echo 'Them ' . $may . '-' . $seria . ' thanh cong';
		} else {
			echo 'Fail';
		}
	}

	public function index( Request $request ) {
		$data = IdSeriaSupport::paginate( 20 );

		return view( 'backend.idSeriaSupport.index', [
			'data' => $data
		] );
	}

	public function destroy( $id ) {
		$idSeria = IdSeriaSupport::findOrFail( $id );
		if ( $idSeria->delete() ) {
			Session::flash( 'success_message', 'This id seria support has been delete!' );
		} else {
			Session::flash( 'error_message', 'Fail to delete this seria' );
		}

		return redirect()->route( 'idSeriaSupport.index' );
	}
}
