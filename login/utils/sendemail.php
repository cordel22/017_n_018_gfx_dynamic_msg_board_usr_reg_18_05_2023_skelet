


<?php

$body = "Thank you for registering at <thiswebsite.com>.
        To activate your account, please click on this link:\n\n";
        //  add the login folder into url!!!
        //  $body .= BASE_URL . 'activate.php?x=' . urlencode($e) . "&y=$a";  //  tento urlencode hodi vzdy stejny output?
        $body .= BASE_URL . 'login/activate.php?x=' . urlencode($e) . "&y=$a";  //  tento urlencode hodi vzdy stejny output?
        /* 
        //  don't send it now, u dont have the mail server setup, in demo, 
        //  just show the link to his login on the same page
        mail($trimmed['email'], 'Registration Confirmation', $body, 'From: cordelfenevall@gmail.com ');
 */
        //  Finish the page:
        echo '<h3>Thank you for registering! A confirmation email has been sent to your address.
        Please click on the link in that email in order to activate your account.</h3>';


        //  if the mail server doesnt work, just in demo, login from this page
        $nosmtp = "<div>
              By the way, since we re on localhost and smtp has not been set up, \n\n
              won't you try the following link cause aint none in your mailbox:\n\n";
        //  $nosmtp .=  BASE_URL . 'activate.php?x=' . urlencode($e) . "&y=$a";     //  mas stejny urlencode outputnuty ak v dB..?
        $nosmtp .=  BASE_URL . 'login/activate.php?x=' . urlencode($e) . "&y=$a";     //  mas stejny urlencode outputnuty ak v dB..?
        $nosmtp .=  "</div>";

        echo $nosmtp;