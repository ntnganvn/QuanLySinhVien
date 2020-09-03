<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Signup</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="Stylesignup.css" type="text/css">
    <script type="text/javascript">
    function validate() {
    var email = document.forms["myform"]["email"].value;
    var re = /^(?:[a-z0-9!#$%&amp;'*+/=?^_`{|}~-]+(?:\.[a-z0-9!#$%&amp;'*+/=?^_`{|}~-]+)*|"(?:[\x01-\x08\x0b\x0c\x0e-\x1f\x21\x23-\x5b\x5d-\x7f]|\\[\x01-\x09\x0b\x0c\x0e-\x7f])*")@(?:(?:[a-z0-9](?:[a-z0-9-]*[a-z0-9])?\.)+[a-z0-9](?:[a-z0-9-]*[a-z0-9])?|\[(?:(?:25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?)\.){3}(?:25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?|[a-z0-9-]*[a-z0-9]:(?:[\x01-\x08\x0b\x0c\x0e-\x1f\x21-\x5a\x53-\x7f]|\\[\x01-\x09\x0b\x0c\x0e-\x7f])+)\])$/;
    var x=re.test(email);
    if(x){
    }else{
        alert("Email id not in correct format");
    return false;
    } 
}
</script>
</head>
<body>
<?php
    $name=$pass=$email="";
    if ($_SERVER["REQUEST_METHOD"]=="POST") {
        if (empty($_POST["email"])) {
            $email ="";
        }
        if (empty($_POST["name"])) {
            $name ="";
        }
        if (empty($_POST["pass"])) {
            $pass ="";
        } else {
            $pass = test_input($_POST["pass"]);
            $name=test_input($_POST["name"]);
            $email=test_input($_POST["email"]);
            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $email = "";
            }
            else {
            $username ="user_test";
            $password ="1234567890";
            $server = "localhost";
            $dbname = "management";
         // ket noi database test
            $connect = new mysqli($server,$username,$password,$dbname);
        // ket noi error thi bao va thoat
            if($connect->connect_error) {
                die("No connection:" . $connect->connect_error);
                exit();
            }
        //xu li du lieu
        
        $sql ="INSERT INTO users(username,password,email)
        VALUES('$name','$pass','$email')";
        if($connect->query($sql)===FALSE) {
            echo "Error:".$sql."<br>".$connect->error;
        }
        echo "<a id='chinh' href='Login.php'></a>" ;
        echo "<script type='text/javascript'> alert('Signup successful'); document.getElementById('chinh').click(); </script>"; 
        die();
        //dong ket noi
            $connect->close();
        }
        }
        }
        function test_input($data) {
            $data = trim($data);
            $data= stripslashes($data);
            $data = htmlspecialchars($data);
            return $data;
        }
    ?>
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post" style="border:1px solid #ccc" onsubmit="return validate()" name="myform">
        <div class="container">
            <h1>Sign Up</h1>
            <hr>
            <label for="email"><b>Email</b></label>
            <input type="text" required placeholder="Enter Email" name="email" id="email" value="">
            <label for="name"><b>Usename</b></label>
            <input type="text" required placeholder="Enter Username" name="name" id="name" value="">
            <label for="pass"><b>Password</b></label>
            <input type="password" placeholder="Enter Password" name="pass" required id="pass" value="">
            
            <p><center>By creating an account, you agree to our <a href="#" style="color:dodgerblue"> Terms & Privacy</a></center></p>
            <p><center><font color="gray">Registered?</font><a href="http://localhost/project/trangchinh/Login.php" style="color:red;"> Log in</a></center></p>
            <div class="clearfix">
                <button type="button" class="cancelbtn">Cancel</button>
                <button type="submit" class="signupbtn">Sign Up</button>
            </div>
        </div>
</form>
</body>
</html>