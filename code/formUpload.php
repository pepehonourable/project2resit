<?php
include "connect.php";
session_start();
$target_dir = "../userUpload/"; //FIX-ED
$_SESSION['userId'] = 1; //REMOVE

$userId = $_SESSION['userId'];
$userFeedback = $_POST['userFeedback'];
$uploadedFile = $_FILES['uploadedFile'];
$productName = $_POST['productName'];
$rating = $_POST['rating'];
$image = $_FILES["uploadedFile"]["name"];

$stmt = $conn->prepare("SELECT ProductId FROM Product WHERE Title=?");
$stmt->bind_param("s", $productName);
$stmt->execute();

$result = $stmt->get_result(); // get the mysqli result
$id = $result->fetch_assoc();
$productId = implode(',', $id);

if (isset($_SESSION['userId']))
    if (in_array($_POST['rating'], array(1, 2, 3, 4, 5))) {
        if (isset($_FILES["uploadedFile"])) {
            if ($_FILES["uploadedFile"]["size"] < 1000000) {
                if (strlen($_FILES["uploadedFile"]["name"]) <= 60) {
                    $acceptedFileTypes = ["image/jpg", "image/jpeg", "image/png"];
                    $fileinfo = finfo_open(FILEINFO_MIME_TYPE);
                    $uploadedFileType = finfo_file($fileinfo, $_FILES["uploadedFile"]["tmp_name"]);
                    if (in_array($uploadedFileType, $acceptedFileTypes)) {
                        if ($_FILES["uploadedFile"]["error"] > 0) {
                            echo "Error: " . $_FILES["uploadedFile"]["error"] . "<br />";
                        } else {
                            if (file_exists($target_dir . $_FILES["uploadedFile"]["name"])) {
                                echo $_FILES["uploadedFile"]["name"] . " already exists. ";
                            } else {
                                if ($feedback = $_POST["userFeedback"]) {
                                    if (!empty($feedback)) {
                                        if (strlen($feedback) < 501) {
                                            if (move_uploaded_file($_FILES["uploadedFile"]["tmp_name"], $target_dir . $_FILES["uploadedFile"]["name"])) {
                                                $stmt = $conn->prepare("INSERT INTO feedback (UserId, Text, Image, ProductId, Rating) VALUES (?, ?, ?, ?, ?)");
                                                $stmt->bind_param("issii", $userId, $userFeedback, $image, $productId, $rating);
                                                $stmt->execute();
                                                $_SESSION['message'] = 'Feedback Submitted!';

                                                header('location: feedback.php');
                                            } else {
                                                echo "Directory could not be found";
                                            }
                                        } else {
                                            echo "Feedback cannot exceed 500 characters";
                                        }
                                    } else {
                                        echo "Feedback cannot be empty";
                                    }
                                } else {
                                    echo "Please insert feedback";
                                }
                            }
                        }
                    } else {
                        echo "Must be png, jpg or jpeg";
                    }
                } else {
                    echo "Image name must be less then 60 charecters long";
                }
            } else {
                echo "Must be less that 10mb";
            }
        } else {
            echo "No image selected";
        }
    } else {
        echo "please select a rating between 1-5";
    }
else {
    echo "Please login to sumbit fedback form";
}
?>