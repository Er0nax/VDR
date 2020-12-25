<?php
include("$_SERVER[DOCUMENT_ROOT]/config/config.php");

$contriids = $con->query('SELECT * FROM contributor');


$idnr5 = $_SESSION["id"];
$query5 = "SELECT * FROM `users` WHERE id='$idnr5'";
$result5 = $con->query($query5);
$row5 = $result5->fetch_assoc();

$var5 = $row5["perms"];

echo $var5;

mysqli_close($con);
?>

<!DOCTYPE html>
<html lang="en">

<head>
	<title>Table V02</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<!--===============================================================================================-->
	<link rel="icon" type="/image/png" href="images/icons/favicon.ico" />
	<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="/vendor/bootstrap/css/bootstrap.min.css">
	<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="/fonts/font-awesome-4.7.0/css/font-awesome.min.css">
	<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="/vendor/animate/animate.css">
	<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="/vendor/select2/select2.min.css">
	<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="/vendor/perfect-scrollbar/perfect-scrollbar.css">
	<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="/css/util_show_contributor.css">
	<link rel="stylesheet" type="text/css" href="/css/main_show_contributor.css">
	<!--===============================================================================================-->
</head>

<body>

	<div class="limiter">
		<div class="container-table100">
			<div class="wrap-table100">
				<div class="table">

					<div class="row header">
						<div class="cell">
							Discord Name
						</div>
						<div class="cell">
							Why?
						</div>
						<div class="cell">
							What community?
						</div>
						<div class="cell">
							How many followers?
						</div>
						<div class="cell">
							Link
						</div>
						<div class="cell">
							Information
						</div>
					</div>

					<?php foreach ($contriids as $contriid) { ?>

						<div class="row">
							<div class="cell" data-title="Full Name">
								<?php echo $contriid['name']; ?>
							</div>
							<div class="cell" data-title="Age">
							<?php echo $contriid['why']; ?>
							</div>
							<div class="cell" data-title="Job Title">
							<?php echo $contriid['whatcommunity']; ?>
							</div>
							<div class="cell" data-title="Location">
							<?php echo $contriid['howmany']; ?>
							</div>
							<div class="cell" data-title="link">
							<?php echo $contriid['link']; ?>
							</div>
							<div class="cell" data-title="info">
							<?php echo $contriid['information']; ?>
							</div>
						</div>

					<?php } ?>

				</div>
			</div>
		</div>
	</div>




	<!--===============================================================================================-->
	<script src="/vendor/jquery/jquery-3.2.1.min.js"></script>
	<!--===============================================================================================-->
	<script src="/vendor/bootstrap/js/popper.js"></script>
	<script src="/vendor/bootstrap/js/bootstrap.min.js"></script>
	<!--===============================================================================================-->
	<script src="/vendor/select2/select2.min.js"></script>
	<!--===============================================================================================-->
	<script src="/js/main.js"></script>

</body>

</html>