
<?php 
  require('connect.php');

  $mybooks = [];

  $sql = "SELECT * FROM mybooks";

// read all books from MySql for the Angular book list.
  if ($result = mysqli_query($boo, $sql)) {
    $count = 0;

    while ($row = mysqli_fetch_assoc($result)) {
      $mybooks[$count]['bookID'] = $row['bookID'];
      $mybooks[$count]['authorName'] = $row['authorName'];
      $mybooks[$count]['bookTitle'] = $row['bookTitle'];
      $mybooks[$count]['storyHook'] = $row['storyHook'];
      $mybooks[$count]['genre'] = $row['genre'];
      $mybooks[$count]['pubDate'] = $row['pubDate'];
      $mybooks[$count]['publisher'] = $row['publisher'];
      $mybooks[$count]['recBy'] = $row['recBy'];
      $mybooks[$count]['starRating'] = $row['starRating'];

      $count++;
    }
    echo json_encode(['data'=>$mybooks]);
  }
  
  else{
    http_response_code(404);
  }

  ?>
