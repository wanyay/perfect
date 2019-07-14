<?php

namespace App\Http\Controllers\ApiController;

use App\Http\Controllers\Controller;

use App\Supplier;

use Response;

class SupplierApiController extends Controller
{
  public function getSupplier()
  {
    return response()->json(Supplier::all());
  }

  public function store()
  {
  	$customer = new Supplier;
    $customer->name = $request->input('name');
    $customer->phone = $request->input('phone');
    $customer->address = $request->input('address');
    $customer->save();

    $customers = Supplier::orderBy('id','des')->get();
    return response()->json($customers);
  }
}
