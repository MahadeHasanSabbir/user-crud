<?php
  session_start();
  if (!isset($_SESSION['id'])) {
    echo json_encode(['error' => 'Authentication required']);
    http_response_code(401);
    exit;
  }

  require_once('./UserUpdate.php');
  $userUpdate = new UserUpdate();
  $requestMethod = $_SERVER['REQUEST_METHOD'];
  
  if ($requestMethod == 'DELETE') {
    $data = json_decode(file_get_contents('php://input'), true);
    if (empty($data['id'])) {
        echo json_encode(['error' => 'User ID is required']);
        http_response_code(400);
        exit;
    }
    $response = $userUpdate->userDelete($data['id']);
    echo json_encode($response);
    http_response_code(200);
  } else {
      echo json_encode(['error' => 'Method Not Allowed']);
      http_response_code(405);
  }

?>