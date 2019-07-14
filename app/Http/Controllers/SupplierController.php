<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Supplier;

class SupplierController extends Controller
{
  public function index()
  {
    $suppliers = supplier::all();

    return view('supplier.index',compact('suppliers'));
  }

  public function create()
  {
    return view('supplier.create');
  }

  /**
   * show edit form of each supplier
   *
   * @return view
   */

  public function edit($id)
  {
      $supplier = supplier::findOrFail($id);

      return view('supplier.edit',compact('supplier'));
  }

  public function store(Request $request)
  {
    $supplier = supplier::create($request->all());

    $supplier ? flash()->success('Success','New Supplier has been added.') : flash()->error('Error','Something is wrong!');

    return redirect()->action('SupplierController@index');
  }

  /**
   * update single supplier to database
   *
   * @return view
   */
  public function update($id,Request $request)
  {
      $supplier = supplier::findOrFail($id);

      $supplier->update($request->all());

      flash()->success('Updated','Supplier has been updated.');

      return redirect()->action('SupplierController@index');

  }

  /**
   * detele single supplier
   *
   * @return view
   */

  public function destroy($id)
  {
    $supplier = supplier::destroy($id);
    return $supplier;
  }
}
