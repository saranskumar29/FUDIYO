<?php 
session_start();

if(isset($_POST['email']) && 
   isset($_POST['pass'])){

    include "db_conn.php";
   

    $email = $_POST['email'];
    $pass = $_POST['pass'];

    $data = "email=".$email;
    
    if(empty($email)){
    	$em = "Email is required";
    	header("Location: ../alogin.php?error=$em&$data");
	    exit;
    }else if(empty($pass)){
    	$em = "Password is required";
    	header("Location: ../alogin.php?error=$em&$data");
	    exit;
    }else {

        $sql = "SELECT * FROM alogin WHERE email = ?";
    	$stmt = $conn->prepare($sql);

      $stmt->execute([$email]);
    
if($stmt->rowCount() == 1){
  $user = $stmt->fetch();
  
  $email =  $user['Email'];
  $password =  $user['Password'];  


  if($email === $_POST['email']){ 
  
     
     if($pass === $password){
        $_SESSION['email'] = $email;

                 header("Location: ../admin_db.php");
                 exit;
             }else {
               $em = "Incorect Email or password";
               header("Location: ../alogin.php?error=$em&$data");
               exit;
            }

          }else {
            $em = "Incorect Email or password";
            header("Location: ../alogin.php?error=$em&$data");
            exit;
         }

      }else {
         $em = "Incorect Email or password";
         header("Location: ../alogin.php?error=$em&$data");
         exit;
      }
    }


}else {
	header("Location: ../alogin.php?error=error");
	exit;
}