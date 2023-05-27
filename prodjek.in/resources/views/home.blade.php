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

    <ul>
      <li>
        <h1><img src="assets/logo_white.png" />Prodjek.in</h1>
      </li>
      <li>
        <a class="active" href="/home"
          ><img src="assets/dashboard_logo.png" /> Dashboard</a
        >
      </li>
      <li>
        <a href="#"><img src="assets/profile_logo.png" /> Profile</a>
      </li>
      <li>
        <a href="/project-list"
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

    <!-- NavBar End -->

    <!-- Hero -->
    <div>
      <h1>Good Morning, Username!</h1>
      <div class="container">
        <div class="card">
          <h3>Uncompleted Task</h3>
          <h4 style="color: #aa1c1c">80</h4>
          <p>Tasks Needed to be Completed</p>
        </div>

        <div class="card">
          <h3>New QC Task</h3>
          <h4 style="color: #aa931c">20</h4>
          <p>Tasks Needed to be Revised</p>
        </div>

        <div class="card">
          <h3>Ongoing Projects</h3>
          <h4 style="color: #1caa4c">5</h4>
          <p>Projects Being Worked On!</p>
        </div>
      </div>

      <h1>New Notifications</h1>

      <div class="notif-container">
        <div class="notif">
          <h1>Task Name</h1>
          <h2>Project Name</h2>
          <h3>- Message</h3>
          <div class="notif-img"><img src="assets/close_logo.png" /></div>
        </div>

        <div class="notif">
          <h1>Task Name</h1>
          <h2>Project Name</h2>
          <h3>- Message</h3>
          <div class="notif-img"><img src="assets/close_logo.png" /></div>
        </div>

        <div class="notif">
          <h1>Task Name</h1>
          <h2>Project Name</h2>
          <h3>- Message</h3>
          <div class="notif-img"><img src="assets/close_logo.png" /></div>
        </div>

        <div class="notif">
          <h1>Task Name</h1>
          <h2>Project Name</h2>
          <h3>- Message</h3>
          <div class="notif-img"><img src="assets/close_logo.png" /></div>
        </div>
      </div>
    </div>

    <!-- Hero End -->
  </body>
</html>
