<?php
  require_once('./UserRegister.php');
  $register = new Register();
  $requestMethod = $_SERVER['REQUEST_METHOD'];
  
  if ($requestMethod == 'POST') {
    $data = json_decode(file_get_contents('php://input'), true);

    if (empty($data['name']) || empty($data['email']) || empty($data['address']) || empty($data['password'])) {
        echo json_encode(['error' => 'All fields are required']);
        http_response_code(400);
        exit;
    }

    $response = $register->register($data['name'], $data['email'], $data['address'], $data['password']);
    echo json_encode($response);
    http_response_code(200);
  } else {
    echo json_encode(['error' => 'Method Not Allowed']);
    http_response_code(405);
  }
?>