<?php

/**
    Class ProductsController
    @package app\controllers
 */

namespace app\controllers;
use app\core\Application;
use app\core\Controller;
use app\core\Request;
use app\core\Response;
use app\models\User;
use app\models\Product;
use app\models\Category;
use app\models\Swap;
use app\models\RequestNotification;
use app\models\Password;
use \PDO;

class HomeController extends Controller {
    public function getProductDetails(Request $req, Response $resp) {
        $this->setLayout("navigation");
        $this->setCurrent("Product Details");

        $product_id = $req->getParam("productId") ?? false;

        if($product_id) {
            $product = Product::findOne(["id" => $product_id]);

            if($product) {
                $user = User::findOne(["id" => $product->user_id]);
                $product->user = $user ? $user : null;
                
                if($product->user) {
                    return $this->render('ProductPage', [
                        "model" => $product
                    ]);
                }
            }
        } 
            
        $resp->redirect("/");
    }

    public function getUserProducts(Request $req, Response $resp) {

        $sql = "SELECT * FROM product WHERE user_id = ?";
        $stmt = Application::$app->db->pdo->prepare($sql);
        $stmt->bindValue(1, $_GET["id"]);
        $stmt->execute();
        $stmt->setFetchMode(PDO::FETCH_ASSOC);
        $rows = $stmt->fetchAll();


        return json_encode($rows);
    }

    public function createSwap(Request $req, Response $resp) {
        $body = $req->getBody();

        // Create swap model and save it to the database
        $swap = new Swap();
        $sender = User::findOne(["id" => $body["sender_id"]]);

        $swap->loadData($body);


        // Create user_notification about the swap that has been created
        if($sender && $swap->save()) {
            $request = new RequestNotification();
            $request->sender_id = $body["sender_id"];
            $request->receiver_id = $body["receiver_id"];
            $sender_name = $sender->displayName();
            $message = "$sender_name has sent you a SWAP request.";

            // Get last inserted swap
            $stmnt = Application::$app->db->pdo->prepare("SELECT LAST_INSERT_ID()");
            $stmnt->execute();
            $last_inserted_id = $stmnt->fetchAll()[0][0];

            $swap = Swap::findOne(["id" => $last_inserted_id]);
            $swap->productSent = Product::findOne(["id" => $swap->product_sent_id]);
            $swap->productReceived = Product::findOne(["id" => $swap->product_received_id]);
         
            $productReceivedName = $swap->productReceived->name;
            $productSentName = $swap->productSent->name;
            $id = $swap->productSent->id;
            $message.="\n He'd like to know if you are interested in exchanging your $productReceivedName with his $productSentName\n";
            $message.="<a href='productDetails?productId=$id'>Click here to check his product!</a>";
            $request->swap_id = $swap->id;
            $request->message = $message;
            $request->save();
        } 
        else $resp->redirect("/home");


        // Set flash message that swap has been created
        Application::$app->session->setFlash("swap_sent_success","Your SWAP request has been sent successfully!");
    
        // Redirect user to current page where swap success message will be displayed
        $resp->redirect("/productDetails?productId=$swap->product_received_id");
    }

    public function getNotifications(Request $req, Response $res) {
        $this->setLayout("navigation");
        $this->setCurrent("Notifications");

        // $id = Application::$app->user->id;
        // $stmt = Application::$app->db->pdo->prepare("SELECT * FROM requestNotifications WHERE receiver_id = $id");
        // $stmt->execute();

        // $stmt->setFetchMode(PDO::FETCH_ASSOC);
        // $notifications = $stmt->fetchAll();
        $notifications = RequestNotification::find(["receiver_id" => Application::$app->user->id], "sent_at");
        

        foreach($notifications as $key => $notif) {
            $notif->swap = Swap::findOne(["id" => $notif->swap_id]);
        }
        
        return $this->render("notifications",[
            "notifications" => $notifications
        ]
        );
    }

    public function acceptSwap(Request $req, Response $resp) {
        if(isset($_POST["swap_id"]) && isset($_POST["notif_id"])) {
            $swap_id = $_POST["swap_id"];
            $notification_id = $_POST["notif_id"];

            // $stmnt = Application::$app->db->pdo->prepare("UPDATE swaps SET isApprovedByReceiver = 1 WHERE id=$swap_id");
            // $stmnt->execute();
            $st =Swap::updateOne(["id" => $swap_id], ["isApprovedByReceiver" => 1]);
            $notification  = RequestNotification::findOne(["id" => $notification_id]);
            $approver = User::findOne(["id" => $notification->receiver_id]);
            $approverName = $approver->displayName();
         

            $newRequest = new RequestNotification();
            $newRequest->sender_id = $notification->receiver_id;
            $newRequest->receiver_id = $notification->sender_id;
            $newRequest->message = "$approverName has accepted your SWAP request";
            $newRequest->swap_id = $notification->swap_id;
            $newRequest->save();

            return $st;
        }
        else $resp->redirect("/notifications");
    } 

    public function getHomepage(Request $req,Response $resp) {
        $this->setLayout('navigation');
        $this->setCurrent('Home');    
        $kategorite = Category::findAll(false); 
          
        $products = "";
        $noOfProducts;

        if(isset($_GET["categoryId"])) {

            $cat_id = $_GET["categoryId"];
            $products = Product::find(["category_id" => $cat_id], "created_at");
            $products = array_filter($products,function ($product) {
                return $product->user_id !== Application::$app->user->id;
            });
            $noOfProducts = count($products);
            $products = array_slice($products,0, 7);
        } 
        else if(isset($_GET["searchValue"]) && isset($_GET["searchBy"])) {
            $searchValue = $_GET["searchValue"];
            $searchBy = $_GET["searchBy"];
            $statement = "";
            $regex ="'^.*".$searchValue.".*$'";
            $u_id = Application::$app->user->id;

            if($searchBy === "user") {
                $statement = Application::$app->db->pdo->prepare("SELECT P.id, P.name, P.amount,P.imagePath, P.created_at, P.description, P.category_id, P.user_id
                 FROM product P INNER JOIN user U ON P.user_id = U.id AND P.user_id != $u_id
                WHERE U.firstname REGEXP $regex OR U.lastname REGEXP $regex 
                OR U.username REGEXP $regex  ORDER BY P.created_at DESC");
               
            }
            else if($searchBy === "category") {
                $statement = Application::$app->db->pdo->prepare("SELECT P.id, P.name, P.amount,P.imagePath, P.created_at, P.description, P.category_id, P.user_id
                FROM product P INNER JOIN category C ON P.category_id = C.category_id AND P.user_id != $u_id
                WHERE C.category_name REGEXP $regex  ORDER BY P.created_at DESC");
            }
            else if($searchBy === "product") {
                $statement = Application::$app->db->pdo->prepare("SELECT P.id, P.name, P.amount,P.imagePath, P.created_at, P.description, P.category_id, P.user_id
                FROM product P  WHERE (P.name REGEXP $regex OR description REGEXP $regex) AND P.user_id != $u_id ORDER BY P.created_at DESC");
            }


            $statement->execute();
            $statement->setFetchMode(PDO::FETCH_CLASS, Product::class);
            $rows = $statement->fetchAll();
          
            $products = $rows;
            $noOfProducts = 0;

        }
        else {
            // $products = Product::findAll(7);
            $allProducts = Product::findAll(false, "created_at");
            $allProducts = array_filter($allProducts,function ($product) {
                return $product->user_id !== Application::$app->user->id;
            });
            $noOfProducts = count($allProducts);
            $products = array_slice($allProducts,0, 7);
        }
        
        // $products = new Product();
        // $products = $products->getProducts(['category_id' => 1]);
        
        // $name = [];
        // $name['cid'] = 1;
        //     $j = 0;

        //     foreach($products as $key => $value)
        //     {
        //         $name['product'][$j] = $value;                
        //     $j++; 
        //     }
        
        
        // $i = 0;
        // foreach($kategoria as $key =>$value)
        // {
        //     $name['name'][$i] = $value;
        //     $i++;
        // }

        $products = array_filter($products,function ($product) {
            return $product->user_id !== Application::$app->user->id;
        });

        $selected = $_GET["categoryId"] ?? false;
        if($selected)
            $selected -= 1;
                
        return $this->render('logged_user', [
            "categories" => $kategorite,
            "products" => $products,
            "selectedCategory" => $selected ?? 0,
            "noOfProducts" => $noOfProducts
        ]);
    }

    public function loadProducts(Request $req,Response $resp) {
        if(isset($_GET["categoryId"]) && isset($_GET["limit"])) {
            $categoryId = $_GET["categoryId"];
            $limit = $_GET["limit"];
            $totalDisplayed = $_GET["totalDisplayed"];
            $where = "";
            
            if($categoryId != -1) {
                $where = "AND category_id = :$categoryId";
            }

            $u_id = Application::$app->user->id;
            $stmnt = Application::$app->db->pdo->prepare("SELECT * FROM product WHERE user_id != $u_id $where LIMIT $totalDisplayed,$limit");
            $stmnt->bindValue(":$categoryId", $categoryId);

            $stmnt->execute();
            $stmnt->setFetchMode(PDO::FETCH_ASSOC);
            $rows = $stmnt->fetchAll();
            
            // $rows = array_filter($rows,function ($product) {
            //     return $product->user_id !== Application::$app->user->id;
            // });
            return json_encode($rows);
        }
        else return false;
    }

    public function deleteRequestNotification(Request $req, Response $resp) {
        if(isset($_POST["notif_id"])) {
            $notification_id = $_POST["notif_id"];
            $notification  = RequestNotification::findOne(["id" => $notification_id]);
            RequestNotification::deleteOne(["id" => $notification_id]);

            $swap_id = $_POST["swap_id"];

            // $stmnt = Application::$app->db->pdo->prepare("UPDATE swaps SET isApprovedByReceiver = 1 WHERE id=$swap_id");
            // $stmnt->execute();
            $st =Swap::updateOne(["id" => $swap_id], ["isDeclinedByReceiver" => 1]);
            $decliner = User::findOne(["id" => $notification->receiver_id]);
            $declinerName = $decliner->displayName();
         

            $newRequest = new RequestNotification();
            $newRequest->sender_id = $notification->receiver_id;
            $newRequest->receiver_id = $notification->sender_id;
            $newRequest->message = "$declinerName has declined your SWAP request";
            $newRequest->swap_id = $notification->swap_id;
            $newRequest->save();

            return "Request notification successfully deleted!";
        }
    }

    public function getMyProfile(Request $req, Response $resp) {
        $this->setLayout("navigation");
        $this->setCurrent("My Profile");
        $userModel = Application::$app->user;
        $productModel = new Product();
        $passwordModel = new Password();
        $categories = Category::findAll(false);

        $products = Product::find(["user_id" => Application::$app->user->id]);

        return $this->render("my_profile", [
            "myProducts" => $products,
            "userModel" => $userModel,
            "productModel" => $productModel,
            "categories" => $categories,
            "passwordModel" => $passwordModel,
            "isPassModalOpen" => false,
            "isProductEditModalOpen" => false
         ]);
    }

    // private function searchByUsers(Request $req, Response $resp) {
    //         $searchBy = $_GET["searchValue"];
            
    //         $regex ="'^.*".$searchBy.".*$'";
    //         $statement = Application::$app->db->pdo->prepare("SELECT * FROM product P INNER JOIN user U ON P.user_id = U.id
    //         WHERE U.firstname REGEXP $regex OR U.lastname REGEXP $regex 
    //         OR U.username REGEXP $regex");
    //         $statement->execute();

    //         $statement->setFetchMode(PDO::FETCH_ASSOC);
    //         $rows = $statement->fetchAll();
    //         return json_encode($rows);
    // }

    public function postMyProfile(Request $req, Response $resp) {
        if(isset($_POST['currentPassword']) && isset($_POST['newPassword']) && isset($_POST['repeatNewPassword'])) {
            $body = $req->getBody();

            $passwordModel = new Password();
            $passwordModel->loadData($body);

            if($passwordModel->validate()) {
                if(password_verify($passwordModel->currentPassword, Application::$app->user->password)) {
                    $password = password_hash($passwordModel->newPassword, PASSWORD_DEFAULT);
                    User::updateOne(["id" => Application::$app->user->id], ["password" => $password]);
                    Application::$app->user = User::findOne(["id" => Application::$app->user->id]);
                    Application::$app->session->setFlash("success_pass_change", "Password has been changed successfully!");
                    $resp->redirect("/myProfile");
                    return;
                } else {
                    $passwordModel->addError('currentPassword', "Password is incorrect!");
                }
            }


            $this->setLayout("navigation");
            $this->setCurrent("My Profile");
            $userModel = Application::$app->user;
            $productModel = new Product();
            $categories = Category::findAll(false);
            $products = Product::find(["user_id" => Application::$app->user->id]);

            return $this->render("my_profile", [
                "myProducts" => $products,
                "userModel" => $userModel,
                "productModel" => $productModel,
                "categories" => $categories,
                "passwordModel" => $passwordModel,
                "isPassModalOpen" => true,
                "isProductEditModalOpen" =>false
            ]);
        }
        else if(isset($_POST["editModal"])) {
            $body = $req->getBody();
            $productModel = new Product();
            $productModel->loadData($body);
            
            $tmpName = $_FILES["imagePath"]["tmp_name"];
            $imageName = $_FILES["imagePath"]["name"];
            $fileError = $_FILES["imagePath"]["error"];
            $fileType = $_FILES["imagePath"]["type"];
            $fileSize = $_FILES["imagePath"]["size"];
            $productModel->imagePath= "cccc";
            $id = $_POST["product_id"];


            if($productModel->validate()) {
                if($fileError != 4) {
                    $extarr = explode(".",$imageName );
                    $fileExt = strtolower(end($extarr));
                    $allowed = array("jpeg", "jpg", "png", "svg");
                    if(in_array($fileExt, $allowed)) {
                        if($fileError === 0) {
                            if($fileSize < 2000000) {
                                $newImageName = $body["product_id"]."_".$body["name"]."_".uniqid('', true).$fileExt;
                                $fileDestination = "../public/images/products/".$newImageName;
                                move_uploaded_file($tmpName, $fileDestination);
                                
                                $imagePath="/images/products/".$newImageName;

                                Product::updateOne(["id" => $id], ["name" => $productModel->name,
                                                                "amount" => $productModel->amount,
                                                                "imagePath" => $imagePath,
                                                                "description" => $productModel->description]);
                                Application::$app->session->setFlash("edited_product_success","Product with id $id has been edited successfully!");
                                $resp->redirect("/myProfile");
                                
                            } else {
                                $productModel->addError("imagePath", "Image must have a maximal size of 2MB!");
                            }
                        } else {
                            $productModel->addError("imagePath", "There was some error while uploading your image!");
                        }
                    }
                    else {
                        $productModel->addError("imagePath", "Image type must jpeg, jpg, png or svg!");
                    }
                }
                else {
                    Product::updateOne(["id" => $id], ["name" => $productModel->name,
                                                                "amount" => $productModel->amount,
                                                                "description" => $productModel->description]);
                    Application::$app->session->setFlash("edited_product_success","Product with id $id has been edited successfully!");
                    $resp->redirect("/myProfile");
                }
            }

            $this->setLayout("navigation");
            $this->setCurrent("My Profile");
            $userModel = Application::$app->user;
            $passwordModel = new Password();
            $categories = Category::findAll(false);
            $products = Product::find(["user_id" => Application::$app->user->id]);

            return $this->render("my_profile", [
                "myProducts" => $products,
                "userModel" => $userModel,
                "productModel" => $productModel,
                "categories" => $categories,
                "passwordModel" => $passwordModel,
                "isPassModalOpen" => false,
                "isProductEditModalOpen" => true
            ]);
        }
    }

    public function postDeleteProduct(Request $req, Response $resp) {
        if(isset($_POST["product_id"])) {
            Product::deleteOne(["id" =>$_POST['product_id']]);
            return true;
        }
    }
}

