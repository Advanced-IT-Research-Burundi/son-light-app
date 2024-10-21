<?php

namespace App\Http\Controllers;

use App\Http\Requests\PaymentStoreRequest;
use App\Http\Requests\PaymentUpdateRequest;
use App\Models\Invoice;
use App\Models\Payment;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class PaymentController extends Controller
{
    public function index(Request $request): View
    {
        $payments = Payment::latest()->get();
        return view('payment.index', compact('payments'));
    }

    public function create(Request $request): View
    {
        $invoices = Invoice::latest()->get();
        return view('payment.create', compact('invoices'));
    }

    public function store(PaymentStoreRequest $request): RedirectResponse
    {
        $data = $request->validated();
        $data['user_id'] = Auth::user()->id;
        $payment = Payment::create($data);

        return redirect()->route('payments.index');
    }

    public function show(Request $request, Payment $payment): View
    {
        return view('payment.show', compact('payment'));
    }

    public function edit(Request $request, Payment $payment): View
    {
        $invoices = Invoice::latest()->get();
        return view('payment.edit', compact(['payment','invoices']));
    }

    public function update(PaymentUpdateRequest $request, Payment $payment): RedirectResponse
    {
        $data = $request->validated();
        $data['user_id'] = Auth::user()->id;

        $payment->update($data);

        return redirect()->route('payments.index');
    }

    public function destroy(Request $request, Payment $payment): RedirectResponse
    {
        $payment->delete();

        return redirect()->route('payments.index');
    }
}
