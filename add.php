<?php
	if (!empty($_POST)) {
    $fullname=$MSSV=$birthday=$khoa=$class=$phone=$email=$imag='';
    if(isset($_POST['fullname'])) {
    $fullname =test_input($_POST['fullname']);
    }
    if(isset($_POST['MSSV'])) {
      $MSSV = test_input($_POST['MSSV']);
    }
    if(isset($_POST['birthday'])) {
      $birthday = test_input($_POST['birthday']);
    }
    if(isset($_POST['khoa'])) {
      $khoa = test_input($_POST['khoa']);
    }
    if(isset($_POST['class'])) {
    $class = test_input($_POST['class']);
    if(!preg_match("/^[A]{1}[0]{1}[0-5]{1}$/", $class)){
      $class="";
    }
    }
    if(isset($_POST['phone'])) {
      $phone = test_input($_POST['phone']);
      if(!preg_match("/^[0]{1}[3 or 9]{1}[0-9]{8}$/", $phone)) {
        $phone="";
      }
    }
    if(isset($_POST['email'])) {
      $email = test_input($_POST['email']);
      if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
      $email = "";
      }
    }
    if(isset($_POST['imag'])) {
      $imag = test_input($_POST['imag']);
    }
    require_once ('dbhelp.php');
    $fullname = str_replace('\'','\\\'',$fullname);
    $MSSV = str_replace('\'','\\\'',$MSSV);
    $khoa = str_replace('\'','\\\'',$khoa);
    $class = str_replace('\'','\\\'',$class);
    $phone= str_replace('\'','\\\'',$phone);
    $email = str_replace('\'','\\\'',$email);
    $sql = "INSERT INTO student(fullname,MSSV,birthday,khoa,class,phone,email,imag) VALUE ('$fullname','$MSSV','$birthday','$khoa','$class','$phone','$email','$imag')";
    execute($sql);
    echo "<a id='chinh' href='chinh.php'></a>" ;
    echo "<script type='text/javascript'> alert('Update successful'); document.getElementById('chinh').click(); </script>"; 
    die();
}
function test_input($data){
	$data = trim($data);
	$data = stripcslashes($data);
	$data = htmlspecialchars ($data);
	return $data;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Add Student</title>
  <link rel="stylesheet" href="Stylephu.css">
  <script type="text/javascript">
function validate() {
  var phone= document.forms["myform"]["phone"].value;
  var ph=/^\+?([0-9]{2})\)?[-. ]?([0-9]{4})[-. ]?([0-9]{4})$/;
  var y = ph.test(phone);
  if (y){
  } else {
  alert("Phone id not in correct format");
  return false;
  }
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

<div class="container">

  <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" onsubmit="return validate()" name="myform">
    <h1><center><font face="Malgun Gothic" color="E33539" size="10">Thông Tin Sinh Viên</font></center></h1>
      <div class row1>
      <div class="column2">
      </br>
      </br>
      <img id="img" height="200px" width="80%" >
      <input id="inp" type='file' required>
      <textarea id="b64" name="imag" style="display:none">
      </textarea>
      <br>
      </div>
      <div class="column1">
  <div class="row">
    <div class="col-25">
      <label for="fname"><b>Họ Và Tên</b></label>
    </div>
    <div class="col-75">
      <input type="text" id="fname" name="fullname" placeholder="Nhập họ và tên của bạn.." style="height:50px" required maxlength="30">
    </div>
  </div>
  <div class="row">
    <div class="col-25">
      <label for="mssv"><b>MSSV</b></label>
    </div>
    <div class="col-75">
      <input type="text" id="fname" name="MSSV" placeholder="Nhập mssv của bạn..." style="height:50px" required maxlength="7" pattern="[1 or 2]{1}[0-9]{1}[1]{1}[0-9]{4}">
    </div>
  </div>
  <div class="row">
    <div class="col-25">
      <label for="NGAYSINH"><b>Ngày Sinh</b></label>
    </div>
    <div class="col-75">
      <input type="date" id="fname" name="birthday" style="height:50px" required>
    </div>
  </div>
    
  <div class="row">
    <div class="col-25">
      <label for="khoa"><b>Khoa</b></label>
    </div>
    <div class="col-75">
    <select id="fname" name="khoa"  style="height:50px" value="<?=$khoa?>" required>
        <option selected hidden>Chọn Khoa</option>
        <option value="Khoa Học Máy Tính">Khoa Học Máy Tính</option>
        <option value="Điện-Điện Tử">Điện-Điện Tử</option>
        <option value="Cơ Khí">Cơ Khí</option>
        <option value="Kỹ Thuật Hóa Học">Kỹ Thuật Hóa Học</option>
      </select>
    </div>
  </div>
    <div class="row">
    <div class="col-25">
      <label for="lop"><b>Lớp</b></label>
    </div>
    <div class="col-75">
       
    <select id="fname" name="class"  style="height:50px" value="<?=$class?>" required>
        <option selected hidden>Chọn Lớp</option>
        <option value="A01">A01</option>
        <option value="A02">A02</option>
        <option value="A03">A03</option>
        <option value="A04">A04</option>
      </select>
    </div>


  </div>
  <div class="row">
    <div class="col-25">
      <label for="dienthoai"><b>SĐT</b></label>
    </div>
    <div class="col-75">
      <input type="text" id="fname" name="phone" placeholder="Nhập số điện thoại của bạn..." style="height:50px" required maxlength="10">
    </div>
  </div>
    <div class="row">
    <div class="col-25">
      <label for="mail"><b>Email</b></label>
    </div>
    <div class="col-75">
      <input type="text" id="fname"name="email" placeholder="@gmail.com" style="height:50px" required maxlength="30">
    </div>
  </div>

      <div class="row">
        <div class="button">
        <button class="btn btn-success">Save</button>
        </div>
        <div class="button">
        <button class="btn btn-success"><a href="http://localhost/project/trangchinh/chinh.php" style="text-decoration:none;color:white;">Cancel</a></button>
        </div>
  </div>
      </div>
      
      </div>

  </form>

</div>
<script type="text/javascript">
function readFile() {
  
if (this.files && this.files[0]) {

var FR= new FileReader();

FR.addEventListener("load", function(e) {
document.getElementById("img").src       = e.target.result;
document.getElementById("b64").innerHTML = e.target.result;
}); 

FR.readAsDataURL( this.files[0] );
}

}
document.getElementById("inp").addEventListener("change", readFile);
</script>
</body>
</html>