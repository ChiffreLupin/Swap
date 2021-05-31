<?php

/**
    Class AuthController
    @package app\controllers
 */

namespace app\controllers;
use app\core\Controller;
use app\core\Request;
use app\core\Response;
use app\models\User;
use app\core\Application;
use app\models\LoginUser;
use \PDO;

//Import PHPMailer classes into the global namespace
//These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

//Load Composer's autoloader
require '../vendor/autoload.php';


class AuthController extends Controller {
    

    // We can specify access on all the controller or on a specific 
    // function by specifying it inside the parameters of the middleware
   
   public function getLogin(Request $req,Response $resp) {
    if(isset($_GET["login"])) {
        $this->setLayout('auth');
        $this->setCurrent('Login');

        $loginUser = new LoginUser();

        return $this->render('authentication/LogIn', [
            'model' => $loginUser
        ]);
    }
    else $resp->redirect("/");
   }

   public function postLogin(Request $req, Response $resp) {
    if(isset($_POST["login"])) {
        
        $this->setLayout('auth');
        $this->setCurrent('Login');

        $loginUser = new LoginUser();
        $loginUser->loadData($req->getBody());
        
        if($loginUser->validate() && $loginUser->login()) {
            $user = User::findOne(["email" => $loginUser->email]);
       
            if($user->type === 'admin') {
                $this->setLayout("admin");
                $this->setCurrent("Users");
        
                return $this->render("admin/admin_user");
            }
            $resp->redirect('/home');
            return;
        }

       

        return $this->render('authentication/LogIn', [
            'model' => $loginUser
        ]);
    } else {
        $resp->redirect("/");
    }
   }


    public function getRegister(Request $req,Response $resp) {
        $registerModel = new User();

        $this->setLayout('auth');
        $this->setCurrent('Register');

        return $this->render('authentication/SignUp', [
            'model' => $registerModel
        ]);
    }

    public function postRegister(Request $req,Response $resp) {
        if(isset($_POST["register"])) {
            $registerModel = new User();
        
            $registerModel->loadData($req->getBody());
            
            // If the data is valid and we successfully stored it inside the database
            // We return success page
            if($registerModel->validate() && $registerModel->save()) {     
                Application::$app->session->setFlash('success','Thanks for registering');
                $user = User::findOne(['email' => $registerModel->email]);
                Application::$app->login($user);
                Application::$app->response->redirect('/home');
                return;
            }

        // Else we return to the current page 
        // This time we pass the model with all the errors
            $this->setLayout('auth');
            $this->setCurrent('Register');

            return  $this->render('authentication/SignUp', [
                'model' => $registerModel
            ]);
        } else {
            $resp->redirect("/");
        }
    }

    public function getResetPassword(Request $req, Response $resp) {
        $this->setLayout('auth');
        $this->setCurrent('Reset Password');

        $selector = $req->getParam("selector");
        $validator = $req->getParam("validator");
        
        if(!empty($selector) && !empty($validator)) {
            // Check these are hexadecimals
            if(ctype_xdigit($selector) !== false && ctype_xdigit($validator) !== false) {
                return $this->render('authentication/resetPassword', [
                    "selector" => $selector,
                    "validator" => $validator
                ]);
            }
        } else {
            return $resp->redirect("/");
        }
    }

    public function postResetPassword(Request $req, Response $res) {
        if(isset($_POST["reset-password"])) {
            $this->setLayout('auth');

            $body = $req->getBody();
            
            $selector = $body["selector"];
            $validator = $body["validator"];
            $newPassword = $body["newPassword"];
            $newPasswordRepeat = $body["confirmNewPassword"];

            if(empty($newPassword) || empty($newPasswordRepeat)) {
                Application::$app->session->setFlash("error-new", "Password fields must not be empty!");
                $this->setCurrent('Reset Password');
                return $this->render("authentication/resetPassword", [
                    "selector" => $selector,
                    "validator" => $validator
                ]);
            } else if($newPassword !== $newPasswordRepeat) {
                Application::$app->session->setFlash("error-new", "Password fields must be equal!");
                $this->setCurrent('Reset Password');
                return $this->render("authentication/resetPassword", [
                    "selector" => $selector,
                    "validator" => $validator
                ]);
            }

            $currentDate = date("U");

            // Placeholder are only needed for data from the user not the ones we create like the currentDate
            $sql = "SELECT * FROM pwdReset WHERE pwdResetSelector=? AND pwdResetExpires >= ?";
            $stmt = Application::$app->db->pdo->prepare($sql);
            $stmt->bindValue(1, $selector);
            $stmt->bindValue(2, $currentDate);
            $stmt->execute();
            $stmt->setFetchMode(PDO::FETCH_ASSOC);
            $rows = $stmt->fetchAll();

            if(!$rows) {
                Application::$app->session->setFlash("error", "Something went wrong! Resubmit your request!");
                $this->setCurrent('Forgot Password');
                return $this->render("authentication/ForgotPassword");
            }

            $row = $rows[0];
            $tokenBin = hex2bin($validator);
            $tokenCheck = password_verify($tokenBin, $row["pwdResetToken"]);

            if($tokenCheck === false) {
                Application::$app->session->setFlash("error", "Something went wrong! Resubmit your request!");
                $this->setCurrent('Forgot Password');
                return $this->render("authentication/ForgotPassword");
            }
            else if($tokenCheck === true) {
                // Update user password with the new password
                $sql = "UPDATE user SET password=? WHERE email=?";
                $stmt = Application::$app->db->pdo->prepare($sql);
                $newPasswordHash = password_hash($newPassword, PASSWORD_DEFAULT);
                $stmt->bindValue(1,$newPasswordHash);
                $stmt->bindValue(2, $row["pwdResetEmail"]);
                $stmt->execute();

                // Delete token from database
                $sql = "DELETE FROM pwdReset WHERE pwdResetEmail=?";
                $stmt = Application::$app->db->pdo->prepare($sql);
                $stmt->bindValue(1, $row["pwdResetEmail"]);
                $stmt->execute();
                
                // Redirect user to login page
                $this->setCurrent('Login');
                Application::$app->session->setFlash("successResetPwd", "You have successfully reset your password!");
                $res->redirect("/login");
            }

        } else {
            return $this->render("_404");
        }
    }

    public function getForgotPassword(Request $req, Response $res) {
        $this->setLayout('auth');
        $this->setCurrent('Forgot Password');
      
        return $this->render('authentication/ForgotPassword');
    }

    public function postForgotPassword(Request $req, Response $res) {
        $body = $req->getBody();
        $value = $body["email"];
        $error = "";

        $this->setLayout('auth');
        $this->setCurrent('Forgot Password');

        if(filter_var($value, FILTER_VALIDATE_EMAIL)) {
            // Email is correct
            // Check if there is a user with this email
            $user =  User::findOne(["email" => $value]);
            if($user) {
                Application::$app->session->setFlash("recovery", "A password recovery link has been sent to your email!");

                $selector = bin2Hex(random_bytes(8));
                // Used to authenticate correct user
                $token = random_bytes(32);

                $link = "http://localhost:8080/resetPassword?id=".$user->id."&selector=".$selector."&validator=".bin2Hex($token);   
                
                // 1 HOUR FROM NOW
                $expires = date("U") + 1800;

                // Deleting existing tokens from db in case user tried to reset his password
                $sql = "DELETE FROM pwdReset WHERE pwdResetEmail=?";
                $stmt = Application::$app->db->pdo->prepare($sql);
                $stmt->bindValue(1, $value, PDO::PARAM_STR);
                $stmt->execute();

                $sql = "INSERT INTO pwdReset (pwdResetEmail, pwdResetSelector, pwdResetToken, pwdResetExpires) VALUES (?, ?, ?, ?);";
                $stmt = Application::$app->db->pdo->prepare($sql);
                $hashedToken = password_hash($token, PASSWORD_DEFAULT);
                $stmt->bindValue(1, $value);
                $stmt->bindValue(2, $selector);
                $stmt->bindValue(3, $hashedToken);
                $stmt->bindValue(4, $expires);
                $stmt->execute();


                $message = file_get_contents(__DIR__.'\email.html');   
                $message = str_replace('{{content}}', $link, $message);
                
                $mail = new PHPMailer();
                $mail->isSMTP();
                $mail->SMTPAuth = true;
                $mail->SMTPSecure = "ssl";
                $mail->Host = "smtp.gmail.com";
                $mail->Port = "465";
                $mail->isHTML(true);
                $mail->Username = "projectrailway9@gmail.com";
                $mail->Password = "PeppaLaPorquetta";
                $mail->SetFrom("projectrailway9@gmail.com");
                $mail->Subject = "Password recovery verification!";
                $mail->msgHTML($message);
                $mail->AddAddress($value);
                $mail->Send();

                $res->redirect("/forgotPassword");
                return;
            }
            else Application::$app->session->setFlash("error", "There is no user with this email registered!");

        }
        else {
            $error = Application::$app->session->setFlash("error", "Please enter a valid email!");

        }

        return $this->render('authentication/ForgotPassword');

    }

    public function logout(Request $req, Response $res) {
        clearstatcache();
        Application::$app->logout();
        $res->redirect('/login?login=1');
    }
}