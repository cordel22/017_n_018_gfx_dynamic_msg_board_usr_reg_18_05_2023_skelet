<?php # Script 18.10 - forgot_password.php
//  This page allows a user to reset their password, if forgotten
require('includes/config.inc.php');
$page_title = 'Forgot your Password';
include('includes/header.html');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  require(MYSQL);

  //  Assume nothing:
  $uid = FALSE;

  //  Validate the email address...
  if (!empty($_POST['email'])) {
    //  Check for the existence of that email address...
    /* $q = 'SELECT user_id FROM users WHERE email="'
      . mysqli_real_escape_string($dbc, $_POST['email']) . '"';
    $r = mysqli_query($dbc, $q) or trigger_error(
      "Query: $q\n<br />MySQL Error: " . mysqli_error($dbc) */

    
    require_once('./utils/forgotcheckemail.php');

    //  $stmt = $pdo->query($q);  //  or trigger_error("Query: $q\n<br />MySQL Error: " . mysqli_error($dbc)


    //  if (mysqli_num_rows($r) == 1) {
    $row_count = $stmt->rowCount();
    if ($row_count == 1) {

      //  debug
      echo "<br />";
      var_dump($stmt);
      echo "<br />";


      $row = $stmt->fetch(PDO::FETCH_ASSOC);
      echo "<br />";
      var_dump($row);
      echo "<br />";
      //  debug

      //  Retrieve the user ID:
      //  list($uid) = mysqli_fetch_array($r, MYSQLI_NUM);
      //  list($uid) = $stmt->fetch(PDO::FETCH_ASSOC);
      //$uid = $stmt->fetch(PDO::FETCH_ASSOC);
      $uid = (int) $row['user_id'];

      //  debug
      echo "<br />";
      var_dump($uid);
      echo "<br />";
      //  debug

    } else {
      //  No database match made.
      echo '<p class="error">The submitted email address 
          does not match those on file!</p>';
    }
  } else {
    //  No email!
    echo '<p class="error">You forgot to enter your email aaddress!</p>';
  } //  End of empty($_POST['email']) IF.

  if ($uid) {

    //  debug
    echo "<br />";
    var_dump($uid);
    echo "<br />";
    //  debug
    //  If everything's OK.
    //  Create  a new, random password:
    $p = substr(md5(uniqid(rand(), true)), 3, 10);
    $pShalene = SHA1('$p');  //  shalene ti nejde v statemente...

    //  Update the database:
    /* $q = "UPDATE users SET pass=SHA1('$p') WHERE user_id=$uid LIMIT 1";
    $r = mysqli_query($dbc, $q) or trigger_error(
      "Query: $q\n<br />MySQL Error: " . mysqli_error($dbc)
    ); */

    //  debug
    echo "<br />";
    var_dump($p);
    echo "<br />";
    var_dump($pShalene);
    echo "<br />";
    var_dump($uid);
    //  debug
    /*  tu kurva co je za problem, rozdeleny riadok..?
    $sql = "UPDATE users SET pass = :pass
            WHERE user_id = :user_id LIMIT 1";
    $stmt = $pdo->prepare($sql);
    $stmt->execute(array(
      //  ':pass' => SHA1('$p'),
      ':pass' => $pShalene,
      ':user_id' => $uid
    )); //  or trigger_error("Query: $q\n<br />MySQL Error: " . mysqli_error($dbc));
 */

    require_once('./utils/forgotupdatep.php');



    //  if (mysqli_affected_rows($dbc) == 1) {
    if ($stmt->rowCount() == 1) {
      //  If it ran OK.

      //  Send an email:
      require_once('./utils/forgotsendemail.php');
      
      //  mysqli_close($dbc);
      $stmt = null;
      include('includes/footer.html');
      exit(); //  Stop the script.

    } else {
      //  If it did not run OK.
      echo '<p class="error">Your pssword could not be changed
          due to a system error. We apologize for any inconvenience.</p>';
    }
  } else {
    //  Failed the validation test.
    echo '<p class="error">Please try again.</p>';
  }

  //  mysqli_close($dbc);
  $stmt = null;
} //  End of the main Submit conditional.

?>

<h1>Reset Your Password</h1>
<p>Enter your email address below and your password will be reset.</p>
<form action="forgot_password.php" method="post">
  <fieldset>
    <p><b>Email Address:</b> <input type="text" name="email" size="20" maxlength="60" value="<?php
                                                                                              if (isset($_POST['email'])) echo $_POST['email'];
                                                                                              ?>" /></p>
  </fieldset>
  <div align="center"><input type="submit" name="submit" value="Reset My Password" /></div>
</form>

<?php include('includes/footer.html'); ?>