<?php 
//Including constant file
include ('../config/constants.php');
//check wheather the id and image_name value is set or not
if(isset($_GET['id']) && isset($_GET['image_name']))
{
    //get the value and delete
    $id=$_GET['id'];
    $image_name=$_GET['image_name'];

    //Remove the physical image file is available
    if($image_name != "")
    {
        //remove if image is availabe 
        $path="../images/category/".$image_name;

        //remove the image
        $remove=unlink($path);

        //If failed to remove image then add an error message and stop the process
        if($remove==false)
        {
            //Set the SESSION Message
            $_SESSION['remove']="<div class='error'>Category image cannot be deleted</div>";

            //Redirect to manage-category.php 
            header('location:'.HOMEURL.'admin/manage-category.php');
            //stop the process
            die();
        }
    }
    //Delete data from database
    $sql="DELETE FROM category WHERE id=$id";

    //Execute the Query
    $res=  mysqli_query($conn,$sql);

    //Check wheather the data is delete from database or not
    if($res==true)
    {
        //set success message and redirect
        $_SESSION['delete']="<div class='success'>Category Deleted Successfully!</div>";

        //Redirect to manage-category.php
        header('location:'.HOMEURL.'admin/manage-category.php');
    }
    else
    {
        //set fail message and redirect
        $_SESSION['delete']="<div class='error'>Category cannot be deleted</div>";

        //Redirect to manage-category.php
        header('location:'.HOMEURL.'admin/manage-category.php');

    }
      
}
else
{
    //redirect to manage-category.php
    header('location:'.HOMEURL.'admin/manage-category.php');

}
?>