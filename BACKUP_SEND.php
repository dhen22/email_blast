<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php';

//for csv file
//$emailArray = array_map('trim', file('recipients.csv'));
//$bodyArray = array_map('trim', file('Msg.csv'));

if (isset($_POST["send"])){
  $sender_name = $_POST["sender_name"];
  $sender = $_POST["sender"];
  $subject = $_POST["subject"];
  #$csv = file_get_contents($_FILES["csv_file"]["tmp_name"]);
  #$emailArray = explode(",",$csv);
  #print_r($emailArray);

  //filtering yung laman ni csv dito and turn into array
  if ($_FILES['csv_file']['size'] == 0);{
    header("Location: index.php?stat=0");
  }
  $row = 1;
  if (($handle = fopen($_FILES['csv_file']['tmp_name'], "r")) !== FALSE) {
    while (($data = fgetcsv($handle, 10000, "|")) !== FALSE) {
        $emailArray[] = $data[0];
        $bodyArray[] = $data[1];
        $t_name[] = $data[2];
        $t_accnt[] = $data[3];
        $t_prv[] = $data[4];
        $t_duepay[] = $data[5];
        $t_duedate[] = $data[6];
    }
  }

  //Create an instance; passing `true` enables exceptions
  $mail = new PHPMailer(true);

  try {
    //Server settings
    $mail->SMTPDebug  = 0;                                      //Enable verbose debug output
    $mail->isSMTP();                                            //Send using SMTP
    $mail->Host       = 'smtp-relay.sendinblue.com';            //Set the SMTP server to send through
    $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
    $mail->Username   = 'sese.edhenjoy@gmail.com';              //SMTP username
    $mail->Password   = 'WMRfAKd0cVXCJ27H';                     //SMTP password
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;         //Enable implicit TLS encryption
    $mail->Port       = 587;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

    //Recipients
    $mail->setFrom($sender, $sender_name);
    $totalEmails = count($emailArray);

    for($i=0; $i<$totalEmails; $i++){
      $Email = $emailArray[$i];
      //$mail->AddReplyTo("alscmalolos@gmail.com", $from);

      //to
      $to = $Email;
      $mail->AddAddress($to, "");

      //subject
      $mail->IsHTML(true);
      $mail->Subject = $subject;

      //body of message
      $array = $bodyArray[$i];
      $accnt_name = $t_name[$i];
      $accnt_num = $t_accnt[$i];
      $accnt_prev = $t_prv[$i];
      $accnt_pay = $t_duepay[$i];
      $accnt_due = $t_duedate[$i];
      
      //HTML emails sa loob ni $Body
      $message  = "<html><body>";
    
      $message .= "<table width='100%' bgcolor='white' cellpadding='0' cellspacing='0' border='0'>";

      $message .= "<tr><td>";

      $message .= "<table align='center' width='100%' border='0' cellpadding='0' cellspacing='0' style='max-width:650px; background-color:#fff; font-family:Verdana, Geneva, sans-serif;'>";
  
      $message .= "<tbody>
        <table role='presentation' style='width:100%;border-collapse:collapse;border:0;border-spacing:0;background:#ffffff;'>
          <tr>
            <align='center' style='padding:0;'>
            <table role='presentation' style='width:602px;border-collapse:collapse;border:1px solid #cccccc;border-spacing:0;text-align:left;'>
              <tr>
                <td align='center' style='padding:20px 0px 20px;background:#f1efef;'>
                  <img src='https://asianland.ph/wp-content/uploads/2018/12/al_logo-slogan.png' alt='' width='300' style='height:auto;display:block;'/>
                </td>
              </tr>
                <tr>
                  <td style='padding:36px 30px 30px 30px;'>
                    <table role='presentation' style='width:100%;border-collapse:collapse;border:0;border-spacing:0;'>
                      <tr>
                        <td style='padding:0 0 20px 0;color:#153643;'>
                        <h1 style='font-size:20px;margin:0 0 20px 0;font-family:Arial,sans-serif;'>Asianland Strategies Corporation</h1>
                        <p style='margin:0 0 12px 0;font-size:14px;line-height:24px;font-family:Arial,sans-serif;'>".$array.".</p>
                        </td>
                      </tr>
                    </table>

                    <table role='presentation' style='width:100%;border-collapse:collapse;border:0;border-spacing:0;'>
                      <tr>
                        <th style='padding:5px 0 20px;font-family:Arial,sans-serif;font-size:16px;'>Summary of monthly billing:</th>
                      </tr>
                      <tr>
                        <td style='padding:5px 0 5px;font-family:Arial,sans-serif;font-size:13px;'><strong>Account Name</strong></td><td style='padding-right:50px;font-family:Arial,sans-serif;font-size:14px;'><strong>".$accnt_name."</strong></td>
                      </tr>
                      <tr>
                        <td style='padding:5px 0 5px;font-family:Arial,sans-serif;font-size:13px;'><strong>Account Number</strong></td><td style='font-family:Arial,sans-serif;font-size:14px;'><strong>".$accnt_num."</strong></td>
                      </tr>
                      <tr>
                        <td style='padding:5px 0 5px;font-family:Arial,sans-serif;font-size:13px;'><strong>Previous Payment</strong></td><td style='font-family:Arial,sans-serif;font-size:14px;'><strong>".$accnt_prev."</strong></td>
                      </tr>
                      <tr>
                        <td style='padding:5px 0 5px;font-family:Arial,sans-serif;font-size:13px;'><strong>Due Payment</strong></td><td style='font-family:Arial,sans-serif;font-size:14px;'><strong>".$accnt_pay."</strong></td>
                      </tr>
                      <tr>
                        <td style='padding:5px 0 5px;font-family:Arial,sans-serif;font-size:13px;'><strong>Due Date</strong></td><td style='font-family:Arial,sans-serif;font-size:14px;'><strong>".$accnt_due."</strong></td>
                      </tr>
                    </table>
                  </td>
                </tr>
              <tr>
                <td style='padding:30px;background:#133d92;'>
                  <table role='presentation' style='width:100%;border-collapse:collapse;border:0;border-spacing:0;font-size:9px;font-family:Arial,sans-serif;'>
                    <tr>
                      <td style='padding:0;width:50%;' align='left'>
                        <p style='margin:0;font-size:12px;line-height:16px;font-family:Arial,sans-serif;color:#ffffff;'>
                          &reg; 2022 ASIAN LAND CORPORATE CENTER <br> Grand Royale Subdivision, Bulihan, Malolos City, Bulacan, Philippines <br/>
                        </p>
                      </td>
                      <td style='padding:0;width:50%;' align='right'>
                        <table role='presentation' style='border-collapse:collapse;border:0;border-spacing:0;'>
                          <tr>
                            <td style='padding:0 0 0 10px;width:38px;'>
                              <a href='https://twitter.com/asianlandph?lang=en' style='color:#ffffff;'><img src='https://assets.codepen.io/210284/tw_1.png' alt='Twitter' width='50' style='height:auto;display:block;border:0;' /></a>
                            </td>
                            <td style='padding:0 0 0 10px;width:38px;'>
                              <a href='https://www.facebook.com/asianlandbulacanph/' style='color:#ffffff;'><img src='https://assets.codepen.io/210284/fb_1.png' alt='Facebook' width='50' style='height:auto;display:block;border:0;' /></a>
                            </td>
                          </tr>
                        </table>
                      </td>
                    </tr>
                  </table>
                </td>
              </tr>
            </table>
          </tr>
        </table>
    
      </tbody>";
  
      $message .= "</table>";

      $message .= "</td></tr>";
      $message .= "</table>";

      $message .= "</body></html>";
      //HTML email ends here
      
      /////Pwedeng gumawa ng email template eto lang gagamitin
      #$mail->Body = file_get_contents('C:\xampp\htdocs\Email_php\template.html');
      
      //Laman ni Messsage which is yung html
      $mail->Body = $message;

      //dito naman yung array attachment which is attachments per clients.
      #$mail->AddAttachment( $_FILES["attachment"]["tmp_name"][$i], $_FILES["attachment"]["name"][$i] );

      //you can also send an instance attachment yung hindi per clients.
      #foreach ($_FILES["attachment"]["name"] as $k => $v) {
        #$mail->AddAttachment( $_FILES["attachment"]["tmp_name"][$k], $_FILES["attachment"]["name"][$k] );
      #}

      $mail->Send();
      $mail->ClearAddresses();
      #$mail->clearAttachments();

      header("Location: index.php?status=1");
    }

  } catch (Exception $e) {
    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
  }
}