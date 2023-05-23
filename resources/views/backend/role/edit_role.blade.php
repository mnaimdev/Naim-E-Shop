@extends('layouts.dashboard')

@section('content')
    <div class="container">
        <div class="col-lg-8 m-auto col-sm-12 col-md-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="mt-3">Edit Role</h3>
                </div>
                <div class="card-body">
                    <form action="{{ route('role.update') }}" method="POST">
                        @csrf

                        @if (session('edit_role'))
                            <div class="alert alert-success">
                                {{ session('edit_role') }}
                            </div>
                        @endif

                        <div class="form-group">

                            <span class="badge badge-secondary">{{ $roles->name }}</span>
                            <input type="hidden" name="role_id" value="{{ $roles->id }}">
                        </div>
                        <div class="form-group">
                            <h5>Select Permission</h5>
                            @foreach ($permissions as $permission)
                                <div>
                                    <input type="checkbox" name="permission[]" value="{{ $permission->id }}"
                                        {{ $roles->hasPermissionTo($permission->id) ? 'checked' : '' }}>

                                    {{ $permission->name }}
                                </div>
                            @endforeach

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
