<?php # Script 17.4 - forum.php
//  This page shows the threads in  forum.
include('includes/header.html');

//  Retrieve all the messages in this forum...

//  If the user is logged in and has chosen a time zone,
//  use that to convert the dates and times:
require_once('./misc/converttz.php');


//  The query for retrieving all the threads in this forum, along with the original user,
//  when the thread was first posted, when it was last replied to, and how many replies it's had:
require_once('./misc/allthreadsdatesnumreplies.php');


//  forum table
require_once('./misc/forumtable.php');



//  Include the HTML footer file:
include('includes/footer.html');
