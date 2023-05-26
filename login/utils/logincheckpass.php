



<?php

if (!empty($_POST['pass'])) {
    //  $p = mysqli_real_escape_string($dbc, $_POST['pass']);
    $p = $_POST['pass'];
          //  debug shalene heslo
          echo "<br />";
          echo "not encyphered password dollar_p: $p";
          echo "<br />";
          //  end debug shalene heslo
  } else {
    $p = FALSE;
    echo '<p class="error">You forgot to enter your password!</p>';
  }
