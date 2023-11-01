@extends('admin.layouts.master')
@section('body')
<main id="main" class="main">

    <div class="pagetitle">
      <h1>{{$title}}</h1>
    </div><!-- End Page Title -->

    <section class="section profile">
      <div class="row">
        <div class="col-xl-4">

          <div class="card">
            <div class="card-body profile-card pt-4 d-flex flex-column align-items-center">

              <img src="assets/img/profile-img.jpg" alt="Profile" class="rounded-circle">
              <h2>{{auth()->user()->name}}</h2>
              <h3>{{auth()->user()->email}}</h3>
              <div class="social-links mt-2">
                <a href="#" class="twitter"><i class="bi bi-twitter"></i></a>
                <a href="#" class="facebook"><i class="bi bi-facebook"></i></a>
                <a href="#" class="instagram"><i class="bi bi-instagram"></i></a>
                <a href="#" class="linkedin"><i class="bi bi-linkedin"></i></a>
              </div>
            </div>
          </div>

        </div>

        <div class="col-xl-8">
            @foreach ($errors->all() as $error)
                <div class="alert alert-danger alert-dismissible fade show">{{ $error }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endforeach
          <div class="card">
            <div class="card-body pt-3">
              <!-- Bordered Tabs -->
              <ul class="nav nav-tabs nav-tabs-bordered">

                <li class="nav-item">
                  <button class="nav-link active" data-bs-toggle="tab" data-bs-target="#profile-overview">Overview</button>
                </li>

                <li class="nav-item">
                  <button class="nav-link" data-bs-toggle="tab" data-bs-target="#profile-edit">Edit Profile</button>
                </li>

                <li class="nav-item">
                  <button class="nav-link" data-bs-toggle="tab" data-bs-target="#profile-change-password">Change Password</button>
                </li>

              </ul>
              <div class="tab-content pt-2">

                <div class="tab-pane fade show active profile-overview" id="profile-overview">

                  <h5 class="card-title">Profile Details</h5>

                  <div class="row">
                    <div class="col-lg-3 col-md-4 label ">Full Name</div>
                    <div class="col-lg-9 col-md-8">{{auth()->user()->name}}</div>
                  </div>
                  <div class="row">
                    <div class="col-lg-3 col-md-4 label ">NID</div>
                    <div class="col-lg-9 col-md-8">{{auth()->user()->members->nid ?? "N/A"}}</div>
                  </div>
                  <div class="row">
                    <div class="col-lg-3 col-md-4 label ">Date of Birth</div>
                    <div class="col-lg-9 col-md-8">{{auth()->user()->members->dob ?? "N/A"}}</div>
                  </div>
                  <div class="row">
                    <div class="col-lg-3 col-md-4 label ">Membership</div>
                    <div class="col-lg-9 col-md-8">{{auth()->user()->members->payment ?? "N/A"}}</div>
                  </div>
                  <div class="row">
                    <div class="col-lg-3 col-md-4 label ">Batch</div>
                    <div class="col-lg-9 col-md-8">{{auth()->user()->members->batch ?? "N/A"}}</div>
                  </div>
                  <div class="row">
                    <div class="col-lg-3 col-md-4 label ">Blood Group</div>
                    <div class="col-lg-9 col-md-8">{{auth()->user()->members->blood_group ?? "N/A"}}</div>
                  </div>

                  <div class="row">
                    <div class="col-lg-3 col-md-4 label">Company</div>
                    <div class="col-lg-9 col-md-8">{{auth()->user()->members->employeer_name ?? "N/A"}}</div>
                  </div>

                  <div class="row">
                    <div class="col-lg-3 col-md-4 label">Designation</div>
                    <div class="col-lg-9 col-md-8">{{auth()->user()->members->designation ?? "N/A"}}</div>
                  </div>

                  <div class="row">
                    <div class="col-lg-3 col-md-4 label">Country</div>
                    <div class="col-lg-9 col-md-8">Bangladesh</div>
                  </div>

                  <div class="row">
                    <div class="col-lg-3 col-md-4 label">Address</div>
                    <div class="col-lg-9 col-md-8">{{auth()->user()->members->address ?? "N/A"}}</div>
                  </div>
                  <div class="row">
                    <div class="col-lg-3 col-md-4 label">Employeer Address</div>
                    <div class="col-lg-9 col-md-8">{{auth()->user()->members->employeer_address ?? "N/A"}}</div>
                  </div>

                  <div class="row">
                    <div class="col-lg-3 col-md-4 label">Phone</div>
                    <div class="col-lg-9 col-md-8">{{auth()->user()->contact ?? "N/A"}}</div>
                  </div>

                  <div class="row">
                    <div class="col-lg-3 col-md-4 label">Email</div>
                    <div class="col-lg-9 col-md-8">{{auth()->user()->email ?? "N/A"}}</div>
                  </div>

                </div>

                <div class="tab-pane fade profile-edit pt-3" id="profile-edit">

                  <!-- Profile Edit Form -->
                  <form action="{{route("admin.profile.uddate")}}" method="POST">
                    @csrf
                    <div class="row mb-3">
                      <label for="profileImage" class="col-md-4 col-lg-3 col-form-label">Profile Image</label>
                      <div class="col-md-8 col-lg-9">
                        <img src="assets/img/profile-img.jpg" alt="Profile">
                        <div class="pt-2">
                          <a href="#" class="btn btn-primary btn-sm" title="Upload new profile image"><i class="bi bi-upload"></i></a>
                          <a href="#" class="btn btn-danger btn-sm" title="Remove my profile image"><i class="bi bi-trash"></i></a>
                        </div>
                      </div>
                    </div>

                    <div class="row mb-3">
                      <label for="fullName" class="col-md-4 col-lg-3 col-form-label">First Name</label>
                      <div class="col-md-8 col-lg-9">
                        <input name="first_name" type="text" class="form-control" id="fullName" value="{{auth()->user()->members->first_name ?? "N/A"}}">
                      </div>
                    </div>
                    <input name="id" type="hidden" class="form-control" id="fullName" value="{{auth()->user()->id ?? "N/A"}}">

                    <div class="row mb-3">
                      <label for="fullName" class="col-md-4 col-lg-3 col-form-label">Last Name</label>
                      <div class="col-md-8 col-lg-9">
                        <input name="last_name" type="text" class="form-control" id="fullName" value="{{auth()->user()->members->last_name ?? "N/A"}}">
                      </div>
                    </div>

                    <div class="row mb-3">
                      <label for="fullName" class="col-md-4 col-lg-3 col-form-label">Membership</label>
                      <div class="col-md-8 col-lg-9">
                        <select class="form-select" name="payment" aria-label="Default select example">
                            <option value="General Member" {{auth()->user()->members->payment == "General Member" ? "selected":""}}>General Member</option>
                            <option value="Life Member" {{auth()->user()->members->payment == "Life Member" ? "selected":""}}>Life Member</option>
                            <option value="Donor Member" {{auth()->user()->members->payment == "Donor Member" ? "selected":""}}>Donor Member</option>
                            <option value="Honorary Member" {{auth()->user()->members->payment == "Honorary Member" ? "selected":""}}>Honorary Member</option>
                      </select>
                      </div>
                    </div>

                    <div class="row mb-3">
                      <label for="fullName" class="col-md-4 col-lg-3 col-form-label">Batch</label>
                      <div class="col-md-8 col-lg-9">
                        <select class="form-select" name="batch" aria-label="Default select example">
                            @for ($i=0; $i<=9; $i++ )
                                <option value="{{"202".$i}}" {{auth()->user()->members->batch == "202".$i ? "selected" : ""}}>{{"202".$i}}</option>
                            @endfor
                      </select>
                      </div>
                    </div>

                    <div class="row mb-3">
                      <label for="fullName" class="col-md-4 col-lg-3 col-form-label">NID</label>
                      <div class="col-md-8 col-lg-9">
                        <input name="nid" type="text" class="form-control" id="fullName" value="{{auth()->user()->members->nid ?? "N/A"}}">
                      </div>
                    </div>

                    <div class="row mb-3">
                      <label for="fullName" class="col-md-4 col-lg-3 col-form-label">Date Of Birth</label>
                      <div class="col-md-8 col-lg-9">
                        <input name="dob" type="date" class="form-control" id="fullName" value="{{auth()->user()->members->dob ?? "N/A"}}">
                      </div>
                    </div>

                    <div class="row mb-3">
                      <label for="fullName" class="col-md-4 col-lg-3 col-form-label">Blood Group</label>
                      <div class="col-md-8 col-lg-9">
                        <input name="blood_group" type="text" class="form-control" id="fullName" value="{{auth()->user()->members->blood_group ?? "N/A"}}">
                      </div>
                    </div>

                    <div class="row mb-3">
                      <label for="about" class="col-md-4 col-lg-3 col-form-label">Address</label>
                      <div class="col-md-8 col-lg-9">
                        <textarea name="address" class="form-control" id="about" style="height: 100px">{{auth()->user()->members->address ?? "N/A"}}</textarea>
                      </div>
                    </div>

                    <div class="row mb-3">
                      <label for="company" class="col-md-4 col-lg-3 col-form-label">Company</label>
                      <div class="col-md-8 col-lg-9">
                        <input name="employeer_name" type="text" class="form-control" id="company" value="{{auth()->user()->members->employeer_name ?? "N/A"}}">
                      </div>
                    </div>

                    <div class="row mb-3">
                      <label for="Job" class="col-md-4 col-lg-3 col-form-label">Designation</label>
                      <div class="col-md-8 col-lg-9">
                        <input name="designation" type="text" class="form-control" id="Job" value="{{auth()->user()->members->designation ?? "N/A"}}">
                      </div>
                    </div>

                    <div class="row mb-3">
                      <label for="Address" class="col-md-4 col-lg-3 col-form-label">Company Address</label>
                      <div class="col-md-8 col-lg-9">
                        <input name="employeer_address" type="text" class="form-control" id="Address" value="{{auth()->user()->members->employeer_address ?? "N/A"}}">
                      </div>
                    </div>

                    <div class="row mb-3">
                      <label for="Phone" class="col-md-4 col-lg-3 col-form-label">Phone</label>
                      <div class="col-md-8 col-lg-9">
                        <input name="contact" type="text" class="form-control" id="Phone" value="{{auth()->user()->contact ?? "N/A"}}">
                      </div>
                    </div>

                    <div class="row mb-3">
                      <label for="Email" class="col-md-4 col-lg-3 col-form-label">Email</label>
                      <div class="col-md-8 col-lg-9">
                        <input name="email" type="email" class="form-control" id="Email" value="{{auth()->user()->email ?? "N/A"}}">
                      </div>
                    </div>

                    <div class="text-center">
                      <button type="submit" class="btn btn-primary">Save Changes</button>
                    </div>
                  </form><!-- End Profile Edit Form -->

                </div>

                <div class="tab-pane fade pt-3" id="profile-change-password">
                  <!-- Change Password Form -->
                  <form action="{{route("admin.profile.reset-password")}}" method="POST">
                    @csrf
                    <input name="" type="hidden" class="form-control" id="fullName" value="{{auth()->user()->id ?? "N/A"}}">
                    <div class="row mb-3">
                      <label for="currentPassword" class="col-md-4 col-lg-3 col-form-label">Current Password</label>
                      <div class="col-md-8 col-lg-9">
                        <input name="current_password" type="password" class="form-control" id="currentPassword">
                      </div>
                    </div>

                    <div class="row mb-3">
                      <label for="newPassword" class="col-md-4 col-lg-3 col-form-label">New Password</label>
                      <div class="col-md-8 col-lg-9">
                        <input name="new_password" type="password" class="form-control" id="newPassword">
                      </div>
                    </div>

                    <div class="row mb-3">
                      <label for="renewPassword" class="col-md-4 col-lg-3 col-form-label">Re-enter New Password</label>
                      <div class="col-md-8 col-lg-9">
                        <input name="new_confirm_password" type="password" class="form-control" id="renewPassword">
                      </div>
                    </div>

                    <div class="text-center">
                      <button type="submit" class="btn btn-primary">Change Password</button>
                    </div>
                  </form><!-- End Change Password Form -->

                </div>

              </div><!-- End Bordered Tabs -->

            </div>
          </div>

        </div>
      </div>
    </section>

  </main><!-- End #main -->
@endsection