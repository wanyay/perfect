<?php

namespace App\Http\Controllers;

use App\Credit;

use App\Customer;

use Illuminate\Http\Request;

class CreditController extends Controller
{
  /**
   * show all credit of Customer
   *
   * @return view
   * @param cusotmer id
   */
    public function show($id)
    {
      $customer = Customer::findOrFail($id);
      $credits = Credit::orderBy('created_at','decs')->where('customer_id',$id)->where('is_payback',0)->paginate(5);
      $paybacks = Credit::orderBy('created_at','decs')->where('customer_id',$id)->where('is_payback',1)->paginate(5);
      $total = 0;
      $total_credit = 0;
      $total_payback = 0;
      foreach ($credits as $credit) {
        $total_credit += $credit->amount ;
      }

      foreach ($paybacks as $payback) {
        $total_payback += $payback->amount ;
      }
      $total = $total_credit - $total_payback;
      return view('customer.credit',compact('customer','credits','total','paybacks'));
    }

    public function payback(Request $request)
    {
      Credit::create(['customer_id' => $request->customer_id,'amount'=> $request->amount,'is_payback' => 1,'remark'=>'Payback']);
      return redirect()->route('credit.show',$request->customer_id);
    }
}
