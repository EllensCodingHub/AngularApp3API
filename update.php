
<?php 
  require ('connect.php');
  header('Content-Type: application/json');

  // helpful for debugging
  ini_set('display_errors', 1);
  error_reporting(E_ALL);

  // parse form data
  $bookID = isset($_POST['bookID']) ? (int) $_POST['bookID'] : 0;
  $authorName = mysqli_real_escape_string($boo, $_POST['authorName'] ?? '');
  $bookTitle = mysqli_real_escape_string($boo, $_POST['bookTitle'] ?? '');
  $storyHook = mysqli_real_escape_string($boo, $_POST['storyHook'] ?? '');
  $genre = mysqli_real_escape_string($boo, $_POST['genre'] ?? '');
  $pubDate = mysqli_real_escape_string($boo, $_POST['pubDate'] ?? '');
  $publisher = mysqli_real_escape_string($boo, $_POST['publisher'] ?? '');
  $recBy = mysqli_real_escape_string($boo, $_POST['recBy'] ?? '');
  $starRating = mysqli_real_escape_string($boo, $_POST['starRating'] ?? '');

  // validate required fields
  if ($bookID < 1 || $authorName == '' || $bookTitle == '') {
    http_response_code(400);
    echo json_encode(['error' => 'missing required fields']);
    exit;
  }

  // update book
  $recBySql = $recBy === '' ? 'NULL' : "'{$recBy}'";
  $starRatingSql = $starRating === '' ? 'NULL' : "'{$starRating}'";
  $sql = "UPDATE mybooks SET
    authorName = '$authorName',
    bookTitle = '$bookTitle',
    storyHook = '$storyHook',
    genre = '$genre',
    pubDate = '$pubDate',
    publisher = '$publisher',
    recBy = {$recBySql},
    starRating = {$starRating}
    WHERE bookID = $bookID LIMIT 1";

  if (mysqli_query($boo, $sql)) {
    http_response_code(200);
    echo json_encode(['message' => 'Contact updated successfully.']);
  }
  else {
    http_response_code(500);
    echo json_encode(['error' => 'Database update failed.']);
  }

?>