
<?php 
  // database credentials
  define('DB_HOST', 'localhost');
  define('DB_USER', 'root');
  define('DB_PASS', '');
  define('DB_NAME', 'my_books_2026');

  // connect with the database
  function connect() {
    $connect = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME);

    if (mysqli_connect_errno()) {
      die("Failed to connect:" . mysqli_connect_errno());
    }

    mysqli_set_charset($connect, "utf8");

    return $connect;
  }

  $boo = connect();
  
?>