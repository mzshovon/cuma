<div class="col-12">
    <div class="card recent-sales overflow-auto">

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

      <div class="card-body">
        <h5 class="card-title">Recent Registered</h5>

        <table class="table table-borderless datatable">
          <thead>
            <tr>
              <th scope="col">#</th>
              <th scope="col">Name</th>
              <th scope="col">Contact</th>
              <th scope="col">Email</th>
              <th scope="col">Registered At</th>
            </tr>
          </thead>
          <tbody>
            @forelse ($members as $member)
                <tr>
                    <th scope="row"><a href="#">{{$member['id']}}</a></th>
                    <td>{{$member['name']}}</td>
                    <td>{{$member['contact']}}</td>
                    <td>{{$member['email']}}</td>
                    <td>{{ \Carbon\Carbon::parse($member['created_at'])->format("d, M Y")}}</td>
                </tr>
            @empty

            @endforelse

          </tbody>
        </table>

      </div>

    </div>
  </div><!-- End Recent Sales -->
