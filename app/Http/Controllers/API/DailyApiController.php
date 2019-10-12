<?php

namespace App\Http\Controllers\API;

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

class DailyApiController extends Controller
{
	public function daily()
	{
        $total = Sale::today()->sum('total');
        $invoices = Sale::today()->count();
        $credit = Credit::today()->sum('amount');
        $profit = Sale::today()->sum('profit');
        $p_total = Purchase::today()->sum('total');
        $purchase = Purchase::today()->count();
        $p_credit = SupplierCredit::today()->sum('amount');
        $expense = Expense::today()->sum('amount');
        $items = SaleItem::with('item')->today()->select('item_id',DB::raw('SUM(qty) as total'))->groupBy('item_id')->get();

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

    public function dailychange($date)
    {
    $total = Sale::whereDate('created_at',$date)->sum('total');
    $invoices = Sale::whereDate('created_at',$date)->count();
    $credit = Credit::whereDate('created_at',$date)->where('is_payback', false )->sum('amount');
    $profit = Sale::whereDate('created_at',$date)->sum('profit');
    $p_total = Purchase::whereDate('created_at',$date)->sum('total');
    $purchase = Purchase::whereDate('created_at',$date)->count();
    $p_credit = SupplierCredit::whereDate('created_at',$date)->sum('amount');
    $expense = Expense::whereDate('created_at',$date)->sum('amount');
    $items = SaleItem::with('item')->whereDate('created_at',$date)->select('item_id',DB::raw('SUM(qty) as total'))->groupBy('item_id')->get();

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
