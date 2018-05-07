<?php

namespace App\Http\Controllers\Backend;

use App\Models\CreditCard;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;

class CreditCardController extends Controller
{
	public function getFirstNumber() {
		$credit = CreditCard::where('is_used', '0')->first();
		if($credit) {
			$credit->is_used = 1;
			$credit->save();
			echo $credit->number;
		} else {
			echo 'Het hang';
		}
	}

    public function create() {
		return view('backend.creditcard.create');
    }

	public function store( Request $request ) {
		$user_id = \Auth::user()->id;

		$content = trim($request->credit_cards);
		$content = explode("\n", $content);
		$content = array_filter($content, 'trim'); // remove any extra \r characters left behind

		$count = 0;
		foreach ($content as $line) {
			if(CreditCard::firstOrCreate(['number' => trim($line), 'user_id' => trim($user_id) ])) {
				$count++;
			}
		}

		if($count > 0) {
			Session::flash('success_message', 'Insert your credit cards successful');
		}

		return redirect()->route( 'creditCard.create' );
	}

	public function index(Request $request) {
		$data = CreditCard::where('user_id', \Auth::user()->id)->paginate(20);

		return view('backend.creditcard.index', [
			'data' => $data
		]);
	}

	public function destroy($id) {
		$credit = CreditCard::findOrFail($id);
		if ($credit->delete()) {
			Session::flash('success_message', 'This credit has been delete!');
		} else {
			Session::flash('error_message', 'Fail to delete this credit');
		}
		return redirect()->route('creditCard.index');
	}
}
