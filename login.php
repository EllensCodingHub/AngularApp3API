
<?php
  date_default_timezone_set('America/Toronto'); 
  
  require('connect.php');

  header('Content-type: application/json');

    // helpful for debugging
  ini_set('display_errors', 1);
  error_reporting(E_ALL);

  // get the posted data
  $postdata = json_decode(file_get_contents("php://input"));

  $userName = mysqli_real_escape_string($boo, $postdata->userName ?? '');
  $password = $postdata->password ?? '';

  if (empty($userName) || empty($password)) {
    http_response_code(400);
    echo json_encode(['error' => "Username and password are required."]);
    exit;
  }

  // retrieve the user record
  $sql = "SELECT * FROM registrations WHERE userName = '$userName' LIMIT 1";
  $result = mysqli_query($boo, $sql);

  if ($result && mysqli_num_rows($result) === 1) {
    $user = mysqli_fetch_assoc($result);

    $failedAttempts = (int)$user['failedAttempts'];
    $lastFailed = (int)$user['lastFailedLogin'] ? strtotime($user['lastFailedLogin']) : 0;
    $lockoutDuration = 120; // 2-minutes

    // check if account is locked
    if ($failedAttempts >= 3 && (time() - $lastFailed) < $lockoutDuration) {
      $remaining = ceil(($lockoutDuration - (time() - $lastFailed)) / 60);
      http_response_code(403);
      echo json_encode(['error' => "Account locked. Please try again in $remaining minute(s)."]);
      exit;
    }

    // verify password
    if (password_verify($password, $user['password'])) {
      // reset failed attempts on success
      $update = "UPDATE registrations SET failedAttempts = 0, lastFailedLogin = NULL WHERE userID = {$user['userID']}";
      mysqli_query($boo, $update);
      http_response_code(200);
      echo json_encode(['success' => true, 'message' => "Congratulations. You have logged in successfully."]);
      exit;
    }
    else {
      // increment failed attempts
      $failedAttempts++; // adds 1 to the value stored in $failedAttempts

      $update = "UPDATE registrations SET failedAttempts = $failedAttempts, lastFailedLogin = NOW() WHERE userID = {$user['userID']}";
      mysqli_query($boo, $update);

      // calculate remaining attempts before lockout
      $remainingAttempts = max(0, 3 - $failedAttempts);

      http_response_code(401);
      echo json_encode(['error' => 'invalid username or password',
      'remainingAttempts' => $remainingAttempts]);
      exit;
    }
    
   }   // (still need?) echo json_encode(['success' => true, 'message' => 'Congratulations. You have logged in successfully.']);

  else {
    http_response_code(404);
    echo json_encode(['error' => 'User not found.',
    'remainingAttempts' => $remainingAttempts]);
    exit;
  }
  

?>