{{-- Registrar Side navbar --}}

<nav class="col-sm-3 col-md-2 d-none d-sm-block bg-light sidebar">
  <ul class="nav nav-pills flex-column">

    <li class="nav-item">
          <div class="dropdown show">
            <a class="nav-link dropdown-toggle" href="#" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              Manage Users
            </a>

            <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
              <a class="dropdown-item" href="{{ URL::route('user.view') }}">View User</a>
              <a class="dropdown-item" href="{{ URL::route('user.create') }}">Add User</a>
            </div>
          </div>
    </li>

    <li class="nav-item">
              <div class="dropdown show">
                <a class="nav-link dropdown-toggle" href="#" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  Manage Departments
                </a>

                <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                  <a class="dropdown-item" href="{{ URL::route('department.view') }}">View Department</a>
                  <a class="dropdown-item" href="{{ URL::route('department.create') }}">Add Department</a>
                </div>
              </div>
        </li>

    <li class="nav-item">
                  <div class="dropdown show">
                    <a class="nav-link dropdown-toggle" href="#" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                      Manage Students
                    </a>

                    <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                      <a class="dropdown-item" href="{{ URL::route('student.view') }}">View Student</a>
                      <a class="dropdown-item" href="{{ URL::route('student.create') }}">Add Student</a>
                    </div>
                  </div>
            </li>

    <li class="nav-item">
      <a class="nav-link" href="{{ URL::route('report.index') }}">Reports</a>
    </li>
  </ul>
</nav>