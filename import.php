<?php

//import.php

if(isset($_POST["client_email"]))
{
 $connect = new PDO("mysql:host=localhost;dbname=testing", "root", "");
 $client_email = $_POST["client_email"];
 $client_name = $_POST["client_name"];
 $client_acct = $_POST["client_acct"];
 for($count = 0; $count < count($client_email); $count++)
 {
  $query .= "
  INSERT INTO tbl_student(student_name, student_phone, student_email) 
  VALUES ('".$client_email[$count]."', '".$client_name[$count]."', '".$client_acct[$count]."');
  
  ";
 }
 $statement = $connect->prepare($query);
 $statement->execute();
}

?>