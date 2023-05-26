


<?php

if (preg_match('/^[A-Z \'.-]{2,40}$/i', $trimmed['name'])) {
    $n = $trimmed['name'];
  } else {
    echo '<p class="error">Please enter your name!</p>';

  }


  