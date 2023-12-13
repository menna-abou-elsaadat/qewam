<?php

namespace App\Services;

use App\Models\CustomerUser;
use App\Models\UserSession;
use App\Models\Invoice;
use App\Models\InvoiceUser;
use App\Models\InvoiceUserSession;

class InvoiceService
{

	public static function create($customer,$starting_date,$ending_date)
	{
		$registered_users_within_period = $customer->registeredUsersWithin($starting_date,$ending_date)
			->pluck('id')->toArray();

		$users_id_activated_or_appointment_users_sessions_within_period = $customer->activatedOrAppoitmentUsersSessionsWIthin($starting_date,$ending_date)->pluck('user_id')->toArray();

		$users_ids = array_unique(array_merge($registered_users_within_period,$users_id_activated_or_appointment_users_sessions_within_period));

		// create invoice object
		$invoice = new Invoice();
		$invoice->customer_id = $customer->id;
		$invoice->starting_date = $starting_date;
		$invoice->ending_date = $ending_date;
		$invoice->save();
		////////////////////////////////////
		foreach ($users_ids as $key => $user_id) {
			$user = CustomerUser::find($user_id);
			$total_paid = $user->invoicesTotalPaid();
			
			$prices_array = [];

			if ($user->isRegisteredWithin($starting_date,$ending_date)) {
				
				$prices_array['registered'] = config('constants.registration');
			}

			$activated_sessions_id_array = $user->activatedSessionsIfNoInvoicedSessionsWithin($starting_date,$ending_date);

			if (count($activated_sessions_id_array) > 0) {

				$prices_array['activated_session'] = config('constants.activation');
			}

			$appointment_sessions_id_array = $user->appointmentSessionsIfNoInvoicedSessionsWithin($starting_date,$ending_date);

			if (count($appointment_sessions_id_array) > 0) {

				$prices_array['appointment_session'] = config('constants.appointment');
			}

			$max_price = max($prices_array);
			$max_session_price = array_search($max_price,$prices_array);
			if ($max_price > $total_paid) {

				$price_will_be_paid = $max_price - $total_paid;
			}
			else
			{
				$price_will_be_paid = 0;
			}
			
			
			if (count($prices_array) > 0) {
				//create invoice user object
				$invoice_user = new InvoiceUser();
				$invoice_user->invoice_id = $invoice->id;
				$invoice_user->user_id = $user_id;
				$invoice_user->save();

				if (isset($prices_array['registered'])) {
					
					$invoice_user_session = new InvoiceUserSession();
					$invoice_user_session->invoice_user_id = $invoice_user->id;
					if ($max_session_price == 'registered') {
						$invoice_user_session->price = $price_will_be_paid;
					}
					$invoice_user_session->session_type = 'Registration';
					$invoice_user_session->invoice_id = $invoice->id;
					$invoice_user_session->save();
				}

				foreach ($activated_sessions_id_array as $key => $session_id) {
					$session = UserSession::find($session_id);
					$session->invoiced = 1;
					$session->save();

					$invoice_user_session = new InvoiceUserSession();
					$invoice_user_session->invoice_user_id = $invoice_user->id;
					if ($max_session_price == 'activated_session' && $key == 0) {
						$invoice_user_session->price = $price_will_be_paid;
					}
					$invoice_user_session->user_session_id = $session_id;
					$invoice_user_session->session_type = 'Activation';
					$invoice_user_session->invoice_id = $invoice->id;
					$invoice_user_session->save();

				}

				foreach ($appointment_sessions_id_array as $key => $session_id) {
					$session = UserSession::find($session_id);
					$session->invoiced = 1;
					$session->save();

					$invoice_user_session = new InvoiceUserSession();
					$invoice_user_session->invoice_user_id = $invoice_user->id;
					if ($max_session_price == 'appointment_session' && $key == 0) {
						$invoice_user_session->price = $price_will_be_paid;
					}
					$invoice_user_session->user_session_id = $session_id;
					$invoice_user_session->session_type = 'Appointment';
					$invoice_user_session->invoice_id = $invoice->id;
					$invoice_user_session->save();

				}

			}
			
		}

		return $invoice;

	}
}
?>