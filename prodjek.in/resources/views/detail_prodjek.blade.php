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
    <link href="{{ asset('css/style_detail_prodjek.css') }}" rel="stylesheet" type="text/css" >
  </head>
  <body>
    <ul>
      <li>
        <h1><img src="/assets/logo_white.png" />Prodjek.in</h1>
      </li>
      <li>
        <a href="/home"
          ><img src="/assets/dashboard_logo.png" /> Dashboard</a
        >
      </li>
      <li>
        <a href="#"><img src="/assets/profile_logo.png" /> Profile</a>
      </li>
      <li>
        <a class="active" href="/project-list"><img src="/assets/prodjek_logo.png" /> Prodjek</a>
      </li>
      <li>
        <b><img src="/assets/logout_logo.png" /> Log Out</b>
      </li>
    </ul>

    <div>
      <h1>Good Morning, Username!</h1>

      <div class="prodjek-page">
        <h1>{{ $workspace->name }}</h1>
        <div class="details">
          <h2>Members</h2>
          <p>
            @foreach ($members as $member)
              | {{ $member->user->name }} | 
            @endforeach
          </p>
          <br />
          <h2>Team</h2>
          <p>{{ $workspace->team_name }}</p>
          <br />
          <h2>Role</h2>
          <p>{{ $workspace_list->role }}</p>
          <br />
          <h2>Detail</h2>
          <p>{{ $workspace->project_detail }}</p>
          <br />
        </div>

        <div class="actions">
          <!-- Note ini untuk sementara -->
          <div class="task-container">
            <form action="{{ route('createTask') }}" method="POST" enctype="multipart/form-data" class="">
              @csrf
              <div class="">
                  <input name="name" type="text" class="" placeholder="Task Name" value="{{ old('name') }}">
                  @error('name')
                      <div class="">
                          {{ $message }}
                      </div>
                  @enderror
              </div>
              
              <div class="p-2">
                  <input name="description" type="text" class="" placeholder="Task Description" value="{{ old('description') }}">
                  @error('description')
                      <div class="">
                          {{ $message }}
                      </div>
                  @enderror
              </div>

              <div class="">
                  <label for="due_date">Due Date</label>
                  <input name="due_date" type="date" class="" value="{{ old('due_date') }}">
                  @error('due_date')
                      <div class="">
                          {{ $message }}
                      </div>
                  @enderror
              </div>

              <div class="">
                  <input name="priority" type="text" class="" placeholder="Project Detail" value="{{ old('priority') }}">
                  @error('priority')
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

          <div class="task-container">
            <h2>Make Back-End Auth<a>Re-Assign</a></h2>
            <p>User request login auth from google lorem ipsum<b>Check</b></p>
            <h2>Status: Assigned to "Developer 1"<c>Delete</c></h2>
          </div>

          <div class="task-container">
            <h2>Make Back-End Auth<a>Assign</a></h2>
            <p>User request login auth from google lorem ipsum<b>Check</b></p>
            <h2>Status: Assigned to "Developer 1"<c>Delete</c></h2>
          </div>
          <div class="button">
            <a><img src="/assets/add_logo.png" /></a>
          </div>
        </div>
      </div>
    </div>
  </body>
</html>