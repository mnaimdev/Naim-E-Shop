@extends('layouts.dashboard')

@section('content')
    <div class="container">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="mt-3 text-center">Product List</h3>
                </div>
                <div class="card-body">
                    <table class="table">
                        <tr>
                            <th>SL</th>
                            <th>Product Name</th>
                            <th>Product Price</th>
                            <th>Discount</th>
                            <th>Category</th>
                            <th>Brand</th>
                            <th>Preorder</th>
                            <th>Action</th>
                        </tr>
                        @foreach ($products as $sl => $product)
                            <tr>
                                <td>{{ $sl + 1 }}</td>
                                <td>{{ $product->product_name }}</td>
                                <td>{{ $product->price }}</td>
                                <td>{{ $product->discount == null ? 'NA' : $product->discount }}</td>
                                <td>{{ $product->rel_to_category->category_name }}</td>
                                <td>{{ $product->rel_to_brand->brand_name }}</td>
                                <td>
                                    <input data-id="{{ $product->id }}" class="toggle-class" type="checkbox"
                                        data-onstyle="success" data-offstyle="danger" data-toggle="toggle" data-on="Active"
                                        data-off="InActive" {{ $product->preorder ? 'checked' : '' }}>
                                </td>
                                <td>
                                    <div class="d-flex ">
                                        <a href="{{ route('product.inventory', $product->id) }}"
                                            class="btn btn-primary mx-3">Inventory</a>
                                        <a href="{{ route('product.delete', $product->id) }}"
                                            class="btn btn-danger">Delete</a>


                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('footer_scripts')
    @if (session('product_delete'))
        <script>
            const Toast = Swal.mixin({
                toast: true,
                position: 'top-end',
                showConfirmButton: false,
                timer: 3000,
                timerProgressBar: true,
                didOpen: (toast) => {
                    toast.addEventListener('mouseenter', Swal.stopTimer)
                    toast.addEventListener('mouseleave', Swal.resumeTimer)
                }
            })

            Toast.fire({
                icon: "success",
                title: "{{ session('product_delete') }}",
            })
        </script>
    @endif


    <script>
        $(function() {
            $('.toggle-class').change(function() {
                var preorder = $(this).prop('checked') == true ? 1 : 0;
                var product_id = $(this).data('id');



                $.ajax({
                    type: "GET",
                    dataType: "json",
                    url: '/preorder',
                    data: {
                        'preorder': preorder,
                        'product_id': product_id
                    },
                    success: function(data) {
                        console.log(data)
                    }
                });
            })
        })
    </script>
@endsection
