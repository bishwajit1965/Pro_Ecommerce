<?php

namespace Codecourse\Repositories;

use Codecourse\Repositories\PHPMailer as PHPMailer;
use Codecourse\Repositories\Database as Database;
use PDO;
use PDOException;

class User
{
    private $conn;
    private $table ='tbl_users';

    public function __construct()
    {
        $database = new Database();
        $db = $database->dbConnection();
        $this->conn = $db;
    }

    public function runQuery($sql)
    {
        $stmt = $this->conn->prepare($sql);
        return $stmt;
    }

    public function lasdID()
    {
        $stmt = $this->conn->lastInsertId();
        return $stmt;
    }

    public function register($firstName, $lastName, $email, $upass, $vupass, $code)
    {
        try {
            // Form validation check
            if (empty($firstName)) {
                header('Location: ../../admin/login/signup.php?fnError');
                exit();
            } elseif (strlen($firstName) < 3) {
                header('Location: ../../admin/login/signup.php?fnLenError');
                exit();
            } elseif (!preg_match("/^[a-zA-Z ]*$/", $firstName)) {
                header('Location: ../../admin/login/signup.php?fnPtnError');
                exit();
            } elseif (empty($lastName)) {
                header('Location: ../../admin/login/signup.php?lnError');
                exit();
            } elseif (strlen($lastName) < 3) {
                header('Location: ../../admin/login/signup.php?lnLenError');
                exit();
            } elseif (!preg_match("/^[a-zA-Z ]*$/", $lastName)) {
                header('Location: ../../admin/login/signup.php?lnPtnError');
                exit();
            } elseif (empty($email)) {
                header('Location: ../../admin/login/signup.php?mailError');
                exit();
            } elseif (empty($email)) {
                header('Location:../../admin/login/signup.php?mailError');
                exit();
            } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                header('Location: ../../admin/login/signup.php?mailPtnError');
                exit();
            } elseif (empty($upass)) {
                header("Location: ../../admin/login/signup.php?uPassEmptyError");
                exit();
            } elseif (strlen($upass) < 6) {
                header('Location: ../../admin/login/signup.php?upassStrLengthError');
                exit();
            } elseif (empty($vupass)) {
                header("Location: ../../admin/login/signup.php?vPassEmptyError");
                exit();
            } elseif (strlen($vupass) < 6) {
                header('Location: ../../admin/login/signup.php?vpassStrLengthError');
                exit();
            } else {
                // Matching two passwwords
                $password = md5($upass);
                $verifyPassword = md5($vupass);
                if ($password == $verifyPassword) {
                    $password = $password;
                } else {
                    header('Location: ../../admin/login/signup.php?passMisMatchError');
                    exit;
                }

                $stmt = $this->conn->prepare("INSERT INTO $this->table(firstName,lastName,userEmail,userPass,tokenCode)
                VALUES(:first_name,:last_name,:user_mail,:user_pass,:active_code)");
                $stmt->bindparam(':first_name', $firstName);
                $stmt->bindparam(':last_name', $lastName);
                $stmt->bindparam(':user_mail', $email);
                $stmt->bindparam(':user_pass', $password);
                $stmt->bindparam(':active_code', $code);
                $stmt->execute();
                return $stmt;
            }
        } catch (PDOException $ex) {
            echo $ex->getMessage();
        }
    }

    // Admin register
    public function registerAdmin($firstName, $lastName, $email, $upass, $vupass, $code)
    {
        try {
            // Form validation check
            if (empty($firstName)) {
                header('Location: ../../admin/roles/addUser.php?fnError');
                exit();
            } elseif (strlen($firstName) < 3) {
                header('Location: ../../admin/roles/addUser.php?fnLenError');
                exit();
            } elseif (!preg_match("/^[a-zA-Z ]*$/", $firstName)) {
                header('Location: ../../admin/roles/addUser.php?fnPtnError');
                exit();
            } elseif (empty($lastName)) {
                header('Location: ../../admin/roles/addUser.php?lnError');
                exit();
            } elseif (strlen($lastName) < 3) {
                header('Location: ../../admin/roles/addUser.php?lnLenError');
                exit();
            } elseif (!preg_match("/^[a-zA-Z ]*$/", $lastName)) {
                header('Location: ../../admin/roles/addUser.php?lnPtnError');
                exit();
            } elseif (empty($email)) {
                header('Location: ../../admin/roles/addUser.php?mailError');
                exit();
            } elseif (empty($email)) {
                header('Location:../../admin/roles/addUser.php?mailError');
                exit();
            } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                header('Location: ../../admin/roles/addUser.php?mailPtnError');
                exit();
            } elseif (empty($upass)) {
                header("Location: ../../admin/roles/addUser.php?uPassEmptyError");
                exit();
            } elseif (strlen($upass) < 6) {
                header('Location: ../../admin/roles/addUser.php?upassStrLengthError');
                exit();
            } elseif (empty($vupass)) {
                header("Location: ../../admin/roles/addUser.php?vPassEmptyError");
                exit();
            } elseif (strlen($vupass) < 6) {
                header('Location: ../../admin/roles/addUser.php?vpassStrLengthError');
                exit();
            } else {
                // Matching two passwwords
                $password = md5($upass);
                $verifyPassword = md5($vupass);
                if ($password == $verifyPassword) {
                    $password = $password;
                } else {
                    header('Location: ../../admin/login/signup.php?passMisMatchError');
                    exit;
                }

                $stmt = $this->conn->prepare("INSERT INTO $this->table(firstName,lastName,userEmail,userPass,tokenCode)
                VALUES(:first_name,:last_name,:user_mail,:user_pass,:active_code)");
                $stmt->bindparam(':first_name', $firstName);
                $stmt->bindparam(':last_name', $lastName);
                $stmt->bindparam(':user_mail', $email);
                $stmt->bindparam(':user_pass', $password);
                $stmt->bindparam(':active_code', $code);
                $stmt->execute();
                return $stmt;
            }
        } catch (PDOException $ex) {
            echo $ex->getMessage();
        }
    }

    public function login($email, $upass)
    {
        try {
            // Checks if email field is empty And shows message
            if (empty($email)) {
                header('Location: ../../admin/login/index.php?blankEmail');
                exit;
            }
            $stmt = $this->conn->prepare("SELECT * FROM $this->table WHERE userEmail=:email_id");
            $stmt->execute(array(':email_id' => $email));
            $userRow = $stmt->fetch(PDO::FETCH_ASSOC);
            if ($stmt->rowCount() == 1) {
                if ($userRow['userStatus'] == 'Y') {
                    if ($userRow['userPass'] == md5($upass)) {
                        $_SESSION['userSession'] = $userRow['userID'];
                        // For role based machenism logging in Email session is created
                        $_SESSION['userEmail'] = $userRow['userEmail'];
                        $_SESSION['userRole'] = $userRow['userRole'];
                        if (isset($_POST['remember'])) {
                            $cookie_email  = $userRow['userEmail'];
                            $cookie_pass  = $upass;
                            setcookie('userEmail', $cookie_email, time() + (86400 * 30), "/");
                            setcookie('userPass', $cookie_pass, time() + (86400 * 30), "/");
                            return true;
                        } else {
                            header('Location: ../../admin/login/index.php?cookieError');
                        }
                        return true;
                    } else {
                        header('Location: ../../admin/login/index.php?passwordError');
                        exit;
                    }
                } else {
                    header('Location: ../../admin/login/index.php?inactive');
                    exit;
                }
            } else {
                header('Location: ../../admin/login/index.php?emptyEmail');
                exit;
            }
        } catch (PDOException $ex) {
            echo $ex->getMessage();
        }
    }

    public function is_logged_in()
    {
        if (isset($_SESSION['userSession'])) {
            return true;
        }
    }

    public function redirect($url)
    {
        header("Location: $url");
    }

    /* Get email to create role based admin access */
    public function getEmail()
    {
        $stmt = $this->conn->prepare("SELECT userEmail FROM $this->table WHERE userRole = 0");
        $email = $stmt->execute();
        $userRow = $stmt->fetch(PDO::FETCH_OBJ);
        if ($stmt->rowCount() == 1) {
            $email = $userRow->userEmail;
            return $email;
        } else {
            return false;
        }
    }
    // Get logged in user is
    public function getAdminId()
    {
        $stmt = $this->conn->prepare("SELECT userID FROM $this->table WHERE userRole = 0");
        $stmt->execute();
        $data = $stmt->fetch(PDO::FETCH_OBJ);
        if ($stmt->rowCount() == 1) {
            $userID = $data->userID;
            return $userID;
        } else {
            return false;
        }
    }

    /* Get email to create role based admin access */
    public function getEditorEmail()
    {
        $stmt = $this->conn->prepare("SELECT userEmail FROM $this->table WHERE userRole = 1");
        $email = $stmt->execute();
        $userRow = $stmt->fetch(PDO::FETCH_OBJ);
        if ($stmt->rowCount() == 1) {
            $email = $userRow->userEmail;
            return $email;
        } else {
            return false;
        }
    }
    /* Get email to create role based admin access */
    public function getAuthorEmail()
    {
        $stmt = $this->conn->prepare("SELECT userEmail FROM $this->table WHERE userRole = 2");
        $email = $stmt->execute();
        $userRow = $stmt->fetch(PDO::FETCH_OBJ);
        if ($stmt->rowCount() == 1) {
            $email = $userRow->userEmail;
            return $email;
        } else {
            return false;
        }
    }

    //Uaer Logout
    public function logout()
    {
        session_destroy();
        $_SESSION['userSession'] = false;
        // Wil destroy cookie data
        // if (isset($_COOKIE['userEmail']) && isset($_COOKIE[ 'userPass'])) {
        //     setcookie('userEmail', '', time() - (86400 * 30), "/");
        //     setcookie('userPass', '', time() - (86400 * 30), "/");
        // } else {
        // }
    }

    public function send_mail($email, $message, $subject)
    {
        $mail = new PHPMailer(true);
        $mail->IsSMTP();
        $mail->SMTPDebug = 1;
        $mail->SMTPAuth = true;
        $mail->SMTPSecure = 'ssl';
        $mail->Host = 'smtp.gmail.com';
        $mail->Port = 465;
        $mail->AddAddress($email);
        // $mail->Username="your_gmail_id_here@gmail.com";
        // $mail->Password="your_gmail_password_here";
        // $mail->SetFrom('your_gmail_id_here@gmail.com','Coding Cage');
        // $mail->AddReplyTo("your_gmail_id_here@gmail.com","Coding Cage");
        $mail->Username = 'paul.bishwajit09@gmail.com';
        $mail->Password = 'B.#66129.#Paul';
        $mail->SetFrom('paul.bishwajit09@gmail.com', 'Project Ecommerce');
        $mail->AddReplyTo('paul.bishwajit09@gmail.com', 'Project Ecommerce');
        $mail->Subject = $subject;
        $mail->MsgHTML($message);
        $mail->Send();
    }
}
