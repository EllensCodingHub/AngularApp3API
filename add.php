
<?php 
  require ('connect.php');
  header('Content-Type: application/json');

  // helpful for debugging
  ini_set('display_errors', 1);
  error_reporting(E_ALL);

  // get the posted data
  $postdata = file_get_contents("php://input");

  if (isset($postdata) && !empty($postdata)) {
    $request = json_decode($postdata);

      // validate the required fields
      if (trim($request->data->authorName) == '' || trim($request->data->bookTitle) == '' || 
      trim($request->data->storyHook) == '' || trim($request->data->genre) == '' || 
      trim($request->data->pubDate) == '' || trim($request->data->publisher) == '' || 
      trim($request->data->recBy) == '' || trim($request->data->starRating) == '') {
      
      http_response_code(400);
      echo json_encode(['message' => 'missing required fields']);
      exit;
      }

      // sanitize
      $authorName = mysqli_real_escape_string($boo, trim($request->data->authorName));
      $bookTitle = mysqli_real_escape_string($boo, trim($request->data->bookTitle));
      $storyHook = mysqli_real_escape_string($boo, trim($request->data->storyHook));
      $genre = mysqli_real_escape_string($boo, trim($request->data->genre));
      $pubDate = mysqli_real_escape_string($boo, trim($request->data->pubDate));
      $publisher = mysqli_real_escape_string($boo, trim($request->data->publisher));
      $recBy = mysqli_real_escape_string($boo, trim($request->data->recBy));
      $starRating = mysqli_real_escape_string($boo, trim($request->data->starRating));

      // insert into database
      $sql = "INSERT INTO `mybooks`(`authorName`, `bookTitle`, `storyHook`, `genre`, `pubDate`, `publisher`, `recBy`, `starRating`)
        VALUES('{$authorName}', '{$bookTitle}', '{$storyHook}', '{$genre}', '{$pubDate}', '{$publisher}', '{$recBy}', '{$starRating}')";

      if (mysqli_query($boo, $sql)) {
        http_response_code(201);
        echo json_encode([
          'data' => [
            'bookID' => mysqli_insert_id($boo),
            'authorName' => $authorName,
            'bookTitle' => $bookTitle,
            'storyHook' => $storyHook,
            'genre' => $genre,
            'pubDate' => $pubDate,
            'publisher' => $publisher,
            'recBy' => $recBy,
            'starRating' => $starRating
          ]
        ]);
      }
      else {
        http_response_code(422);
        echo json_encode(['message' => 'Database insert failed.']);
      }
      
  }
?>