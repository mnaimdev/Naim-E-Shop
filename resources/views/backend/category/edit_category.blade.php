@extends('layouts.dashboard')

@section('content')
    <div class="container">
        <div class="col-lg-8 m-auto col-sm-12 col-md-12">
            <div class="card">
                <div class="card-header">
                    <h3>Edit Category</h3>
                </div>
                <div class="card-body">
                    <form action="{{ route('category.update') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        @if (session('category_update'))
                            <div class="alert alert-success">
                                {{ session('category_update') }}
                            </div>
                        @endif

                        <div class="form-group mb-3">
                            <input type="text" name="category_name" value="{{ $category->category_name }}"
                                class="form-control">

                            <input type="hidden" name="category_id" value="{{ $category->id }}">

                        </div>

                        <div class="form-group mb-3">
                            <input type="file" name="cat_img" class="form-control"
                                onchange="document.getElementById('blah').src = window.URL.createObjectURL(this.files[0])">
                        </div>

                        <div class="form-group mb-3">
                            <img width="200" src="{{ asset('/uploads/category') }}/{{ $category->cat_img }}"
                                id="blah" alt="">
                        </div>

                        <div class="form-group">
                            <button class="btn btn-primary" type="submit">Update</button>
                        </div>



                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
