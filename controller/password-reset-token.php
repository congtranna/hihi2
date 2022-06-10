<?php 
date_default_timezone_set('Asia/Ho_Chi_Minh');
require_once 'class/database.php';
require_once 'class/maildb.php';
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;
require 'Exception.php';
require 'PHPMailer.php';
require 'SMTP.php';
$classconnection = new connection();
$conn = $classconnection->connect();
$status = "";
$status2 = "";
if(isset($_GET['email']))
{
  $email = $_GET['email'];
  $select=mysqli_query($conn,"SELECT Email,Password FROM users WHERE Email='$email'");
  if(mysqli_num_rows($select)==1)
  {
//    while($row=mysqli_fetch_array($select))
//    {
//      $email=md5($row['email']);
//      $pass=md5($row['password']);
//    }
 	$token = md5($email).rand(10,9999);
 	$expFormat = mktime(date("H"), date("i")+5, date("s"), date("m") ,date("d"), date("Y"));
    $expDate = date("Y-m-d H:i:s",$expFormat);
	$update = mysqli_query($conn,"UPDATE users set token='".$token."' ,exp_date='".$expDate."' WHERE Email='".$email."'");
    //$link = "<a href='localhost/mineinus/reset-password.php?key=".$email."&token=".$token."'>Click This</a>";
	$link = "localhost/ecomerce/reset-password.php?key=".$email."&token=".$token."";
    $mail = new PHPMailer();
    $mail->CharSet =  "utf-8";                      //Enable verbose debug output
    $mail->isSMTP();                                            //Send using SMTP
    $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
    $mail->SMTPAuth   = "true";    					  //Enable SMTP authentication
    $mail->Username   = "$emailhost";                     //SMTP username mineinusmc@gmail.com
    $mail->Password   = "$passwordhost";                               //SMTP password ynmizdlevrjintbc
    $mail->SMTPSecure = "ssl";            //tls Enable implicit TLS encryption
    $mail->Port       = "465";                                    //587 TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

    //Recipients
    //$mail->setFrom('kahn12345678@gmail.com', 'Mailer');
	$mail->setFrom("$emailhost", "E-Commerce");
    //$mail->addAddress('kahn12345678@gmail.com', 'Joe User');     //Add a recipient
    $mail->addAddress("$email");               //Name is optional
    //$mail->addReplyTo('info@example.com', 'Information');
    //$mail->addCC('cc@example.com');
    //$mail->addBCC('bcc@example.com');

    //Attachments
    //$mail->addAttachment('/var/tmp/file.tar.gz');         //Add attachments
    //$mail->addAttachment('/tmp/image.jpg', 'new.jpg');    //Optional name

    //Content
    $mail->isHTML(true);                                  //Set email format to HTML
    $mail->Subject = 'Email thay đổi password!';
    $mail->Body    = "<body class='st-Email' bgcolor='767676' style='border: 0; margin: 0; padding: 0; -webkit-text-size-adjust: 100%; -ms-text-size-adjust: 100%; min-width: 100%; width: 100%;' override='fix'>
    <table class='st-Background' bgcolor='767676' border='0' cellpadding='0' cellspacing='0' width='100%' style='border: 0; margin: 0; padding: 0;height: 100%'>
      <tbody>
        <tr>
          <td style='border: 0; margin: 0; padding: 0;height: 100%'>
            <table class='st-Wrapper' align='center' bgcolor='ffffff' border='0' cellpadding='0' cellspacing='0' width='600' style='border-bottom-left-radius: 5px; border-bottom-right-radius: 5px; margin: 0 auto; min-width: 600px;height: 100%'>
              <tbody style='height: 100%'>
                <tr>
                  <td style='border: 0; margin: 0; padding: 0;'>
                    <table class='st-Header st-Header--simplified st-Width st-Width--mobile' border='0' cellpadding='0' cellspacing='0' width='600' style='min-width: 600px;'>
                      <tbody>
                        <tr>
                          <td class='st-Spacer st-Spacer--divider' colspan='4' height='19' style='border: 0; margin: 0; padding: 0; font-size: 1px; line-height: 1px; mso-line-height-rule: exactly;'>
                            <div class='st-Spacer st-Spacer--filler'> </div>
                          </td>
                        </tr>
                        <tr>
                          <td class='st-Spacer st-Spacer--gutter' style='border: 0; margin: 0; padding: 0; font-size: 1px; line-height: 1px; mso-line-height-rule: exactly;' width='64'>
                            <div class='st-Spacer st-Spacer--filler'> </div>
                          </td>
                          <td class='st-Header-logo' align='left' height='21' width='49' style='border: 0; margin: 0; padding: 0;'>
                            <div class='st-Header-area st-Target st-Target--mobile' style='background-color: #6772e5;'>         </div>
                          </td>
                          <td class='st-Header-spacing' width='423' style='border: 0; margin: 0; padding: 0;'>
                            <div class='st-Spacer st-Spacer--filler'> </div>
                          </td>
                          <td class='st-Spacer st-Spacer--gutter' style='border: 0; margin: 0; padding: 0; font-size: 1px; line-height: 1px; mso-line-height-rule: exactly;' width='64'>
                            <div class='st-Spacer st-Spacer--filler'> </div>
                          </td>
                        </tr>
                        <tr>
                          <td class='st-Spacer st-Spacer--divider' colspan='4' height='19' style='border: 0; margin: 0; padding: 0; font-size: 1px; line-height: 1px; mso-line-height-rule: exactly;'>
                            <div class='st-Spacer st-Spacer--filler'> </div>
                          </td>
                        </tr>
                        <tr class='st-Divider'>
                          <td class='st-Spacer st-Spacer--gutter' style='border: 0; margin: 0; padding: 0; font-size: 1px; line-height: 1px; max-height: 1px; mso-line-height-rule: exactly;' width='64'>
                            <div class='st-Spacer st-Spacer--filler'> </div>
                          </td>
                          <td bgcolor='#e6ebf1' colspan='2' height='1' style='border: 0; margin: 0; padding: 0; font-size: 1px; line-height: 1px; max-height: 1px; mso-line-height-rule: exactly;'>
                            <div class='st-Spacer st-Spacer--filler'> </div>
                          </td>
                          <td class='st-Spacer st-Spacer--gutter' style='border: 0; margin: 0; padding: 0; font-size: 1px; line-height: 1px; max-height: 1px; mso-line-height-rule: exactly;' width='64'>
                            <div class='st-Spacer st-Spacer--filler'> </div>
                          </td>
                        </tr>
                        <tr>
                          <td class='st-Spacer st-Spacer--divider' colspan='4' height='32' style='border: 0; margin: 0; padding: 0; font-size: 1px; line-height: 1px; max-height: 1px; mso-line-height-rule: exactly;'>
                            <div class='st-Spacer st-Spacer--filler'> </div>
                          </td>
                        </tr>
                      </tbody>
                    </table>
                    <table class='st-Preheader st-Width st-Width--mobile' border='0' cellpadding='0' cellspacing='0' width='600' style='min-width: 600px;'>
                      <tbody>
                        <tr>
                          <td align='center' height='0' style='border: 0; margin: 0; padding: 0; color: #ffffff; display: none !important; font-size: 1px; line-height: 1px; max-height: 0; max-width: 0; mso-hide: all !important; opacity: 0; overflow: hidden; visibility: hidden;'>
                            <span class='st-Delink st-Delink--preheader' style='color: #ffffff; text-decoration: none;'>
    Chúng tôi nhận được yêu cầu thay đổi mật khẩu tại E-Commerce.

          ‌ ‌ ‌ ‌ ‌ ‌ ‌ ‌ ‌ ‌ ‌ ‌ ‌ ‌ ‌ ‌ ‌ ‌ ‌ ‌ ‌ ‌ ‌ ‌ ‌ ‌ ‌ ‌ ‌ ‌ ‌ ‌ ‌ ‌ ‌ ‌ ‌ ‌ ‌ ‌ ‌ ‌ ‌ ‌ ‌ ‌ ‌ ‌ ‌ ‌ ‌ ‌ ‌ ‌ ‌ ‌ ‌ ‌ ‌ ‌ ‌ ‌ ‌ ‌ ‌ ‌ ‌ ‌ ‌ ‌ ‌ ‌ ‌ ‌ ‌ ‌ ‌ ‌ ‌ ‌ ‌ ‌ ‌ ‌ ‌ ‌ ‌ ‌ ‌ ‌ ‌ ‌ ‌ ‌ ‌ ‌ ‌ ‌ ‌ ‌ ‌ ‌ ‌ ‌ ‌ ‌ ‌ ‌ ‌ ‌ ‌ ‌ ‌ ‌ ‌ ‌ ‌ ‌ ‌ ‌ ‌ ‌ ‌ ‌ ‌ ‌ ‌ ‌ ‌ ‌ ‌ ‌ ‌ ‌ ‌ ‌ ‌ ‌ ‌ ‌ ‌ ‌ ‌ ‌ ‌ ‌ ‌ ‌ ‌ ‌ ‌ ‌ ‌ ‌ ‌ ‌ ‌ ‌ ‌ ‌ ‌ ‌ ‌ ‌ ‌ ‌ ‌ ‌ ‌ ‌ ‌ ‌ ‌ ‌ ‌ ‌ ‌ ‌ ‌ ‌ ‌ ‌ ‌ ‌ ‌ ‌ ‌ ‌ ‌ ‌ ‌ ‌ ‌ ‌ ‌ ‌ ‌ ‌ ‌ ‌ ‌ ‌ ‌ ‌ ‌ ‌ ‌ ‌ ‌ ‌ ‌ ‌ ‌ ‌ ‌ ‌ ‌ ‌ ‌ ‌ ‌ ‌ ‌ ‌ ‌ ‌ ‌ ‌ ‌ ‌ ‌ ‌ ‌ ‌ ‌ ‌ ‌ ‌ ‌ ‌ ‌ ‌ ‌ ‌ ‌ ‌ ‌ ‌ ‌ ‌ ‌ ‌ ‌ ‌ ‌ ‌ ‌ ‌ ‌ ‌ ‌ ‌ ‌ ‌ ‌ ‌ ‌ ‌ ‌ ‌ ‌ ‌ ‌ ‌ ‌ ‌ ‌ ‌ ‌ ‌ ‌ ‌ ‌ ‌ ‌ ‌ ‌ ‌ ‌ ‌ ‌ ‌ ‌ ‌ ‌ ‌ ‌ ‌ ‌ ‌ ‌ ‌ ‌ ‌ ‌ ‌ ‌ ‌ ‌ ‌ ‌ ‌ ‌ ‌ ‌ ‌ ‌ ‌ ‌ ‌ ‌ ‌ ‌ ‌

          
        </span>
                          </td>
                        </tr>
                      </tbody>
                    </table>
                    <table class='st-Copy st-Width st-Width--mobile' border='0' cellpadding='0' cellspacing='0' width='600' style='min-width: 600px;'>
                      <tbody>
                        <tr>
                          <td class='st-Spacer st-Spacer--gutter' style='border: 0; margin: 0; padding: 0; font-size: 1px; line-height: 1px; mso-line-height-rule: exactly;' width='64'>
                            <div class='st-Spacer st-Spacer--filler'> </div>
                          </td>
                          <td class='st-Font st-Font--body' style='border: 0; margin: 0; padding: 0; color: #525F7f !important; font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, 'Helvetica Neue', Ubuntu, sans-serif; font-size: 16px; line-height: 24px;'>
                            Xin chào,
                          </td>
                          <td class='st-Spacer st-Spacer--gutter' style='border: 0; margin: 0; padding: 0; font-size: 1px; line-height: 1px; mso-line-height-rule: exactly;' width='64'>
                            <div class='st-Spacer st-Spacer--filler'> </div>
                          </td>
                        </tr>
                        <tr>
                          <td class='st-Spacer st-Spacer--stacked' colspan='3' height='12' style='border: 0; margin: 0; padding: 0; font-size: 1px; line-height: 1px; mso-line-height-rule: exactly;'>
                            <div class='st-Spacer st-Spacer--filler'> </div>
                          </td>
                        </tr>
                      </tbody>
                    </table>
                    <table class='st-Copy st-Width st-Width--mobile' border='0' cellpadding='0' cellspacing='0' width='600' style='min-width: 600px;'>
                      <tbody>
                        <tr>
                          <td class='st-Spacer st-Spacer--gutter' style='border: 0; margin: 0; padding: 0; font-size: 1px; line-height: 1px; mso-line-height-rule: exactly;' width='64'>
                            <div class='st-Spacer st-Spacer--filler'> </div>
                          </td>
                          <td class='st-Font st-Font--body' style='border: 0; margin: 0; padding: 0; color: #525F7f !important; font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, 'Helvetica Neue', Ubuntu, sans-serif; font-size: 16px; line-height: 24px;'>
                            Chúng tôi nhận được yêu cầu thay đổi mật khẩu tại E-Commerce.
                          </td>
                          <td class='st-Spacer st-Spacer--gutter' style='border: 0; margin: 0; padding: 0; font-size: 1px; line-height: 1px; mso-line-height-rule: exactly;' width='64'>
                            <div class='st-Spacer st-Spacer--filler'> </div>
                          </td>
                        </tr>
                        <tr>
                          <td class='st-Spacer st-Spacer--stacked' colspan='3' height='12' style='border: 0; margin: 0; padding: 0; font-size: 1px; line-height: 1px; mso-line-height-rule: exactly;'>
                            <div class='st-Spacer st-Spacer--filler'> </div>
                          </td>
                        </tr>
                      </tbody>
                    </table>
                    <table class='st-Copy st-Width st-Width--mobile' border='0' cellpadding='0' cellspacing='0' width='600' style='min-width: 600px;'>
                      <tbody>
                        <tr>
                          <td class='st-Spacer st-Spacer--gutter' style='border: 0; margin: 0; padding: 0; font-size: 1px; line-height: 1px; mso-line-height-rule: exactly;' width='64'>
                            <div class='st-Spacer st-Spacer--filler'> </div>
                          </td>
                          <td class='st-Font st-Font--body' style='border: 0; margin: 0; padding: 0; color: #525F7f !important; font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, 'Helvetica Neue', Ubuntu, sans-serif; font-size: 16px; line-height: 24px;'>
                            Bạn có thể reset mật khẩu bằng cách nhấn vào link bên dưới:
                          </td>
                          <td class='st-Spacer st-Spacer--gutter' style='border: 0; margin: 0; padding: 0; font-size: 1px; line-height: 1px; mso-line-height-rule: exactly;' width='64'>
                            <div class='st-Spacer st-Spacer--filler'> </div>
                          </td>
                        </tr>
                        <tr>
                          <td class='st-Spacer st-Spacer--stacked' colspan='3' height='12' style='border: 0; margin: 0; padding: 0; font-size: 1px; line-height: 1px; mso-line-height-rule: exactly;'>
                            <div class='st-Spacer st-Spacer--filler'> </div>
                          </td>
                        </tr>
                      </tbody>
                    </table>
                    <table class='st-Copy st-Width st-Width--mobile' border='0' cellpadding='0' cellspacing='0' width='600' style='min-width: 600px;'>
                      <tbody>
                        <tr>
                          <td class='st-Spacer st-Spacer--gutter' style='border: 0; margin: 0; padding: 0; font-size: 1px; line-height: 1px; mso-line-height-rule: exactly;' width='64'>
                            <div class='st-Spacer st-Spacer--filler'> </div>
                          </td>
                          <td class='st-Font st-Font--body' style='border: 0; margin: 0; padding: 0; color: #525F7f; font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, 'Helvetica Neue', Ubuntu, sans-serif; font-size: 16px; line-height: 24px;'>
                            <table class='st-Button st-Button--fullWidth' border='0' cellpadding='0' cellspacing='0' width='100%'>
                              <tbody>
                                <tr>
                                  <td align='center' class='st-Button-area' height='38' valign='middle' style='border: 0; margin: 0; padding: 0; background-color: #666ee8; border-radius: 5px; text-align: center;'>
                                    <a class='st-Button-link' style='border: 0; margin: 0; padding: 0; color: #ffffff; display: block; height: 38px; text-align: center; text-decoration: none;' href='".$link."'>
                                      <span class='st-Button-internal' style='border: 0; margin: 0; padding: 0; color: #ffffff; font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, 'Helvetica Neue', Ubuntu, sans-serif; font-size: 16px; font-weight: bold; height: 38px; line-height: 38px; mso-line-height-rule: exactly; text-decoration: none; vertical-align: middle; white-space: nowrap; width: 100%;'>     Reset<span style='border: 0; margin: 0; padding: 0; color: #666ee8; font-size: 12px; text-decoration: none;'>‑</span>your<span style='border: 0; margin: 0; padding: 0; color: #666ee8; font-size: 12px; text-decoration: none;'>‑</span>password </span>
                                    </a>
                                  </td>
                                </tr>
                              </tbody>
                            </table>
                          </td>
                          <td class='st-Spacer st-Spacer--gutter' style='border: 0; margin: 0; padding: 0; font-size: 1px; line-height: 1px; mso-line-height-rule: exactly;' width='64'>
                            <div class='st-Spacer st-Spacer--filler'> </div>
                          </td>
                        </tr>
                        <tr>
                          <td class='st-Spacer st-Spacer--stacked' colspan='3' height='12' style='border: 0; margin: 0; padding: 0; font-size: 1px; line-height: 1px; mso-line-height-rule: exactly;'>
                            <div class='st-Spacer st-Spacer--filler'> </div>
                          </td>
                        </tr>
                      </tbody>
                    </table>
                    <table class='st-Copy st-Width st-Width--mobile' border='0' cellpadding='0' cellspacing='0' width='600' style='min-width: 600px;'>
                      <tbody>
                        <tr>
                          <td class='st-Spacer st-Spacer--gutter' style='border: 0; margin: 0; padding: 0; font-size: 1px; line-height: 1px; mso-line-height-rule: exactly;' width='64'>
                            <div class='st-Spacer st-Spacer--filler'> </div>
                          </td>
                          <td class='st-Font st-Font--body' style='border: 0; margin: 0; padding: 0; color: #525F7f !important; font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, 'Helvetica Neue', Ubuntu, sans-serif; font-size: 16px; line-height: 24px;'>
                            Nếu bạn không yêu cầu thay đổi mật khẩu, hãy bỏ qua email này.
                          </td>
                          <td class='st-Spacer st-Spacer--gutter' style='border: 0; margin: 0; padding: 0; font-size: 1px; line-height: 1px; mso-line-height-rule: exactly;' width='64'>
                            <div class='st-Spacer st-Spacer--filler'> </div>
                          </td>
                        </tr>
                        <tr>
                          <td class='st-Spacer st-Spacer--stacked' colspan='3' height='12' style='border: 0; margin: 0; padding: 0; font-size: 1px; line-height: 1px; mso-line-height-rule: exactly;'>
                            <div class='st-Spacer st-Spacer--filler'> </div>
                          </td>
                        </tr>
                      </tbody>
                    </table>
                    <table class='st-Copy st-Width st-Width--mobile' border='0' cellpadding='0' cellspacing='0' width='600' style='min-width: 600px;'>
                      <tbody>
                        <tr>
                          <td class='st-Spacer st-Spacer--gutter' style='border: 0; margin: 0; padding: 0; font-size: 1px; line-height: 1px; mso-line-height-rule: exactly;' width='64'>
                            <div class='st-Spacer st-Spacer--filler'> </div>
                          </td>
                          <td class='st-Font st-Font--body' style='border: 0; margin: 0; padding: 0; color: #525F7f !important; font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, 'Helvetica Neue', Ubuntu, sans-serif; font-size: 16px; line-height: 24px;'>
                             Email reset mật khẩu sẽ hết hiệu lực trong vòng 5 phút.
                          </td>
                          <td class='st-Spacer st-Spacer--gutter' style='border: 0; margin: 0; padding: 0; font-size: 1px; line-height: 1px; mso-line-height-rule: exactly;' width='64'>
                            <div class='st-Spacer st-Spacer--filler'> </div>
                          </td>
                        </tr>
                        <tr>
                          <td class='st-Spacer st-Spacer--stacked' colspan='3' height='12' style='border: 0; margin: 0; padding: 0; font-size: 1px; line-height: 1px; mso-line-height-rule: exactly;'>
                            <div class='st-Spacer st-Spacer--filler'> </div>
                          </td>
                        </tr>
                      </tbody>
                    </table>
                    <table class='st-Copy st-Width st-Width--mobile' border='0' cellpadding='0' cellspacing='0' width='600' style='min-width: 600px;'>
                      <tbody>
                        <tr>
                          <td class='st-Spacer st-Spacer--gutter' style='border: 0; margin: 0; padding: 0; font-size: 1px; line-height: 1px; mso-line-height-rule: exactly;' width='64'>
                            <div class='st-Spacer st-Spacer--filler'> </div>
                          </td>
                          <td class='st-Font st-Font--body' style='border: 0; margin: 0; padding: 0; color: #525F7f !important; font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, 'Helvetica Neue', Ubuntu, sans-serif; font-size: 16px; line-height: 24px;'>                        
                          </td>
                          <td class='st-Spacer st-Spacer--gutter' style='border: 0; margin: 0; padding: 0; font-size: 1px; line-height: 1px; mso-line-height-rule: exactly;' width='64'>
                            <div class='st-Spacer st-Spacer--filler'> </div>
                          </td>
                        </tr>
                        <tr>
                          <td class='st-Spacer st-Spacer--stacked' colspan='3' height='12' style='border: 0; margin: 0; padding: 0; font-size: 1px; line-height: 1px; mso-line-height-rule: exactly;'>
                            <div class='st-Spacer st-Spacer--filler'> </div>
                          </td>
                        </tr>
                      </tbody>
                    </table>
                    <table class='st-Footer st-Width st-Width--mobile' border='0' cellpadding='0' cellspacing='0' width='600' style='min-width: 600px;'>
                      <tbody>
                        <tr>
                          <td class='st-Spacer st-Spacer--divider' colspan='3' height='20' style='border: 0; margin: 0; padding: 0; font-size: 1px; line-height: 1px; max-height: 1px; mso-line-height-rule: exactly;'>
                            <div class='st-Spacer st-Spacer--filler'> </div>
                          </td>
                        </tr>
                        <tr class='st-Divider'>
                          <td class='st-Spacer st-Spacer--gutter' style='border: 0; margin: 0; padding: 0; font-size: 1px; line-height: 1px; max-height: 1px; mso-line-height-rule: exactly;' width='64'>
                            <div class='st-Spacer st-Spacer--filler'> </div>
                          </td>
                          <td bgcolor='#e6ebf1' colspan='2' height='1' style='border: 0; margin: 0; padding: 0; font-size: 1px; line-height: 1px; max-height: 1px; mso-line-height-rule: exactly;'>
                            <div class='st-Spacer st-Spacer--filler'> </div>
                          </td>
                          <td class='st-Spacer st-Spacer--gutter' style='border: 0; margin: 0; padding: 0; font-size: 1px; line-height: 1px; max-height: 1px; mso-line-height-rule: exactly;' width='64'>
                            <div class='st-Spacer st-Spacer--filler'> </div>
                          </td>
                        </tr>
                        <tr>
                          <td class='st-Spacer st-Spacer--divider' colspan='3' height='31' style='border: 0; margin: 0; padding: 0; font-size: 1px; line-height: 1px; mso-line-height-rule: exactly;'>
                            <div class='st-Spacer st-Spacer--filler'> </div>
                          </td>
                        </tr>
                        <tr>
                          <td class='st-Spacer st-Spacer--gutter' style='border: 0; margin: 0; padding: 0; font-size: 1px; line-height: 1px; mso-line-height-rule: exactly;' width='64'>
                            <div class='st-Spacer st-Spacer--filler'> </div>
                          </td>
                          
                          <td class='st-Spacer st-Spacer--gutter' style='border: 0; margin: 0; padding: 0; font-size: 1px; line-height: 1px; mso-line-height-rule: exactly;' width='64'>
                            <div class='st-Spacer st-Spacer--filler'> </div>
                          </td>
                        </tr>
                        <tr>
                          <td class='st-Spacer st-Spacer--emailEnd' colspan='3' height='64' style='border: 0; margin: 0; padding: 0; font-size: 1px; line-height: 1px; mso-line-height-rule: exactly;'>
                            <div class='st-Spacer st-Spacer--filler'> </div>
                          </td>
                        </tr>
                      </tbody>
                    </table>
                  </td>
                </tr>
              </tbody>
            </table>
          </td>
        </tr>
      </tbody>
    </table>
  </body>";
    //$mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

//    $mail->send();
    if($mail->Send())
    {
	  header ('location: ../password-reset-token-submit.php');
    }
    else
    {
      echo "Mail Error - >".$mail->ErrorInfo;
    }
  }	
}
?>