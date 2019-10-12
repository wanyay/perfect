<?php


namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Customer;

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

        $customers = Customer::orderBy('id', 'des')->get();
        return response()->json($customers);
    }
}
