<?php 
    include('../config/constants.php');

    if(isset($_GET['id']) && isset($_GET['image_name'])) 
    {
        //Process to Delete

        //Get id and Image name
        $id = $_GET['id'];
        $image_name = $_GET['image_name'];

        //Remove the Image if Available

        //Check whether the image is available or not and Delete only if available
        if($image_name != "")
        {
            // image is available and need to remove from folder

            //Getting the Image Path
            $path = "../images/food/".$image_name;

            //Remove Image File from Folder
            $remove = unlink($path);

            //Check whether the image is removed or not
            if($remove==false)
            {
                //Unable to Remove image
                $_SESSION['upload'] = "<div class='error'>Unable to Remove Image File.</div>";
                //Redirect to Manage Food
                header('location:'.HOMEURL.'admin/manage-food.php');
                //Stop the Process of Deleting Food
                die();
            }

        }

        // Delete Food from Database
        $sql = "DELETE FROM food WHERE id=$id";

        //Execute the Query
        $res = mysqli_query($conn, $sql);

        //CHeck whether the query executed or not and set the session message respectively

        //..Redirect to manage-food.php with a Session Message
        if($res==true)
        {
            //Food Deleted
            $_SESSION['delete'] = "<div class='success'>Food Deleted Successfully!</div>";
            header('location:'.HOMEURL.'admin/manage-food.php');
        }
        else
        {
            //Failed to Delete Food
            $_SESSION['delete'] = "<div class='error'>Unable to Delete Food.</div>";
            header('location:'.HOMEURL.'admin/manage-food.php');
        }

        

    }
    else
    {
        //Redirect to manage-food.php Page
       
        $_SESSION['unauthorize'] = "<div class='error'>Unauthorized Access.</div>";
        header('location:'.HOMEURL.'admin/manage-food.php');
    }

?>