<?php

//fetch.php

if(!empty($_FILES['csv_file']['name']))
{
 $file_data = fopen($_FILES['csv_file']['tmp_name'], 'r');
 $column = fgetcsv($file_data);
 while(($row = fgetcsv($file_data, 10000, "|")) !== FALSE)
 {
  $row_data[] = array(
   'client_email'  => $row[0],
   'client_name'  => $row[2],
   'client_acct' => $row[3]
  );
 }
 $output = array(
  'column'  => $column,
  'row_data'  => $row_data
 );

 echo json_encode($output);

}

?>