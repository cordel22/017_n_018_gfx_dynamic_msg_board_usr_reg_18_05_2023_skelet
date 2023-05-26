


<?php

   // Check for a new language ID...
   // Then store the language ID in the session:


if (isset($_GET['lid']) && filter_var($_GET['lid'], 
FILTER_VALIDATE_INT, array('min_range' => 1))
){
  $_SESSION['lid'] = $_GET['lid'];
} elseif (!isset($_SESSION['lid'])) {
  $_SESSION['lid'] = 1; //  Default.
}

