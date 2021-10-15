<?php
session_start();
$name=$email=$username=$password=$repassword=$status=$sql=" ";
$errors = array();
$con= mysqli_connect('localhost','root','','project');
if(isset($_POST['register'])){
        $name=mysqli_real_escape_string($con,$_POST['rname']);
        $username=mysqli_real_escape_string($con,$_POST['runame']);
        $email=mysqli_real_escape_string($con,$_POST['remail']);

        $password=mysqli_real_escape_string($con,$_POST['rpass']);
        $repassword=mysqli_real_escape_string($con,$_POST['rrepass']);

        if ($password!=$repassword){
                array_push($errors,"*Inncorrect password");
            }
        if (count($errors)==0){
            $sql= "INSERT INTO register (id,FullName,UserName,Email,Password,Status)
                        VALUES ('','$name','$username','$email','$password','1')";
            if(mysqli_query($con,$sql)){
            $_SESSION['username']=$username;
            $_SESSION['success']="You are successfully logged in";

            header('location:main.php');
            }

        }


}
if(isset($_POST['login'])){
    $username=mysqli_real_escape_string($con,$_POST['runame']);
    $password=mysqli_real_escape_string($con,$_POST['rpass']);
    $sql="SELECT * FROM register WHERE UserName = '$username' AND Password = '$password'";
    $r = mysqli_query($con,$sql);
    if (mysqli_num_rows($r) == 1){
        $_SESSION['username']=$username;
        $_SESSION['success']="You are successfully logged in";

        header('location:main.php');
    }
    else{
        array_push($errors,"Invalid username/password");
    }

}


?>
