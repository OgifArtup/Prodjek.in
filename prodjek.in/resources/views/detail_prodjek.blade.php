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
    <!-- NavBar -->

    <div class="sidebar">
        <header><img src="/assets/logo_white.png" /><b>Prodjek.In</b></header>

        <ul class="list1">
          <li><a href="/home"><img src="/assets/dashboard_logo.png" />Dashboard</a></li>
          <li><a href="/view-profile"><img src="/assets/profile_logo.png" />Profile</a></li>
          <li><a href="/project-list"><img src="/assets/prodjek_logo.png" />Prodjek</a></li>
          <li><form action="/logout" method="POST" class="logOut">
            @csrf
            <button type="submit" class="dropdown-item">
            <img src="/assets/logout_logo.png" />Logout
            </button>
        </form></li>
        </ul>
      </div>


    <!-- NavBar End -->

    <!-- Hero -->
    <div class="mainContainer">
      <div class="Message">
        <h1>Good Morning, {{ auth()->user()->name }}!</h1>
      </div>


      <div class="Card">
        <h1>{{ $workspace->name }}</h1>
        <hr>
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
          <br/>
          <h2>Invite Member</h2>

          <div class="searchbar">
          <form action="{{ route('inviteMember', ['id' => $workspace->id]) }}" method="POST" enctype="multipart/form-data" class="">
            @csrf

                <input name="email" type="text" class="" placeholder="Add User's Email">
                @error('email')
                    <div class="">
                        {{ $message }}
                    </div>
                @enderror
                <button type="submit">Add</button>
          </form>
</div>
        </div>
        </div>

        <div class="Card">
        <h1>Tasks</h1>
        <br>
        @for ($i = 0; $i < count($tasks); $i++)
          <div class="task-container">
            <div class="header">
            <h2>{{ $tasks[$i]->name }}</h2>
            <p>Re-Assign</p>
            </div>

            <div class="body">
            <p>{{ $tasks[$i]->description }}</p>
            @if ($tasks[$i]->status === 'Ongoing')
            <form action="{{route('checkTask', ['id' => $tasks[$i]->id])}}" method="post">
              @csrf
              @method('patch')
              <button type="submit">Check</button>
            </form>
            @elseif ($tasks[$i]->status === 'Done')
            <form action="{{route('uncheckTask', ['id' => $tasks[$i]->id])}}" method="post">
              @csrf
              @method('patch')
              <button type="submit" >Uncheck</button>
            </form>
            @endif
            </div>

            <div class="footer">
            <p>Deadline : <b>{{ \Carbon\Carbon::parse($tasks[$i]->date)->format('d/m/Y') }}</b></p>
            <p>Priority :<b> {{ $tasks[$i]->priority }}</b></p>
            <p>Status:<b> {{ $tasks[$i]->status }}</b></p>
            <p>Assigned to :
            @for ($j = 0; $j < count($assignedMember[$i]); $j++)
            <b>"{{ $assignedMember[$i][$j]->name }}"</b>
            @endfor
            </p>
            <form action="{{route('deleteTask', ['id' => $tasks[$i]->id])}}" method="post">
              @csrf
              @method('delete')
              <button type="submit" class="">Delete</button>
            </form>

            </div>
          </div>


          <div class="task-container">
            <h2>{{ $tasks[$i]->name }} Assigned Members :</h2>
            <h2>
              @for ($j = 0; $j < count($assignedMember[$i]); $j++)
                <form action="{{route('deleteAssignedMember')}}" method="POST">
                  @csrf
                  @method('delete')
                  {{ $assignedMember[$i][$j]->name }}
                  <input type="hidden" name="user_id" value="{{ $assignedMember[$i][$j]->id }}">
                  <input type="hidden" name="task_id" value="{{ $tasks[$i]->id }}">
                  <c><button type="submit" class="">Delete</button></c>
                </form>
              @endfor
            </h2>
            @if (count($nonAssignedMember[$i])>0)
            <h2>Assign Other Members</h2>
            <form action="{{ route('addAssignedMembers', ['id' => $tasks[$i]->id]) }}" method="POST">
              @csrf
              <div class="">
                @for ($j = 0; $j < count($nonAssignedMember[$i]); $j++)
                  <label><input type="checkbox" name=assign[] value='{{$nonAssignedMember[$i][$j]->id}}'>{{ $nonAssignedMember[$i][$j]->name }}</label>
                @endfor
              </div>
              <div class="">
                <button type="submit" class="">Assign Members</button>
              </div>
            </form>
            @elseif (count($nonAssignedMember[$i]) === 0)

            @endif
          </div>
          @endfor
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

          <div class="button">
            <a><img src="/assets/add_logo.png" /></a>
          </div>
        </div>
      </div>
    </div>
  </body>
</html>
