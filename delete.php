
<?php 
  require('connect.php');

  $bookID = ($_GET['bookID'] != null && (int)$_GET['bookID'] > 0) ? mysqli_real_escape_string($boo, (int)$_GET['bookID']) : false;

  if ($bookID == false) {
    return http_response_code(400);
  }

  // delete the book record
  $sql = "DELETE FROM 'mybooks' WHERE 'bookID' = '{$bookID}' LIMIT 1";

  if (mysqli_query($boo, $sql)) {
    http_response_code(204);
  }
  else {
    http_response_code(422);
  }
  
?>