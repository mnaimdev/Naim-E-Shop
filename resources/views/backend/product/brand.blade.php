@extends('layouts.dashboard')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-lg-8 col-sm-12 col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="mt-3">Brand List</h3>
                    </div>
                    <div class="card-body">
                        <table class="table">
                            <tr>
                                <th>SL</th>
                                <th>Brand Name</th>
                                <th>Brand Image</th>
                                <th>Action</th>
                            </tr>
                            @foreach ($brands as $sl => $brand)
                                <tr>
                                    <td>{{ $sl + 1 }}</td>
                                    <td>{{ $brand->brand_name }}</td>
                                    <td>
                                        <img width="100" src="{{ asset('/uploads/brand') }}/{{ $brand->brand_image }}"
                                            alt="">
                                    </td>
                                    <td>
                                        <a href="{{ route('brand.remove', $brand->id) }}" class="btn btn-danger">
                                            X
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        </table>
                    </div>
                </div>
            </div>

            <div class="col-lg-4 col-sm-12 col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="mt-3">Add Brand</h3>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('brand.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf

                            <div class="form-group mb-3">
                                <label>Brand Name</label>
                                <input type="text" name="brand_name" class="form-control">
                            </div>

                            <div class="form-group mb-3">
                                <label>Brand Image</label>
                                <input type="file" name="brand_image" class="form-control">
                            </div>

                            <div class="form-group mb-3">
                                <button class="btn btn-primary" type="submit">Add Brand</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
