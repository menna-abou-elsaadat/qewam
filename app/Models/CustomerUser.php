<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CustomerUser extends Model
{
    use HasFactory;

     public function sessions()
    {
        return $this->hasMany(UserSession::class,'user_id');
    }

    public function activatedSessions()
    {
        return $this->sessions()->whereNotNull('activation_date');
    }

    public function appointmentSessions()
    {
        return $this->sessions()->whereNotNull('appointment_date');
    }

    public function invoiceUser()
    {
        return $this->hasMany(InvoiceUser::class,'user_id');
    }

    public function invoicesTotalPaid()
    {
        return $this->invoiceUser()->join('invoice_user_sessions','invoice_user_sessions.invoice_user_id','invoice_users.id')->sum('price');
    }

    public function isRegisteredWithin($starting_date,$ending_date)
    {
        if ($this->registration_date >= $starting_date &&  $this->registration_date <= $ending_date) {
            return true;
        }
        return false;
    }

    public function activatedSessionsIfNoInvoicedSessionsWithin($starting_date,$ending_date)
    {
        $invoiced_sessions_count = $this->activatedSessions()->where('invoiced',1)->count();
        if ($invoiced_sessions_count == 0) {
            return $this->activatedSessions()->where('activation_date','>=',$starting_date)
            ->Where('activation_date','<=',$ending_date)->pluck('id')->toArray();
        }
        return [];
    }

    public function appointmentSessionsIfNoInvoicedSessionsWithin($starting_date,$ending_date)
    {
        $invoiced_sessions_count = $this->appointmentSessions()->where('invoiced',1)->count();
        if ($invoiced_sessions_count == 0) {
            return $this->appointmentSessions()->where('appointment_date','>=',$starting_date)
            ->Where('appointment_date','<=',$ending_date)->pluck('id')->toArray();
        }
        return []; 
    }
}
