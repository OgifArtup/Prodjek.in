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
    <link href="{{ asset('css/style_projek_list.css') }}" rel="stylesheet" type="text/css" >
  </head>
  <body>
   <!-- Navbar -->
   <div class="sidebar">
    <header><img src="assets/logo_white.png" /><b>Prodjek.In</b></header>

    <ul class="list1">
      <li><a href="/home"><img src="assets/dashboard_logo.png" />Dashboard</a></li>
      <li><a href="#"><img src="assets/profile_logo.png" />Profile</a></li>
      <li><a href="/project-list"><img src="assets/prodjek_logo.png" />Prodjek</a></li>
      <li><form action="/logout" method="POST" class="logOut">
        @csrf
            <button type="submit" class="dropdown-item">
            <img src="/assets/logout_logo.png" />Logout
            </button>
        </form></li>
        </ul>
      </div>
      <!-- Navbar End -->

    <!-- Hero -->
    <div class="mainContainer">
    <div>
      <h1>Good Morning, {{ auth()->user()->name }}!</h1>
    </div>
    <div class="container">
    @for ($i = 0; $i < count($projects); $i++)


      <div class="box1">
      <a href="{{route('viewDetails', ['id' => $projects[$i]->workspace_id])}}">
          <h2>{{ $projects[$i]->workspace->name }}</h2>
          <p class="task">Team</p>
          <p class="task_num"> <b class="num">{{ $taskAmount[$i] }} </b></p>
          <p class="task_T">Tasks</p>
          <p class="bold"><br />{{ $projects[$i]->workspace->team_name }}</p>
          <p><br />Role</p>
          <p class="bold"><br />{{ $projects[$i]->role }}</p>
          <p><br />Detail</p>
          <p class="bold"><br />{{ $projects[$i]->workspace->project_detail }}</p>
      </a>
      </div>


    @endfor
    </div>
     <!-- Minta tolong dibenerin sizing nya (figo) -->
    <div class="boxadd">
        <h2>Add New Project</h2>
        <form action="{{ route('createProject') }}" method="POST" enctype="multipart/form-data" class="">
          @csrf
          <div class="">
              <input name="name" type="text" class="" placeholder="Project Name" value="{{ old('name') }}">
              @error('name')
                  <div class="">
                      {{ $message }}
                  </div>
              @enderror
          </div>

          <div class="p-2">
              <input name="team_name" type="text" class="" placeholder="Team Name" value="{{ old('team_name') }}">
              @error('team_name')
                  <div class="">
                      {{ $message }}
                  </div>
              @enderror
          </div>

          <div class="">
              <input name="project_detail" type="text" class="" placeholder="Project Detail" value="{{ old('project_detail') }}">
              @error('project_detail')
                  <div class="">
                      {{ $message }}
                  </div>
              @enderror
          </div>

          <div class="">
              <button type="submit" class="">Add Project</button>
          </div>
        </form>
    </div>
  </body>
</html>
