


<?php


if (isset($_SESSION['user_id'])) {
    echo '<a href="logout.php" title="Logout">
            Logout
          </a><br />
          <a href="login/change_password.php" title="Change Your Password">
    Change Password
  </a><br />
  ';
  


    //  Add links if the user is an administrator:
  //  you switched to the forum2 users table which doent hve user level!!!
    if (isset($_SESSION['user_level']) && $_SESSION['user_level'] == 1) {
      echo '<a href="login/view_users.php" title="View All Users">
              View Users
            </a><br />

            <a href="#">Some Admin Page</a><br />
    ';
    } 
          
  } else {
    //  Not logged in.  //  "http://localhost/register.php"
    echo '<a href="login/register.php" title="Register for the site">   
            Register
          </a><br />
          <a href="login/login.php" title="Login">Login</a><br /><p>skus qq qq q@q.com qqqq alebo ww ww w@w.com wwww</p>
          <a href="login/forgot_password.php" title="Password Retrieval">
            Retrieve Password
          </a><br />
    ';
  }