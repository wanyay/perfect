<?php

namespace App\Http\Controllers;

use App\Credit;

use App\Customer;

use Carbon\Carbon;
use Illuminate\Http\Request;

class CreditController extends Controller
{
    /**
     * show all credit of Customer
     *
     * @return view
     * @param cusotmer id
     */
    public function show($id)
    {
        $customer = Customer::findOrFail($id);

        $credits = $customer->getAllCredits(true);
        $paybacks = $customer->getAllPaybacks(true);

        $total = $customer->getTotalCredits();

        return view('customer.credit', compact('customer', 'credits', 'total', 'paybacks'));
    }

    public function payback(Request $request)
    {
        Credit::create([
            'customer_id' => $request->customer_id,
            'amount'=> $request->amount,
            'is_payback' => 1,'remark'=>'Payback',
            'created_at' => Carbon::parse($request->date)
        ]);
        return redirect()->route('credit.show', $request->customer_id);
    }

    public function destroy(Credit $credit)
    {
        try {
            $credit->delete();
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()],500);
        }

        return response()->json(['status' => 'success']);
    }
}
