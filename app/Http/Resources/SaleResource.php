<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class SaleResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            "id" => $this->id,
            "code" => $this->code,
            "total" => $this->total,
            "profit" => $this->profit,
            "customer" => $this->customer,
            "date" => $this->date
        ];
    }
}
