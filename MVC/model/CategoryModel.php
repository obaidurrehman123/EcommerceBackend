<?php
require_once '/Applications/XAMPP/xamppfiles/htdocs/EcommerceBackend/MVC/helpers/DbConnection.php';

class CategoryModel {
    private $database;

    public function __construct(){
        $this->database = new DbConnection();
    }
    public function addCategory($c_id, $c_name) {
        $query = "INSERT INTO Category (c_id, c_name) VALUES (?, ?)";
        $params = [$c_id, $c_name];
        $res = $this->database->execute($query, $params);
        if ($res) {
            echo 'Successfully added the Category record';
            return true;
        } else {
            echo 'Error while adding the Category';
        }
    }
    //Fetching All Category
    public function fetchAllCategories(){
        $query = "SELECT * FROM Category";
        $res = $this->database->execute($query);
        if ($res) {
            $categories = $res->fetchAll(PDO::FETCH_ASSOC);
            return $categories;
        } else {
            echo 'Error while fetching categories';
            return false;
        }
    }
    //Deleting Category On Id based
    public function deleteCategory($c_id) {
        $query = "DELETE FROM Category WHERE c_id = ?";
        $params = [$c_id];
        $res = $this->database->execute($query, $params);
        if ($res) {
            echo 'Successfully deleted the Category';
            return true;
        } else {
            echo 'Error while deleting the Category';
            return false;
        }
    }
    // Updating category on id based
    public function updateCategory($c_id, $c_name) {
        $query = "UPDATE Category SET c_name = ? WHERE c_id = ?";
        $params = [$c_name, $c_id];
        $res = $this->database->execute($query, $params);
        if ($res) {
            echo 'Successfully updated the Category name';
            return true;
        } else {
            echo 'Error while updating the Category name';
            return false;
        }
    }
}
?>