


<?php

//  forum table


$row_count = $stmt->rowCount();
if ($row_count > 0) {
  //  Create a table:
  echo '<table width="100%" border="0" cellspacing="2" cellpadding="2" align="center">
    <tr>
      <td align="left" width="50%"><em>' . $words['subject'] . '</em>:</td>
      <td align="left" width="20%"><em>' . $words['posted_by'] . '</em>:</td>
      <td align="center" width="10%"><em>' . $words['posted_on'] . '</em>:</td>
      <td align="center" width="10%"><em>' . $words['replies'] . '</em>:</td>
      <td align="center" width="10%"><em>' . $words['latest_reply'] . '</em>:</td>
    </tr>';

  //  Fetch each thread:
  //  while ($row = mysqli_fetch_array($r, MYSQLI_ASSOC)) {
  while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
    echo '<tr>
            <td align="left"><a href="read.php?tid=' . $row['thread_id'] . '">'
      . $row['subject'] . '</a></td>
             <td align="left">' . $row['username'] . '</td>
             <td align="center">' . $row['first'] . '</td>
             <td align="center">' . $row['responses'] . '</td>
             <td align="center">' . $row['last'] . '</td>
          </tr>';
  }

  echo '</table>';  //  Complete the table.
} else {
  echo '<p>There are currently no messages in this forum.</p>';
}


