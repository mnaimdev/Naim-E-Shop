@extends('layouts.dashboard')

@section('content')
    <div class="container">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="m-auto">Add Product</h3>
                </div>
                <div class="card-body">
                    <form action="{{ route('product.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <div class="form-group mb-3">
                            <div class="row">
                                <div class="col-lg-6">
                                    <label>Product Name</label>
                                    <input type="text" name="product_name" class="form-control"
                                        value="{{ old('product_name') }}">
                                    @error('product_name')
                                        <strong class="text-danger">
                                            {{ $message }}
                                        </strong>
                                    @enderror
                                </div>

                                <div class="col-lg-6">
                                    <label>Product Price</label>
                                    <input type="number" name="price" class="form-control" value="{{ old('price') }}">
                                    @error('price')
                                        <strong class="text-danger">
                                            {{ $message }}
                                        </strong>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="row">
                                <div class="col-lg-6">
                                    <select name="category_id" class="form-control category_id">
                                        <option value="{{ old('category_id') }}">-- Select Category --</option>
                                        @foreach ($categories as $category)
                                            <option value="{{ $category->id }}">
                                                {{ $category->category_name }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('category_id')
                                        <strong class="text-danger">
                                            {{ $message }}
                                        </strong>
                                    @enderror
                                </div>

                                <div class="col-lg-6">
                                    <select name="subcategory_id" class="form-control subcategory_id">
                                        <option value="{{ old('subcategory_id') }}">-- Select Subcategory --</option>
                                    </select>
                                    @error('subcategory_id')
                                        <strong class="text-danger">
                                            {{ $message }}
                                        </strong>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="row">
                                <div class="col-lg-6">

                                    <input type="number" name="discount" class="form-control" placeholder="Discount"
                                        value="{{ old('discount') }}">
                                    @error('discount')
                                        <strong class="text-danger">
                                            {{ $message }}
                                        </strong>
                                    @enderror
                                </div>

                                <div class="col-lg-6">
                                    <select name="brand_id" class="form-control">
                                        <br>
                                        <option value="{{ old('brand') }}">-- Select Brand --</option>
                                        @foreach ($brands as $brand)
                                            <option value="{{ $brand->id }}">{{ $brand->brand_name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="form-group mb-3">
                            <label>Short Description</label>
                            <input type="text" name="short_desp" class="form-control" value="{{ old('short_desp') }}">
                        </div>

                        <div class="form-group mb-3">
                            <label>Long Description</label>
                            <textarea name="long_desp" class="form-control" id="summernote">
                            </textarea>
                            @error('long_desp')
                                <strong class="text-danger">
                                    {{ $message }}
                                </strong>
                            @enderror
                        </div>

                        <div class="form-group mb-3">
                            <label>Preview Image</label>
                            <input type="file" name="preview" class="form-control">
                            @error('preview')
                                <strong class="text-danger">
                                    {{ $message }}
                                </strong>
                            @enderror
                        </div>

                        <div class="form-group mb-3">
                            <label>Thumbnails</label>
                            <input type="file" name="thumbnail[]" multiple class="form-control">
                            @error('preview')
                                <strong class="text-danger">
                                    {{ $message }}
                                </strong>
                            @enderror
                        </div>

                        <div class="form-group">
                            <button class="btn btn-primary" type="submit">
                                Submit
                            </button>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('footer_scripts')
    <script>
        $('.category_id').change(function() {
            category_id = $(this).val();

            // ajax setup
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $.ajax({
                url: '/getSubcategory',
                type: 'POST',
                data: {
                    'category_id': category_id,
                },
                success: function(data) {
                    $('.subcategory_id').html(data);
                }
            })

        });
    </script>

    <script>
        $(document).ready(function() {
            $('#summernote').summernote();
        });
    </script>

    @if (session('product'))
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
                icon: 'success',
                title: '{{ session('product') }}'
            })
        </script>
    @endif
@endsection
