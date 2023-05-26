

<?php



$q = "SELECT user_id, username/*, user_level*/ FROM users WHERE (email='$e' AND pass = '$p')/* AND active IS NULL*/";
$stmt = $pdo->query($q);



//  if (@mysqli_num_rows($r) == 1) {
$row_count = $stmt->rowCount();
//  debug
echo "<br >";
print_r($stmt);
echo "<br >";
var_dump($stmt);
echo "<br >";
//  end debug



