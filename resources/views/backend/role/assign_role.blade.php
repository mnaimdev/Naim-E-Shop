@extends('layouts.dashboard')

@section('content')
    <div class="container" style="margin-top: 100px;">
        <div class="col-lg-12 col-md-12 col-sm-12">
            <div class="card">
                <div class="card-header">
                    <h3>Assigned List</h3>
                </div>
                <div class="card-body">
                    <table class="table table-striped">
                        <tr>
                            <th>SL</th>
                            <th>User</th>
                            <th>Role</th>
                            <th>Permission</th>
                            <th>Action</th>
                        </tr>
                        @foreach ($users as $sl => $user)
                            <tr>
                                <td>{{ $sl + 1 }}</td>
                                <td>
                                    {{ $user->name }}
                                </td>
                                <td>
                                    @forelse ($user->getRoleNames() as $role)
                                        <span class="badge badge-info">
                                            {{ $role }}
                                        </span>
                                    @empty
                                        <span>N/A</span>
                                    @endforelse
                                </td>
                                <td>
                                    @forelse ($user->getAllPermissions() as $permission)
                                        <span class="badge badge-secondary badge-sm m-1">
                                            {{ $permission->name }}
                                        </span>
                                    @empty
                                        <span>N/A</span>
                                    @endforelse
                                </td>
                                <td>
                                    <a href="{{ route('edit.user.permission', $user->id) }}"
                                        class="btn btn-primary my-3">Edit</a>
                                    <a href="{{ route('delete.user.permission', $user->id) }}" class="btn btn-danger">X</a>
                                </td>
                            </tr>
                        @endforeach
                    </table>
                </div>
            </div>
        </div>

        <div class="col-lg-6 col-sm-12 col-md-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="mt-3">Assign Role</h3>
                </div>
                <div class="card-body">
                    <form action="{{ route('assign.user.role') }}" method="POST">
                        @csrf

                        @if (session('assign'))
                            <div class="alert alert-success">
                                {{ session('assign') }}
                            </div>
                        @endif

                        <div class="form-group">
                            <select name="user_id" class="form-control">
                                <option>-- Select User --</option>
                                @foreach ($users as $user)
                                    <option value="{{ $user->id }}">{{ $user->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <select name="role_id" class="form-control">
                                <option>-- Select Role --</option>
                                @foreach ($roles as $role)
                                    <option value="{{ $role->id }}">{{ $role->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <button class="btn btn-primary" type="submit">Add</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
