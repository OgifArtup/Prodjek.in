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
    <title>View Profile</title>
    <link href="{{ asset('css/style_profile.css') }}" rel="stylesheet" type="text/css" >

  </head>
  <body>
    <!-- NavBar -->
  <div class="all">
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
    <div class ="MainContainer">

    <div>
      <h1>Good Morning, {{ auth()->user()->username }}!</h1>
    </div>

    <div class="Card">
    <div>
      <h1>Change Profile</h1>
    </div>
        <form action="{{ route('updateProfile') }}" method="POST">
            @csrf
            <label for="Username" class="form-label"><h2>Username</h2></label>
            <input name="Username" type="text" class="form-control" id="Username" value="{{ $profile->username }}">

            <label for="Email" class="form-label"><h2>Email</h2></label>
            
            <input type="text" class="form-control" id="Email" readonly value="{{ $profile->email }}">
            <br>

            <button type="submit" class="insertBttn">Update Profile</button>
        </form>
        <br/>
        <br/>
    </div>


    <div class="Card">
    <div>
      <h1>Reset Password</h1>
    </div>
        <form action="{{ route('updatePassword') }}" method="POST">
            @csrf
            <input name="lastPass" type="text" class="form-control" id="LastPass" placeholder="Last Password" >
            <br/>
            <input name="newPass" type="text" class="form-control" id="NewPass" placeholder="New Password" >
            <br/>
            <input name="confPass" type="text" class="form-control" id="ConfirmPass" placeholder="Confirmation Password" >
            <br/>
            <button type="submit" class="insertBttn">Update Password</button>
        </form>
    </div>
</div>
</div>
  </body>
</html>
