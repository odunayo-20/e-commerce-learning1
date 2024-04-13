<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Mail\InvoiceOrderMailable;
use App\Models\Order;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Mail;

class OrderController extends Controller
{
    public function index(Request $request)
    {
        // $today = Carbon::now();
        // $orders = Order::whereDate('created_at', $today)->paginate(7);
        $today = Carbon::now()->format('Y-m-d');
        $orders = Order::when($request->date != null, function ($q) use ($request) {
            return $q->whereDate('created_at', $request->date);
        }, function ($q) use ($today) {
            return $q->whereDate('created_at', $today);
        })
            ->when($request->status != null, function ($q) use ($request) {
                return $q->where('status_message', $request->status);
            })
            ->paginate(7);

        return view('admin.orders.index', compact('orders'));
    }

    public function show(int $orderId)
    {
        // $today = Carbon::now()->format('Y-m-d');
        $order = Order::where('id', $orderId)->first();

        if ($order) {
            return view('admin.orders.view', compact('order'));
        } else {
            session()->flash('error', 'Order Id Not Found');

            return redirect(route('admin.order'));
        }

    }

    public function updateOrderStatus(int $orderId, Request $request)
    {
        // dd('do Something');

        $order = Order::where('id', $orderId)->first();
        if ($order) {
            $order->update([
                'status_message' => $request->order_status,
            ]);
            session()->flash('success', 'Order Status Updated');

            return redirect()->back();
        } else {
            session()->flash('error', 'Order Id Not Found');

            return redirect(route('admin.order'));
        }

    }

    public function viewInvoice(int $orderId)
    {
        $order = Order::findOrFail($orderId);

        return view('admin.invoice.view-invoice', compact('order'));
    }

    public function generateInvoice(int $orderId)
    {

        $order = Order::findOrFail($orderId);
        $data = ['order' => $order];
        $todayDate = Carbon::now()->format('Y-m-d');
        $pdf = Pdf::loadView('admin.invoice.view-invoice', $data);

        return $pdf->download('invoice'.'-'.$order->id.'-'.$todayDate.'.pdf');
    }

    public function mailInvoice($orderId){
        $order = Order::findOrFail($orderId);
        Mail::to($order->email)->send(new InvoiceOrderMailable($order));
        session()->flash('success', 'Invoice Mail has been sent to'.' '. $order->email);
        return redirect()->back();
    }
}