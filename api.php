<?php
require_once 'class/UserAuth.php';
require_once 'class/UserInfo.php';
require_once 'class/UserRegister.php';
require_once 'class/UserUpdate.php';

header('Content-Type: application/json');

session_start();

$auth = new Auth();
$userInfo = new UserInfo();
$register = new Register();
$userUpdate = new UserUpdate();

if ($_SERVER['REQUEST_METHOD'] != 'POST' && !isset($_SESSION['id']) && !in_array($_SERVER['REQUEST_URI'], ['/user-crud/api.php/register', '/user-crud/api.php/login'])) {
    echo json_encode(['error' => 'Authentication required']);
    http_response_code(401);
    exit;
}

$requestMethod = $_SERVER['REQUEST_METHOD'];
$requestUri = strtok($_SERVER['REQUEST_URI'], '?');

switch ($requestUri) {
    case '/user-crud/api.php/register':
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
        break;

    case '/user-crud/api.php/login':
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
        break;

    case '/user-crud/api.php/profile':
        if ($requestMethod == 'GET') {
            $response = $userInfo->profileView($_SESSION['id']);
            echo json_encode($response);
            http_response_code(200);
        } else {
            echo json_encode(['error' => 'Method Not Allowed']);
            http_response_code(405);
        }
        break;

    case '/user-crud/api.php/users':
        if ($requestMethod == 'GET') {
            $response = $userInfo->userView();
            echo json_encode($response);
            http_response_code(200);
        } else {
            echo json_encode(['error' => 'Method Not Allowed']);
            http_response_code(405);
        }
        break;

    case '/user-crud/api.php/update/password':
        if ($requestMethod == 'PUT') {
            $data = json_decode(file_get_contents('php://input'), true);

            if (empty($data['oldpass']) || empty($data['newpass'])) {
                echo json_encode(['error' => 'Both old and new passwords are required']);
                http_response_code(400);
                exit;
            }

            $response = $userUpdate->passUpdate($_SESSION['id'], $data['oldpass'], $data['newpass']);
            if (isset($response['error'])) {
                echo json_encode($response);
                http_response_code(400);
            } else {
                echo json_encode($response);
                http_response_code(200);
            }
        } else {
            echo json_encode(['error' => 'Method Not Allowed']);
            http_response_code(405);
        }
        break;

    case '/user-crud/api.php/update/info':
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
        break;

    case '/user-crud/api.php/delete/user':
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
        break;
    
    case '/user-crud/api.php/logout':
        if ($requestMethod == 'POST') {
            $response = $auth->logout();
            echo json_encode($response);
            http_response_code(200);
        } else {
            echo json_encode(['error' => 'Method Not Allowed']);
            http_response_code(405);
        }
        break;

    default:
        echo json_encode(['error' => 'Not Found']);
        http_response_code(404);
        break;
}
?>
