<?php
session_start();
require("./connection.php");

if($_SERVER["REQUEST_METHOD"]==="POST"){
    $title=$_POST['title'];
    $recipient=$_POST['recipient'];
    $message=$_POST['message'];
    $attachment=$_FILES['user_file'];
    $sender=$_SESSION['id'];

    function lencek($string, $max_length){
        if (empty($string)||$string== ''|| strlen($string)>$max_length){
            return false;
    }
    return true;
    }

    //TODO : Sanitize title
    //len < 32
    //cannot be empty
    //must be robust against xss and html injection
    if (!lencek($title, 32)) {
        echo'test\n';
    }
    $title = filter_var($title, FILTER_SANITIZE_STRING);    


    //TODO : Sanittize message
    //len < 255
    //must be robust against xss and html injection
    //word count => 5
    if (!lencek($message, 255) || str_word_count($message) < 5) {
        // Handle error for invalid message
        echo'test\n';
    }
    
    //TODO : Sanitize recipient input
    //Must be between 1 to 4 [inclusive]
    //Recipient must be a digit
    if (!ctype_digit($recipient) || $recipient < 1 || $recipient > 4) {
        // Handle error
        echo'test\n';
    }

    //TODO : Sanitize and validate attachment file
    //ext must be pdf,png,jpeg,jpg,excel,mp4,zip,7z,txt,rar,pptx,docx
    //size must be < 10MB
    //must be > 0(cannot be empty)
    //file name must be randomized
    //'../../' zipslip prevention (must not contain path)
    //filename must not contain special characters
    $attachment = $_FILES['user_file'];

    $allowed_extensions = ['pdf', 'png', 'jpeg', 'jpg', 'excel', 'mp4', 'zip', '7z', 'txt', 'rar', 'pptx', 'docx'];
    $max_size = 10 * 1024 * 1024; // 10 MB

    // Check file extension
    $ext = pathinfo($attachment['name'], PATHINFO_EXTENSION);
    if (!in_array($ext, $allowed_extensions)) {
        // Handle invalid file extension
        echo'wakwkw\n';
    }

    // Check file size
    if ($attachment['size'] > $max_size || $attachment['size'] <= 0) {
        // Handle invalid file size
    }

    // Prevent directory traversal and sanitize filename
    $filename = basename($attachment['name']);
    $filename = preg_replace("/[^a-zA-Z0-9.-]/", "", $filename);

    // Randomize file name
    $randomized_name = uniqid() . '.' . $ext;

    //if recepient exists on database


    $fileinfo=pathinfo($attachment['name']);
    $filename=$fileinfo['filename'];
    $targetdir="../uploads/";
    $newfilepath=$targetdir . $filename;
    if(move_uploaded_file($attachment['tmp_name'],$newfilepath)){
        echo 'success ';
    }else{
        echo 'failed ... ___ ...\n';
    };

    $query="INSERT INTO communications(title,recipient_id,sender_id,message,attachment) values('$title','$recipient','$sender,'$message','$newfilepath') ";

   $result=$db->query($query);
   $db->close();
}
?>