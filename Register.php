<?php
$Email=$_POST['Email'];
$psw=$_POST['psw'];
if(!empty($Email) || !empty($psw))
{
	$host="localhost";
	$dbusername="root";
	$dbpassword="";
	$dbname="login";

	$conn=new mysqli ($host,$dbusername,$dbpassword,$dbname);
	if(mysqli_connect_error()){
		die('Connect Error ('.
			mysqli_connect_errno() .')'
			.mysqli_connect_error());
	}
	else{
		$SELECT="SELECT Email From Register Where Email=? Limit 1"
		;
		$INSERT="INSERT Into Register(Email,psw)values(?,?)";
		
        $stmt=$conn->prepare($SELECT);
        $stmt->bind_param("s",$Email);
        $stmt->execute();
        $stmt->bind_result($Email);
        $stmt->store_result();
        $rnum=$stmt->num_rows;


        if($rnum==0){
        	 $stmt->close();
        	 $stmt=$conn->prepare($INSERT);
        	 $stmt->bind_param("ss", $Email,$psw);
        	 $stmt->execute();
        	 echo "Register Sucessfully";

        }
        else{
        	echo "Someone Already register using this Email id";
        }
        $stmt->close();
        $conn->close();
        	}
	
}
else{
	echo "All field are required";
	die();
}
?>