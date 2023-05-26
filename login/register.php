<?php # Script 18.6 - register.php
//  This is the registration page for the site.

//  Include the configuration file:
//  debug
require('includes/config.inc.php');

//  Set the page title and include the HTML header:
$page_title = 'Register';
//lets try to override this header?

//wont do no good

//u r cnnected from the config through footer or how daa fuck!!!
include('includes/header.html');

//  include('../includes/header.html');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  //  Handle the form.

  //  Need the database connection:
  //  debug
  //  u need this bitch but it is in the login/includes/config...
  require(MYSQL);

  //  Trim all the incoming data:
  $trimmed = array_map('trim', $_POST);

  //  Assume invalid values:
  $fn = $ln = $e = $p = FALSE;

  //  Check for a first name:
  /*  careful, you dont put into ch18 but forum2!!! there is only name!!!!
  if (preg_match('/^[A-Z \'.-]{2,20}$/i', $trimmed['first_name'])) {
    //  $fn = mysqli_real_escape_string($dbc, $trimmed['first_name']);  //  not necessary when using PDO  https://stackoverflow.com/questions/15648228/how-to-use-write-mysql-real-escape-string-in-pdo
    $fn = $trimmed['first_name'];
  } else {
    echo '<p class="error">Please enter your first name!</p>';
    echo 'lets see, you put in : ' . $trimmed['first_name'];    //  this line aint in book
  }


  //  Check for a last name:
  if (preg_match('/^[A-Z \'.-]{2,40}$/i', $trimmed['last_name'])) {
    //  $ln = mysqli_real_escape_string($dbc, $trimmed['last_name']);   //  not necessary when using PDO  https://stackoverflow.com/questions/15648228/how-to-use-write-mysql-real-escape-string-in-pdo
    $ln = $trimmed['last_name'];
  } else {
    echo '<p class="error">Please enter your last name!</p>';
    //  echo 'lets see, you put in : ' . $trimmed['last_name'];
  }
  */
  //  Check for a name:
    require_once('./utils/checkname.php');

  //  Check for an email address:
    require_once('./utils/checkemail.php');
  

  //  Check for a password and match aginst the confirmed password:
    require_once('./utils/checkconfirmpass.php');
    

  if ($n && $e && $p) {
    //  If everything's OK...
    //  Make sure the email address is available:
    //  $q = "SELECT user_id FROM users WHERE email='$e'";
    //  $r = mysqli_query($dbc, $q) or trigger_error("Query: $q\n<br />MySQL Error: " . mysqli_error($dbc));
    require_once('./utils/emailavailablequery.php');
    
    //  if (mysqli_num_rows($r) == 0) {
    if ($row_count == 0) {
      //  Available.

      //  Create the activation code:
      $a = md5(uniqid(rand(), true));

      //  Add the user to the database:
      // $q = "INSERT INTO users (email, pass, first_name, last_name, active,
      // registration_date) VALUES ('$e', SHA1('$p'), '$fn', '$ln', '$a', NOW() )";
      // $r = mysqli_query($dbc, $q) or trigger_error("Query: $q\n<br />MySQL Error: " . mysqli_error($dbc));
//  WATCH OUT!!!  forum2 users can not activatte, so register here, and you are good to go!!!
      
      
      require_once('./utils/adduser2dbquery.php');
      


      //  if (mysqli_affected_rows($dbc) == 1) {
      if ($stmt->rowCount() == 1) {
        //  If it ran OK.

        /* 
        // configure smtp server
        ini_set('SMTP', 'tls://smtp.gmail.com');
        //  ini_set('smtp_port', '465');
        ini_set('smtp_port', '587');
        ini_set("sendmail_from", "cordelfenevall@gmail.com");
 */

        //  Send the email:
        require_once('./utils/sendemail.php');
        

        include('includes/footer.html'); //  Include the HTML footer.
        exit(); //  Stop the page.
      } else {
        //  If it did not run OK.
        echo '<p class="error">You could not be registered due to a system error.
        We apologie for any inconvenience.</p>';
      }
    } else {
      //  The email address is not available.
      echo '<p class="error">
        That email address has already been registered.
        If you have forgotten your password, 
        use the link at right to have your password sent to you.
        </p>';
    }
  } else {
    //  If one of the data tests failed.
    echo '<p class="error">Plese try again.</p>';
  }

  //  mysqli_close($dbc);
  //  https://stackoverflow.com/questions/18277233/pdo-closing-connection
  $stmt = null;
} //  End of the main Submit conditional.
?>

<h1>Register</h1>
<form action="register.php" method="post">
  <fieldset>
    <!--
    <p><b>First Name:</b>
      <input type="text" name="first_name" size="20" maxlength="20" value="
          <?php
    /*      if (isset($trimmed['first_name']))
            echo $trimmed['first_name'];  */
          ?>
        " />
    </p>

    <p><b>Last Name:</b>
      <input type="text" name="last_name" size="20" maxlength="40" value="
          <?php
    /*      if (isset($trimmed['last_name']))
            echo $trimmed['last_name'];  */
          ?>
        " />
    </p>
-->
    <p><b>Name:</b>
      <input type="text" name="name" size="20" maxlength="40" value="
          <?php
          if (isset($trimmed['name']))
            echo $trimmed['name'];
          ?>
        " />
    </p>

    <p><b>Email Address:</b>
      <input type="text" name="email" size="30" maxlength="60" value="
          <?php
          if (isset($trimmed['email']))
            echo $trimmed['email'];
          ?>
        " />
    </p>

    <p><b>Password:</b>
      <input type="password" name="password1" size="20" maxlength="20" value="
          <?php
          if (isset($trimmed['password1']))
            echo $trimmed['password1'];
          ?>
        " />
      <small>
        Use only letters, numbers, and the underscore.
        Must be between 4 and 20 charactes long.
      </small>
    </p>

    <p><b>Confirm Password:</b>
      <input type="password" name="password2" size="20" maxlength="20" value="
          <?php
          if (isset($trimmed['password2']))
            echo $trimmed['password2'];
          ?>
        " />
    </p>
  </fieldset>

  <div align="center">
    <input type="submit" name="submit" value="Register" />
  </div>
</form>

<?php include('includes/footer.html'); ?>