<?php
header("Access-Control-Allow-Origin: http://newlabo.work");
header("Access-Control-Allow-Headers: Content-Type");
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;
require "vendor/autoload.php";
$json = file_get_contents("php://input");
$inputs = json_decode($json, true);
$msg = "";
//メール本文
foreach($inputs as $key => $value){
    $msg .= $key. "：". $value . "\n";
}
$mail = new PHPMailer(true);
try {
    $host = "HOST"; //メールサーバーホスト
    $username = "SMTP_USERNAME"; // SMTPユーザー
    $password = "SMTP_PASSWORD"; //SMTPパスワード
    $from = "FROM_MAIL_ADDRESS"; //差出人メールアドレス
    $fromname = "FROM_NAME"; //差出人の名前
    $to = "TO_MAIL_ADDRESS"; //送信先メールアドレス
    $toname = "TO_NAME"; //送信先の名前
    //件名・本文
    $subject = "送信テスト";
    $body = $msg;
    //メール設定
    $mail->isSMTP();
    $mail->SMTPAuth = true;
    $mail->Host = $host;
    $mail->Username = $username;
    $mail->Password = $password;
    $mail->SMTPSecure = "tls";
    $mail->Port = 587;
    $mail->CharSet = "utf-8";
    $mail->Encoding = "base64";
    $mail->setFrom($from, $fromname);
    $mail->addAddress($to, $toname);
    $mail->Subject = $subject;
    $mail->Body    = $body;
    //メール送信
    if($mail->send()){
        echo "送信完了";
    }
} catch (Exception $e) {
    echo "送信失敗";
}
exit();