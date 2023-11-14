<?php

namespace App\Http\Controllers;

use App\Events\InvoicePaid;
use App\Models\Invoice;
use Illuminate\Http\Request;

class InvoiceController extends Controller
{
    public function handleWebhook(Request $request)
    {
        $invoice_number = $request->data['tx_ref'];
        $invoice = Invoice::where('invoice_number', $invoice_number)->first();
        if ($request->data['status'] == "successful" && $request->data['amount'] >= $invoice->amount)
        {
            $invoice->update(["status" => "paid", "paid_at" => now()]);
            event(new InvoicePaid($invoice));
        }

        return response("ok", 200);
    }
}
