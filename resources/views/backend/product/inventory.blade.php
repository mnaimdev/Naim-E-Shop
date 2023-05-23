@extends('layouts.dashboard')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-lg-8 col-sm-12 col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h3>Inventory List</h3>
                    </div>
                    <div class="card-body">
                        <table class="table table-striped">
                            <tr>
                                <th>SL</th>
                                <th>Product Name</th>
                                <th>Color</th>
                                <th>Size</th>
                                <th>Quantity</th>
                                <th>Action</th>
                            </tr>
                            @foreach ($inventories as $sl => $inventory)
                                <tr>
                                    <td>{{ $sl + 1 }}</td>
                                    <td>{{ $inventory->rel_to_product->product_name }}</td>
                                    <td>{{ $inventory->rel_to_color->color_name }}</td>
                                    <td>{{ $inventory->rel_to_size->size_name }}</td>
                                    <td>{{ $inventory->quantity }}</td>
                                    <td>
                                        <a href="{{ route('delete.inventory', $inventory->id) }}"
                                            class="btn btn-danger">Delete</a>
                                    </td>
                                </tr>
                            @endforeach
                        </table>
                    </div>
                </div>
            </div>

            <div class="col-lg-4 col-md-12 col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <h3>Product Inventory</h3>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('inventory.store') }}" method="POST">
                            @csrf

                            <div class="form-group">
                                <h3 class="bg-secondary p-2 text-white">{{ $product->product_name }}</h3>
                                <input type="hidden" name="product_id" value="{{ $product->id }}">
                            </div>

                            <div class="form-group mb-3">
                                <select name="color_id" class="form-control">
                                    <option>-- Select Color --</option>
                                    @foreach ($colors as $color)
                                        <option value="{{ $color->id }}">
                                            {{ $color->color_name }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('color_id')
                                    <strong class="text-danger">
                                        {{ $message }}
                                    </strong>
                                @enderror
                            </div>

                            <div class="form-group mb-3">
                                <select name="size_id" class="form-control">
                                    <option>-- Select Size --</option>
                                    @foreach ($sizes as $size)
                                        <option value="{{ $size->id }}">
                                            {{ $size->size_name }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('size_id')
                                    <strong class="text-danger">
                                        {{ $message }}
                                    </strong>
                                @enderror
                            </div>

                            <div class="form-group mb-3">
                                <input type="number" name="quantity" class="form-control" placeholder="Quantity">
                                @error('quantity')
                                    <strong class="text-danger">
                                        {{ $message }}
                                    </strong>
                                @enderror
                            </div>

                            <div class="form-group mb-3">
                                <button class="btn btn-primary" type="submit">Add</button>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
