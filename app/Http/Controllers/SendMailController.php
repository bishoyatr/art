<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\PHPMailer;

class SendMailController extends Controller
{
    public function store(Request $request)
    {
        $mail = new PHPMailer(true);
    
        try {
    
            /* Email SMTP Settings */
            $mail->isSMTP();                                      
            $mail->SMTPDebug = 1;  
            // $mail->SMTPAuth = true;
            $mail->SMTPSecure = 'ssl';
            $mail->Host = env('MAIL_HOST');
            $mail->Username = env('MAIL_USERNAME');
            $mail->Password = env('MAIL_PASSWORD');
            $mail->Port = 587;
            $mail->setFrom(env('MAIL_FROM_ADDRESS'), env('MAIL_FROM_NAME'));
            $mail->addAddress($request->email);
    
            $mail->isHTML(true);
            
            
            
            
            // $mail->isSMTP();
            // $mail->isSMTP();
            // $mail->SMTPAuth = true;
            // $mail->SMTPSecure = env('MAIL_ENCRYPTION');
            //$mail->Port = env('MAIL_PORT');
            // $mail->SMTPAuth = false;
            // $mail->SMTPAutoTLS = false; 
            // $mail->SMTPOptions = array(
            //     'ssl' => array(
            //         'verify_peer' => false,
            //         'verify_peer_name' => false,
            //         'allow_self_signed' => true
            //     )
            // );

    
    
            $mail->Subject = $request->subject;
            $mail->Body    = $request->body;
    
            if( !$mail->send() ) {

                return response("error Email not sent.")->withErrors($mail->ErrorInfo);
            }
                
            else {
                return response("success Email has been sent.");
            }
    
        } catch (Exception $e) {
                return response($e);
        }
    }
}
