<?php 

if(isset($_POST['orgname']) && 
   isset($_POST['orgid']) && 
   isset($_POST['email']) && 
   isset($_POST['phone']) && 
   isset($_POST['pass']) && 
   isset($_POST['confpass'])){

    include "db_conn.php";
    
    $orgname = $_POST['orgname'];
    $orgid = $_POST['orgid'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $pass = $_POST['pass'];
    $confpass = $_POST['confpass'];

$data = "orgname=".$orgname."&orgid=".$orgid."&email=".$email."&phone=".$phone;

if (empty($orgname)) {
    $em = "Organisation/Individual name is required";
    header("Location: ../dsignup.php?error=$em&$data");
    exit;
}else if(empty($orgid)){
    $em = "Aadhar/Organisation Id is required";
    header("Location: ../dsignup.php?error=$em&$data");
    exit;
}else if(empty($email)){
    $em = "Email is required";
    header("Location: ../dsignup.php?error=$em&$data");
    exit;
}else if(empty($phone)){
    $em = "Phone is required";
    header("Location: ../dsignup.php?error=$em&$data");
    exit;
}else if(empty($pass)){
    $em = "Password is required";
    header("Location: ../dsignup.php?error=$em&$data");
    exit;
}else if(empty($confpass)){
    $em = "Confirm Password is required";
    header("Location: ../dsignup.php?error=$em&$data");
    exit;
}else if ($pass!= $confpass){
    $em="Both passwords should be same.";
    header("Location: ../dsignup.php?error=$em&$data");
    exit;
}
else 
{ 



    $pass = password_hash($pass, PASSWORD_DEFAULT);
    $confpass = password_hash($confpass, PASSWORD_DEFAULT);

    $targetDirectory = "../uploads/";
    $targetFileName=basename($_FILES['fileToUpload']['name']);
    $targetFile = $targetDirectory.basename($_FILES['fileToUpload']['name']);
    $uploadSuccess = move_uploaded_file($_FILES["fileToUpload"]["tmp_name"],$targetFile);

    	$sql = "INSERT INTO dsignup(orgname, orgid, email, phone, password, confirmpassword,filepath,verify_status) 
    	        VALUES(?,?,?,?,?,?,?,?)";
    	$stmt = $conn->prepare($sql);
    	$stmt->execute([$orgname, $orgid, $email, $phone, $pass, $confpass,$targetFileName, 1]);

    	header("Location: ../dsignup.php?success=Your account has been created successfully");
	    exit;
    }


    }else {
	header("Location: ../dlogin.php?error=error");
	exit;
}