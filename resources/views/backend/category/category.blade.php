@extends('layouts.dashboard')

@section('content')
    <div class="container">
        <div class="col-lg-12 col-sm-12 col-md-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="mt-2">Show Category</h3>
                </div>
                <div class="card-body">

                    @if (session('category_del'))
                        <div class="alert alert-danger">
                            {{ session('category_del') }}
                        </div>
                    @endif

                    <table class="table table-striped">
                        <tr>
                            <th>SL</th>
                            <th>Category Name</th>
                            <th>Category Image</th>
                            <th>Added By</th>
                            <th>Action</th>
                        </tr>
                        @foreach ($categories as $sl => $category)
                            <tr>
                                <td>{{ $sl + 1 }}</td>
                                <td>{{ $category->category_name }}</td>
                                <td>
                                    <img class="rounded-circle" width="70" height="70"
                                        src="{{ asset('/uploads/category') }}/{{ $category->cat_img }}" alt="">
                                </td>
                                <td>
                                    {{ $category->rel_to_user->name }}
                                </td>
                                <td>
                                    <a href="{{ route('category.edit', $category->id) }}" class="btn btn-primary">Edit</a>

                                    <a href="{{ route('category.delete', $category->id) }}"
                                        class="btn btn-danger">Delete</a>
                                </td>
                            </tr>
                        @endforeach
                    </table>
                </div>
            </div>
        </div>
        <div class="col-lg-12 col-sm-12 col-md-12">
            <div class="card" style="margin-top: 100px;">
                <div class="card-header">
                    <h3 class="mt-2">Add Category</h3>
                </div>
                <div class="card-body">
                    <form action="{{ route('category.store') }}" method="post" enctype="multipart/form-data">
                        @csrf

                        @if (session('category'))
                            <div class="alert alert-success">
                                {{ session('category') }}
                            </div>
                        @endif

                        <div class="form-group">
                            <label>Category Name</label>
                            <input type="text" class="form-control" name="category_name">
                            @error('category_name')
                                <strong class="text-danger">{{ $message }}</strong>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label>Category Image</label>
                            <input type="file" class="form-control" name="cat_img"
                                onchange="document.getElementById('blah').src = window.URL.createObjectURL(this.files[0])">
                            @error('cat_img')
                                <strong class="text-danger">{{ $message }}</strong>
                            @enderror
                        </div>

                        <div class="form-group">
                            <img width="200" id="blah" alt="">
                        </div>

                        <div class="form-group">
                            <button type="submit" class="btn btn-primary">Add</button>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
