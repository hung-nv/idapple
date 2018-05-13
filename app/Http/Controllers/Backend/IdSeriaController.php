<?php

namespace App\Http\Controllers\Backend;

use App\Models\IdSeria;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;

class IdSeriaController extends Controller {

	public function download() {
		$dataStorage = [];
		$id_serias = IdSeria::select( 'seria', 'may' )->get();
		foreach ( $id_serias as $item ) {
			$dataStorage[] = $item->may . ':' . $item->seria;
		}
		$dataStorage = implode( "\n", $dataStorage );
		Storage::put( 'idSerias.txt', $dataStorage );

		return Response::download( storage_path( 'app/idSerias.txt' ) );
	}

	public function deleteAll() {
		IdSeria::truncate();

		return redirect()->route( 'idSeria.index' );
	}

	public function insert( $may, $seria ) {
		$idSeria = IdSeria::create( [ 'seria' => $seria, 'may' => $may ] );
		if ( $idSeria ) {
			echo 'Them ' . $may . '-' . $seria . ' thanh cong';
		} else {
			echo 'Fail';
		}
	}

	public function index( Request $request ) {
		$data = IdSeria::paginate( 20 );

		return view( 'backend.idSeria.index', [
			'data' => $data
		] );
	}

	public function destroy( $id ) {
		$idSeria = IdSeria::findOrFail( $id );
		if ( $idSeria->delete() ) {
			Session::flash( 'success_message', 'This seria has been delete!' );
		} else {
			Session::flash( 'error_message', 'Fail to delete this seria' );
		}

		return redirect()->route( 'idSeria.index' );
	}
}
