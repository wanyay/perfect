<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Unit;

class UnitsController extends Controller
{
    /**
     * show all of units
     *
     * @return view
     */
    public function index()
    {
      $units = Unit::orderBy('created_at','desc')->get();
      return view('units.index',compact('units'));
    }

    /**
     * show create form of units.
     *
     * @return view
     */
    public function create()
    {
      return view('units.create');
    }

    /**
     * show edit form of each unit
     *
     * @return view
     */

    public function edit($id)
    {
        $unit = Unit::findOrFail($id);

        return view('units.edit',compact('unit'));
    }

    /**
     * save input data to database
     *
     * @return view
     */

    public function store(Request $request)
    {
      $unit = Unit::create($request->all());

      $unit ? flash()->success('Success','New Unit has been added.') : flash()->error('Error','Something is wrong!');

      return redirect()->action('UnitsController@index');
    }

    /**
     * update single unit to database
     *
     * @return view
     */
    public function update($id,Request $request)
    {
        $unit = Unit::findOrFail($id);

        $unit->update($request->all());

        flash()->success('Updated','Unit has been updated.');

        return redirect()->action('UnitsController@index');

    }

    /**
     * detele single unit
     *
     * @return view
     */

    public function destroy($id)
    {
      $unit = Unit::destroy($id);
      return $unit;
    }
}
