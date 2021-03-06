<?php

namespace App\Http\Controllers\Backend;

use App\Models\Port;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;

class PortController extends Controller {
	public function index() {
		$data = Port::paginate( 20 );

		return view( 'backend.port.index', [
			'data' => $data
		] );
	}

	public function destroy( $id ) {
		$port = Port::findOrFail( $id );
		if ( $port->delete() ) {
			Session::flash( 'success_message', 'This port has been delete!' );
		} else {
			Session::flash( 'error_message', 'Fail to delete this port' );
		}

		return redirect()->route( 'port.index' );
	}

	public function deleteAll() {
		Port::truncate();

		return redirect()->route( 'port.index' );
	}

	public function store( $port ) {
		$count = 0;
		if ( strlen( strstr( $port, '&' ) ) > 0 ) {
			$arrayPort = explode( '&', $port );
			foreach ( $arrayPort as $i ) {
				if ( is_numeric( $i ) ) {
					Port::firstOrCreate( [ 'port' => trim( $i ) ] );
					$count ++;
				}
			}
		} else {
			if ( is_numeric( $port ) ) {
				Port::firstOrCreate( [ 'port' => $port ] );
				$count ++;
			}
		}

		if ( $count > 0 ) {
			echo 'Add ' . $count . ' port thành công!';
		} else {
			echo 'Fail cmnr';
		}
	}

	public function delete( $port ) {
		$count = 0;
		if ( strlen( strstr( $port, '&' ) ) > 0 ) {
			$arrayPort = explode( '&', $port );
			foreach ( $arrayPort as $i ) {
				if ( is_numeric( $i ) ) {
					$instance = Port::where( 'port', trim( $i ) )->first();
					if ( $instance ) {
						$instance->delete();
						$count ++;
					}
				}
			}
		} else {
			if ( is_numeric( $port ) ) {
				$instance = Port::where( 'port', trim( $port ) )->first();
				if ( $instance ) {
					$instance->delete();
					$count ++;
				}
			}
		}

		if ( $count > 0 ) {
			echo 'Xoá ' . $count . ' port thành công!';
		} else {
			echo 'Fail cmnr';
		}
	}

	public function view() {
		$port = Port::orderBy( DB::raw( 'RAND()' ) )->first();
		if ( $port ) {
			echo $port->port;
		} else {
			echo 'Hết hàng';
		}
	}
}
