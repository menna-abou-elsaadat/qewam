<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory;

    public function invoices()
    {
        return $this->hasMany(Invoice::class);
    }

    public function users()
    {
        return $this->hasMany(CustomerUser::class);
    }

    public function registeredUsersWithin($starting_date,$ending_date)
    {
        return $this->users()->whereNotNull('registration_date')
            ->where('registration_date','>=',$starting_date)
            ->Where('registration_date','<=',$ending_date);
    }

    public function activatedOrAppoitmentUsersSessionsWIthin($starting_date,$ending_date)
    {
        return $this->users()->join('user_sessions','customer_users.id','user_sessions.user_id')
        ->where(function($q) use ($starting_date,$ending_date){
            $q->whereNotNull('activation_date')
            ->where('activation_date','>=',$starting_date)
            ->Where('activation_date','<=',$ending_date);
        })->orWhere(function($q) use ($starting_date,$ending_date){
            $q->whereNotNull('appointment_date')
            ->where('appointment_date','>=',$starting_date)
            ->Where('appointment_date','<=',$ending_date);
        });
    }

}
