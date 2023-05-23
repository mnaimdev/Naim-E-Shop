@extends('layouts.dashboard')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-lg-8">
                <div class="card">
                    <div class="card-header">
                        <h3>
                            Color List
                        </h3>

                        @if (session('color_delete'))
                            <div class="alert alert-danger">
                                {{ session('color_delete') }}
                            </div>
                        @endif
                    </div>

                    <div class="card-body">
                        <table class="table">
                            <tr>
                                <th>SL</th>
                                <th>Color Name</th>
                                <th>Color</th>
                                <th>Action</th>
                            </tr>
                            @foreach ($colors as $sl => $color)
                                <tr>
                                    <td>{{ $sl + 1 }}</td>
                                    <td>{{ $color->color_name }}</td>
                                    <td>
                                        @if ($color->color_code == '')
                                            <div>
                                                No Color
                                            </div>
                                        @else
                                            <div
                                                style="height: 30px;
                                                 width: 100px;
                                                 padding: 5px;
                                                 color: white;
                                                text-align: center;
                                               background-color: {{ $color->color_code }}">
                                            </div>
                                        @endif

                                    </td>
                                    <td>
                                        <a href="{{ route('color.delete', $color->id) }}" class="btn btn-danger">Delete</a>
                                    </td>
                                </tr>
                            @endforeach
                        </table>
                    </div>
                </div>
            </div>

            <div class="col-lg-4">
                <div class="card">
                    <div class="card-header">
                        <h3 class="mt-3">
                            Add Color
                        </h3>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('color.store') }}" method="POST">
                            @csrf

                            @if (session('color'))
                                <div class="alert alert-success">
                                    {{ session('color') }}
                                </div>
                            @endif

                            <div class="form-group">
                                <input type="text" name="color_name" class="form-control" placeholder="Color Name">
                                @error('color_name')
                                    <strong class="text-danger">
                                        {{ $message }}
                                    </strong>
                                @enderror
                            </div>
                            <div class="form-group">
                                <input type="text" name="color_code" class="form-control" placeholder="Color Code">
                            </div>
                            <div class="form-group">
                                <button type="submit" class="btn btn-primary">Add Color</button>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>


        <div class="row">
            <div class="col-lg-8">
                <div class="card" style="margin-top: 100px;">
                    <div class="card-header">
                        <h3 class="mt-3">
                            Size List
                        </h3>

                        @if (session('size_delete'))
                            <div class="alert alert-danger">
                                {{ session('size_delete') }}
                            </div>
                        @endif
                    </div>

                    <div class="card-body">
                        <table class="table">
                            <tr>
                                <th>SL</th>
                                <th>Size Name</th>
                                <th>Action</th>
                            </tr>
                            @foreach ($sizes as $sl => $size)
                                <tr>
                                    <td>{{ $sl + 1 }}</td>
                                    <td>{{ $size->size_name }}</td>

                                    <td>
                                        <a href="{{ route('size.delete', $size->id) }}" class="btn btn-danger">Delete</a>
                                    </td>
                                </tr>
                            @endforeach
                        </table>
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="card" style="margin-top: 100px;">
                    <div class="card-header">
                        <h3 class="mt-3">
                            Add Size
                        </h3>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('size.store') }}" method="POST">
                            @csrf

                            @if (session('size'))
                                <div class="alert alert-success">
                                    {{ session('size') }}
                                </div>
                            @endif

                            <div class="form-group">
                                <input type="text" name="size_name" class="form-control" placeholder="Size Name">
                                @error('size_name')
                                    <strong class="text-danger">
                                        {{ $message }}
                                    </strong>
                                @enderror
                            </div>

                            <div class="form-group">
                                <button type="submit" class="btn btn-primary">Add Size</button>
                            </div>

                        </form>
                    </div>
                </div>
            </div>

        </div>


    </div>
@endsection
