<?php
require_once '/Applications/XAMPP/xamppfiles/htdocs/EcommerceBackend/MVC/helpers/DbConnection.php';
class ProductModel {
    private $database;

    public function __construct(){
        $this->database = new DbConnection();
    }
    // adding prduct 
    public function addProduct($pid, $p_name,$p_description,$price,$c_id) {
        $query = "INSERT INTO products (pid,p_name,p_description,price,c_id) VALUES (?, ?,?,?,?)";
        $params = [$pid,$p_name,$p_description,$price,$c_id];
        $res = $this->database->execute($query, $params);
        if ($res) {
            echo 'Successfully added the Product record';
            return true;
        } else {
            echo 'Error while adding the Product';
        }
    }
    // Fetching all products with category name
    public function fetchAllProducts() {
        $query = "SELECT p.*, c.c_name FROM products p JOIN Category c ON p.c_id = c.c_id";
        $res = $this->database->execute($query);
        if ($res) {
            $products = $res->fetchAll(PDO::FETCH_ASSOC);
            return $products;
        } else {
            echo 'Error while fetching products';
            return false;
        }
    }
    // Update Product wrt to id
    public function updateProduct($pid, $p_name ,$p_description,$price , $c_id) {
        $query = "UPDATE products SET p_name = ? , p_description = ? , price = ? , c_id = ?  WHERE pid = ?";
        $params = [$pid ,$p_name,$p_description,$price,$c_id];
        $res = $this->database->execute($query, $params);
        if ($res) {
            echo 'Successfully updated the Product details';
            return true;
        } else {
            echo 'Error while updating the Product details';
            return false;
        }
    } 
     //Deleting Product On Id based
    public function deleteProduct($pid) {
        $query = "DELETE FROM products WHERE pid = ?";
        $params = [$pid];
        $res = $this->database->execute($query, $params);
        if ($res) {
            echo 'Successfully deleted the Product';
            return true;
        } else {
            echo 'Error while deleting the Product';
            return false;
        }
    }   
}
?>