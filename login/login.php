<?php # Script 18.8 - login.php
//  This is the login page for the site.
//  TODO: is this the correct includes config???
require('includes/config.inc.php');
$page_title = 'Login';
include('includes/header.html');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  require(MYSQL);

  //  Validate the email address:
  require_once('./utils/logincheckemail.php');

  //  Validate the password:
  require_once('./utils/logincheckpass.php');
  
  if ($e && $p) {
    //  lebo sha1 shalene nefunguje v statemente:
    //  nemaj to v uvodzovkach!!!
    $p = SHA1($p);
              //  debug shalene heslo
              echo "<br />";
              echo "encyphered password dollar_p: $p";
              echo "<br />";
              //  end debug shalene heslo
    //  If everything's OK.
    //  Query the database:
    /* $q = "SELECT user_id, first_name, user_level
          FROM users WHERE
          (email='$e' AND pass=SHA1('$p')) AND active IS NULL";
    $r = mysqli_query($dbc, $q)
      or trigger_error("Query: $q\n<br />MySQL Error: "
        . mysqli_error($dbc)); */

    // $q = "SELECT user_id, first_name, user_level FROM users WHERE
    // (email='$e' /* AND pass=SHA1('$p') */) AND active IS NULL";

    //  $q = "SELECT user_id, first_name, user_level FROM users WHERE email='kokot@kokotko.com' AND active IS NULL";

    //  $stmt = $pdo->query("SELECT user_id, first_name, user_level FROM users WHERE email='kokot@kokotko.com' AND active IS NULL");  //  or trigger_error("Query: $q\n<br />MySQL Error: " . mysqli_error($dbc));
    //  this one is for login users, two lines below is forum2 users
    //  $q = "SELECT user_id, first_name, user_level FROM users WHERE (email='$e' AND /*pass=SHA1('$p') */pass = '$p') AND active IS NULL";
    
    require_once('./utils/loginquerydb.php');

    if ($row_count == 1) {
      //  A match was made.

      //  debug
      echo "sme tu!";
      $row = $stmt->fetch(PDO::FETCH_ASSOC);
      echo "<br />";
      var_dump($row);
      //  end debug

      //  Register the values:
      //  $_SESSION = mysqli_fetch_array($r, MYSQLI_ASSOC);   //  inak tu sa do session zapisuju userove premenne

      if ($row) { // no row = false
        //   debug
        echo "user_id = " . $row['user_id'] . "<br />";
        //  echo "first_name = " . $row['first_name'] . "<br />";
        echo "name = " . $row['name'] . "<br />";
        echo "user_level = " . $row['user_level'] . "<br />";
        //  end debug

        //  set session
        require_once('./utils/loginsetsess.php');
  
      }
      echo "pozrime si $ SESSION, nemalo by tam nieco byt..?<br />";
      var_dump($_SESSION);
      //  mysqli_free_result($r);


      $stmt->closeCursor();
      //  mysqli_close($dbc);
      $stmt = null;

      //  Redirect the user:
      //  TODO: bacha kam to presmerujes, ale tusim to fungovalo dobre...
      $url = BASE_URL . 'index.php';
      //  Define the URL.
      ob_end_clean();
      //  Delete the buffer.
      header("Location: $url");
      exit(); //  Quit the script.
    } else {
      //  No match was made.
      echo '<p class="error">Either the email address and password
        enteredd do not match those on file or you have not yet 
        activted your account.</p>';
    }
  } else {
    //  If everything wasn't OK.
    echo '<p class="error">Please try again.</p>';
  }
  //  mysqli_close($dbc);
  $stmt = null;
} //  End of SUBMIT conditional.
?>

<h1>Login</h1>
<p>
  Your browser must allow cookies in order to log in.
</p>
<form action="login.php" method="post">
  <fieldset>
    <p><b>Email Address:</b>
      <input type="text" name="email" size="20" maxlength="60" />
    </p>
    <p><b>Password:</b>
      <input type="password" name="pass" size="20" maxlength="20" />
    </p>
    <div align="center">
      <input type="submit" name="submit" value="Login" />
    </div>

  </fieldset>
</form>

<?php include('includes/footer.html');
