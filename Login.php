<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <title>Login</title>
    <link rel="stylesheet" href="Stylelogin.css" type="text/css">
</head>
<body>
<?php
if($_SERVER["REQUEST_METHOD"]=="POST") {
    $name=$pass="";
    if (empty($_POST["name"])) {
        $name ="";
    }
    if (empty($_POST["pass"])) {
        $pass ="";
    } else {
        $pass = test_input($_POST["pass"]);
        $name=test_input($_POST["name"]);
        $name = strip_tags($name);
		$name = addslashes($name);
		$pass = strip_tags($pass);
		$pass = addslashes($pass);
        $username ="user_test";
        $password ="1234567890";
        $server = "localhost";
        $dbname = "management";
     // ket noi database test
        $connect = new mysqli($server,$username,$password,$dbname);
    // ket noi error thi bao va thoat
        if($connect->connect_error) {
            die("No connection:" . $conn->connect_error);
            exit();
        }
        // xu ly du lieu
        $sql= "SELECT Id FROM users WHERE username='$name'and password ='$pass' ";
        // huong thu tuc: $result = mysqli_query($connect,$sql);
        //$count = mysqli_num_rows($result);

        //huong doi tuong
        $result= $connect->query($sql);
        $count =   $result->num_rows;
        if($count==1) {
            $_SESSION['user'] = $name;
            header('Location:chinh.php');
        }
        //dong ket noi
        mysqli_close($connect);
    }
}
function test_input($data) {
    $data = trim($data);
    $data= stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

?>
<div class="content">
    <fieldset class="box" >
        <legend><center><img src="loginnam.jpg"  class="img-circle" width="150" height="150" ></center></legend>
        <h1><center><font face="Malgun Gothic" color="red" size="8">Log In</font></center></h1>
        <div class="thongtin">
            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="POST">
            <label for="name"><b>Username</b></label>
            <input type="text" required placeholder="Enter username" name="name" id="name" value="">
            <label for="pass"><b>Password</b></label>
            <input placeholder="Enter Password" type="password" required name="pass" id="pass" value="">
            <input type="submit" name="submit" value="Submit">
            
        </form>
        </div>
    <div class="dont">
        
        <a href="http://localhost/project/trangchinh/Signup.php">Don't have an account?</a>

    </div>
</fieldset>
</div>
</body>
</html>