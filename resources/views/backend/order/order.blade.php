@extends('layouts.dashboard')

@section('content')
    <div class="container">
        <div class="col-lg-12">
            <div class="card" style="margin-top: 100px;">
                <div class="card-header">
                    <h3 class="mt-3">Orders List</h3>
                </div>
                <div class="card-body">
                    <table class="table">
                        <tr>
                            <th>SL</th>
                            <th>Order Id</th>
                            <th>Status</th>
                            <th>Total</th>
                            <th>Action</th>
                        </tr>

                        @foreach ($orders as $sl => $order)
                            <tr>
                                <td>{{ $sl + 1 }}</td>
                                <td>{{ $order->order_id }}</td>
                                <td>
                                    @php
                                        if ($order->status == 0) {
                                            echo 'placed';
                                        }
                                        
                                        if ($order->status == 1) {
                                            echo 'packaging';
                                        }
                                        
                                        if ($order->status == 2) {
                                            echo 'shipped';
                                        }
                                        
                                        if ($order->status == 3) {
                                            echo 'ready to deliver';
                                        }
                                        
                                        if ($order->status == 4) {
                                            echo 'delivered';
                                        }
                                        
                                    @endphp
                                </td>
                                <td>{{ $order->total }} TK</td>
                                <td>
                                    <form action="{{ route('order.status') }}" method="POST">
                                        @csrf

                                        <button type="submit" name="status" value="{{ $order->order_id . ',' . 0 }}"
                                            class=" btn-primary">placed</button>

                                        <button type="submit" name="status" value="{{ $order->order_id . ',' . 1 }}"
                                            class=" btn-info">packaging</button>

                                        <button type="submit" name="status" value="{{ $order->order_id . ',' . 2 }}"
                                            class=" btn-secondary">shipped</button>

                                        <button type="submit" name="status" value="{{ $order->order_id . ',' . 3 }}"
                                            class=" btn-danger">ready to deliver</button>

                                        <button type="submit" name="status" value="{{ $order->order_id . ',' . 4 }}"
                                            class=" btn-dark">delivered</button>

                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
