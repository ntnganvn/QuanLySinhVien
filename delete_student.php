<?php
if (isset($_POST['Id'])) {
    $Id = $_POST['Id'];
    require_once('dbhelp.php');
    $sql='delete from student where Id= '.$Id;
    execute($sql);
    echo " success delete ";
}
?>