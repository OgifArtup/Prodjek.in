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
    <title>Login Page</title>
    <link rel="stylesheet" href="css/style_login.css" />
  </head>
  <body>
    <section class="header">
      <nav>
        <div class="logo-contain">
          <a href="main.html"><img src="assets/logo.png" /></a>
        </div>
        <div class="nav-link">
          <ul>
            <li class="link">English (UK) ˅</li>
          </ul>
        </div>
      </nav>
      <div class="banner-text">
        <p>Manage your Projects, Teams,</p>
        <br />
        <p>and progress with us.</p>
      </div>
      <div class="body">
        <div class="gambar">
          <img src="assets/illustration.png" />
        </div>
        <div class="loginform">
          <h1>Welcome</h1>
          <div class="form">
            <div class="login_3rd_party">
              {{-- <form action="home.html">
                <input
                  type="submit"
                  class="submit-google"
                  value="Login with Google"
                />
              </form> --}}
              <a href="{{ route('googleLogin') }}">
                Login
              </a>
            </div>
            <br />
            <p>- OR -</p>
            <br />
            <form action="{{ route('manualLogin') }}" method="POST" enctype="multipart/form-data">
              @csrf
              <div class="input-field">
                <input
                  name="email"
                  type="text"
                  class="input"
                  id="email"
                  placeholder="Email"
                />
                @error('email')
                    <div class="text-danger">
                        {{ $message }}
                    </div>
                @enderror
              </div>
              <div class="input-field">
                <input
                  name="password"
                  type="password"
                  class="input"
                  id="email"
                  placeholder="Password"
                />
                @error('password')
                    <div class="text-danger">
                        {{ $message }}
                    </div>
                @enderror
              </div>
              <br />
              <div class="input-field">
                <input type="submit" class="submit" value="Login Now" />
              </div>
            </form>
          </div>
        </div>
      </div>
    </section>
  </body>
</html>
