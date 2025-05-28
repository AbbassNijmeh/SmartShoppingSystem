<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use App\Mail\OrderShipped;
use Illuminate\Support\Facades\Mail;

class DeliveryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (Auth::user()->role != 'delivery') {
            return redirect()->route('login');
        }
        $orders = Order::with('orderItems')->where('status', '=', 'shipping')->where('delivery_id', '=', Auth::id())->get();
        return view('delivery.index', compact('orders'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function updateStatus(Request $request)
    {
        $request->validate([
            'order_id' => 'required|exists:orders,id',
            'otp' => 'required|string',
        ]);

        $order = Order::findOrFail($request->order_id);

        if (!$order) {
            return redirect()->route('delivery.index')->with('error', 'Order not found.');
        }

        if ($order->delivery_otp !== $request->otp) {
            return redirect()->route('delivery.index')->with('error', 'Invalid OTP.');
        }

        $order->status = 'delivered';
        $order->save();

        return redirect()->route('delivery.index')->with('success', 'Order status updated successfully.');
    }

    /**
     * Resend the OTP for an order.
     */
    public function resendOtp(Request $request)
    {
        $request->validate([
            'order_id' => 'required|exists:orders,id',
        ]);

        $order = Order::findOrFail($request->order_id);

        // Generate a new OTP
        $newOtp = Str::random(6);
        $order->update(['delivery_otp' => $newOtp]);

        // Resend the OTP via email
        Mail::to($order->user->email)->send(new OrderShipped($order));

        return redirect()->route('delivery.index')->with('success', 'A new OTP has been sent to the customer.');
    }
}
