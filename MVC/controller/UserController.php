<?php
require_once '/Applications/XAMPP/xamppfiles/htdocs/EcommerceBackend/MVC/model/UserModel.php';
class UserController {
    private $userModel;
    
    public function __construct() {
        $this->userModel = new UserModel();
        session_start();
    }

    // signUp function
    public function signUp($data) {
        $u_id = $data['u_id'] ?? null;
        $firstName = $data['first_name'] ?? null;
        $lastName = $data['last_name'] ?? null;
        $email = $data['email'] ?? null;
        $password = $data['password'] ?? null;
        $status = $data['status'] ?? null;
        $phone = $data['phone'] ?? null;

        if ($u_id && $firstName && $lastName && $email && $password && $status && $phone) {
            if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
                $res = $this->userModel->signUpUser($u_id, $firstName, $lastName, $email, $hashedPassword, $status, $phone);
                if ($res) {
                    echo "User registered successfully";
                } else {
                    echo "User registration failed.";
                }
            } else {
                echo 'Invalid Email';
            }
        } else {
            echo "Missing required fields.";
        }
    }

  // login function
public function signIn($data) {
    $email = $data['email'] ?? null;
    $password = $data['password'] ?? null;

    if ($email && $password) {
        $user = $this->userModel->signInUser($email);

        if ($user) {
            $verifyPass = $this->userModel->verifyPassword($password, $user['password']);
            if ($verifyPass) {
                $_SESSION['u_id'] = $user['u_id']; 
                $_SESSION['status'] = $user['status'];
                echo $user['u_id'];
                echo $user['status'];
                echo "User logged in successfully";
            } else {
                echo "Invalid Password";
            }
        } else {
            echo 'Invalid Email';
        }
    } else {
        echo 'Email and password fields cannot be empty';
    }
}

}
?>