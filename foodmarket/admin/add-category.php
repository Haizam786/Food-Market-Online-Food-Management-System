<?php include('partials/menu.php');?>
<div class="main-content">
    <div class="wrapper">
        <h1>Add Category</h1>

        </br></br>

        <?php
        if(isset($_SESSION['add']))
        {
            //displaying session message
            echo $_SESSION['add']; 
            //removing session message
            unset ($_SESSION['add']); 
        }

        if(isset($_SESSION['upload']))
        {
            //displaying session message
            echo $_SESSION['upload']; 
            //removing session message
            unset ($_SESSION['upload']); 
        }

        ?>
        </br></br>
        <!--Add Category form Start-->
        <form action="" method="POST" enctype="multipart/form-data">
            <table class="tbl-30">
                <tr>
                    <td>Title:</td>
                    <td>
                        <input type="text" name="title" placeholder="Category Title">
                    </td>
                </tr>

                <tr>
                    <td>Select Image:</td>
                    <td>
                        <input type="file" name="image" >
                    </td>
                </tr>

                <tr>
                    <td>Featured:</td>
                    <td>
                        <input type="radio" name="featured" value="Yes">Yes
                        <input type="radio" name="featured" value="No">No
                        
                    </td>
                </tr>

                <tr>
                    <td>Active:</td>
                    <td>
                        <input type="radio" name="active" value="Yes">Yes
                        <input type="radio" name="active" value="No">No
                        
                    </td>
                </tr>

                <tr>
                    <td colspan="2">
                        <input type="submit" name="submit" value="Add Category" class="btn-secondary">
                    </td>
                </tr>
            </table>

        </form>
        <!--Add Category End-->

        <?php 
        //check wheather the submit button is clicked or not
        if(isset($_POST['submit']))   
        {
            //Get the value from category form
            $title = $_POST['title'];

            //for radio input type, we need to check whether the button is selected or not
            if(isset($_POST['featured']))
            {
                //Get the value from form
                $featured=$_POST['featured'];
            }
            else
            {
                //set the default value
                $featured="No";
                
            }
            if(isset($_POST['active']))
            {
                $active=$_POST['active'];
            }
            else
            {
                $active="No";
            }

            //check wheather the image is selected or not and set the value for image name accordingly
          

           if(isset($_FILES['image']['name']))
           {
               //upload the image
               //to upload the image we require image name,source path & destination path
               $image_name=$_FILES['image']['name'];

               //Upload image only if image is selected
               if($image_name != "")
               {

               
                    //...Auto rename the image
                    //...get the extension of the image(jpg,png etc)  e.g: specialfood1.jpg
                    $ext=end(explode('.',$image_name));

                    //rename the image
                    $image_name="Food_Category_".rand(000, 999).'.'.$ext; //e.g. food_category_834.jpg
                    $source_path=$_FILES['image']['tmp_name'];
                    $destination_path="../images/category/".$image_name;

                    //finally uploading the image
                    $upload=move_uploaded_file($source_path,$destination_path);

                    //check wheather image is uploaded or not
                    //if the image is not uploaded then stop the process and redirect with an error message
                    if($upload==false)
                    {
                        //Set message
                        $_SESSION['upload']="<div class='error'>Image cannot be uploaded</div>";

                        //redirect to add-category.php
                        header('location:'.HOMEURL.'admin/add-category.php');

                        //stop the process
                            die();
               }
            }
           }
           else
           {
               //not uploading the image and set the image_name value as blank
               $image_name="";
           }

            //creating sql query to insert category into database
            $sql="INSERT INTO category SET
                title='$title',
                image_name='$image_name',
                featured='$featured',
                active='$active'
            ";

            //execute the query and store in the database
            $res=mysqli_query($conn, $sql);

            //check wheather the query executed or not and added to the database or not
            if($res==TRUE)
            {
                //Query executed and category added
                $_SESSION['add']="<div class='success'>Category Added Successfully!</div>";

                //Redirect to manage-category.php
                header('location:'.HOMEURL.'admin/manage-category.php');
            }
            else
            {
                //Failed to add category
                $_SESSION['add']="<div class='error'>Category cannot be added</div>";

                //Redirect to manage-category.php
                header('location:'.HOMEURL.'admin/add-category.php');
            }
        }
        ?>
    </div>
</div>
<?php include('partials/footer.php');?>