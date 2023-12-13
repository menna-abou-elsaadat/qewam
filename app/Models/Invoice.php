<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    use HasFactory;

    public function sessions()
    {
        return $this->hasMany(InvoiceUserSession::class);
    }
    public function totalPrice()
    {
        return $this->sessions()->sum('price');
    }
    public function users()
    {
        return $this->hasMany(InvoiceUser::class);
    }
}
