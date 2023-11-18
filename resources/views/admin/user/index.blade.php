@extends('admin.layouts.master')
@section('body')
    <main id="main" class="main">

        <div class="pagetitle">
            <h1>{{ $title }}</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{URL::to('/')}}">Home</a></li>
                    <li class="breadcrumb-item">Users</li>
                    <li class="breadcrumb-item active">Data</li>
                </ol>
            </nav>
        </div><!-- End Page Title -->

        <section class="section">
            <div class="row">
                <div class="col-lg-12">
                    @foreach ($errors->all() as $error)
                        <div class="alert alert-danger alert-dismissible fade show">{{ $error }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endforeach
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-10">
                                    <h5 class="card-title">
                                        {{ $title }}
                                        <a href="{{route('admin.createUser')}}" class="btn btn-success btn-sm">Add Member</a>
                                    </h5>

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
                                        <th scope="col">Membership ID</th>
                                        <th scope="col">Email</th>
                                        <th scope="col">Contact</th>
                                        <th scope="col">Payment</th>
                                        <th scope="col">Batch</th>
                                        <th scope="col">Blood Group</th>
                                        {{-- <th>Assign Role</th> --}}
                                        <th scope="col">Role</th>
                                        <th scope="col">Registered At</th>
                                        @if (auth()->user()->hasRole('admin') || auth()->user()->hasRole('superadmin'))
                                            <th scope="col">Action</th>
                                        @endif
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($users as $key => $user)
                                        <tr>
                                            <th scope="row">{{ ++$key }}</th>
                                            <td>
                                                @if ($user['members']['image_path'])
                                                    <img src="{{URL::to("/") ."/". $user['members']['image_path']}}" alt="Profile" class="rounded-circle" style="height: 30px;width:30px">
                                                @endif
                                                {{ $user['name'] }}
                                            </td>
                                            <td>
                                                @if (!$user['members']['membership_id'])
                                                    <a href="javascript:void(0)" class="btn btn-outline-primary btn-sm"
                                                    onclick="assignRoleModalShow(`{{ $user['members']['id'] }}`, null, `{{ $user['email'] }}`)">N/A. Update?</a>
                                                @else
                                                    <button class="btn btn-success btn-sm"> {{$user['members']['membership_id']}} </button>
                                                @endif
                                            </td>
                                            <td>{{ $user['email'] }}</td>
                                            <td>{{ $user['contact'] }}</td>
                                            <td>{{ $user['members']['payment'] }}</td>
                                            <td>{{ $user['members']['batch'] }}</td>
                                            <td>{{ $user['members']['blood_group'] }}</td>
                                            <td>{{ isset($user['roles'][0]) ? $user['roles'][0]['name'] : "user" }}</td>
                                            <td>{{ \Carbon\Carbon::parse($user['updated_at'])->format("d, M Y") }}</td>
                                            @if (auth()->user()->hasRole('admin') || auth()->user()->hasRole('superadmin'))
                                                <td>
                                                    <a href="{{route('admin.edituser',['userId' => $user['id']])}}" class="btn btn-outline-info btn-sm">
                                                        Update
                                                    </a>
                                                </td>
                                            @endif
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
                                    <h5 class="modal-title">Assign membership id to user</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                <form action="{{ route('admin.assignMembershipIdToUser') }}"
                                    method="POST" class="mx-3">
                                    @csrf
                                    <input type="hidden" name="user_id" id="id_user_id">
                                    <input type="hidden" name="user_email" id="id_user_email">
                                    <input class="form-control" type="text" name="membership_id" id="membership_id" placeholder="Input membership id">
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary"
                                            data-bs-dismiss="modal">Close</button>
                                        <button type="submit"
                                            class="btn btn-primary light">Submit</button>
                                    </div>
                                </form>
                                </div>
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
        function assignRoleModalShow(userId, memberbershipId, userEmail) {
            if(userId == "" || userId == null){
                return false
            }
            if (memberbershipId) {
                $("#membership_id").val(memberbershipId);
            } else {
                $("#membership_id").val('');
            }
            if (userEmail) {
                $("#id_user_email").val(userEmail);
            } else {
                $("#id_user_email").val('');
            }
            $("#id_user_id").val(userId);
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
