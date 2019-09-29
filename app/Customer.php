<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    protected $table = 'customers';

    protected $fillable = ['name', 'phone', 'address', 'credit'];

    public function sale()
    {
        return $this->belongsTo('App\Sale');
    }

    public function credits()
    {
        return $this->hasMany('App\Credit');
    }

    public function getAllCredits($paginate = false)
    {
        $query = $this->credits()->where('is_payback', 0)->orderBy('created_at', 'desc');

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

    public function getTotalCreditsAttribute()
    {
        $credits = $this->getAllCredits()->sum('amount');
        $paybacks = $this->getAllPaybacks()->sum('amount');

        return $credits - $paybacks;
    }
}
