<?php

session_start();
require "./connection.php";
$is_login= false;   

var_dump($is_login == 0);
var_dump($is_login === 0);


if ($_SERVER['REQUEST_METHOD'] === "POST") {

    $username = $_POST['username'];
    $password = $_POST['password'];
    $query="SELECT * FROM users WHERE username = '$username' and password='$password';";

    $result =$db->query($query);
    $db->close();

    if($result->num_rows ===1){
        $_SESSION ["success_message"]="login success";
        $row=$result->fetch_assoc;
    
        $_SESSION["success_message"] = "Login Success";
        $_SESSION["id"]=$row['id'];
        $_SESSION['login'] = true;
        $_SESSION['username'] = $row['username'];
        $_SESSION['role']=$row['role'];

        header("Location: ../messages.php");
    }
    else {
        $_SESSION["error_message"] = "Login Failed";

        header("Location: ../login.php");
    }
}
?>
    <!-- // session_start();
    // $is_login = false;

    // $USERNAMES = [
    //     "admin",
    //     "user",
    //     "root"
    // ];

    // $PASSWORD = [
    //     "123",
    //     "password",
    //     "toor"
    // ];
    //$_GET (ngambil data)
    //$_POST (ngirim data)
    
    // $username=$_POST['username'];
    // $password = $_POST['password'];

    // var_dump($username);
    // var_dump($password);
    //var dump untuk mendump isi

    //alt login
    //isset($_POST['login]){}


    // $conn= mysqli_connect('localhost', 'root','','sp');
    //     if($conn->connect_error){
    //         echo "Error : Connection Failed!";
    //     die('Connection Failed: '. $conn->connect_error);
    // }else{
    //     echo "YES SUCCESS!";
    // }

    // if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    //     $username = $_POST['username'];
    //     $password = $_POST['password'];
        
    //     // Debug: Output submitted username and password
    //     echo "Submitted Username: " . $username . "<br>";
    //     echo "Submitted Password: " . $password . "<br>";
    
    //     $sql = "SELECT * FROM users WHERE username = ?";
    //     $stmt = $conn->prepare($sql);
    //     $stmt->bind_param('s', $username);
    //     $stmt->execute();
    //     $result = $stmt->get_result();
    
    //     if ($result->num_rows > 0) {
    //         $row = $result->fetch_assoc();
    
    //         // Debug: Output stored password hash
    //         echo "Stored Password Hash: " . $row['password'] . "<br>";
    
    //         if (password_verify($password, $row['password'])) {
    //             // Login successful
    //             session_start();
    //             $_SESSION['username'] = $username;
    //             echo "success!";
    //             exit();
    //         } else {
    //             // Invalid password
    //             echo "Invalid password.";
    //         }
    //     } else {
    //         // Invalid username
    //         echo "Invalid username.";
    //     }
    // }

    // if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    //     $username = $_POST['username'];
    //     $password = $_POST['password'];
    
    //     $sql = "SELECT * FROM users WHERE username = ?";
    //     $stmt = $conn->prepare($sql);
    //     $stmt->bind_param('s', $username);
    //     $stmt->execute();
    //     $result = $stmt->get_result();
    
    //     if ($result->num_rows > 0) {
    //         $row = $result->fetch_assoc();
    //         if (password_verify($password, $row['password'])) {
    //             // Login successful
    //             session_start();
    //             $_SESSION['username'] = $username;
    //             // header("Location: dashboard.php");
    //             exit();
    //         } else {
    //             // Invalid password
    //             echo "Invalid password.";
    //         }
    //     } else {
    //         // Invalid username
    //         echo "Invalid username.";
    //     }
    // }

    // if($_POST['login'] === 'Login'){
    //     $username = $_POST['username'];
    //     $password = $_POST['password'];
    //     //for login
    //     }
    // // else if ($_POST['register']=== "Register"){
    // //     //for register
    // //     }

    // for ($i = 0; $i < count($USERNAMES); $i++){
    //     if($USERNAMES[$i]=== $username 
    //     && $PASSWORD[$i]=== $password ){
    //         echo "Success!";
    //         $is_login=true;
    //         break;
    //     }

    // }
    // if($is_login){
    //     $_SESSION["success_msg"]="Successfully loged in!";
    //     $_SESSION['login']=true;
    //     $_SESSION['username']=$username;
    //     // echo $username;
    //     header("Location: ../login.php");
    // }
    // else{
    //     echo 'failed!';

    //     $_SESSION["error_msg"]=
    //     "Login Failed!!";
    //     header("Location: ../login.php");
    // }


    // if($username==='admin' && $password=== 'admin123'){
    //         echo "yeah bitch Username : $username\n";
    //         echo "\n"
    //         echo 'Login Success';
    // }
    // else {
    //     echo "Police!";
    // }(ONLY FOR TESTING!)


    //Yg ini bawah ini cuma coba2 aja, ga ush diikutin
    
?> -->