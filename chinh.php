<?php
require_once('dbhelp.php');
session_start();
if(!isset($_SESSION['user'])) {
    header('Location:Login.php');
}
?>
<!DOCTYPE HTML>
<html>
<head>
    <meta charset="UTF-8">
        <title>Bảng chính</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="Style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script type='text/javascript'>
    function signout(){
        if (confirm("Do you want signout?")) {
            $.post("Signout.php", function(data) {
            location.reload();
        } )
        } else {
            return;
    }
    }
    </script>
</head>
<body  onload="myFunction()" style="margin:0;">
<div id="loader"></div>
    <!--phan header-->
    <div style="display:none;" id="myDiv" class="animate-bottom">
    <div class="header">
        <h1><center><font face="Algerian" color="003366" size="20" >Quản Lí Danh Sách Sinh Viên</font></center></h1>
    </div>
    <!--thanh menu-->
    <div class="sticky">
        <div class="topnav">
            <div class="out">
            <abbr title="Sign out" ><a onclick="signout()"><i class="fa fa-sign-out aria-hidden="true"></i></a></abbr>
            </div>
            <div class="out1">
            <a><i class="fa fa-users aria-hidden="true"> <?php echo $_SESSION['user'];  ?></i></a>
            </div>
        </div>
    </div>
    <div class="content">
        
        <form id="search" method="get" class="tracuu">
        <h1 style="padding-top:20px;"><font size="6" color="FF3366"><b><center>Tra Cứu Thông Tin</center></b></font></h1>
        <div class="row">
            <div class="column">
            <div class= "row1">
                    <div class="col-25">
                        <label for="name">Họ Và Tên</label>
                    </div>
                    <div class="col-75">
                        <input type="text" id="name" name="name" placeholder="Nhập tên...">
                    </div>
                    </div>
                    <div class= "row1">
                    <div class="col-25">
                        <label for="mssv">MSSV</label>
                    </div>
                    <div class="col-75">
                        <input type="text" id="mssv" name="mssv" placeholder ="Nhập MSSV...">
                    </div>
                    </div>
            </div>
            <div class="column">
                <div class= "row1">
                    <div class="col-25">
                        <label for="khoa">Khoa</label>
                    </div>
                    <div class="col-75">
                        <input type="text" id="khoa" name="khoa" placeholder="Nhập khoa...">
                    </div>
                    </div>
                    <div class="row1">
                    <div class="col-25">
                        <label for="class">Lớp</label>
                    </div>
                    <div class="col-75">
                        <input type="text" id="class" name="class" placeholder ="Nhập Lớp...">
                    </div>
                    </div>
            </div>
        </div>
        <div class="column1">
            <form>
                <button type="search"><center><i class="fa fa-search"> Search</i></center></button>
            </form>
        </div>
    </form>
    <form class="danhsach" method="post" id="danhsach">
    <div class="table" id="list">
        <table>
        <h1><font size="6" color="FF3366"><center><b>Danh Sách Sinh Viên</b></center></font></h1>
        <div class="button">
                <button class="btn btn-success" ><a href="http://localhost/project/trangchinh/add.php">Add Student</a></button>
        </div>
            <thead>
                <tr>
                    <th>STT</th>
                    <th>Họ Và Tên</th>
                    <th>MSSV</th>
                    <th>Ngày Sinh</th>
                    <th>Khoa</th>
                    <th>Lớp</th>
                    <th>SĐT</th>
                    <th>Email</th>
                    <th width="40px"></th>
                    <th></th>
                </tr>
            </thead>
            <tbody id="myTable">
            <?php
            if(isset($_GET['name']) && $_GET['name']!='' || isset($_GET['mssv']) && $_GET['mssv']!='' || isset($_GET['khoa']) && $_GET['khoa']!=''|| isset($_GET['class']) && $_GET['class']!='' ) {
                $sql = 'SELECT * FROM student where fullname like "%'.$_GET['name'].'%" && MSSV like "%'.$_GET['mssv'].'%" && khoa like "%'.$_GET['khoa'].'%" &&  class like "%'.$_GET['class'].'%"';
            }
            /* if (isset($_GET['mssv']) && $_GET['mssv']!='') {
                $sql = 'SELECT * FROM student where MSSV like "%'.$_GET['mssv'].'%"';
            }
            if(isset($_GET['khoa']) && $_GET['khoa']!='') {
                $sql = 'SELECT * FROM student where khoa like "%'.$_GET['khoa'].'%"';
            }
            if(isset($_GET['class']) && $_GET['class']!='') {
                $sql = 'SELECT * FROM student where class like "%'.$_GET['class'].'%"';
            } */ else{
                $sql = 'SELECT * FROM student';
            }
            $studentList = executeResult($sql);
            $index=1;
            foreach ($studentList as $std) {
                echo '<tr>
                    <td><center>'.($index++).'</center></td>
                    <td>'.$std['fullname'].'</td>
                    <td><center>'.$std['MSSV'].'</center></td>
                    <td ><center>'.$std['birthday'].'</center></td>
                    <td>'.$std['khoa'].'</td>
                    <td><center>'.$std['class'].'</center></td>
                    <td><center>'.$std['phone'].'</center></td>
                    <td>'.$std['email'].'</td>
                    <td><center><button class="btn btn-danger" onclick="deteleStudent('.$std['Id'].')">Delete</button></center></td>
                    <td><center><button class="btn btn-warning"><a href="http://localhost/project/trangchinh/edit.php?Id='.$std['Id'].'">Edit</a></button></center></td>
                </tr>';
            }
            ?>
            </tbody>
        </table>
        
    </div>
    </form>
</div>
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
    function deteleStudent(Id) {
        option = confirm ('Do you want to delete?')
        if(!option) {
            return;
        }
        console.log(Id)
        $.post("delete_student.php",{'Id':Id}, function(data) {
        location.reload();
        } )
    }
</script>
</body>
</html>