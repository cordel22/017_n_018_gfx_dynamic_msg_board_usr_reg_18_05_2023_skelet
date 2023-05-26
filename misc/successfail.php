


<?php

if ($stmt->rowCount() == 1) {
        echo '<p>Your post has been entered.</p>';
      } else {
        echo '<p>Your post could not be handled due to a system error.</p>';
      }