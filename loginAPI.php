<?php
	include 'connectdb.php';
	include 'http.php';

	$temp_array = array();
	
    $postdata = file_get_contents("php://input");


	$request = json_decode($postdata);

	$username =  filter_var(trim($request->username) ,FILTER_VALIDATE_EMAIL);
	$password = trim($request->password);

	
	$qry = "Call sp_login('$username','$password')";
	$result = mysqli_query($conn,$qry);

	if(mysqli_num_rows($result) > 0) {

		while($rows = mysqli_fetch_assoc($result)) {

			$temp_array[] = $rows;
		}
		
		echo json_encode(array("user"=>$temp_array));
				
	}else{

		echo json_encode("fail");
	}
		
	
?>