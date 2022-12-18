<?php include('partials/menu.php'); ?>

<div class="main-content">
    <div class="wrapper">
        <h1>Manage Food</h1>

        </br></br>

        <!--Btn to add an admin-->
        <a href="<?php echo HOMEURL; ?>admin/add-food.php" class="btn-primary">Add Food</a>

        </br> </br> </br>
        <?php
        if (isset($_SESSION['add'])) {
            //displaying session message
            echo $_SESSION['add'];
            //removing session message
            unset($_SESSION['add']);
        }

        if (isset($_SESSION['delete'])) {
             //displaying session message
            echo $_SESSION['delete'];
            //removing session message
            unset($_SESSION['delete']);
        }

        if (isset($_SESSION['upload'])) {
            //displaying session message
            echo $_SESSION['upload'];
            //removing session message
            unset($_SESSION['upload']);
        }

        if (isset($_SESSION['unauthorize'])) {
            //displaying session message
            echo $_SESSION['unauthorize'];
            //removing session message
            unset($_SESSION['unauthorize']);
        }

        if (isset($_SESSION['update'])) {
            //displaying session message
            echo $_SESSION['update'];
            //removing session message
            unset($_SESSION['update']);
        }

        ?>
        </br> </br>


        <table class="tbl-full">
            <tr>
                <th>S.N.</th>
                <th>Title</th>
                <th>Price</th>
                <th>Image</th>
                <th>Featured</th>
                <th>Active</th>
                <th>Actions</th>
            </tr>

            <?php
            //Creating SQL Query to Get all the Food
            $sql = "SELECT * FROM food";

            //Execuinge the qUery
            $res = mysqli_query($conn, $sql);

            //Count Rows to check whether foods available or not
            $count = mysqli_num_rows($res);

            //Create Serial Number Variable and Set Default Value as 1
            $sn = 1;

            if ($count > 0) {
                // food is available in Database

                //Get the Foods from Database and Display
                while ($row = mysqli_fetch_assoc($res)) {
                    //get the values from individual columns
                    $id = $row['id'];
                    $title = $row['title'];
                    $price = $row['price'];
                    $image_name = $row['image_name'];
                    $featured = $row['featured'];
                    $active = $row['active'];
            ?>

                    <tr>
                        <td><?php echo $sn++; ?>. </td>
                        <td><?php echo $title; ?></td>
                        <td>LKR <?php echo $price; ?></td>
                        <td>
                            <?php
                            //Check whether image available or not
                            if ($image_name == "") {
                                //image not available, dislpay an error Message
                                echo "<div class='error'>Image not Added.</div>";
                            } else {
                                // Image is available, Display Image
                            ?>
                                <img src="<?php echo HOMEURL; ?>images/food/<?php echo $image_name; ?>" width="100px">
                            <?php
                            }
                            ?>
                        </td>
                        <td><?php echo $featured; ?></td>
                        <td><?php echo $active; ?></td>
                        <td>
                            <a href="<?php echo HOMEURL; ?>admin/update-food.php?id=<?php echo $id; ?>" class="btn-secondary">Update Food</a>
                            <a href="<?php echo HOMEURL; ?>admin/delete-food.php?id=<?php echo $id; ?>&image_name=<?php echo $image_name; ?>" class="btn-tertiary">Delete Food</a>
                        </td>
                    </tr>

            <?php
                }
            } else {
                //Food not Added in Database
                echo "<tr> <td colspan='7' class='error'> Food not Added Yet</td> </tr>";
            }

            ?>


        </table>
    </div>

</div>

<?php include('partials/footer.php'); ?>