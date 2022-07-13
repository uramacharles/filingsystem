<?php
trait mailer{
	public function sendMail($subject,$message,$from,$to){
		connection::connecter();
		$messagebody = <<<_end

 <!DOCTYPE html>
<html>
<head>
	<title>Message From The House of Laws</title>
	<link rel="shortcut icon" href="asset/images/logo.png" type="image/x-icon">
	<link rel="icon" href="asset/images/logo.png" type="image/x-icon">
</head>		
	<body style="padding-bottom: 2em;background-color: whitesmoke;">
		<div style="width:80%; height: 5em; padding: 1em; text-align: center;background-color: blue; color: white; font-family: tahoma;border-top-right-radius: 3px;border-top-left-radius: 3px;border-bottom-left-radius: 4px;border-bottom-right-radius: 4px;font-weight: bolder; letter-spacing: 10px;font-size: 20px; margin:auto;"><img src="asset/images/logo.png" style="width: 10%" /> &nbsp; The House of Laws</div>


		<div style="background-color: whitesmoke; width:80%; margin:auto; padding:1em; min-height: 20em;"> $message </div>


		<footer style="background-color: blue; color: white;width:80%;font-weight: bolder; padding: 2em;text-align: center;padding-bottom: 5em; margin:auto; height: auto;">
			We will serve you better with you.

            <!--Footer Column-->
        	<div style="width: 100%; height: 15em; position: relative;">
        		<a href="index"><img src="asset/images/logo.png" alt="" style="width: 100% ; height: 100%" /></a>
            </div>
            
            <!--Footer Column-->
        	<div style="width: 100% ; height: 15em; padding-bottom: 2em;position: relative;">
                <div class="">
                	<h2>Practice Area:</h2>
                    <ul class="info">
                        <li><a href="practice-area">Litigation and Bar Advocacy</a></li>
                        <li><a href="practice-area">Fundamental and Constitutional Rights Activism</a></li>
                        <li><a href="practice-area">Property and Corporate Legal Practice</a></li>
                        <li><a href="practice-area">Pre & Post Election Dispute Resolution</a></li>
                        <li><a href="practice-area">Taxation and its Enforcement</a></li>
                        <li><a href="practice-area">Arbitration and Alternative Dispute Resolution</a></li>
                        <li><a href="practice-area">Law Research and Reforms</a></li>
                        <li><a href="practice-area">Publications of Law Journals and Law Report Digests</a></li>
                    </ul>
                </div>
            </div>
		</footer>
	</body>
</html>
_end;

		$newmessage= wordwrap($messagebody);
		$header = "From:".$from;
		$header .= "MIME-Version: 1.0"."\r\n"."X-Mailer: PHP/" . phpversion()."\r\n"; 
		$header .= "Content-type: text/html; charset=iso-8859-1" . "\r\n";

		if(mail($to,$subject,$newmessage,$header)){
			return "true";
		}
		else{
			return "false";
		}
	}
}
?>