@extends('admin.layouts.master')
@section('body')
<main id="main" class="main">

    <div class="pagetitle">
      <h1>{{$title}}</h1>
    </div><!-- End Page Title -->

    <section class="section profile">
      <div class="row">
        <div class="col-xl-6">
            @foreach ($errors->all() as $error)
                <div class="alert alert-danger alert-dismissible fade show">{{ $error }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endforeach
          <div class="card">
            <div class="card-body pt-3">
              <div class="tab-content pt-2">
                <div class="t" id="profile-edit">
                <h4 class="text-center">User Details</h4>
                <hr>
                  <!-- Profile Edit Form -->
                  <form action="{{route("admin.storeUser")}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="row mb-3">
                      <label for="fullName" class="col-md-4 col-lg-3 col-form-label">First Name <small class="text-danger">*</small></label>
                      <div class="col-md-8 col-lg-9">
                        <input name="first_name" type="text" class="form-control" id="fullName" value="{{$user['members']['first_name'] ?? ''}}" required>
                      </div>
                    </div>

                    <div class="row mb-3">
                      <label for="fullName" class="col-md-4 col-lg-3 col-form-label">Last Name <small class="text-danger">*</small></label>
                      <div class="col-md-8 col-lg-9">
                        <input name="last_name" type="text" class="form-control" id="fullName" value="{{$user['members']['last_name'] ?? ''}}" required>
                      </div>
                    </div>


                    <div class="row mb-3">
                        <label for="Phone" class="col-md-4 col-lg-3 col-form-label">Phone <small class="text-danger">*</small></label>
                        <div class="col-md-8 col-lg-9">
                          <input name="contact" type="text" class="form-control" id="Phone" value="{{$user['contact'] ?? ''}}" required>
                        </div>
                      </div>

                      <div class="row mb-3">
                        <label for="Email" class="col-md-4 col-lg-3 col-form-label">Email <small class="text-danger">*</small></label>
                        <div class="col-md-8 col-lg-9">
                          <input name="email" type="email" class="form-control" id="Email" value="{{$user['email'] ?? ''}}" required>
                        </div>
                      </div>

                    <div class="row mb-3">
                      <label for="about" class="col-md-4 col-lg-3 col-form-label">Address <small class="text-danger">*</small></label>
                      <div class="col-md-8 col-lg-9">
                        <textarea name="address" class="form-control" id="about" style="height: 100px" required>
                            {{$user['members']['address'] ?? ''}}
                        </textarea>
                      </div>
                    </div>
                    <div class="row mb-3">
                      <label for="Address" class="col-md-4 col-lg-3 col-form-label">Reference Name</label>
                      <div class="col-md-8 col-lg-9">
                        <input name="reference" type="text" class="form-control" value="{{$user['members']['reference'] ?? ''}}" id="reference">
                      </div>
                    </div>
                    <div class="row mb-3">
                      <label for="Address" class="col-md-4 col-lg-3 col-form-label">Reference Number</label>
                      <div class="col-md-8 col-lg-9">
                        <input name="reference_number" type="text" class="form-control" value="{{$user['members']['reference_number'] ?? ''}}" id="reference_number">
                      </div>
                    </div>
                    <div class="row mb-3">
                        <label for="Address" class="col-md-4 col-lg-3 col-form-label">Profile Image</label>
                        <div class="col-md-8 col-lg-9">
                          <input name="profile_image" type="file" class="form-control" id="profile_image">
                        </div>
                      </div>
                </div>
              </div><!-- End Bordered Tabs -->

            </div>
          </div>

        </div>
        <div class="col-xl-6">
          <div class="card">
            <div class="card-body pt-3">
              <div class="tab-content pt-2">
                <div class="t" id="profile-edit">
                    <h4 class="text-center">Member Details</h4>
                    <hr>
                    <div class="row mb-3">
                      <label for="fullName" class="col-md-4 col-lg-3 col-form-label">Membership <small class="text-danger">*</small></label>
                      <div class="col-md-8 col-lg-9">
                        <select class="form-select" name="payment" aria-label="Default select example">
                            <option value="General Member" {{$user['members']['payment'] == "General Member" ? "selected":""}}>General Member</option>
                            <option value="Life Member" {{$user['members']['payment'] == "Life Member" ? "selected":""}}>Life Member</option>
                            <option value="Donor Member" {{$user['members']['payment'] == "Donor Member" ? "selected":""}}>Donor Member</option>
                            <option value="Honorary Member" {{$user['members']['payment'] == "Honorary Member" ? "selected":""}}>Honorary Member</option>
                      </select>
                      </div>
                    </div>

                    <div class="row mb-3">
                      <label for="fullName" class="col-md-4 col-lg-3 col-form-label">Batch <small class="text-danger">*</small></label>
                      <div class="col-md-8 col-lg-9">
                        <select class="form-select" name="batch" aria-label="Default select example">
                            @for ($i=1; $i<=50; $i++ )
                                @if (in_array($i, [24,25,26]))
                                    <option value="{{"Batch ".$i. " (MBA)"}}">{{"Batch ".$i. " (MBA)"}}</option>
                                    <option value="{{"Batch ".$i. " (M.Com)"}}">{{"Batch ".$i. "(M.Com)"}}</option>
                                @else
                                    <option value="{{"Batch ".$i}}">{{"Batch ".$i}}</option>
                                @endif
                            @endfor
                      </select>
                      </div>
                    </div>

                    <div class="row mb-3">
                      <label for="fullName" class="col-md-4 col-lg-3 col-form-label">NID <small class="text-danger">*</small></label>
                      <div class="col-md-8 col-lg-9">
                        <input name="nid" type="text" class="form-control" id="fullName" value="{{$user['members']['nid'] ?? ''}}" required>
                      </div>
                    </div>

                    <div class="row mb-3">
                      <label for="fullName" class="col-md-4 col-lg-3 col-form-label">Date Of Birth <small class="text-danger">*</small></label>
                      <div class="col-md-8 col-lg-9">
                        <input name="dob" type="date" class="form-control" id="fullName" value="{{$user['members']['dob'] ?? ''}}" required>
                      </div>
                    </div>

                    <div class="row mb-3">
                      <label for="fullName" class="col-md-4 col-lg-3 col-form-label">Blood Group</label>
                      <div class="col-md-8 col-lg-9">
                        <select class="form-select" name="blood_group" aria-label="Default select example">
                            <option value="A+" {{$user['members']['blood_group'] == "A+" ? "selected" : ""}}>A+</option>
                            <option value="A-" {{$user['members']['blood_group'] == "A-" ? "selected" : ""}}>A-</option>
                            <option value="B+" {{$user['members']['blood_group'] == "B+" ? "selected" : ""}}>B+</option>
                            <option value="B-" {{$user['members']['blood_group'] == "B-" ? "selected" : ""}}>B-</option>
                            <option value="O+" {{$user['members']['blood_group'] == "O+" ? "selected" : ""}}>O+</option>
                            <option value="O-" {{$user['members']['blood_group'] == "O-" ? "selected" : ""}}>O-</option>
                            <option value="AB+" {{$user['members']['blood_group'] == "AB+" ? "selected" : ""}}>AB+</option>
                            <option value="AB-" {{$user['members']['blood_group'] == "AB-" ? "selected" : ""}}>AB-</option>
                      </select>
                      </div>
                    </div>
                    <div class="row mb-3">
                        <label for="company" class="col-md-4 col-lg-3 col-form-label">Company</label>
                        <div class="col-md-8 col-lg-9">
                          <input name="employeer_name" type="text" class="form-control" value="{{$user['members']['employeer_name'] ?? ''}}" id="company">
                        </div>
                      </div>

                      <div class="row mb-3">
                        <label for="Job" class="col-md-4 col-lg-3 col-form-label">Designation</label>
                        <div class="col-md-8 col-lg-9">
                          <input name="designation" type="text" class="form-control" id="Job" value="{{$user['members']['designation'] ?? ''}}">
                        </div>
                      </div>

                      <div class="row mb-3">
                        <label for="Address" class="col-md-4 col-lg-3 col-form-label">Company Address</label>
                        <div class="col-md-8 col-lg-9">
                          <input name="employeer_address" type="text" class="form-control" id="Address" value="{{$user['members']['employeer_address'] ?? ''}}">
                        </div>
                      </div>
                    <div class="row mb-3">
                      <label for="Address" class="col-md-4 col-lg-3 col-form-label">Membership ID</label>
                      <div class="col-md-8 col-lg-9">
                        <input name="membership_id" type="text" class="form-control" id="membership_id" value="{{$user['members']['membership_id'] ?? ''}}">
                      </div>
                    </div>
                </div>
              </div><!-- End Bordered Tabs -->

            </div>
          </div>

        </div>

        @if (auth()->user()->hasRole('admin') || auth()->user()->hasRole('superadmin'))
            <div class="text-center">
                <button type="submit" class="btn btn-primary">Update Member</button>
            </div>
        @endif
        </form>

      </div>
    </section>

  </main><!-- End #main -->
@push('script')
    <script src="https://cdn.jsdelivr.net/npm/tsparticles-confetti@2.12.0/tsparticles.confetti.bundle.min.js"></script>
    <script>
        function removeFile(){
            $("input[type=file]").val("");
        }
        function confettiAnimation() {
            const duration = 5 * 1000,
            animationEnd = Date.now() + duration,
            defaults = { startVelocity: 30, spread: 360, ticks: 60, zIndex: 0 };

            function randomInRange(min, max) {
            return Math.random() * (max - min) + min;
            }

            const interval = setInterval(function() {
            const timeLeft = animationEnd - Date.now();

            if (timeLeft <= 0) {
                return clearInterval(interval);
            }

            const particleCount = 50 * (timeLeft / duration);

            // since particles fall down, start a bit higher than random
            confetti(
                Object.assign({}, defaults, {
                particleCount,
                origin: { x: randomInRange(0.1, 0.3), y: Math.random() - 0.2 },
                })
            );
            confetti(
                Object.assign({}, defaults, {
                particleCount,
                origin: { x: randomInRange(0.7, 0.9), y: Math.random() - 0.2 },
                })
            );
            }, 250);
        }
		@if(Session::has('success'))
            confettiAnimation();
		@endif

    </script>
@endpush
@endsection
