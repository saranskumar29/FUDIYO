<?php 
session_start();

if(isset($_POST['email']) && 
   isset($_POST['pass'])){

    include "db_conn.php";
   

    $input_email = $_POST['email'];
    $pass = $_POST['pass'];

    $data = "email=".$email;

    if(empty($input_email)){
    	$em = "Email is required";
    	header("Location: ../rlogin.php?error=$em&$data");
	    exit;
    }else if(empty($pass)){
    	$em = "Password is required";
    	header("Location: ../rlogin.php?error=$em&$data");
	    exit;
    }else {

        $sql = "SELECT * FROM rsignup WHERE email = ? AND verify_status =2";
    	$stmt = $conn->prepare($sql);

      $stmt->execute([$input_email]);
      
      if($stmt->rowCount() == 1){
          $user = $stmt->fetch();

          $orgname =  $user['orgname'];
          $orgid =  $user['orgid '];
          $email =  $user['email'];
          echo $email;
          $phone =  $user['phone'];
          $password =  $user['password'];
          $confirmpassword =  $user['confirmpassword'];
          $id =  $user['id'];
          if($input_email == $email){ echo $pass;
            
             if(password_verify($pass, $password)){
                 $_SESSION['id'] = $id;
                 $_SESSION['orgname'] = $orgname;

                 header("Location: ../receiver_db.php");
                 exit;
             }else {
               $em = "Incorect Email or password";
               header("Location: ../rlogin.php?error=$em&$data");
               exit;
            }

          }else {
            $em = "Incorect Email or password";
            header("Location: ../rlogin.php?error=$em&$data");
            exit;
         }

      }else {
         $em = "Incorect Email or password";
         header("Location: ../rlogin.php?error=$em&$data");
         exit;
      }
    }


}else {
	header("Location: ../rlogin.php?error=error");
	exit;
}