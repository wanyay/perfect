<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Customer;

class CustomerController extends Controller
{
    public function index()
    {
      $customers = Customer::all();

      return view('customer.index',compact('customers'));
    }

    public function create()
    {
      return view('customer.create');
    }

    /**
     * show edit form of each Customer
     *
     * @return view
     */

    public function edit($id)
    {
        $customer = Customer::findOrFail($id);

        return view('customer.edit',compact('customer'));
    }

    public function store(Request $request)
    {
      $customer = Customer::create($request->all());

      $customer ? flash()->success('Success','New Customer has been added.') : flash()->error('Error','Something is wrong!');

      return redirect()->action('CustomerController@index');
    }

    /**
     * update single Customer to database
     *
     * @return view
     */
    public function update($id,Request $request)
    {
        $customer = Customer::findOrFail($id);

        $customer->update($request->all());

        flash()->success('Updated','Customer has been updated.');

        return redirect()->action('CustomerController@index');

    }

    /**
     * detele single Customer
     *
     * @return view
     */

    public function destroy($id)
    {
      $customer = Customer::destroy($id);
      return $customer;
    }
}
