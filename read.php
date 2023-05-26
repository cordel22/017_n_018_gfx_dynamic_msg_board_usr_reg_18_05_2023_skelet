<?php # Script 17.5 - read.php
//  This page shows the messages in  thread.
//  premature reincarnation
include('includes/header.html');

//  Check for a thread ID...
$tid = FALSE;
if (isset($_GET['tid']) && filter_var($_GET['tid'], FILTER_VALIDATE_INT, array('min_range' => 1))) {
  //  Create a shorthand version of the thread ID:
  $tid = $_GET['tid'];

  //  Convert the date if the user is logged in:
  require_once('./misc/convertdate.php');

  //  Run the query:
  require_once('./misc/checkthreadidquery.php');

  //  if (!(mysqli_num_rows($r) > 0)) {
  if (!($row_count > 0)) {
    $tid = FALSE;   //  Invalid thread ID!
  }
} //    End of isset($_GET['tid']) IF.

if ($tid) {
  //  Get the messages in this thread...
  $printed = FALSE; //  Flag variable.

  //  Fetch each:
  
  while ($messages = $stmt->fetch(PDO::FETCH_ASSOC)) {
    //  Only need to print the subject once!
    if (!$printed) {
      echo "<h2>{$messages['subject']}<h2>\n";
      $printed = TRUE;
    }

    //  Print the message:
    echo "<p>{$messages['username']} ({$messages['posted']})<br />{$messages['message']}</p><br />\n";
  } //  End of WHILE loop.

  //  Show the form to post a message:
  include('includes/post_form.php');
} else {
  //  Invalid thread ID!
  echo '<p>This page has been accessed in error.</p>';
}

include('includes/footer.html');