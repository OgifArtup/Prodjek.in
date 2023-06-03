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
        <a href="/view-profile"><img src="assets/profile_logo.png" /> Profile</a>
      </li>
      <li>
        <a class="active" href="/project-list"
          ><img src="assets/prodjek_logo.png" /> Prodjek</a
        >
      </li>
      <ul class="ul2">
        <li>
        <b><form action="/logout" method="POST">@csrf
          <img src="/assets/logout_logo.png" />
            <button type="submit" class="dropdown-item">
                Logout
            </button>
        </form></b>
        </li>
      </ul>
    </ul>

    <div>
      <h1>Good Morning, {{ auth()->user()->name }}!</h1>
    </div>

    <div>
        <form action="{{ route('updateProfile') }}" method="POST">
            @csrf
            <label for="Username" class="form-label">Username</label>
            <br/>
            <input name="Username" type="text" class="form-control" id="Username" value="{{ $profile->username }}">
            <br/>

            <label for="Email" class="form-label">Email</label>
            <br/>
            <input type="text" class="form-control" id="Email" readonly value="{{ $profile->email }}">
            <br/>

            <button type="submit" class="insertBttn">Update Profile</button>
        </form>
        <br/>
        <br/>
    </div>


    <div>
        <form action="{{ route('updatePassword') }}" method="POST">
            @csrf
            <label for="resetPassword" class="form-label">Reset Password</label>
            <br/>
            <input name="lastPass" type="text" class="form-control" id="LastPass" placeholder="Last Password" >
            <br/>
            <input name="newPass" type="text" class="form-control" id="NewPass" placeholder="New Password" >
            <br/>
            <input name="confPass" type="text" class="form-control" id="ConfirmPass" placeholder="Confirmation Password" >
            <br/>
            <button type="submit" class="insertBttn">Update Password</button>
        </form>
    </div>

  </body>
</html>
