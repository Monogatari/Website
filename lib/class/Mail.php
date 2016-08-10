<?php

	/**
	 * ==============================
	 * Mail
	 * ==============================
	 */

	class Mail {

		private $recipients;
		private $subject;
		private $body;
		private $headers;

		function __construct(){
			$this -> recipients = [];
			$this -> headers = [];
	    }

	    public function addRecipient($recipient){
		    if(($recipient = filter_var($recipient, FILTER_SANITIZE_EMAIL))){
			    if(filter_var($recipient, FILTER_VALIDATE_EMAIL) && !in_array($recipient, $this -> recipients)){
				    array_push($this -> recipients, $recipient);
			    }
		    }
	    }

	    public function addHeader($header){
		    if(!in_array($header, $this -> headers)){
			    array_push($this -> headers, $header."\r\n");
		    }
	    }

	    public function setSubject($subject){
		    $this -> subject = $subject;
	    }

	    public function setBody($body){
		    $this -> body = $body;
	    }

		public function send(){
			$header = join("", $this -> headers);
			foreach($this -> recipients as $recipient){
				mail($recipient, $this -> subject, $this -> body, $header);
			}
		}
	}
?>