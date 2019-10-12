<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\ProductType;

class ProductTypeController extends Controller
{
    /**
     * show all of ProductTypes
     *
     * @return view
     */
    public function index()
    {
        $product_types = ProductType::all();
        return view('product_type.index', compact('product_types'));
    }

    /**
     * show create form of ProductTypes.
     *
     * @return view
     */
    public function create()
    {
        return view('product_type.create');
    }

    /**
     * show edit form of each ProductType
     *
     * @return view
     */

    public function edit($id)
    {
        $product_type = ProductType::findOrFail($id);

        return view('product_type.edit', compact('product_type'));
    }

    /**
     * save input data to database
     *
     * @return view
     */

    public function store(Request $request)
    {
        $product_type = ProductType::create($request->all());

        $product_type ? flash()->success('Success', 'New Product Type has been added.') : flash()->error('Error', 'Something is wrong!');

        return redirect()->action('ProductTypeController@index');
    }

    /**
     * update single ProductType to database
     *
     * @return view
     */
    public function update($id, Request $request)
    {
        $product_type = ProductType::findOrFail($id);

        $product_type->update($request->all());

        flash()->success('Updated', 'ProductType has been updated.');

        return redirect()->action('ProductTypeController@index');
    }

    /**
     * detele single ProductType
     *
     * @return view
     */

    public function destroy($id)
    {
        $product_type = ProductType::destroy($id);
        return $product_type;
    }
}
