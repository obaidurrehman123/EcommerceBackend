<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
require_once '/Applications/XAMPP/xamppfiles/htdocs/EcommerceBackend/MVC/controller/UserController.php';
require_once '/Applications/XAMPP/xamppfiles/htdocs/EcommerceBackend/MVC/controller/CategoryController.php';
require_once '/Applications/XAMPP/xamppfiles/htdocs/EcommerceBackend/MVC/controller/ProductController.php';
$userController = new UserController();
$categoryController = new CategoryController();
$productController = new ProductController();
$requestPath = $_SERVER['REQUEST_URI'];

$requestPath = str_replace('index.php/', '', $requestPath);
$route = ltrim(parse_url($requestPath, PHP_URL_PATH), '/');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $json = file_get_contents('php://input');
    $data = json_decode($json, true);

    if ($data !== null) {
        switch ($route) {
            case 'EcommerceBackend/signup':
                $userController->signUp($data);
                break;
            case 'EcommerceBackend/signin':
                $userController->signIn($data);
                break;
            case 'EcommerceBackend/addCategory':
                $categoryController->addCategory($data);
                break;
            case 'EcommerceBackend/addProduct':
                $productController->addProduct($data);
                break;
            default:
                echo "Invalid route.";
                break;
        }
    } else {
        echo "Invalid JSON data.";
    }
} else if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    switch ($route) {
        case 'EcommerceBackend/getAllCategories':
            $categoryController->getAllCategories();
            break;
        case 'EcommerceBackend/getAllProducts':
            $productController->getAllProducts();
            break;
        default:
            echo "Invalid route.";
            break;
    }
} else if ($_SERVER['REQUEST_METHOD'] === 'DELETE') {
    $json = file_get_contents('php://input');
    $data = json_decode($json, true);

    if ($data !== null) {
        switch ($route) {
            case 'EcommerceBackend/deleteCategory':
                $categoryController->deleteCategory($data);
                break;
            case 'EcommerceBackend/deleteProduct':
                $productController->deleteProduct($data);
                break;
            default:
                echo "Invalid route.";
                break;
        }
    } else {
        echo "Invalid JSON data.";
    }
} else if ($_SERVER['REQUEST_METHOD'] === 'PUT') {
    $json = file_get_contents('php://input');
    $data = json_decode($json, true);

    if ($data !== null) {
        switch ($route) {
            case 'EcommerceBackend/updateCategory':
                $categoryController->updateCategory($data);
                break;
            case 'EcommerceBackend/updateProduct':
                $productController->updateProduct($data);
                break;
            default:
                echo "Invalid route.";
                break;
        }
    } else {
        echo "Invalid JSON data.";
    }
} else {
    echo "Invalid request method.";
}
?>