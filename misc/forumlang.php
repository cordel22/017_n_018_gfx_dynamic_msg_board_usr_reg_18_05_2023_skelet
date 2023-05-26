



<?php


$q = "SELECT lang_id, lang FROM languages ORDER BY lang_eng ASC";
                  //  $r = mysqli_query($dbc, $q);
                  $stmt = $pdo->query($q);
                  $row_count = $stmt -> rowCount();
                  //  if (mysqli_num_rows($r) > 0) {
                  if ($row_count > 0) {
                    //  while ($menu_row = mysqli_fetch_array($r, MYSQLI_NUM)) {
                    while ($menu_row = $stmt->fetch(PDO::FETCH_NUM)) {
                      
                      echo "<option value=\"$menu_row[0]\">$menu_row[1]</option>\n";
                    }
                  }
                  //  mysqli_free_result($r);
                  $stmt->closeCursor();


