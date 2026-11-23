
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
      if (trim($request->data->authorName) == '' || trim($request->data->bookTitle) == '') {
      
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
      
      $recBy = trim((string) ($request->data->recBy ?? ''));
      $recBy = $recBy === '' ? null : mysqli_real_escape_string($boo, $recBy);
      
      $starRating = trim((string) ($request->data->starRating ?? ''));
      $starRating = $starRating === '' ? null : mysqli_real_escape_string($boo, $starRating);
      
      $imageName = mysqli_real_escape_string($boo, trim($request->data->imageName ?? 'placeholder_100.jpg'));

      // insert into database
      $recBySql = $recBy === null ? 'NULL' : "'{$recBy}'";
      $starRatingSql = $starRating === null ? 'NULL' : "'{$starRating}'";

      $sql = "INSERT INTO `mybooks`(`authorName`, `bookTitle`, `storyHook`, `genre`, `pubDate`, `publisher`, `recBy`, `starRating`, `imageName`)
        VALUES('{$authorName}', '{$bookTitle}', '{$storyHook}', '{$genre}', '{$pubDate}', '{$publisher}', {$recBySql}, {$starRatingSql},'{$imageName}')";

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
            'starRating' => $starRating,
            'imageName' => $imageName
          ]
        ]);
      }
      else {
        http_response_code(422);
        echo json_encode(['message' => 'Database insert failed.']);
      }
      
  }
?>