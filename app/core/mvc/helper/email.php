<?php


class Email{
    public $to_email;
    public $from_email;
    public $subject_str;
    public $message_str;
    public $attachment;


    public function __construct() {
             
    }
    
    public function sendmail(){
		
		//trebalo bi ovako nesto da ide ja sam otvorio ovaj mail nalog i dodelio mu ovaj password
		$mail = new PHPMailer;
		$mail->isSMTP();                                      	// Set mailer to use SMTP
		$mail->Host = 'smtp.mandrillapp.com';  					// Specify main and backup SMTP servers
		$mail->SMTPAuth = true;                               	// Enable SMTP authentication
		$mail->Username = 'admin@creativeeweb.com'; 				// SMTP username
		$mail->Password = 'VmQi5yPJNC-7TPhCUry8Lw';                          	// SMTP password
		$mail->SMTPSecure = 'tls';                            	// Enable TLS encryption, `ssl` also accepted
		$mail->Port = 587;                                    	// TCP port to connect to
			
		$mail->From = $this->from_email;
		$mail->FromName = 'Agencija SHOPKO';
		$mail->addAddress($this->to_email);     						// Add a recipient
		$mail->addReplyTo('office@shopko.rs');
			
		$mail->isHTML(true);
		$mail->Subject = $this->subject_str;
		$mail->Body    = $this->setup_message();
                if(isset($this->attachment)){
                    foreach($this->attachment as $a){
                        $mail->addAttachment($a);
                    }
                }
                
		
		//slanje
		$mail->send();
		
		
		
		
        //mail($this->to_email, $this->subject_str, $this->setup_message(), $this->setup_headers());
    }
    
    private function setup_message(){
            $m = '<html><body>';
            $m .= $this->message_str;
            $m .='</body></html>';
            return $m;
    
    }
    
}
