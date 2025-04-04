<?php

require APPPATH . 'third_party/vendor/autoload.php';

use PhpAmqpLib\Connection\AMQPStreamConnection;
use PhpAmqpLib\Message\AMQPMessage;

function send_smtp_mailer($subject = '', $mailto = '', $mailcontent = '', $cc = '', $attachmentdata = array(), $reply_to = '')
{
    $CI = get_instance();



    try {


        $name = 'Smart-FX';
        $host = 'smtp.gmail.com';
        $smtp_username = "noreply@smartfx.com";
        $password = "noreply@smartfx";



        // if (ENVIRONMENT == 'development') {
        //     $mailto = '';
        // }

        // if (strpos($mailto, '@hotmail.com')) {
        //     $host = 'smtp.gmail.com';
        //     $smtp_username = "";
        //     $password = "";
        $smtp_from_email = "noreply@smartfx.com";
        // }

        $mail = new PHPMailer\PHPMailer\PHPMailer;
        $mail->isSMTP();
        $mail->Host = $host;
        $mail->Port = 465;
        $mail->SMTPSecure = 'ssl';
        $mail->SMTPAuth = true;
        $mail->Username = $smtp_username;
        $mail->Password = $password;
        $mail->SetFrom($smtp_from_email, $name);
        if ($reply_to != '') {
            $mail->ClearReplyTos();
            $mail->addReplyTo($reply_to);
        }

        $addresses = explode(',', $mailto);
        foreach ($addresses as $address) {
            $mail->addAddress(trim($address));
        }

        $cc_emails = explode(',', $cc);
        foreach ($cc_emails as $cc_email) {
            $mail->AddCC(trim($cc_email));
        }

        $mail->Subject = $subject;
        $mail->msgHTML($mailcontent);

        if (!empty($attachmentdata)) {
            $filePath = FCPATH . $attachmentdata['filepath'] . $attachmentdata['filename'];
            $mail->addAttachment($filePath);
        }
        if ($mail->send()) {
            $connection = new AMQPStreamConnection('mq.bmark.in', 5672, 'admin', 'rabbitMQ');
            $channel = $connection->channel();
            $email_log_data['email'] = $smtp_from_email;
            $email_log_data['action'] = 'Email_notification';
            $email_log_data['module_name'] = APP_TITLE . '-' . $name . ' : ' . $subject;
            $email_log_data['timestamp_server'] = time();
            $email_log_data['timestamp_date'] = date('Y-m-d h:i:s');


            foreach ($addresses as $address) {
                $email_log_array = [];
                $email_log_data['email_to'] =  $address;
                $email_log_array[] = $email_log_data;
                $email_log = json_encode($email_log_array);
                $msg = new AMQPMessage($email_log);
                $channel->basic_publish($msg, '', 'saveLog');
            }

            foreach ($cc_emails as $cc_email) {
                $email_log_array = [];
                $email_log_data['email_to'] =  $cc_email;
                $email_log_array[] = $email_log_data;
                $email_log = json_encode($email_log_array);
                $msg = new AMQPMessage($email_log);
                $channel->basic_publish($msg, '', 'saveLog');
            }

            return true;
        } else {
            return false;
        }
    } catch (Exception $e) {
        $res = false;
        return $res;
    }
}
