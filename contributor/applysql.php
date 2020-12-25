<?php

include("$_SERVER[DOCUMENT_ROOT]/config/config.php");

/* Attempt MySQL server connection. Assuming you are running MySQL
server with default setting (user 'root' with no password) */

// Check connection
if ($con === false) {
	die("ERROR: Could not connect. " . mysqli_connect_error());
}

// Escape user inputs for security
$nametext = mysqli_real_escape_string($con, $_REQUEST['name']);
$whytext = mysqli_real_escape_string($con, $_REQUEST['why']);
$whatcommunitytext = mysqli_real_escape_string($con, $_REQUEST['whatcommunity']);
$howmanytext = mysqli_real_escape_string($con, $_REQUEST['howmany']);
$linktext = mysqli_real_escape_string($con, $_REQUEST['link']);
$informationtext = mysqli_real_escape_string($con, $_REQUEST['information']);
$my_date = date("Y-m-d H:i:s");

// Attempt insert query execution
$sql = "INSERT INTO contributor (name, why, whatcommunity, howmany, link, information, timestamp) VALUES ('$nametext', '$whytext', '$whatcommunitytext', '$howmanytext', '$linktext', '$informationtext', '$my_date')";
if (mysqli_query($con, $sql)) {
	header('Location: /contributor/submitted');
} else {
	echo "ERROR: Could not able to execute $sql. " . mysqli_error($con);
}

// Close connection
mysqli_close($con);
