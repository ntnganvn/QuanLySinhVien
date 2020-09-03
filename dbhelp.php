<?php
include('config.php');
//
function execute($sql) {
    // connect database
    $connect=mysqli_connect(server,username,password,dbname);
    //query
    mysqli_query($connect,$sql);
    // close connection
    mysqli_close($connect);
}
// su dung cho lenh select=>tra ve ket qua
function executeResult($sql) {
    // connect database
    $connect=mysqli_connect(server,username,password,dbname);
    //query
    $result = mysqli_query($connect,$sql);
    $list = [];
    while($row = mysqli_fetch_array($result,1)) {
        $list[] =$row;
    }
    // close connection
    mysqli_close($connect);
    //$connect->close(); huong doi tuong
    return $list;
}
?>