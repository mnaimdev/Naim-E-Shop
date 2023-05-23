@extends('layouts.dashboard')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="mt-3">Coupon List</h3>
                    </div>
                    <div class="card-body">
                        <table class="table">
                            <tr>
                                <th>SL</th>
                                <th>Coupon Code</th>

                                <th>Discount Amount</th>
                                <th>Type</th>
                                <th>Validity</th>
                                <th>Action</th>
                            </tr>
                            @foreach ($coupons as $sl => $coupon)
                                <tr>
                                    <td>{{ $sl + 1 }}</td>
                                    <td>{{ $coupon->coupon_code }}</td>
                                    <td>{{ $coupon->discount_amount }}</td>
                                    <td>{{ $coupon->type == 1 ? '%' : 'TK' }}</td>
                                    <td>{{ Carbon\Carbon::now()->diffInDays($coupon->validity, false) }} days left</td>

                                    <td>
                                        <a href="{{ route('coupon.delete', $coupon->id) }}" class="btn btn-danger">Delete</a>
                                    </td>
                                </tr>
                            @endforeach
                        </table>
                    </div>
                </div>
            </div>

            <div class="col-lg-6">
                <div class="card">
                    <div class="card-header">
                        <h3 class="mt-3">Add Coupon</h3>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('coupon.store') }}" method="POST">
                            @csrf

                            <div class="form-group mb-3">

                                <input type="text" name="coupon_code" class="form-control" placeholder="Coupon Code">
                            </div>
                            <div class="form-group mb-3">

                                <select name="type" class="form-control">
                                    <option value="">-- Select Type --</option>
                                    <option value="1">Percentage</option>
                                    <option value="2">Solid Amount</option>
                                </select>
                            </div>
                            <div class="form-group mb-3">

                                <input type="number" name="discount_amount" class="form-control"
                                    placeholder="Discount Amount">
                            </div>
                            <div class="form-group mb-3">

                                <input type="date" name="validity" class="form-control" placeholder="Validity">
                            </div>
                            <div class="form-group mb-3">
                                <button type="submit" class="btn btn-primary">Add Coupon</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

        </div>

    </div>
@endsection
