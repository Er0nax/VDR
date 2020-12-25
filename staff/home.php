<?php

include("$_SERVER[DOCUMENT_ROOT]/config/config.php");

// We need to use sessions, so you should always start sessions using the below code.
session_start();
// If the user is not logged in redirect to the login page...
if (!isset($_SESSION['loggedin'])) {
  header('Location: /');
  exit;
}

// show the 3 latest news 

$sql = "SELECT * FROM news ORDER BY timestamp desc limit 3 ";
$result = $con->query($sql);
$sqlall = "SELECT * FROM news ORDER BY timestamp desc";
$resultall = $con->query($sqlall);


if ($result->num_rows > 0) {

  // Output data of each row 
  $idarray = array();
  while ($row = $result->fetch_assoc()) {

    // Create an array to store the 
    // id of the blogs         
    array_push($idarray, $row['id']);
  }
} else {
}

// take the user information

$idnr = $_SESSION["id"];
$query3 = "SELECT * FROM `users` WHERE id='$idnr'";
$result3 = $con->query($query3);
$row3 = $result3->fetch_assoc();

// Take the users role

$role = $row3["role"];
$query2 = "SELECT * FROM `roles` WHERE id='$role'";
$result2 = $con->query($query2);
$row2 = $result2->fetch_assoc();

// Looking for Tasks

$sql1 = "SELECT * FROM tasks WHERE role_id='$role' ORDER BY timestamp desc limit 5";
$result1 = $con->query($sql1);
$sqlall1 = "SELECT * FROM tasks WHERE role_id='$role' ORDER BY timestamp desc";
$resultall1 = $con->query($sqlall1);


if ($result1->num_rows > 0) {

  // Output data of each row 
  $idarray1 = array();
  while ($row1 = $result1->fetch_assoc()) {

    // Create an array to store the 
    // id of the blogs         
    array_push($idarray1, $row1['id']);
  }
} else {
}

$idnr5 = $_SESSION["id"];
$query5 = "SELECT * FROM `users` WHERE id='$idnr5'";
$result5 = $con->query($query5);
$row5 = $result5->fetch_assoc();

$var5 = $row5["perms"];

?>

<!DOCTYPE html>
<html style="font-size: 16px;" lang="de-DE">

<head>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta charset="utf-8">
  <meta name="keywords" content="">
  <meta name="description" content="">
  <meta name="page_type" content="np-template-header-footer-from-plugin">
  <title>VDR | <?php echo htmlspecialchars($row3["username"]); ?></title>
  <link rel="stylesheet" href="/css/nicepage_staff.css" media="screen">
  <link rel="stylesheet" href="/css/main_staff.css" media="screen">
  <script class="u-script" type="text/javascript" src="jquery.js" defer=""></script>
  <script class="u-script" type="text/javascript" src="nicepage.js" defer=""></script>
  <meta name="generator" content="Nicepage 3.1.3, nicepage.com">
  <link rel="icon" href="images/favicon.png">
  <link id="u-theme-google-font" rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:100,100i,300,300i,400,400i,500,500i,700,700i,900,900i|Open+Sans:300,300i,400,400i,600,600i,700,700i,800,800i">
  <link id="u-page-google-font" rel="stylesheet" href="https://fonts.googleapis.com/css?family=Raleway:100,100i,200,200i,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900,900i">


  <script type="application/ld+json">
    {
      "@context": "http://schema.org",
      "@type": "Organization",
      "name": "vanderroling",
      "url": "/"
    }
  </script>
  <meta property="og:title" content="vdr-staff">
  <meta property="og:type" content="website">
  <meta name="theme-color" content="#478ac9">
  <link rel="canonical" href="/">
  <meta property="og:url" content="/">
</head>

<body data-home-page="vdr-staff" data-home-page-title="vdr-staff" class="u-body">
  <section class="u-clearfix u-custom-color-3 u-section-1" id="sec-a684">
    <div class="u-clearfix u-sheet u-sheet-1">
      <a href="/logout" class="u-btn u-button-style u-custom-font u-font-raleway u-none u-text-grey-10 u-text-hover-palette-2-base u-btn-1">Logout</a>
      <a href="" class="u-btn u-button-style u-custom-font u-font-raleway u-none u-text-grey-10 u-text-hover-palette-1-base u-btn-2"><?php echo htmlspecialchars($row3["username"]); ?></a>
      <div class="u-container-style u-custom-color-2 u-group u-radius-10 u-shape-round u-group-1">
        <div class="u-container-layout u-container-layout-1">
          <h1 class="u-custom-font u-font-raleway u-text u-text-default u-title u-text-1">Latest News​:</h1>

          <?php for ($x = 0; $x < 3; $x++) {
            if (isset($x)) {
              $query = mysqli_query(
                $con,
                "SELECT * FROM `news` WHERE id = '$idarray[$x]'"
              );

              $res = mysqli_fetch_array($query);
              $blog_text = $res['text'];
              $blog_title = $res['title'];
          ?>

              <div class="u-border-2 u-border-palette-1-dark-2 u-expanded-width u-line u-line-horizontal u-line-1"></div>
              <p class="u-custom-font u-font-raleway u-text u-text-default u-text-2"><b><?php echo $blog_title; ?></b></p>
              <div class="u-border-1 u-border-grey-dark-1 u-expanded-width u-line u-line-horizontal u-line-2"></div>
              <p class="u-custom-font u-font-raleway u-text u-text-default u-text-3"><?php echo $blog_text; ?> </p>

          <?php }
          } ?>

        </div>
      </div>
      <div class="u-container-style u-custom-color-2 u-group u-radius-10 u-shape-round u-group-2">
        <div class="u-container-layout u-container-layout-2">
          <h1 style="color:<?php echo htmlspecialchars($row2["color"]); ?>" class="u-custom-font u-font-raleway u-text u-text-default u-title u-text-4"><?php echo htmlspecialchars($row2["role"]); ?></h1>
          <div class="u-border-2 u-border-palette-1-dark-2 u-expanded-width u-line u-line-horizontal u-line-3"></div>

          <?php
          if ($result1->num_rows > 0) {
            for ($x1 = 0; $x1 < 1; $x1++) {
              if (isset($x1)) {
                $query1 = mysqli_query(
                  $con,
                  "SELECT * FROM `tasks` WHERE id = '$idarray1[$x1]'"
                );

                $res1 = mysqli_fetch_array($query1);
                $task = $res1['task'];


          ?>

                <h6 class="u-custom-font u-font-raleway u-text u-text-default u-text-5"><?php echo $task; ?><br></h6>

          <?php }
            }
          } ?>

          <?php
          if ($result1->num_rows > 1) {
            for ($x1 = 1; $x1 < 2; $x1++) {
              if (isset($x1)) {
                $query1 = mysqli_query(
                  $con,
                  "SELECT * FROM `tasks` WHERE id = '$idarray1[$x1]'"
                );

                $res1 = mysqli_fetch_array($query1);
                $task = $res1['task'];


          ?>

                <h6 class="u-custom-font u-font-raleway u-text u-text-default u-text-5"><?php echo $task; ?><br></h6>

          <?php }
            }
          } ?>

          <?php
          if ($result1->num_rows > 2) {
            for ($x1 = 2; $x1 < 3; $x1++) {
              if (isset($x1)) {
                $query1 = mysqli_query(
                  $con,
                  "SELECT * FROM `tasks` WHERE id = '$idarray1[$x1]'"
                );

                $res1 = mysqli_fetch_array($query1);
                $task = $res1['task'];


          ?>

                <h6 class="u-custom-font u-font-raleway u-text u-text-default u-text-5"><?php echo $task; ?><br></h6>

          <?php }
            }
          } ?>

          <?php
          if ($result1->num_rows > 3) {
            for ($x1 = 3; $x1 < 4; $x1++) {
              if (isset($x1)) {
                $query1 = mysqli_query(
                  $con,
                  "SELECT * FROM `tasks` WHERE id = '$idarray1[$x1]'"
                );

                $res1 = mysqli_fetch_array($query1);
                $task = $res1['task'];


          ?>

                <h6 class="u-custom-font u-font-raleway u-text u-text-default u-text-5"><?php echo $task; ?><br></h6>

          <?php }
            }
          } ?>

          <?php
          if ($result1->num_rows > 4) {
            for ($x1 = 4; $x1 < 5; $x1++) {
              if (isset($x1)) {
                $query1 = mysqli_query(
                  $con,
                  "SELECT * FROM `tasks` WHERE id = '$idarray1[$x1]'"
                );

                $res1 = mysqli_fetch_array($query1);
                $task = $res1['task'];


          ?>

                <h6 class="u-custom-font u-font-raleway u-text u-text-default u-text-5"><?php echo $task; ?><br></h6>

          <?php }
            }
          } ?>

          </h6>
        </div>
      </div>
      <?php
      if ($var5 == 1) {
      ?>

        <footer>
          <div style="text-align: center;">
            <a href="/generate_token" style="margin-right: 5px;margin-left: 5px;">Generate Token</a>
            <a href="" style="margin-right: 5px;margin-left: 5px;">|</a>
            <a href="/insert-news" style="margin-right: 5px;margin-left: 5px;">Add News</a>
            <a href="" style="margin-right: 5px;margin-left: 5px;">|</a>
            <a href="/insert-task" style="margin-right: 5px;margin-left: 5px;">Add Task</a>
            <a href="" style="margin-right: 5px;margin-left: 5px;">|</a>
            <a href="/register" style="margin-right: 5px;margin-left: 5px;">Register</a>
            <a href="" style="margin-right: 5px;margin-left: 5px;">|</a>
            <a href="/tokens" style="margin-right: 5px;margin-left: 5px;">Tokens</a>
          </div>
        </footer>

      <?php
      }
      ?>
    </div>
  </section>
</body>



</html>