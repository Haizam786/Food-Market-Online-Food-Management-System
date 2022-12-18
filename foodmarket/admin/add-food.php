<?php include('partials/menu.php'); ?>
<div class="main-content">
    <div class="wrapper">
        <h1>Add Food</h1>
        </br></br>

        <?php
        if (isset($_SESSION['upload'])) {
            echo $_SESSION['upload'];
            unset($_SESSION['upload']);
        }
        ?>

        <form action="" method="POST" enctype="multipart/form-data">
            <table class="tbl-30">
                <tr>
                    <td>Title:</td>
                    <td>
                        <input type="text" name="title" placeholder="Title of the food">
                    </td>
                </tr>

                <tr>
                    <td>Description:</td>
                    <td>
                        <textarea name="description" cols="30" rows="5" placeholder="Description of the Food"></textarea>
                    </td>
                </tr>

                <tr>
                    <td>Price:</td>
                    <td>
                        <input type="number" name="price">
                    </td>
                </tr>

                <tr>
                    <td>Select Image:</td>
                    <td>
                        <input type="file" name="image">
                    </td>
                </tr>

                <tr>
                    <td>Category :</td>
                    <td>
                        <select name="category">

                            <?php
                            //create php code to display category from database

                            //create sql to get all active categories from database
                            $sql = "SELECT * FROM category WHERE active='Yes' ";

                            //executing query
                            $res = mysqli_query($conn, $sql);

                            //count rows to check wheather we have categories or not
                            $count = mysqli_num_rows($res);

                            //If count is greater than zero,categories are available or categories are not available
                            if ($count > 0) {
                                //categories are available 
                                while ($row = mysqli_fetch_assoc($res)) {
                                    //get the details of categories
                                    $id = $row['id'];
                                    $title = $row['title'];

                            ?>

                                    <option value="<?php echo $id; ?>"><?php echo $title; ?></option>

                                <?php

                                }
                            } else {
                                //categories are not available 
                                ?>
                                <option value="0">No Category Found</option>
                            <?php
                            }
                            //display on dropdown
                            ?>

                        </select>
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
                        <input type="submit" name="submit" value="Add Food" class="btn-secondary">
                    </td>
                </tr>

            </table>

        </form>
        <?php

        //Check whether the button is clicked or not
        if (isset($_POST['submit'])) {
            //Add the food in Database

            //get the data from form
            $title = $_POST['title'];
            $description = $_POST['description'];
            $price = $_POST['price'];
            $category = $_POST['category'];

            //check wheather radio buttons for featured and active are checked or not
            if (isset($_POST['featured'])) {
                $featured = $_POST['featured'];
            } else {
                $featured = "No"; //setting up the Default Value
            }

            if (isset($_POST['active'])) {
                $active = $_POST['active'];
            } else {
                $active = "No"; //setting up the Default Value

            }

            //upload the image if selected 
            //Check whether the select image is clicked or not and upload the image only if the image is selected
            if (isset($_FILES['image']['name'])) {
                //Getting the details of  selected image
                $image_name = $_FILES['image']['name'];

                //Check Whether the Image is Selected or not and upload image only if selected
                if ($image_name != "") {
                    // Image is SElected
                    // Renamge the Image
                    //Get the extension of selected image(for last part) (jpg, png) "Food-Name.jpg" 
                    $ext = end(explode('.', $image_name));

                    // Creating new name for Image(with random numbers)
                    $image_name = "Food_Name_" . rand(000, 999) . "." . $ext; //Image name be like "Food_Name_567.jpg"

                    //Uploading the Image
                    //getting the source path and destinaton path

                    // Source path is  current location of the image 
                    $src = $_FILES['image']['tmp_name'];

                    //destination path for the image to be uploaded
                    $dst = "../images/food/" . $image_name;

                    //Upload the food image
                    $upload = move_uploaded_file($src, $dst);

                    //check whether image uploaded of not
                    if ($upload == false) {
                        //Failed to Upload the image
                        //REdirect to add-Food.php with error Message
                        $_SESSION['upload'] = "<div class='error'>Image Cannot be Uploaded.</div>";
                        header('location:' . HOMEURL . 'admin/add-food.php');
                        //stopping the process
                        die();
                    }
                }
            } else {
                $image_name = ""; //setting default value blank
            }
            //insert into the database

            //Creating a SQL Query  Add food

            $sql2 = "INSERT INTO food SET 
                    title = '$title',
                    description = '$description',
                    price = $price, 
                    image_name = '$image_name',
                    category_id = $category,
                    featured = '$featured',
                    active = '$active'
                ";

            //Executing the Query
            $res2 = mysqli_query($conn, $sql2);

            //Check whether data inserted or not
            //Redirect with Message to manage-food.php page
            if ($res2 == true) {
                //Data inserted Successfullly
                $_SESSION['add'] = "<div class='success'>Food Added Successfully!.</div>";
                header('location:' . HOMEURL . 'admin/manage-food.php');
            } else {
                //Failed to Insert Data
                $_SESSION['add'] = "<div class='error'>Failed to Add Food.</div>";
                header('location:' . HOMEURL . 'admin/manage-food.php');
            }
        }
        ?>
    </div>
</div>
<?php include('partials/footer.php'); ?>