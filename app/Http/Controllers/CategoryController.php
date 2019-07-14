<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Category;

class CategoryController extends Controller
{
     /**
     * show all of Categorys
     *
     * @return view
     */
    public function index()
    {
      $categories = Category::orderBy('created_at','desc')->get();
      return view('category.index',compact('categories'));
    }

    /**
     * show create form of Categorys.
     *
     * @return view
     */
    public function create()
    {
      return view('category.create');
    }

    /**
     * show edit form of each Category
     *
     * @return view
     */

    public function edit($id)
    {
        $category = Category::findOrFail($id);

        return view('category.edit',compact('category'));
    }

    /**
     * save input data to database
     *
     * @return view
     */

    public function store(Request $request)
    {
      $category = Category::create($request->all());

      $category ? flash()->success('Success','New Category has been added.') : flash()->error('Error','Something is wrong!');

      return redirect()->action('CategoryController@index');
    }

    /**
     * update single Category to database
     *
     * @return view
     */
    public function update($id,Request $request)
    {
        $category = Category::findOrFail($id);

        $category->update($request->all());

        flash()->success('Updated','Category has been updated.');

        return redirect()->action('CategoryController@index');

    }

    /**
     * detele single Category
     *
     * @return view
     */

    public function destroy($id)
    {
      $category = Category::destroy($id);
      return $category;
    }
}
