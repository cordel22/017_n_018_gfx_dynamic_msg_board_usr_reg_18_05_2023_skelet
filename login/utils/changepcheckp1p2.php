


<?php


if (preg_match('/^(\w){4,20}$/', $_POST['password1'])) {
    if ($_POST['password1'] == $_POST['password2']) {
      //  $p = mysqli_real_escape_string($dbc, $_POST['password1']);
      $p = $_POST['password1'];
    } else {
      echo '<p class="error">Your password did not match the 
          confirmed password!</p>';
    }
  } else {
    echo '<p class="error">Plese enter a valid password!</p>';
  }

