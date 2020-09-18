<?php
    // session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="styles.css" rel="stylesheet">
</head>
<body>
    
<h1>CONTACTS</h1>
<a href="index.php">home</a>
<br>
<br>
<?php 

$a = 0;

while ($a < 10) {
  $a++;
  if ($a === 6) {
    echo "<br>num six detected, breaking<br>";
    continue;
  }
  echo $a;
}

?>
<br>
<br>

<?php 
$words = array(
  "Cobalt",
  "Lake Surface",
  "Blue Light",
  "Short Wave",
  );

foreach ($words as $word) {
  echo "Now echoing: " . $word . "<br>";
}

?>
<br>
<br>
<?php

if (!isset($_SESSION['username'])) {
    echo "no user detected";
} else {
    echo "user: " . $_SESSION['username'];
}
?>

</body>
</html>