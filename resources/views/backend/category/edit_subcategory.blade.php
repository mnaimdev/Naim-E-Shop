@extends('layouts.dashboard')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-lg-8 m-auto">
                <div class="card" style="margin-top: 100px;">
                    <div class="card-header">
                        <h3 class="mt-3">Edit Subcategory</h3>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('subcategory.update') }}" method="POST">
                            @csrf

                            @if (session('update_sub'))
                                <div class="alert alert-success">
                                    {{ session('update_sub') }}
                                </div>
                            @endif

                            <div class="form-group">
                                <input type="hidden" value="{{ $subcategory_info->id }}" name="subcategory_id">

                                <select name="category_id" class="form-control">
                                    <option>-- Select Category --</option>
                                    @foreach ($categories as $category)
                                        <option {{ $category->id == $subcategory_info->category_id ? 'selected' : '' }}
                                            value="{{ $category->id }}">
                                            {{ $category->category_name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Sub Category</label>
                                <input type="text" class="form-control" name="subcategory_name"
                                    value="{{ $subcategory_info->subcategory_name }}">

                            </div>
                            <div class="form-group">
                                <button type="submit" class="btn btn-primary">Update</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
