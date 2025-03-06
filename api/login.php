<?php
  session_start();
  require_once('./UserAuth.php');
  $auth = new Auth();
  $requestMethod = $_SERVER['REQUEST_METHOD'];

  if ($requestMethod == 'POST') {
    $data = json_decode(file_get_contents('php://input'), true);

    if (empty($data['email']) || empty($data['password'])) {
        echo json_encode(['error' => 'Email and password are required']);
        http_response_code(400);
        exit;
    }

    $response = $auth->login($data['email'], $data['password']);
    echo json_encode($response);
    http_response_code(200);
  } else {
    echo json_encode(['error' => 'Method Not Allowed']);
    http_response_code(405);
  }

?>