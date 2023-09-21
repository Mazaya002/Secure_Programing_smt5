<?php

    $is_login = false;

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


    $conn= mysqli_connect('localhost', 'root','','sp');
        if($conn->connect_error){
            echo "Error : Connection Failed!";
        die('Connection Failed: '. $conn->connect_error);
    }else{
        echo "YES SUCCESS!";
    }

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $username = $_POST['username'];
        $password = $_POST['password'];
        
        // Debug: Output submitted username and password
        echo "Submitted Username: " . $username . "<br>";
        echo "Submitted Password: " . $password . "<br>";
    
        $sql = "SELECT * FROM users WHERE username = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param('s', $username);
        $stmt->execute();
        $result = $stmt->get_result();
    
        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
    
            // Debug: Output stored password hash
            echo "Stored Password Hash: " . $row['password'] . "<br>";
    
            if (password_verify($password, $row['password'])) {
                // Login successful
                session_start();
                $_SESSION['username'] = $username;
                echo "success!";
                exit();
            } else {
                // Invalid password
                echo "Invalid password.";
            }
        } else {
            // Invalid username
            echo "Invalid username.";
        }
    }

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
    // else if ($_POST['register']=== "Register"){
    //     //for register
    //     }

    // for ($i = 0; $i < count($USERNAMES); $i++){
    //     if($USERNAMES[$i]=== $username 
    //     && $PASSWORD[$i]=== $password ){
    //         echo "Success!";
    //         break;
    //     }
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
    
?>