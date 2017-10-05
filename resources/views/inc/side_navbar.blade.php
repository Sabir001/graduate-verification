{{-- Side navbar --}}

<nav class="col-sm-3 col-md-2 d-none d-sm-block bg-light sidebar">
  <ul class="nav nav-pills flex-column">
    <li class="nav-item">
      <a class="nav-link active" href="manage_users_view">Manage Users</a>
    </li>
    <li class="nav-item">
      <div class="dropdown show">
        <a class="nav-link dropdown-toggle" href="#" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          Manage Universities
        </a>

        <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
          <a class="dropdown-item" href="manage_university_view">University</a>
          <a class="dropdown-item" href="#">Department/Institute</a>
        </div>
      </div>
    </li>

    <li class="nav-item">
      <div class="dropdown show">
        <a class="nav-link dropdown-toggle" href="#" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          Manage Department/Institute
        </a>

        <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
          <a class="dropdown-item" href="#">Semester</a>
          <a class="dropdown-item" href="manage_courses_view">Course</a>
        </div>
      </div>
    </li>

    <li class="nav-item">
      <div class="dropdown show">
        <a class="nav-link dropdown-toggle" href="#" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          Manage Result
        </a>

        <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
          <a class="dropdown-item" href="manage_add_result">Add Result</a>
          <a class="dropdown-item" href="#">Edit</a>
        </div>
      </div>
    </li>

    <li class="nav-item">
      <div class="dropdown show">
        <a class="nav-link dropdown-toggle" href="#" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          Manage Verification
        </a>

        <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
          <a class="dropdown-item" href="#">Request</a>
          <a class="dropdown-item" href="#">Verify</a>
        </div>
      </div>
    </li>
  </ul>
</nav>