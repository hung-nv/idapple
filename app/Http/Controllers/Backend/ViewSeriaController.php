<?php

namespace App\Http\Controllers\Backend;

use App\Models\ViewSeria;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Response;

class ViewSeriaController extends Controller {
	public function download() {
		$dataStorage = ViewSeria::select( 'seria' )->pluck( 'seria' )->toArray();
		$dataStorage = implode( "\n", $dataStorage );
		Storage::put( 'viewSerias.txt', $dataStorage );

		return Response::download( storage_path( 'app/viewSerias.txt' ) );
	}

	public function deleteAll() {
		ViewSeria::truncate();

		return redirect()->route( 'viewSeria.index' );
	}

	public function getFirstId($may) {
		$viewSeria = ViewSeria::where('may', $may)->first();
		if ( $viewSeria ) {
			echo $viewSeria->seria;
			$viewSeria->delete();
		} else {
			echo 'Het hang';
		}
	}

	public function index( Request $request ) {
		$data = ViewSeria::paginate( 20 );

		return view( 'backend.viewSeria.index', [
			'data' => $data
		] );
	}

	public function destroy( $id ) {
		$viewSeria = ViewSeria::findOrFail( $id );
		if ( $viewSeria->delete() ) {
			Session::flash( 'success_message', 'This seria has been delete!' );
		} else {
			Session::flash( 'error_message', 'Fail to delete this seria' );
		}

		return redirect()->route( 'viewSeria.index' );
	}

	public function insert() {
		return view( 'backend.viewSeria.create' );
	}

	public function store( Request $request ) {
		$content = trim( $request->seria_ids );
		$content = explode( "\n", $content );
		$content = array_filter( $content, 'trim' ); // remove any extra \r characters left behind

		$count = 0;
		foreach ( $content as $line ) {
			if ( strlen( strstr( $line, ':' ) ) > 0 ) {
				$value = explode( ':', $line );
				if(count($value) > 2) {
					continue;
				}
				if ( ViewSeria::create( [ 'may' => trim( $value[0] ), 'seria' => trim( $value[1] ) ] ) ) {
					$count ++;
				}
			}
		}

		if ( $count > 0 ) {
			Session::flash( 'success_message', 'Insert your seria successful' );
		}

		return redirect()->route( 'viewSeria.insert' );
	}
}
