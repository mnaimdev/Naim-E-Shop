@extends('layouts.dashboard')


@section('content')
    <div class="container">

        <div class="col-sm-12 col-lg-12 col-md-12">
            <div class="card">
                <div class="card-header">
                    <h3>Subcategory List</h3>
                </div>
                <div class="card-body">

                    @if (session('del_sub'))
                        <div class="alert alert-danger">
                            {{ session('del_sub') }}
                        </div>
                    @endif

                    <table class="table">
                        <tr>
                            <td>SL</td>
                            <td>Subcategory Name</td>
                            <td>Category Name</td>
                            <td>Added By</td>
                            <td>Action</td>
                        </tr>
                        @foreach ($subcategories as $sl => $subcategory)
                            <tr>
                                <td>{{ $sl + 1 }}</td>
                                <td>{{ $subcategory->subcategory_name }}</td>
                                <td>{{ $subcategory->rel_to_category->category_name }}</td>
                                <td>{{ $subcategory->rel_to_user->name }}</td>
                                <td>
                                    <a href="{{ route('edit.subcategory', $subcategory->id) }}"
                                        class="btn btn-primary">Edit</a>

                                    <a href="{{ route('delete.subcategory', $subcategory->id) }}"
                                        class="btn btn-danger">X</a>
                                </td>
                            </tr>
                        @endforeach
                    </table>
                </div>
            </div>
        </div>

        <div class="col-sm-12 col-lg-12 col-md-12">
            <div class="card">
                <div class="card-header">
                    <h3>Add Subcategory</h3>
                </div>
                <div class="card-body">
                    <form action="{{ route('subcategory.store') }}" method="POST">
                        @csrf

                        @if (session('subcategory'))
                            <div class="alert alert-success">
                                {{ session('subcategory') }}
                            </div>
                        @endif

                        <div class="form-group mb-3">
                            <label>Subcategory Name</label>
                            <input type="text" name="subcategory_name" class="form-control">
                            @error('subcategory_name')
                                <strong class="text-danger">
                                    {{ $message }}
                                </strong>
                            @enderror
                        </div>

                        <div class="form-group mb-3">
                            <select name="category_id" class="form-control">
                                <option>-- Select Category --</option>

                                @foreach ($categories as $category)
                                    <option value="{{ $category->id }}">{{ $category->category_name }}</option>
                                @endforeach

                            </select>
                        </div>

                        <div class="form-group mb-3">
                            <button class="btn btn-primary" type="submit">Add</button>
                        </div>

                    </form>
                </div>
            </div>
        </div>

    </div>
@endsection
