

<?php 
  require ('connect.php');
  header('Content-Type: application/json');

  // helpful for debugging
  ini_set('display_errors', 1);
  error_reporting(E_ALL);

  $bookID = isset($_GET['bookID']) ? (int) $_GET['bookID'] : 0;

  if ($bookID <= 0) {
    http_response_code(400);
    exit;
  }

  $sql = "SELECT * FROM `books` WHERE `bookID` = '{$bookID}' LIMIT 1";

  if ($result = mysqli_query($boo, $sql)) {
    if (mysqli_num_rows($result) == 1) {
      echo json_encode(mysqli_fetch_assoc($result));
    }
  }
  else {
    http_response_code(500)
<?php 
  require ('connect.php');
  header('Content-Type: application/json');

  // helpful for debugging
  ini_set('display_errors', 1);
  error_reporting(E_ALL);

  $bookID = isset($_GET['bookID']) ? (int) $_GET['bookID'] : 0;

  if ($bookID <= 0) {
    http_response_code(400);
    exit;
  }

  $sql = "SELECT * FROM `books` WHERE `bookID` = '{$bookID}' LIMIT 1";

  if ($result = mysqli_query($boo, $sql)) {
    if (mysqli_num_rows($result) == 1) {
      echo json_encode(mysqli_fetch_assoc($result));
    }
  }
  else {
    http_response_code(500);
  }
  
  }

?>