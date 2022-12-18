<?php

//Including Constants.php file
include('../config/constants.php');


//getting ID to be deleted
 $id=$_GET['id'];
//Creating SQL Query to Delete Admin

$sql="DELETE FROM admin WHERE id=$id";

//Executing the Query
$res=mysqli_query($conn, $sql);

//check wheather the query executed successfully or not
if($res==true)
{
    //Query executed successfully and admin deleted
    
    //Create SESSION variable to Display Messeage 
    $_SESSION['delete']="<div class='success'>Admin Deleted Successfully!</div>";
    
    //Redirect to manage-admin.php 
    header('location:'.HOMEURL.'admin/manage-admin.php');
}else{
    //Faiiled to delete admin
    $_SESSION['delete']="<div class='error'>Admin cannot be deleted</div>";
    
    //Redirect to manage-admin.php 
    header('location:'.HOMEURL.'admin/manage-admin.php');
}


?>