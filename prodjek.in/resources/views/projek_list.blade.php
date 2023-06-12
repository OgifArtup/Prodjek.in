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
    <div class="all">
      <div class="sidebar">
        <header><img src="assets/logo_white.png" /><b>Prodjek.In</b></header>
        <ul class="list1">
        <li><a href="/home"><img src="assets/dashboard_logo.png" />Dashboard</a></li>
        <li><a href="/view-profile"><img src="assets/profile_logo.png" />Profile</a></li>
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
        <h1>Good Morning, {{ auth()->user()->username }}!</h1>
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

      <!-- add project -->

      <div class="button">
        <a href="#divOne"><img src="/assets/add_logo.png" /></a>
      </div>
      <div class="overlay" id="divOne">
        <div class="wrapper">
          <div class="content">
            <div class="form_container">
              <div class="actions">
                <div class="task-container">
                  <form action="{{ route('createProject') }}" method="POST" enctype="multipart/form-data" class="">
                    @csrf
                    <div class="fields">
                        <label>Project Title</label>
                        <input name="name" type="text" class="" value="{{ old('name') }}">
                        @error('name')
                            <div class="">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <div class="fields">
                        <label>Team Name</label>
                        <input name="team_name" type="text" class="" value="{{ old('team_name') }}">
                        @error('team_name')
                            <div class="">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <div class="fields">
                        <label>Project Detail</label>
                        <!-- 
                        # buat figo: pake yang ini kalo textarea nya gabisa, lgsg delete line 138 aja semuanya

                        <input name="project_detail" type="text" class="" value="{{ old('project_detail') }}"> 
                        
                        -->
                        <textarea name="project_detail" type="text" class="" value="{{ old('project_detail') }}"></textarea>
                        @error('project_detail')
                            <div class="">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <div class="buttons">
                      <a class="redbutton" onclick="history.back()">Cancel</a>
                      <button type="submit" class="buttona">Add Project</button>
                    </div>
                    
                  </form>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>

      <!-- add project end -->

    </div>
  </body>
</html>
