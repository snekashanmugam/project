<?php
$Email = $_POST['Email'];
$psw = $_POST['psw'];
$conn = new mysqli ("localhost","root","","login");
if($conn->connect_error){
	die("Failed to connect : ".$conn->connect_error);

}
else{
	$stmt = $conn->prepare("select * from register where Email = ?");
	$stmt->bind_param("s", $Email);
	$stmt->execute();
	$stmt_result = $stmt->get_result();
	if($stmt_result->num_rows > 0) {
		$data = $stmt_result->fetch_assoc();
		if($data['psw'] === $psw) {
			echo "Login Successfully";
		} else{
			echo "Invalid Email id or password";
		}
	}
	else
	{
		echo "Invalid Email id or password";
	}
}
?>