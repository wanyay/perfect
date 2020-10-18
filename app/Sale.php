<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Sale extends Model
{
    protected $table = 'sales';

    protected $fillable = ['code','customer_id','payment_type','profit','cash','discount', 'credit_due_date', 'total'];

    public function customer()
    {
    	return $this->belongsTo('App\Customer');
    }

    public function getDateAttribute()
    {
        return $this->created_at->format('Y-m-d');
    }

    public function generateInvoiceCode()
    {
        $model = self::latest()->first();
        $year = date('Y');
        $month = date('m');
        $totalInvoiceCountByMonths = self::whereMonth('created_at', $month)->whereYear('created_at', $year)->count();
        if (is_null($model)) {

            return $year . $month . "0001";

        } else {
            switch (strlen($totalInvoiceCountByMonths)) {
                case 1:
                    $invoiceNo = "000" . $totalInvoiceCountByMonths;
                    break;
                case 2:
                    $invoiceNo = "00" . $totalInvoiceCountByMonths;
                    break;
                case 3:
                    $invoiceNo = "0" . $totalInvoiceCountByMonths;
                    break;
                default:
                    $invoiceNo = $totalInvoiceCountByMonths;

            }

            return ($year . $month . $invoiceNo) + 1;

        }

    }
}
