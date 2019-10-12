<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    protected $table = 'customers';

    protected $fillable = ['name', 'phone', 'address', 'credit'];

    public function sale()
    {
        return $this->belongsTo(Sale::class);
    }

    public function credits()
    {
        return $this->hasMany(Credit::class);
    }

    public function getAllCredits($paginate = false)
    {
        $query = $this->credits()->where('is_payback', 0)
            ->orderBy('created_at', 'desc');

        if($paginate) {
            return $query->paginate(10);
        }

        return $query->get();
    }

    public function getAllPaybacks($paginate = false)
    {
        $query = $this->credits()->where('is_payback', 1)->orderBy('created_at', 'desc');

        if($paginate) {
            return $query->paginate(10);
        }

        return $query->get();
    }

    public function getTotalCredits()
    {
        $credits = $this->getAllCredits()->sum('amount');
        $paybacks = $this->getAllPaybacks()->sum('amount');

        return $credits - $paybacks;
    }
}
