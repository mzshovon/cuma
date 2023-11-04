@extends('admin.layouts.master')
@section('body')
  <main id="main" class="main">

    <div class="pagetitle">
      {{-- <h1>{{$title}}</h1> --}}
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="index.html">Home</a></li>
          {{-- <li class="breadcrumb-item active">{{$title}}</li> --}}
        </ol>
      </nav>
    </div><!-- End Page Title -->

    <section class="section dashboard">
      <div class="row">

        <!-- Left side columns -->
        @if (Hash::check(auth()->user()->email, auth()->user()->password))
            <div class="col-lg-12">
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    Hello, <b>{{auth()->user()->name}}</b> Look like your password is very weak. Please click <a href="{{route('admin.profile')}}">change password</a> strong password to secure your profile.
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            </div>
        @else
            <div class="col-lg-12">
                <div class="alert alert-primary alert-dismissible fade show" role="alert">
                    Hello, <b>{{auth()->user()->name}}</b> Welcome to {{env('APP_NAME') ?? "CUMA"}} 🎉
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            </div>
        @endif

        @if (auth()->user()->hasRole('superadmin'))
        <div class="col-lg-8">
          <div class="row">
            <!-- Recent Sales -->

                @include('admin.layouts.partials.cards')
                @include('admin.layouts.partials.topMembers')

          </div>
        </div><!-- End Left side columns -->

        <!-- Right side columns -->
        <div class="col-lg-4">

        @include('admin.layouts.partials.recentActivities')

          <!-- Website Traffic -->
          <div class="card">
            <div class="filter">
              <a class="icon" href="#" data-bs-toggle="dropdown"><i class="bi bi-three-dots"></i></a>
              <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                <li class="dropdown-header text-start">
                  <h6>Filter</h6>
                </li>

                <li><a class="dropdown-item" href="#">Today</a></li>
                <li><a class="dropdown-item" href="#">This Month</a></li>
                <li><a class="dropdown-item" href="#">This Year</a></li>
              </ul>
            </div>

            <div class="card-body pb-0">
              <h5 class="card-title">Website Traffic <span>| Overall</span></h5>
              <div id="trafficChart" style="min-height: 400px;" class="echart"></div>
            </div>
          </div><!-- End Website Traffic -->

          <!-- News & Updates Traffic -->
          <div class="card">
            <div class="filter">
              <a class="icon" href="#" data-bs-toggle="dropdown"><i class="bi bi-three-dots"></i></a>
              <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                <li class="dropdown-header text-start">
                  <h6>Filter</h6>
                </li>

                <li><a class="dropdown-item" href="#">Today</a></li>
                <li><a class="dropdown-item" href="#">This Month</a></li>
                <li><a class="dropdown-item" href="#">This Year</a></li>
              </ul>
            </div>
          </div><!-- End News & Updates -->

        </div><!-- End Right side columns -->
        @else
        <div class="col-lg-12">
              <!-- Website Traffic -->
              <div class="card">

                <div class="card-body pb-0">
                  <img src="https://cdn.dribbble.com/users/1223630/screenshots/8115260/media/8145a871d9c4d67ec06e047ccc6574b4.gif"/>
                  <a href="{{route('admin.profile')}}" class="btn btn-outline-primary btn-lg"> Visit profile </a>
                  <a href="{{route('admin.contact')}}" class="btn btn-outline-primary btn-lg"> Place your ticket </a>
                  <a href="{{route('admin.profile')}}" class="btn btn-outline-primary btn-lg"> Change password </a>
                </div>
              </div><!-- End Website Traffic -->

              <!-- News & Updates Traffic -->
              <div class="card">
                <div class="filter">
                  <a class="icon" href="#" data-bs-toggle="dropdown"><i class="bi bi-three-dots"></i></a>
                  <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                    <li class="dropdown-header text-start">
                      <h6>Filter</h6>
                    </li>

                    <li><a class="dropdown-item" href="#">Today</a></li>
                    <li><a class="dropdown-item" href="#">This Month</a></li>
                    <li><a class="dropdown-item" href="#">This Year</a></li>
                  </ul>
                </div>
              </div><!-- End News & Updates -->

            </div><!-- End Right side columns -->
        @endif

      </div>
    </section>

  </main><!-- End #main -->
@endsection

@push('script')

<script src="{{ asset('/') }}admin/assets/js/call.js"></script>
<script src="{{ asset('/') }}admin/assets/vendor/echarts/echarts.min.js"></script>
<script src="{{ asset('/') }}admin/assets/vendor/chart.js/chart.umd.js"></script>
<script src="{{ asset('/') }}admin/assets/vendor/apexcharts/apexcharts.min.js"></script>

<script>
</script>
@endpush



