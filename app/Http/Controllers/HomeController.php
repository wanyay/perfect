<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Sale;

use App\Credit;

use App\Purchase;

use App\SupplierCredit;

use App\Expense;

use DB;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $total = Sale::wheredate('created_at', DB::raw('CURDATE()'))->sum('total');
        $invoices = Sale::wheredate('created_at', DB::raw('CURDATE()'))->count();
        $credit = Credit::wheredate('created_at', DB::raw('CURDATE()'))->sum('amount');
        $profit = Sale::wheredate('created_at',DB::raw('CURDATE()'))->sum('profit');
        $p_total = Purchase::wheredate('created_at', DB::raw('CURDATE()'))->sum('total');
        $purchase = Purchase::wheredate('created_at', DB::raw('CURDATE()'))->count();
        $p_credit = SupplierCredit::wheredate('created_at', DB::raw('CURDATE()'))->sum('amount');
        $expense = Expense::wheredate('created_at', DB::raw('CURDATE()'))->sum('amount');
        $today_sale_credit_invoice = Sale::where('credit_due_date', DB::raw('CURDATE()'))->count();
//        $today_purchase_credit_invoice = Purchase::where('credit_due_date', DB::raw('CURDATE()'))->count();
        return view('dashboard',compact(
            'total',
            'invoices',
            'credit',
            'profit',
            'p_total',
            'purchase',
            'p_credit',
            'expense',
            'today_sale_credit_invoice'
        ));
    }
}
