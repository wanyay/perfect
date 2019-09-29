<?php


namespace App\Http\Controllers\ApiController;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Customer;
use App\Sale;
use DB;
/**
 *
 */
class CustomerApiController extends Controller
{
  public function getCustomer()
  {
    return response()->json(Customer::all());
  }
  public function store(Request $request)
  {
    $customer = new Customer;
    $customer->name = $request->input('name');
    $customer->phone = $request->input('phone');
    $customer->address = $request->input('address');
    $customer->save();

    $customers = Customer::orderBy('id','des')->get();
    return response()->json($customers);
  }

  public function getTodayDueCredits()
  {
      $totalDueDateCredits = Sale::with('customer')->where('credit_due_date', DB::raw('CURDATE()'))->get();

      return view('todaycredit', compact('totalDueDateCredits'));
  }
}
