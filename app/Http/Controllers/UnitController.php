<?php
namespace App\Http\Controllers;

use App\Services\UnitService;
use Illuminate\Http\Request;

use App\Models\Unit;

class UnitController extends Controller
{
    protected $unitService;

    public function __construct(UnitService $unitService)
    {
        $this->unitService = $unitService;
    }
    /**
     * show all of units
     *
     * @return view
     */
    public function index()
    {
        return view('test');
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

        return view('units.edit', compact('unit'));
    }

    /**
     * save input data to database
     *
     * @return view
     */

    public function store(Request $request)
    {
        $unit = Unit::create($request->all());

        $unit ? flash()->success('Success', 'New Unit has been added.') : flash()->error('Error', 'Something is wrong!');

        return redirect()->action('UnitsController@index');
    }

    /**
     * update single unit to database
     *
     * @return view
     */
    public function update($id, Request $request)
    {
        $unit = Unit::findOrFail($id);

        $unit->update($request->all());

        flash()->success('Updated', 'Unit has been updated.');

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
