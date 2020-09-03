<?php
  require_once ('dbhelp.php');
   
  $fullname=$MSSV=$birthday=$khoa=$class=$phone=$email=$imag=$Id='';
	if (!empty($_POST)) {
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
      if(isset($_POST['Id'])) {
        $Id = test_input($_POST['Id']);
        }
    $fullname = str_replace('\'','\\\'',$fullname);
    $MSSV = str_replace('\'','\\\'',$MSSV);
    $birthday = str_replace('\'','\\\'',$birthday);
    $khoa = str_replace('\'','\\\'',$khoa);
    $class = str_replace('\'','\\\'',$class);
    $phone= str_replace('\'','\\\'',$phone);
    $email = str_replace('\'','\\\'',$email);
    if($Id!='') {
		$sql = "UPDATE student set fullname='$fullname',MSSV='$MSSV',birthday='$birthday',khoa='$khoa',class='$class',phone='$phone',email='$email',imag='$imag' where Id =".$Id;
    execute($sql);
    echo "<a id='chinh' href='chinh.php'></a>" ;
    echo "<script type='text/javascript'> alert('Update successful'); document.getElementById('chinh').click(); </script>"; 
    die();
  }
}

$Id='';
if(isset($_GET['Id'])) {
	$Id = $_GET['Id'];
	$sql ='SELECT * from student WHERE Id ='.$Id;
	$studentList =  executeResult($sql);
	if($studentList !=null && count($studentList)>0) {
	$std = $studentList[0];
	$fullname =$std['fullname'];
  $MSSV =$std['MSSV'];
  $birthday=$std['birthday'];
  $khoa=$std['khoa'];
  $class=$std['class'];
  $phone=$std['phone'];
  $email=$std['email'];
  $imag=$std['imag'];
    } else {
	$Id='';
}
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
    <title>Update Information</title>
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
<body onload="myFunction()" style="margin:0;">
<div id="loader"></div>
<div style="display:none;" id="myDiv" class="animate-bottom">
  <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" onsubmit="return validate()" name="myform">
    <h1><center><font face="Malgun Gothic" color="E33539" size="10">Thông Tin Sinh Viên</font></center></h1>
      <div class row1>
      <div class="column2">
      </br>
      </br>
      <img id="img" height="200px" width="80%" src="<?=$imag?>">
      <input id="inp" type='file' >
      <textarea id="b64" name="imag" style="display:none">
      </textarea>
      <br>
      </div>
      <div class="column1">
  <div class="row">
    <input type="number" name="Id" value="<?=$Id?>" style="display:none;" >
    <div class="col-25">
      <label for="fname"><b>Họ Và Tên</b></label>
    </div>
    <div class="col-75">
      <input type="text" id="fname" name="fullname" value="<?=$fullname?>" placeholder="Nhập tên của bạn..." style="height:50px" required maxlength="30">
    </div>
  </div>
  <div class="row">
    <div class="col-25">
      <label for="mssv"><b>MSSV</b></label>
    </div>
    <div class="col-75">
      <input type="text" id="fname" name="MSSV" value="<?=$MSSV?>" placeholder="Nhập MSSV của bạn..." style="height:50px" required maxlength="7" pattern="[1 or 2]{1}[0-9]{1}[1]{1}[0-9]{4}">
    </div>
  </div>
  <div class="row">
    <div class="col-25">
      <label for="NGAYSINH"><b>Ngày Sinh</b></label>
    </div>
    <div class="col-75">
      <input type="date" id="fname" name="birthday" style="height:50px" value="<?=$birthday?>" required>
    </div>
  </div>
    
  <div class="row">
    <div class="col-25">
      <label for="khoa"><b>Khoa</b></label>
    </div>
    <div class="col-75">
      <select id="fname" name="khoa"  style="height:50px" value="<?=$khoa?>" required>
        <option selected hidden value="<?=$khoa?>"><?php echo $khoa; ?></option>
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
        <option selected hidden value="<?=$class?>"><?php echo $class; ?></option>
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
      <input type="text" id="fname" name="phone" placeholder="Nhập số điện thoại của bạn..." value="<?=$phone?>" style="height:50px"  required maxlength="10" >
    </div>
  </div>
    <div class="row">
    <div class="col-25">
      <label for="mail"><b>Email</b></label>
    </div>
    <div class="col-75">
      <input type="text" id="fname" name="email" placeholder="@gmail.com" value="<?=$email?>" style="height:50px" required maxlength="30">
    </div>
  </div>
  <div class="row">
        <div class="button">
        <button class="btn btn-success" id="update" type="submit" >Update</button>
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
var myVar;

function myFunction() {
    myVar = setTimeout(showPage, 2000);
}

function showPage() {
    document.getElementById("loader").style.display = "none";
    document.getElementById("myDiv").style.display = "block";
    }
</script>
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