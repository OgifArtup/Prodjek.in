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
    <link rel="stylesheet" href="css/style_home.css" />
  </head>

  <body>
    <!-- NavBar -->
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


    <!-- NavBar End -->

    <!-- Hero -->
    <div class="hero">
      <h1>Good Morning, {{ auth()->user()->name }}!</h1>
      <div class="container">
        <div class="card">
          <h3>Uncompleted Task</h3>
          <h4 style="color: #aa1c1c"> {{$undoneTask}} </h4>
          <p>Tasks Needed to be Completed</p>
        </div>
        <div class="card">
          <h3>Done Task</h3>
          <h4 style="color: #aa931c"> {{$doneTask}} </h4>
          <p>Tasks Have Been Done</p>
        </div>

        <div class="card">
          <h3>Ongoing Projects</h3>
          <h4 style="color: #1caa4c"> {{ $projectAmount }} </h4>
          <p>Projects Being Worked On!</p>
        </div>
      </div>

      <h1>New Notifications</h1>

      <div class="notif-container">
        @foreach ($notifications as $notification)
        <div class="notif">
          <h1>{{ $notification->workspace->name }}</h1>
          <h2>{{ $notification->detail }}</h2>
          <div class="notif-img"><img src="assets/close_logo.png" /></div>
        </div>
        @endforeach
        @if (count($notifications) == 0)
          <div class="notif">
          <h2>No New Notification</h2>
        </div>
        @endif
      </div>

      <h1>Invitations</h1>

      <div class="notif-container">
        @foreach ($invitations as $invitation)
        <div class="notif">
          <h1>{{ $invitation->workspace->name }}</h1>
          <h2>{{ $invitation->detail }}</h2>
          <div class="notif-img"><img src="assets/close_logo.png" /></div>
          <form action="{{route('deleteNotification', ['id' => $invitation->id])}}" method="post">
            @csrf
            @method('delete')
            <button action="/decline-invitation" type="submit" class="deleteBttn">Decline</button>
          </form>
          <form action="{{route('acceptInvitation', ['id' => $invitation->id])}}" method="post">
            @csrf
            <button action="/accept-invitation" type="submit" class="deleteBttn">Accept</button>
          </form>
        </div>
        @endforeach
        @if (count($notifications) == 0)
          <div class="notif">
          <h2>No New Invitation</h2>
        </div>
        @endif
      </div>
    </div>
</div>
    <!-- Hero End -->
  </body>
</html>