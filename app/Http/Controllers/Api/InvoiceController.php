<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\InvoiceRequest;
use App\Helpers\ApiResponse;
use App\Services\InvoiceService;
use App\Models\Customer;
use App\Http\Resources\InvoiceResource;
use App\Models\Invoice;

class InvoiceController extends Controller
{
    public function index($invoice_id)
    {
        $invoice = Invoice::find($invoice_id);
        if (!$invoice) {
            return ApiResponse::sendResponse(400,'This invoice id not found please try with another invoice id',null);
        }

        return new InvoiceResource($invoice);

    }
    public function create(InvoiceRequest $request)
    {
        $input_data = $request->input();
        $input_data['START'] = date('Y-m-d',strtotime($input_data['START']));
        $input_data['END'] = date('Y-m-d',strtotime($input_data['END']));
        //validate requested period doesnot overlap any other period
        $customer = Customer::find($input_data['CUSTOMER_ID']);
        $overlapped_invoices = $customer->invoices()->where(function($q) use ($input_data){
            $q->where('starting_date','<=',$input_data['START'])->where('ending_date','>',$input_data['START']);
        })->orWhere(function($q) use ($input_data){
            $q->where('starting_date','<',$input_data['END'])
            ->where('ending_date','>=',$input_data['END']);
        })->count();

        if ($overlapped_invoices) {
            return ApiResponse::sendResponse(400,'This period overlaps with another period',null);
        }
        // \\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\

        $created_invoice = InvoiceService::create($customer,$input_data['START'],$input_data['END']);
        return ApiResponse::sendResponse(301,'Invoice was created successfully',['id'=>$created_invoice->id]);
    }
}
