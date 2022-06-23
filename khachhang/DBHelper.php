<?php
require_once('config.php');



function execute($sql) {
    //save data into table
    //open connection to database
    $conn = mysqli_connect(HOST, USERNAME, PASSWORD, DATABASE);

    //insert, update, delete
    mysqli_query($conn, $sql);

    //close connection
    mysqli_close($conn);
}

function executeResult($sql) {
    //save data into table
    //open connection to database
    $conn = mysqli_connect(HOST, USERNAME, PASSWORD, DATABASE);

    //select
    $result = mysqli_query($conn, $sql);
    $data = [];
    if($result != null){
        while($row = mysqli_fetch_array($result, 1)) {
            $data[] = $row;
        }
    }

    mysqli_close($conn);

    return $data;
}
function executeSingleResult($sql) {
	//save data into table
	// open connection to database
	$con = mysqli_connect(HOST, USERNAME, PASSWORD, DATABASE);
	//insert, update, delete
	$result = mysqli_query($con, $sql);
    if($result != null){
	$row    = mysqli_fetch_array($result, 1);
    mysqli_close($con);

	return $row;
    }
	//close connection
	
}