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
            <form action="{{ route('createTask', ['id' => $workspace->id]) }}" method="POST" enctype="multipart/form-data" class="">
              @csrf
              <div class="">
                  <input name="name" type="text" class="" placeholder="Task Name" value="{{ old('name') }}">
                  @error('name')
                      <div class="">
                          {{ $message }}
                      </div>
                  @enderror
              </div>
              
              <div class="">
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
                <select name="priority" value="{{ old('priority') }}">
                  <option value="Important">Important</option>
                  <option value="Urgent">Urgent</option>
                  <option value="Normal">Normal</option>
                  <option value="Low">Low</option>
                </select>
                @error('priority')
                    <div class="">
                        {{ $message }}
                    </div>
                @enderror
              </div>

              <div class="">
                <label for="assign[]">Assign To</label>
                @foreach ($members as $member)
                  <label><input type="checkbox" name=assign[] value='{{$member->user->id}}'>{{$member->user->name}}</label>
                @endforeach
                @error('assign')
                    <div class="">
                        {{ $message }}
                    </div>
                @enderror
              </div>

              <div class="">
                  <button type="submit" class="">Add Task</button>
              </div>
            </form>
          </div>
          
          @for ($i = 0; $i < count($tasks); $i++)
          <div class="task-container">
            <h2>{{ $tasks[$i]->name }}<a>Re-Assign</a></h2>
            <p>{{ $tasks[$i]->description }}<b>Check</b></p>
            <h2>Deadline : {{ \Carbon\Carbon::parse($tasks[$i]->date)->format('d/m/Y') }}</h2>
            <h2>Priority : {{ $tasks[$i]->priority }}</h2>
            <h2>Status: Assigned to 
            @for ($j = 0; $j < count($assignedMember[$i]); $j++)
              "{{ $assignedMember[$i][$j] }}"
            @endfor
            <c>Delete</c></h2>
          </div>
          @endfor
          
          <div class="button">
            <a><img src="/assets/add_logo.png" /></a>
          </div>
        </div>
      </div>
    </div>
  </body>
</html>