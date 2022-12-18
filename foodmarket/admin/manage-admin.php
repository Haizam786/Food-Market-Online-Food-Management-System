<?php include('partials/menu.php');?>
        <!--Main Content Start--> 
        <div class="main-content">
             <div class="wrapper">
            <h1>Manage Admin</h1>

            </br></br>

            <?php
            if(isset($_SESSION['add']))
            {
                //displaying session message
                echo $_SESSION['add']; 
                //removing session message
                unset ($_SESSION['add']); 
            }

            if(isset($_SESSION['delete']))
            {
                //displaying session message
                echo $_SESSION['delete']; 
                //removing session message
                unset ($_SESSION['delete']); 
            }

            if(isset($_SESSION['update']))
            {
                //displaying session message
                echo $_SESSION['update']; 
                //removing session message
                unset ($_SESSION['update']); 
            }

            if(isset($_SESSION['user-not-found']))
            {
                //displaying session message
                echo $_SESSION['user-not-found']; 
                //removing session message
                unset ($_SESSION['user-not-found']); 
            }

            if(isset($_SESSION['password-not-match']))
            {
                //displaying session message
                echo $_SESSION['password-not-match']; 
                //removing session message
                unset ($_SESSION['password-not-match']); 
            }

            if(isset($_SESSION['change-password']))
            {
                //displaying session message
                echo $_SESSION['change-password']; 
                //removing session message
                unset ($_SESSION['change-password']); 
            }

            ?>
            </br></br>

            <!--Btn to add an admin-->
            <a href="add-admin.php" class="btn-primary">Add Admin</a>

            </br> </br> </br>

            <table class ="tbl-full">
                <tr>
                    <th>S.N.</th>
                    <th>Full Name</th>
                    <th>Username</th>
                    <th>Actions</th>
                </tr>

                <?php
                //Query to get all admin from the database
                $sql="SELECT * FROM admin";

                //Execute the Query
                $res=mysqli_query($conn, $sql);

                //Check wheather the query is executed or not
                if($res==TRUE)
                {
                    //Count ROWS wheather there are data in the database or not
                    $count=mysqli_num_rows($res); //get all the rows in database

                    $sn=1; //Create a variable and assign the value

                    //check the number of the database
                    if($count>0)
                    {
                        //data is available in the database
                        while ($rows=mysqli_fetch_assoc($res))
                        {
                            //using while loop to get data from the database
                            //while loop will run until as long as data is available in the database

                            //Get individual data
                            $id=$rows['id'];
                            $full_name=$rows['full_name'];
                            $username=$rows['username'];

                            //Display the values in the table
                            ?>

                <tr>
                    <td><?php echo $sn++; ?></td>
                    <td><?php echo $full_name; ?> </td>
                    <td><?php echo $username; ?></td>
                    <td>
                        <a href="<?php echo HOMEURL; ?>admin/update-admin.php?id=<?php echo $id; ?>" class="btn-secondary">Update Admin</a>
                        <a href="<?php echo HOMEURL; ?>admin/delete-admin.php?id=<?php echo $id; ?> " class="btn-tertiary">Delete Admin</a>
                        <a href="<?php echo HOMEURL; ?>admin/update-password.php?id=<?php echo $id; ?>" class="btn-primary">Change Password</a>
                    </td>
                </tr>

                            <?php
                        }

                    }else{
                         //data is not available in the database
                    }
                }
                ?>
            </table>


         </div>

        </div>     
        <!--Main Content End--> 

<?php include('partials/footer.php');?>