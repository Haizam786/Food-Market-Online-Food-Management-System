<?php include('../config/constants.php');?>
<html>
    <head>
        <title>Login-Food Market</title>
        <link rel="stylesheet" href="../css/admin.css"> 
    </head>
    <body>
        <div class="login">
            <h1 class="text-center">Login</h1>
            </br></br>

            <?php
            if(isset($_SESSION['login']))
            {
                echo $_SESSION['login'];
                unset ($_SESSION['login']);
            }
            if(isset($_SESSION['no-login-message']))
            {
                echo $_SESSION['no-login-message'];
                unset ($_SESSION['no-login-message']);
            }

            ?>
            </br></br>
            
            <!--Login form start-->
            <form action="" method="POST" class="text-center">
                Username: </br>
                <input type="text" name="username" placeholder="Enter Username"> </br></br>
                Password: </br>
                <input type="password" name="password" placeholder="Enter Password"></br></br>

                <input type="submit" name="submit" value="Login" class="btn-primary">

            </form>
            <!--Login form end-->
            
        </div>
    </body>
</html>

<?php
//check if button is clicked or not
if(isset($_POST['submit']))
{
    //process for login
    //get the data from login form

   // $username=$_POST['username'];
   //$password=md5($_POST['password']);

    $username=mysqli_real_escape_string($conn, $_POST['username']); //to prevent sql injection

    $raw_password=md5($_POST['password']); //password is encrypted with md5 method
    $password=mysqli_real_escape_string($conn, $raw_password); //to prevent sql injection


    //SQL to check wheather the user with username and password exists or not
    $sql="SELECT * FROM admin WHERE username='$username' AND password='$password'";

    //Execute the query
    $res=mysqli_query($conn, $sql);

    //count rows to check wheather the user exists or not
    $count=mysqli_num_rows($res);

    if($count==1)
    {
        //user available and login
        $_SESSION['login']="<div class='success' text-center>Login Success!</div>";
        $_SESSION['user']=$username; //to check wheather the user is logged in or not and logout will unset it

        //Redirect to Home Page/Dashboard
        header('location:'.HOMEURL.'admin/');

    }
    else
    {
        //user is not available and login fail
        $_SESSION['login']="<div class='error' text-center>Username or Password doesn't match</div>";

        //Redirect to Home Page/Dashboard
        header('location:'.HOMEURL.'admin/login.php');
    }
}
?>