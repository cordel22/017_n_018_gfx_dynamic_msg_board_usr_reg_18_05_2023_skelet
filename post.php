<?php # Script 17.7 - post.php
//  This page handles the message post.
//  It also displays the form if creating a new thread.
include('includes/header.html');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  //  Handle the form.

  //  Language ID is in the session.
  //  Validate thread ID ($tid), which may not be present:
  if (isset($_POST['tid']) && filter_var($_POST['tid'], FILTER_VALIDATE_INT, array('min_range' => 1))) {
    $tid = $_POST['tid'];
  } else {
    $tid = FALSE;
  }

  //  If there's no thread ID, a subject must be provided:
  if (!$tid && empty($_POST['subject'])) {
    $subject = FALSE;
    echo '<p>Please enter a subject for this post.</p>';
  } elseif (!$tid && !empty($_POST['subject'])) {
    $subject = htmlspecialchars(strip_tags($_POST['subject']));
  } else {
    //  Thread ID, no need for subject.
    $subject = TRUE;
  }

  //  Validate the body:
  if (!empty($_POST['body'])) {
    $body = htmlentities($_POST['body']);
  } else {
    $body = FALSE;
    echo '<p>Please enter a body for this post.</p>';
  }
  if ($subject && $body) {
    //  OK!

    //  Add the message to the database...

    if (!$tid) {
      //  Create a new thread.
      /* 
        //  https://stackoverflow.com/questions/3716373/real-escape-string-and-pdo
        //  Use prepared statements. Those keep the data and syntax apart, which removes the need for escaping MySQL data. See e.g. this tutorial. */
        require_once('./misc/newthread.php');



      //  if (mysqli_affected_rows($dbc) == 1) {
      //  https://stackoverflow.com/questions/10522520/pdo-were-rows-affected-during-execute-statement
      //  if ($r->rowCount() == 1) {
      if ($stmt->rowCount() == 1) {
        //  $tid = mysqli_insert_id($dbc);
        //  https://stackoverflow.com/questions/9753720/what-is-equivalent-of-mysql-insert-id-using-prepared-statement
        //  if ($r) {
        //  rowCount() is the most useless method in all database APIs. And your code is a perfect example of that.
        //  https://stackoverflow.com/questions/56738038/fatal-error-uncaught-error-call-to-a-member-function-rowcount-on-bool
        $tid = $pdo->lastInsertId();
      } else {
        echo '<p>Your post could not be handled due to a system error.</p>';
      }
    } //  No $tid.

    if ($tid) {

      //  Add this to the replies table:
      
      require_once('./misc/add2repliestable.php');
      
      
      //  $r =mysqli_query($dbc, $q);

      //  success or fail condition
      require_once('./misc/successfail.php');

      
    } //  Valid $tid.
  } else {
    //  Include the form:
    include('includes/post_form.php');
  }
} else {
  //  Display the form:
  include('includes/post_form.php');
}

include('includes/footer.html');
