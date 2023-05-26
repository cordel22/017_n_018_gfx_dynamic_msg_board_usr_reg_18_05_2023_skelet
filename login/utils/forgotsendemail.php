


<?php


$body = "Yourpassword to log into <whtever site.com>
          has been temporarily changed to '$p'. Please log in
          using this password and this email address. Then
          you may change your password to something more familiar.";
      /* 
        //  we still dont have an smtp, no email for now
          mail($_POST['email'], 'Your temporary password.',
          $body, 'From: cordelfenevall@gmail.com');
 */
      //  Print a message and wrap up:
      echo '<h3>Your password has been changed. You will receive
          the new, temporary password at the email address with
          which you registered. Once you hve logged in with this 
          password, you may change it by clicking on the "Change
          Password" link.</h3>';

      echo "<div>
              On the other hand, we still havent set up the mail server,
              <br />
              feel free t use this new password: '$p', 
              <br />
              once logged in, change it for whatever you wnt;)
              </div>";


              