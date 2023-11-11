<?php


?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Email Sender</title>
  <!-- Bootstrap -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-dark">
  <div class="container py-5">
    <div class="row">
      <div class="col-md-8 mx-auto bg-white border p-5">
        <h2 class="text-center fw-bold text-dark mb-3 bg-white">EMAIL BLAST</h2>

        <!-- function Connection/alert from send.php -->
        <?php if (isset($_GET["status"]) && $_GET["status"] == "1") { ?>
          <div class='alert alert-success'>Email sent successfully.</div>
        <?php } ?>

        <?php if (isset($_GET["stat"]) && $_GET["stat"] == "0") { ?>
          <div class='alert alert-danger'>Empty or Wrong File Uploaded.</div>
        <?php } ?>
        

        <!-- Mga label ng HTML -->
        <form action="send.php" method="post" enctype="multipart/form-data">
          <div class="row">
            <div class="col-6 mb-3">
              <label for="sender_name" class="form-label">Sender Name</label>
              <input type="text" class="form-control" id="sender_name" name="sender_name" placeholder="name" autocomplete = "on" required>
            </div>
            <div class="col-6 mb-3">
              <label for="sender" class="form-label">Sender Email</label>
              <input type="email" class="form-control" id="sender" name="sender" placeholder="name@example.com" autocomplete = "on" required>
            </div>
            <div class="col-6 mb-3">
              <label for="subject" class="form-label">Subject</label>
              <input type="text" class="form-control" autocomplete="on" id="subject" name="subject" placeholder="subject" autocomplete = "on" required>
            </div>

            <!--Uploaded CSV naman to-->
            <div class="col-6 mb-3">
              <label for="csv_1" class="form-label" >CSV File</label>
              <input type="file" class="form-control" id="csv_file" name="csv_file" accept=".csv">
            </div>


            <!--Buttons po dito-->
            <!--<div class="col-6 mb-3">
              <label class="form-label" >Attachment File</label>
              <input type="file" class="form-control" id="csv_file" name="attachment[]" multiple>
            </div>-->

            <!--Uploaded attachments naman dito-->
            <div class="col-6 mb-3">
              <button class="btn btn-primary" style="margin-top:32px" name="send" type="submit">Send Email</button>
              <?php 
              $page = $_SERVER['PHP_SELF'];
              print "<a class='btn btn-danger' style='margin-left:10px; margin-top:32px;' href=\"$page\">Reload form</a>";
              ?>
            </div>
          </div>

          
        </form>
      </div>  
    </div>
  </div>
</body>
  <!-- Bootstrap Js -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js"></script>
