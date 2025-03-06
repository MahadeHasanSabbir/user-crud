<?php
  session_start();
  if (!isset($_SESSION['id'])) {
    echo json_encode(['error' => 'Authentication required']);
    http_response_code(401);
    exit;
  }

  require_once('./UserAuth.php');
  $auth = new Auth();
  $requestMethod = $_SERVER['REQUEST_METHOD'];
  
  if ($requestMethod == 'POST') {
    $response = $auth->logout();
    echo json_encode($response);
    http_response_code(200);
  } else {
      echo json_encode(['error' => 'Method Not Allowed']);
      http_response_code(405);
  }

?>