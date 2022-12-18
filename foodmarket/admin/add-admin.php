<?php include('partials/menu.php');?>

        <div class="main-content">
             <div class="wrapper">
                 <h1>Add Admin</h1>

</br> </br>

            <?php
            //checking wheather session is set or not
            if(isset($_SESSION['add']))
            {
                //displaying session message
                echo $_SESSION['add']; 
                //removing session message
                unset ($_SESSION['add']);  
            }

            ?>


                 <form action="" method="POST">

                 <table class="tbl-30">
                     <tr>
                         <td>Full Name:</td>
                         <td>
                             <input type="text" name="full_name" placeholder="Enter Your Full Name">
                        </td> 
                     </tr>

                     <tr>
                         <td>Username:</td>
                         <td>
                             <input type="text" name="username" placeholder="Enter Your Username">
                            </td>
                     </tr>

                     <tr>
                         <td>Password:</td>
                         <td>
                             <input type="password" name="password" placeholder="Enter Your Password">
                            </td>
                     </tr>

                     <tr>
                         <td colspan="2">
                         <input type="submit" name="submit" value="Add Admin" class="btn-primary">
                             
                         </td>
                     </tr>
                 </table>
                 </form>
        </div>
    </div>


<?php include('partials/footer.php');?>

<?php   
    //Process the value from form & store into the database

    //check whether submit button is clicked or not

    if(isset($_POST['submit'])) //check wheather values are submit through POST method
    {
       
       //Get The Data from Form
       $full_name=$_POST['full_name'];
       $username=$_POST['username'];
       $password=md5($_POST['password']); //Encrypting Password with md5

       //SQL Query to store data into database
       $sql="INSERT INTO admin SET
       full_name='$full_name',
       username='$username',
       password ='$password'
       ";
       
       //Executing query and save into database
      $res = mysqli_query($conn, $sql) or die(mysqli_error($conn));

       //check wheather the (query is executed) data is inserted or not and display relevant message
      if($res==true)
       {
           //Creating SESSION Variable to display message
           $_SESSION['add']="<div class='success'>Admin Added Successfully!</div>";

           //Redirect Page to manage-admin.php
           header("location:" .HOMEURL.'admin/manage-admin.php');

       
       }
       else
       {
           //Creating SESSION Variable to display message
           $_SESSION['add']="<div class='error'>Admin cannot be added</div>";

           //Redirect Page to add-admin.php
           header("location:" .HOMEURL.'admin/add-admin.php');
           
       }

    }
?>