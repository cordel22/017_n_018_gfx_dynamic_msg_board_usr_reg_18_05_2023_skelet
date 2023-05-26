



<?php

if (!empty($_POST['email'])) {
    //  $e = mysqli_real_escape_string($dbc, $_POST['email']);
    $e = $_POST['email'];
  } else {
    $e = FALSE;
    echo '<p class="error">You fogot to enter your email address!</p>';
  }


  