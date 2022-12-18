<?php include('partials/menu.php');?>
<div class="main-content">
    <div class="wrapper">
        <h1>Update Admin</h1>

    </br> </br>

            <?php
            //Get the ID of selected Admin
            $id=$_GET['id'];

            //Create Sql query to get the details
            $sql="SELECT * FROM admin where id=$id";

            //Executing the query
            $res=mysqli_query($conn, $sql);

            //Check wheather the query is executed or not
            if($res==TRUE)
            {
                //check wheather the data is available or not
                $count=mysqli_num_rows($res);

                //check wheather admin data available or not
                if($count==1)
                {
                    //Get the details
                    $row=mysqli_fetch_assoc($res);

                    $full_name=$row['full_name'];
                    $username=$row['username'];
                }
                else
                {
                    //Redirect to manage-admin.php
                    header('location:'.HOMEURL.'admin/manage-admin.php');
                }
            }


            ?>

        <form action="" method="POST">
            <table class="tbl-30">
                <tr>
                    <td>Full Name:</td>
                    <td>
                        <input type="text" name="full_name" value="<?php echo $full_name;?>">
                    </td>
                </tr>

                <tr>
                    <td>Username:</td>
                    <td>
                        <input type="text" name="username" value="<?php echo $username;?>">
                    </td>
                </tr>

                <tr>
                    <td colspan="2">
                        <input type="hidden" name="id" value="<?php echo $id;?>">
                         <input type="submit" name="submit" value="Update Admin" class="btn-secondary">
                    </td>
                </tr>
            </table>


        </form>

    </div>
</div>
<?php 
//check wheather submit button is clicked or not
if(isset($_POST['submit']))
{
   //get all the values from form to update
   $id=$_POST['id'];
   $full_name=$_POST['full_name'];
   $username=$_POST['username'];

   //creating a sql query to update admin
   $sql="UPDATE admin SET 
   full_name='$full_name',
   username='$username' 
   WHERE id='$id'
   ";

   //Executing the query
   $res=mysqli_query($conn, $sql);

   //check wheather sql query executed successfully or not
   if($res==TRUE)
   {
       //Query executed and admin updated
       $_SESSION['update']="<div class='success'>Admin Updated Successfully!</div>";

       //Redirect to manage-admin.php
       header('location:'.HOMEURL.'admin/manage-admin.php');
   }else
   {
       //Failed to update admin
       $_SESSION['update']="<div class='error'>Admin cannot be Updated</div>";

       //Redirect to manage-admin.php
       header('location:'.HOMEURL.'admin/manage-admin.php');
   }
}

?>
<?php include('partials/footer.php');?>