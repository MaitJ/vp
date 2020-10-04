<?php

$title = "";
if (empty($username)) {
  $title = "Gheto kalawiki";
}
else {
  $title = $username . " veebileht";
}

?>
<!DOCTYPE html>
<html lang="et">
<head>
  <meta charset="utf-8">
  <link rel="stylesheet" type="text/css" href="../style.css">
  <title><?php echo $title;?></title>

</head>
<body>
