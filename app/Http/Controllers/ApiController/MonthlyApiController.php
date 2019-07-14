<?php

namespace App\Http\Controllers\ApiController;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

use Response;

use App\Sale;

use App\Credit;

use App\Purchase;

use App\SupplierCredit;

use App\Expense;

use App\SaleItem;

use DB;

class MonthlyApiController extends Controller
{
    public function getMonthlyForm()
    {
            return view('report.monthly');
    }

    public function getMonthlyData(Request $request)
    {
    	$formData = $request->all();

    	$total = Sale::month($formData['month'],$formData['year'])->sum('total');
        $invoices = Sale::month($formData['month'],$formData['year'])->count();
        $credit = Credit::month($formData['month'],$formData['year'])->sum('amount');
        $profit = Sale::month($formData['month'],$formData['year'])->sum('profit');
        $p_total = Purchase::month($formData['month'],$formData['year'])->sum('total');
        $purchase = Purchase::month($formData['month'],$formData['year'])->count();
        $p_credit = SupplierCredit::month($formData['month'],$formData['year'])->sum('amount');
        $expense = Expense::month($formData['month'],$formData['year'])->sum('amount');
        $items = SaleItem::with('item')->month($formData['month'],$formData['year'])->select('item_id',DB::raw('SUM(qty) as total'))->groupBy('item_id')->get();

        $data = [
                    "info" => [
                        "s_total" => $total,
                        "invoices" => $invoices,
                        "credit" => $credit,
                        "profit" => $profit,
                        "p_total" => $p_total,
                        "p_invoices" => $purchase,
                        "p_credit" => $p_credit,
                        "expense" => $expense
                    ],
                    'itmes' => $items
                ];

        return Response::json($data);
    	
    }
}