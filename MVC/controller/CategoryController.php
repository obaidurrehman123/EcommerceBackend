<?php
require_once '/Applications/XAMPP/xamppfiles/htdocs/EcommerceBackend/MVC/model/CategoryModel.php';

class CategoryController {
    private $categoryModel;

    public function __construct() {
        $this->categoryModel = new CategoryModel();
    }
    // Adding Category
    public function addCategory($data) {
        $c_id = $data['c_id'] ?? null;
        $c_name = $data['c_name'] ?? null;
        echo $_SESSION['u_id'];
        echo $_SESSION['status'];
        if ((isset($_SESSION['u_id']) && isset($_SESSION['status']) && $_SESSION['status'] == 1)) {
            if ($c_id && $c_name) {
                $res = $this->categoryModel->addCategory($c_id, $c_name);
                if ($res) {
                    echo "Category added successfully";
                } else {
                    echo "Failed to add the category";
                }
            } else {
                echo "Missing required fields";
            }
        } else {
            echo "Must be an admin or logged in";
        }
    }
    // fetching all categories
    public function getAllCategories() {
        $categories = $this->categoryModel->fetchAllCategories();
        if ($categories) {
            echo json_encode($categories);
        } else {
            echo "Failed to fetch categories";
        }
    }
    // Deleting Category on the base of id
    public function deleteCategory($data) {
        $c_id = $data['c_id'] ?? null;
        if ((isset($_SESSION['u_id']) && isset($_SESSION['status']) && $_SESSION['status'] == 1)) {
            if ($c_id) {
                $res = $this->categoryModel->deleteCategory($c_id);
                if ($res) {
                    echo "Category deleted successfully";
                } else {
                    echo "Failed to delete the category";
                }
            } else {
                echo "Missing required fields";
            }
        } else {
            echo "Must be an admin or logged in";
        }
    }
    // Updating the category by id
    public function updateCategory($data) {
        $c_id = $data['c_id'] ?? null;
        $c_name = $data['c_name'] ?? null;
        
        if ((isset($_SESSION['u_id']) && isset($_SESSION['status']) && $_SESSION['status'] == 1)) {
            if ($c_id && $c_name) {
                $res = $this->categoryModel->updateCategory($c_id, $c_name);
                if ($res) {
                    echo "Category updated successfully";
                } else {
                    echo "Failed to update the category";
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