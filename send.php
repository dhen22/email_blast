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
        // $bodyArray[] = $data[1];
        // $t_name[] = $data[2];
        // $t_accnt[] = $data[3];
        // $t_prv[] = $data[4];
        // $t_duepay[] = $data[5];
        // $t_duedate[] = $data[6];
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
      // $array = $bodyArray[$i];
      // $accnt_name = $t_name[$i];
      // $accnt_num = $t_accnt[$i];
      // $accnt_prev = $t_prv[$i];
      // $accnt_pay = $t_duepay[$i];
      // $accnt_due = $t_duedate[$i];
      
      //HTML emails sa loob ni $Body
      // $message  = "<html><body>";
    
      // $message .= "<table width='100%' bgcolor='white' cellpadding='0' cellspacing='0' border='0'>";

      // $message .= "<tr><td>";

      // $message .= "<table align='center' width='100%' border='0' cellpadding='0' cellspacing='0' style='max-width:650px; background-color:#fff; font-family:Verdana, Geneva, sans-serif;'>";
  
      // $message .= "<tbody>
      //     <table role='presentation' style='width:100%;border-collapse:collapse;border:0;border-spacing:0;background:#ffffff;'>
      //       <tr>
      //         <td align='center' style='padding:0;'>
      //           <table role='presentation' style='width:602px;border-collapse:collapse;border:1px solid #cccccc;border-spacing:0;text-align:left;'>
      //             <tr>
      //               <br>
      //               <td align='center' style='padding:20px 0 20px;background:#ffffff;'>
      //                 <img src='https://ci5.googleusercontent.com/proxy/Xy3BTHSO78qpHn_JtxfG8bxhyFt7E95vmS_zGnQdV1qMaRE_07jhs8bcxk0w_9I_82V_4MCdzrj6mY-YlsC3pkKf08ch-gHue7tzwdLXAwMaV0bfYH2-LQzmmEHydB51Xyk3LJ_iLMh4c5WJLL9B2qanyg0bM-mQZTYSYyKCpwV8wpmAMLsO_PJHgFl1x3Cklrq_Ei01OpVj3N8=s0-d-e1-ft#https://juzzed.stripocdn.email/content/guids/CABINET_8d66c2e8936bb9227ea9a47e70c989a27d4d8bc38c351939ca3ac638455052cc/images/header.jpg' alt='' width='560' style='display:block;border:0px;outline:none' class='CToWUd a6T' data-bit='iit' tabindex='0'>
      //               </td>
      //             </tr>
      //             <tr>
      //               <td style='padding:36px 30px 30px 40px;'>
      //                 <table role='presentation' style='width:100%;border-collapse:collapse;border:0;border-spacing:0;'>
      //                   <tr>
      //                     <td style='padding:0 0 20px 0;color:#050505;'>
      //                       <h1 style='font-size:20px;margin:0 0 20px 0;font-family:Arial,sans-serif;text-align: center;'>Congratulations on having your own Asian Land Home!</h1>
      //                       <p style='font-size:16px; text-align: center;'>As it is our commitment to improve the lives of our dear homeowners, here are some tips to help you maintain your Asian Land Home that will be cherished by generations to come.</p>
      //                     </td>   
      //                   </tr>
      //                 </table>
      //                 <img src='https://ci4.googleusercontent.com/proxy/0dXFMSRVP1GJ7IgdNlF5jc4q6u7Vv3ccfCAIGqawyhn3C2vQYsiVh-QLSWagS9BM9FJX9Z0nhL08HPlfMhtgaQZ377PLmRVYrs-siJHXkQNle_ltg2ug667P8P_blBioHkTGdh2UCS3doUHyFgMWqi0mbarXkETmzyBDABg4aw9GTkoVQ65rC68dVT6iMkE5bePQrgIeonoV=s0-d-e1-ft#https://juzzed.stripocdn.email/content/guids/CABINET_8d66c2e8936bb9227ea9a47e70c989a27d4d8bc38c351939ca3ac638455052cc/images/tips.jpg' alt='' width='560' style='display:block;border:0px;outline:none' class='CToWUd a6T' data-bit='iit' tabindex='0'>
      //                 <p style='margin:0px;line-height:24px;color:rgb(51,51,51);font-size:16px; text-align: center;'>Apart from the physical maintenance of your home, make sure to update your real estate property tax every year.<br><br><br>For any concerns and inquiries, you may contact us through:<br>0917 523 7373 / (044) 791 2508 - 09<br>or email us at&nbsp;<a href='mailto:clientcare@asianland.ph' target='_blank'>clientcare@asianland.ph</a></p> 
                      
      //               </td>
      //             </tr>
      //             <tr>
      //               <td >
      //                 <table cellpadding='0' cellspacing='0' width='100%' style='border-collapse:collapse;border-spacing:0px'><tbody><tr><td align='center' valign='top' style='padding-bottom: 20px;width:560px'><table cellpadding='0' cellspacing='0' width='100%' role='presentation' style='border-collapse:collapse;border-spacing:0px'><tbody><tr><td align='center' style='padding:0px;font-size:0px'><table cellpadding='0' cellspacing='0' role='presentation' style='border-collapse:collapse;border-spacing:0px'><tbody><tr><td align='center' valign='top' style='padding:0px 10px 0px 0px'><a href='https://www.facebook.com/AsianLandPH' style='color:rgb(44,181,67);font-size:14px' target='_blank' data-saferedirecturl='https://www.google.com/url?q=https://www.facebook.com/AsianLandPH&amp;source=gmail&amp;ust=1680147226224000&amp;usg=AOvVaw1NEwjJoW_ERIuOiad_YZ3Q'><img src='https://ci3.googleusercontent.com/proxy/WcYYRkDfV6BLV6sIIG7y0T7-wYgqbXF8YsIeddQ4MRwX4XMXJNqgpw2svr4OS_J0MUc6XoHx8BaxhvgmYRD9osVDTdrwPnkIvjebdVU7KttVy23YnpSfZLFYZ4-qtZeI27XTj_GS6acQmI-k7Ue5Q_dBUZpyJH05EDltpg=s0-d-e1-ft#https://juzzed.stripocdn.email/content/assets/img/social-icons/circle-colored/facebook-circle-colored.png' alt='Fb' title='Facebook' width='32' style='display:block;border:0px;outline:none;text-decoration-line:none' class='CToWUd' data-bit='iit'></a></td><td align='center' valign='top' style='padding:0px 10px 0px 0px'><a href='https://www.instagram.com/asianlandph/' style='color:rgb(44,181,67);font-size:14px' target='_blank' data-saferedirecturl='https://www.google.com/url?q=https://www.instagram.com/asianlandph/&amp;source=gmail&amp;ust=1680147226224000&amp;usg=AOvVaw31fGeEHPMvm3M-_z7b2MMs'><img src='https://ci3.googleusercontent.com/proxy/DDVjk3toyDdoJ3IrYPPfh_QerlwcDwgVK75aZMFAXGeeTjnND4YInr3k8tmbyRa31AS7nFuZJrHAMjY0bJfMinWrFoSUAohn6suZFimxEI1z_8J60ToHECtJN7zVfvn4txx2oF3aYG4PbdSXvtDkVj5Lq0PJwlgwAlW7aso=s0-d-e1-ft#https://juzzed.stripocdn.email/content/assets/img/social-icons/circle-colored/instagram-circle-colored.png' alt='Ig' title='Instagram' width='32' style='display:block;border:0px;outline:none;text-decoration-line:none' class='CToWUd' data-bit='iit'></a></td><td align='center' valign='top' style='padding:0px'><a href='https://www.youtube.com/AsianLandPH/' style='color:rgb(44,181,67);font-size:14px' target='_blank' data-saferedirecturl='https://www.google.com/url?q=https://www.youtube.com/AsianLandPH/&amp;source=gmail&amp;ust=1680147226224000&amp;usg=AOvVaw14_WQqAg6VD3peXqFCZyoO'><img src='https://ci4.googleusercontent.com/proxy/aUMDd5FoIWVaxGFiGcAuxq2djsvsJtK5X21WikMlyJfCFqYCzpIbmoK8EtIu3Py93wpWAbzC1enKP_2rNSvOkWheoFbujANB4hjgltulv2fJzfORbmWkYd1PWbrFEJDm2ddJZdsPMRTRu2Mh6WnvaFljl54NRf5zxK3b=s0-d-e1-ft#https://juzzed.stripocdn.email/content/assets/img/social-icons/circle-colored/youtube-circle-colored.png' alt='Yt' title='Youtube' width='32' style='display:block;border:0px;outline:none;text-decoration-line:none' class='CToWUd' data-bit='iit'></a></td></tr></tbody></table></td></tr></tbody></table></td></tr></tbody></table>
                        
      //               </td>
      //             </tr>
      //           </table>
      //         </td>
      //       </tr>
      //     </table>
    
      // </tbody>";
  
      // $message .= "</table>";

      // $message .= "</td></tr>";
      // $message .= "</table>";

      // $message .= "</body></html>";
      //HTML email ends here
      
      /////Pwedeng gumawa ng email template eto lang gagamitin
      $mail->Body = file_get_contents('C:\xampp\htdocs\email_blast\NEWSLETTER_3.html');
      
      //Laman ni Messsage which is yung html
      //$mail->Body = $message;

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