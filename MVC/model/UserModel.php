<?php
require_once '/Applications/XAMPP/xamppfiles/htdocs/EcommerceBackend/MVC/helpers/DbConnection.php';
class UserModel
{
    private $database; 
    public function __construct() {
        $this->database = new DbConnection();
    }  
    // signup functionality
    public function signUpUser($u_id, $firstname, $lastname, $email, $password, $status, $phone) {
        $query = "INSERT INTO users (u_id, first_name, last_name, email, password, status, phone) VALUES (?, ?, ?, ?, ?, ?, ?)";
        $params = [$u_id, $firstname, $lastname, $email, $password, $status, $phone];
        $res = $this->database->execute($query, $params);
        if ($res) {
            echo 'Successfully added the user record';
            return true;
        } else {
            echo 'Error while adding the user';
        }
    }
    // log in functionality
    public function signInUser($email){
        $query = "SELECT * FROM users WHERE email = ? ";
        $params = [$email];
        $res = $this->database->execute($query, $params);
        return $res->fetch(PDO::FETCH_ASSOC);
    }
    //verfifying password
    public function verifyPassword($password, $hashedPassword)
    {
        return password_verify($password, $hashedPassword);
    }
}
?>