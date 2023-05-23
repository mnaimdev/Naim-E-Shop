@extends('layouts.dashboard')

@section('content')
    <div class="container">
        <div class="col-lg-12 col-sm-12 col-md-12">

            <div class="card">
                <div class="card-header">
                    <h3 class="mt-2 py-4 m-auto">Users List
                    </h3>
                </div>
                <div class="card-body">

                    <table class="table table-striped">
                        <tr>
                            <th>SL</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Image</th>
                            <th>Action</th>
                        </tr>
                        @foreach ($users as $sl => $user)
                            <tr>
                                <td>{{ $sl + 1 }}</td>
                                <td>{{ $user->name }}</td>
                                <td>{{ $user->email }}</td>
                                <td>
                                    @if ($user->photo == '')
                                        <img width="64" src="{{ Avatar::create($user->name)->toBase64() }}" />
                                    @else
                                        <img class="rounded-circle" width="64" height="64"
                                            src="{{ asset('/uploads/user') }}/{{ $user->photo }}" alt="">
                                    @endif

                                </td>
                                <td>
                                    <a data-parent="{{ route('user.delete', $user->id) }}"
                                        class="btn btn-danger delete">Delete</a>
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
    @if (session('delete'))
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
                title: '{{ session('delete') }}'
            });
        </script>
    @endif

    <script>
        $('.delete').click(function() {

            Swal.fire({
                title: 'Do you want to delete user?',
                showCancelButton: true,
                confirmButtonText: 'delete',
            }).then((result) => {
                /* Read more about isConfirmed, isDenied below */
                if (result.isConfirmed) {
                    var link = $(this).attr('data-parent');
                    location.href = link;
                } else if (result.isDenied) {
                    Swal.fire('Changes are not saved', '', 'info')
                }
            });

        });
    </script>
@endsection
