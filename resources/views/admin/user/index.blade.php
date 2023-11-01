@extends('admin.layouts.master')
@section('body')
    <main id="main" class="main">

        <div class="pagetitle">
            <h1>Data</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                    <li class="breadcrumb-item">Users</li>
                    <li class="breadcrumb-item active">Data</li>
                </ol>
            </nav>
        </div><!-- End Page Title -->

        <section class="section">
            <div class="row">
                <div class="col-lg-12">

                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-10">
                                    <h5 class="card-title">{{ $title }}</h5>
                                </div>
                                {{-- <div class="col-2">
                                    <h5 class="card-title">
                                        <a href="javascript:void(0)" class="btn btn-success btn-sm"
                                            onclick="createEditModalShow(null,null,null)">Add new</a>
                                    </h5>
                                </div> --}}
                            </div>
                            <!-- Table with stripped rows -->
                            <table class="table datatable">
                                <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">Name</th>
                                        <th scope="col">Email</th>
                                        <th scope="col">Contact</th>
                                        <th scope="col">Payment</th>
                                        <th scope="col">Batch</th>
                                        <th scope="col">Blood Group</th>
                                        {{-- <th>Assign Role</th> --}}
                                        <th scope="col">Role</th>
                                        <th scope="col">Registered At</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($users as $key => $user)
                                        <tr>
                                            <th scope="row">{{ ++$key }}</th>
                                            <td>{{ $user['name'] }}</td>
                                            <td>{{ $user['email'] }}</td>
                                            <td>{{ $user['contact'] }}</td>
                                            <td>{{ $user['members']['payment'] }}</td>
                                            <td>{{ $user['members']['batch'] }}</td>
                                            <td>{{ $user['members']['blood_group'] }}</td>
                                            <td>{{ isset($user['roles'][0]) ? $user['roles'][0]['name'] : "user" }}</td>
                                            <td>{{ \Carbon\Carbon::parse($user['updated_at'])->format("d, M Y") }}</td>

                                            {{-- <td>
                                                @php
                                                    $userRole = App\Models\User::userRole($user['id']);
                                                @endphp

                                                @if (isset($userRole->role))
                                                    <span class="badge bg-primary">{{ $userRole->role }}</span>
                                                    <a href="javascript:void(0)" class="badge bg-info bg-xs"
                                                        onclick="assignRoleModalShow(`{{ $user['id'] }}`, `{{ $userRole->role_id }}`)">Re-assign Role</a>
                                                @else
                                                    <a href="javascript:void(0)" class="badge bg-info bg-xs"
                                                        onclick="assignRoleModalShow(`{{ $user['id'] }}`, null)">Assign Role</a>
                                                @endif
                                            </td> --}}

                                            {{-- <td>
                                                @if (isset($user['status']))
                                                    <span
                                                        class="badge bg-{{ $user['status'] == 1 ? 'success' : 'warning' }}">
                                                        <i
                                                            class="bi {{ $user['status'] == 1 ? 'bi-check-circle me-1' : 'bi-exclamation-triangle me-1' }}"></i>
                                                        {{ $user['status'] == 1 ? 'Active' : 'Inactive' }}
                                                    </span>
                                                @endif
                                            </td> --}}
                                            {{-- <td>
                                                <div class="d-flex">
                                                    <a href="javascript:void(0)"
                                                        onclick="createEditModalShow(`{{ $user['name'] }}`, `{{ $user['email'] }}`, `{{ $user['status'] }}`, `{{ $user['id'] }}`)"
                                                        class="btn btn-primary btn-sm"><i
                                                            class="bi bi-pencil-square"></i></a>
                                                    <a onclick="deleteUser(`{{ route('admin.deleteUser', ['userId' => $user['id']])}}`)"
                                                        class="btn btn-danger btn-sm"><i
                                                            class="bi bi-trash-fill"></i></a>
                                                </div>
                                            </td> --}}
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            <!-- End Table with stripped rows -->

                        </div>
                    </div>

                    {{--  Assign modal start  --}}
                    <div class="modal fade" id="role-assign-modal">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">Assign role to user</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                </div>
                                <form action="{{ route('admin.assignRoleToUser') }}"
                                    method="POST" class="mx-3">
                                    @csrf
                                    <input type="hidden" name="user_id" id="id_user_id">
                                    <select name="role_id" id="id_role_id"
                                        class="form-control" required>
                                        <option value="">Select a Role</option>
                                        @foreach ($roles as $role)
                                            <option id="role_option_id{{ $role->id }}" value="{{ $role->id }}">
                                                {{ $role->name }}</option>
                                        @endforeach
                                    </select>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary"
                                            data-bs-dismiss="modal">Close</button>
                                        <button type="submit"
                                            class="btn btn-sm btn-primary light">Submit</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    {{--  assign modal end  --}}

                </div>
            </div>
        </section>

    </main><!-- End #main -->
@endsection

@push('script')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="{{ asset('/') }}admin/assets/js/call.js"></script>
    <script>
        function assignRoleModalShow(userId, roleId) {
            if(userId == "" || userId == null){
                return false
            }
            $("#id_user_id").val(userId);
            console.log(roleId);
            if (roleId) {
                $("#role_option_id" + roleId).prop('selected', true);
            } else {
                $('#id_role_id').find($('option')).prop('selected', false);
            }
            $("#role-assign-modal").modal('show')
        }

        function deleteUser(url){
            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
                }).then((result) => {
                if (result.isConfirmed) {
                    let _token = fetchCsrfTokenFromForm();
                    fetch(url, {
                        method : 'DELETE',
                        headers: {
                            'X-CSRF-Token' : _token,
                            'Content-Type':'application/json'
                        },
                    }).then(response => response.json())
                    .then((data) => {
                        if(data.statusCode == 200){
                            flashMessage(data.data.message);
                            pageReloadInGivenPeriod();
                        }
                        else {
                            flashMessage(data.data.message, 'error', data.status);
                        }
                    }).catch(error => {
                        console.log(error);
                    });
                    // console.log(res);
                }
            })
        }
    </script>
@endpush
