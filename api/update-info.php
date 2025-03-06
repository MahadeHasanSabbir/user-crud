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
  
  if ($requestMethod == 'PUT') {
    $data = json_decode(file_get_contents('php://input'), true);

    if (empty($data['name']) || empty($data['email']) || empty($data['address'])) {
        echo json_encode(['error' => 'Name, email, and address are required']);
        http_response_code(400);
        exit;
    }

    $response = $userUpdate->infoUpdate($_SESSION['id'], $data['name'], $data['email'], $data['address']);
    echo json_encode($response);
    http_response_code(200);
  } else {
      echo json_encode(['error' => 'Method Not Allowed']);
      http_response_code(405);
  }

?>