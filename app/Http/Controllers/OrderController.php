<?php

namespace App\Http\Controllers;

use App\Models\BillingDetail;
use App\Models\Order;
use App\Models\OrderProduct;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use PDF;

class OrderController extends Controller
{
    function order()
    {
        $orders = Order::all();

        return view('backend.order.order', [
            'orders' => $orders,
        ]);
    }

    function order_status(Request $request)
    {
        $after_explode = explode(',', $request->status);
        $order_id = $after_explode[0];
        $status = $after_explode[1];

        Order::where('order_id', $order_id)->update([
            'status' => $status,
        ]);

        return back();
    }



    function invoice_download($id)
    {

        $orders = Order::find($id);
        $order_id = $orders->order_id;


        $billing_details = BillingDetail::where('order_id', $order_id)->get();
        $order_products = OrderProduct::where('order_id', $order_id)->get();
        $order_info = Order::where('order_id', $order_id)->first();

        $pdf = Pdf::loadView('invoice.download', [
            'billing_details'   => $billing_details,
            'order_products'    => $order_products,
            'order_info'        => $order_info,
        ]);

        return $pdf->download('invoice.pdf');
    }
}
