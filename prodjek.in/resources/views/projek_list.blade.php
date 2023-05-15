<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"
    />
    <title>Home Page</title>
    <link rel="stylesheet" href="css/style_projek_list.css" />
  </head>
  <body>
    <ul>
      <li>
        <h1><img src="assets/logo_white.png" />Prodjek.in</h1>
      </li>
      <li>
        <a href="/home"
          ><img src="assets/dashboard_logo.png" /> Dashboard</a
        >
      </li>
      <li>
        <a href="#"><img src="assets/profile_logo.png" /> Profile</a>
      </li>
      <li>
        <a class="active" href="/project-list"
          ><img src="assets/prodjek_logo.png" /> Prodjek</a
        >
      </li>
      <ul class="ul2">
        <li>
          <a href="/login">
            <b><img src="assets/logout_logo.png" /> Log Out</b></a
          >
        </li>
      </ul>
    </ul>

    <div>
      <h1>Good Morning, Username!</h1>
    </div>

    <div class="container">
      <!-- Minta tolong dibenerin sizing nya (figo) -->
      <div class="boxadd">
        <h2>Add New Project</h2>
        <form action="{{ route('createProject') }}" method="POST" enctype="multipart/form-data" class="m-5">
          @csrf
          <div class="">
              <input name="name" type="text" class="form-control" id="formGroupExampleInput" placeholder="Project Name" value="{{ old('name') }}">
              @error('name')
                  <div class="text-danger">
                      {{ $message }}
                  </div>
              @enderror
          </div>
          
          <div class="p-2">
              <input name="team_name" type="text" class="form-control" id="formGroupExampleInput" placeholder="Team Name" value="{{ old('team_name') }}">
              @error('team_name')
                  <div class="text-danger">
                      {{ $message }}
                  </div>
              @enderror
          </div>

          <div class="">
              <input name="project_detail" type="text" class="form-control" id="formGroupExampleInput" placeholder="Project Detail" value="{{ old('project_detail') }}">
              @error('project_detail')
                  <div class="text-danger">
                      {{ $message }}
                  </div>
              @enderror
          </div>

        <div class="form-row mb-4 d-grid p-2">
              <button type="submit" class="btn btn-primary">Add Project</button>
          </div>
        </form>
      </div>

      @foreach ($projects as $project)
      <a href="/project-details">
        <div class="box1">
          <h2>{{ $project->workspace->name }}</h2>
          <p class="task">Team</p>
          <p class="task_num">80</p>
          <p class="task_T">Tasks</p>
          <p class="bold"><br />{{ $project->workspace->team_name }}</p>
          <p><br />Role</p>
          <p class="bold"><br />{{ $project->role }}</p>
          <p><br />Detail</p>
          <p class="bold"><br />{{ $project->workspace->project_detail }}</p>
        </div>
      </a>
      @endforeach

      <div class="box1">
        <h2>Project Title</h2>
        <p class="task">Team</p>
        <p class="task_num">80</p>
        <p class="task_T">Tasks</p>
        <p class="bold"><br />Pandawa Group</p>
        <p><br />Role</p>
        <p class="bold"><br />Manager</p>
        <p><br />Detail</p>
        <p class="bold"><br />Comprov Prodject.In</p>
      </div>
    </div>
  </body>
</html>
