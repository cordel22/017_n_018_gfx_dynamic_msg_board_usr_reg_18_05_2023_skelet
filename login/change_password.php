<?php # Script 18.11 - change_password.php
//  This page allows a logged-in user to chnge their password.
require('includes/config.inc.php');
$page_title = 'Change your Password';
include('includes/header.html');

//  If no first_name session variable exists, redirect the user:
require_once('./utils/changepifsess.php');


if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  require(MYSQL);

  //  Check for  new password and match against the confirmed password:
  $p = FALSE;
  require_once('./utils/changepcheckp1p2.php');
  
  if ($p) { //  If everything's OK.
    //  Make the query:
    /* $q = "UPDATE users SET pass=SHA1('$p') WHERE user_id=
        {$_SESSION['user_id']} LIMIT 1";
    $r = mysqli_query($dbc, $q) or trigger_error(
      "Query: $q\n<br />MySQL Error: " . mysqli_error($dbc)
    ); */

    $p = SHA1('$p');
    $uid = (int) $_SESSION['user_id'];


    require_once('./utils/changepupdatep.php');
    

    //  if (mysqli_affected_rows($dbc) == 1) {
    if ($stmt->rowCount() == 1) {
      //  If it ran OK.
      //  Send an email, if desired.
      echo '<h3>Your password has been chnged.</h3>';
      //  mysqli_close($dbc); //  Close the database connection.
      $stmt = null;
      include('includes/footer.html'); //  Include the HTML footer.
      exit();
    } else {
      //  If it did not run OK.
      echo '<p class="error">Your password was not changed.
          Make sure your new password is different than the 
          current password. Contact the system administrator if
          you think an error occurred.</p>';
    }
    //)
  } else {
    //  Failed the validation test.
    echo '<p class="error">Please try again.</p>';
  }

  //  mysqli_close($dbc);   //  Close the database connection.
  $stmt = null;
} //  End of the main Submit conditional.

?>

<h1>Change Your Password</h1>
<form action="change_password.php" method="post">
  <fieldset>
    <p><b>New Password:</b> <input type="password" name="password1" size="20" maxlength="20" />
      <small>Use only letters, numbers, and the underscore. Must be
        between 4 and 20 characters long.</small>
    </p>
    <p><b>Confirm New Password:</b>
      <input type="password" name="password2" size="20" maxlength="20" />

    </p>
  </fieldset>
  <div align="center">
    <input type="submit" name="submit" value="Change My Password" />
  </div>
</form>

<?php include('includes/footer.html'); ?>