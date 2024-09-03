<?php 

// you can use reffered to your db settings. 
$con = mysqli_connect("localhost", 'root', '', 'project'); 

if (mysqli_connect_errno()) {
	echo "connection failed :(" . mysqli_connect_errno();
}
