<?php include('partials/menu.php');?>

<div class="main-content">
    <div class="wrapper">
        <h1>Change Password</h1>
</br> </br>

<?php
    if(isset($_GET['id']))
    {
        $id=$_GET['id'];
    }
?>

<form action ="" method="POST">
    <table class="tbl-30">
        <tr>
            <td>Current Password:</td>
            <td>
                <Input type ="password" name ="current_password" placeholder="Current Password">
            </td>
        </tr>

        <tr>
            <td>New Password:</td>
            <td>
            <Input type ="password" name ="new_password" placeholder="New Password">
            </td>
        </tr>

        <tr>
            <td>Confirm Password:</td>
            <td>
            <Input type ="password" name ="confirm_password" placeholder="Confirm Password">
            </td>
        </tr>

        <tr>
            <td colspan="2">
                <input type="hidden" name="id" value="<?php echo $id;?>">
                <input type="submit" name="submit" value="Change Password" class="btn-secondary">
            </td>
        </tr>

    </table>

</form>

    </div>
</div>
<?php
//Check wheather submit button clicked or not
if(isset($_POST['submit']))
{
    //Get data from form
    $id=$_POST['id'];
    $current_password=md5($_POST['current_password']);
    $new_password=md5($_POST['new_password']);
    $confirm_password=md5($_POST['confirm_password']);

    //check wheather the admin with current id and current password exists or not
    $sql="SELECT * FROM admin WHERE id=$id AND password='$current_password'"; //since id is integer type it dosent need ''

    //Executing the query
    $res=mysqli_query($conn, $sql);

    if($res==TRUE)
    {
        //check wheather data is available or not
        $count=mysqli_num_rows($res);

        if($count==1)
        {
            //admin Exits and password can be changed 
           //check wheather new password and confirm password matched or not
           if($new_password==$confirm_password)
           {
               //update the password
              $sql2="UPDATE admin SET 
              password='$new_password'
              WHERE id=$id";

              //Execute the query
              $res2=mysqli_query($conn,$sql2);

              //check wheather the query executed or not
              if($res2==TRUE)
              {
                  //Display success message
                  $_SESSION['change-password']="<div class='success'>Password Changed Successfully!</div>";

                //Redirect User
                header('location:'.HOMEURL.'admin/manage-admin.php');
              }
              else
              {
                  //Display error message
                  $_SESSION['change-password']="<div class='error'>Password cannot be Changed</div>";

                //Redirect User
                header('location:'.HOMEURL.'admin/manage-admin.php');
              }
           }
           else
           {     //check wheather password and retyped password matched or not
               //Redirect to manage-admin.php with an error message 
               $_SESSION['password-not-match']="<div class='error'>Password didn't match</div>";

               //Redirect User
               header('location:'.HOMEURL.'admin/manage-admin.php');
           }
        }
        else
        {
            //admin does not exits set message and redirect
            $_SESSION['user-not-found']="<div class='error'>User not found </div>";

            //Redirect User
            header('location:'.HOMEURL.'admin/manage-admin.php');
        }
    }

   
}
?>
<?php include('partials/footer.php');?>