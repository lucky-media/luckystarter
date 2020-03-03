@extends('layouts.admin')
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">All Users</h4>

                        <div class="card-options">
                            <a href="{{ route('admin.users.create') }}" class="btn btn-xs btn-outline-primary">Create
                                User</a>
                        </div>
                    </div>

                    <div class="table-responsive">
                        <table class="table card-table table-striped table-vcenter dataTable">
                            <thead>
                            <tr>
                                <th>ID</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Roles</th>
                                <th>&nbsp;</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($users as $key => $user)
                                <tr>
                                    <td>{{ $user->id ?? '' }}</td>
                                    <td>{{ $user->name ?? '' }}</td>
                                    <td>{{ $user->email ?? '' }}</td>
                                    <td>
                                        @foreach($user->roles()->pluck('name') as $role)
                                            <span class="badge badge-info">{{ ucfirst($role) }}</span>
                                        @endforeach
                                    </td>
                                    <td>
                                        <a class="icon" href="{{ route('admin.users.edit', $user->id) }}">
                                            <i class="fe fe-edit"></i> Edit
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('javascript')

    <script type="text/javascript">
        $(document).ready(function () {
            $('.dataTable').DataTable({
                "columnDefs": [
                    {
                        "width": "10%",
                        "targets": 0
                    },
                    {
                        "width": "15%",
                        "targets": 3
                    },
                    {
                        "orderable": false,
                        "targets": 4
                    }
                ]
            });
        });
    </script>

@endpush
