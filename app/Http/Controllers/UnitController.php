<?php
namespace App\Http\Controllers;

use App\Services\UnitService;

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
        return view('units.index');
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
        $unit = $this->unitService->getById($id);
        return view('units.edit', compact('unit'));
    }
}
