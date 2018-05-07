<?php

namespace App\Http\Controllers\Backend;

use App\Models\Support;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;

class SupportController extends Controller
{
    public function insert($email) {
		if(!empty($email)) {
			$support = Support::firstOrCreate(['mail' => $email]);
			if($support) {
				echo 'Insert '.$email.' thanh cong.';
			} else {
				'Fail';
			}
		}
    }

	public function index(Request $request) {
		$data = Support::paginate(20);

		return view('backend.support.index', [
			'data' => $data
		]);
	}

	public function destroy($id) {
		$support = Support::findOrFail($id);
		if ($support->delete()) {
			Session::flash('success_message', 'This credit has been delete!');
		} else {
			Session::flash('error_message', 'Fail to delete this credit');
		}
		return redirect()->route('support.index');
	}
}
