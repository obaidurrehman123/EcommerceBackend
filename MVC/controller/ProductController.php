<?php
require_once '/Applications/XAMPP/xamppfiles/htdocs/EcommerceBackend/MVC/model/ProductModel.php';

class ProductController {
    private $productModel;

    public function __construct() {
        $this->productModel = new ProductModel();
    }
    // Adding Category
    public function addProduct($data) {
        $pid = $data['pid'] ?? null;
        $p_name = $data['p_name'] ?? null;
        $p_description = $data['p_description'] ?? null;
        $price = $data['price'] ?? null;
        $c_id = $data['c_id'] ?? null;
        echo $_SESSION['u_id'];
        echo $_SESSION['status'];
        if ((isset($_SESSION['u_id']) && isset($_SESSION['status']) && $_SESSION['status'] == 1)) {
            if ($pid && $p_name && $p_description && $price && $c_id) {
                $res = $this->productModel->addProduct($pid, $p_name ,$p_description,$price,$c_id);
                if ($res) {
                    echo "Product added successfully";
                } else {
                    echo "Failed to add the product";
                }
            } else {
                echo "Missing required fields";
            }
        } else {
            echo "Must be an admin or logged in";
        }
    }
    // fetching all categories
    public function getAllProducts() {
        $products = $this->productModel->fetchAllProducts();
        if ($products) {
            echo json_encode($products);
        } else {
            echo "Failed to fetch products";
        }
    }
    // Deleting Category on the base of id
    public function deleteProduct($data) {
        $pid = $data['pid'] ?? null;
        if ((isset($_SESSION['u_id']) && isset($_SESSION['status']) && $_SESSION['status'] == 1)) {
            if ($pid) {
                $res = $this->productModel->deleteProduct($pid);
                if ($res) {
                    echo "Deleted Product deleted successfully";
                } else {
                    echo "Failed to delete the Failed";
                }
            } else {
                echo "Missing required fields";
            }
        } else {
            echo "Must be an admin or logged in";
        }
    }
    // Updating the Product by id
    public function updateProduct($data) {
        $pid = $data['pid'] ?? null;
        $p_name = $data['p_name'] ?? null;
        $p_description = $data['p_description'] ?? null;
        $price = $data['price'] ?? null;
        $c_id = $data['c_id'] ?? null;
        if ((isset($_SESSION['u_id']) && isset($_SESSION['status']) && $_SESSION['status'] == 1)) {
            if ($pid || $p_name || $p_description || $price || $c_id) {
                $res = $this->productModel->updateProduct($pid,$p_name,$p_description,$price,$c_id);
                if ($res) {
                    echo "Product updated successfully";
                } else {
                    echo "Failed to update the product";
                }
            } else {
                echo "Missing required fields";
            }
        } else {
            echo "Must be an admin or logged in";
        }
    }
}
?>