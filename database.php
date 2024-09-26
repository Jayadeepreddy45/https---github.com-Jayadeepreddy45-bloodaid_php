<?php

$db_server = "ls-8351950865b689bfff6492a24882a37e8a8e80df.cgd4aj6sswr0.us-east-1.rds.amazonaws.com";
$db_user = "jayadeep";
$db_pass = "p@ssw0rd";
$db_name = "bloodaid";
$conn = "";

$conn = mysqli_connect($db_server, $db_user, $db_pass, $db_name);

if ($conn) {
  echo "";
}
 else {
  echo "couldn't connect!";
}

?>
