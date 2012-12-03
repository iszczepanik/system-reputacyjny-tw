<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en-us" lang="en-us">
<head>
	<title>Star Rating widget Demo2 Page</title>
	

	<!-- demo page js -->
	<script type="text/javascript" src="jquery.min.js?v=1.5.1"></script>
	<script type="text/javascript" src="jquery-ui.custom.min.js?v=1.8.13"></script>
	<script type="text/javascript" src="jquery.uni-form.js?v=1.3"></script>
	
	<!-- Star Rating widget stuff here... -->
	<script type="text/javascript" src="jquery.ui.stars_1.js?v=3.0.1b44"></script>
	<link rel="stylesheet" type="text/css" href="jquery.ui.stars_1.css?v=3.0.1b44"/>

	
<script type="text/javascript">
		$(function(){
			// $("#starify").children().not(":input").hide();
			
			// // Create stars from :radio boxes
			// $("#starify").stars({
				// cancelShow: false
			// });
			
			//stars
		var $stars2 = $("#importance_stars");

		$stars2.children().not("select").hide();

		$stars2.stars({
			inputType: "select",
			//captionEl: $("#hover_ocv2"),
			//callback: function(ui, type, value, event){
			//	alert("callback: {\n type: " + type + ",\n value: " + value + ",\n event: " + event.type + "\n}");
			//},
			cancelShow: false
		});
			
		});
	</script>

</head>

<body>
<?
var_dump($_POST);
?>

<form class="uniForm" action="test.php" method="post">

		<div id="importance_stars" >
		<select name="selrate" style="width: 120px">
			<option value="1">1</option>
			<option value="2">2</option>
			<option value="3">3</option>
			<option value="4" selected="selected" >4</option>
			<option value="5">5</option>
			<option value="6">6</option>
			<option value="7">7</option>
		</select>
	</div>



				<button type="submit" class="primaryAction">Submit</button>



		
	</form>


<?php
require("../../PHPMailer/class.phpmailer.php");

$mail             = new PHPMailer();
$mail->Mailer = "smtp";
//$body             = $mail->getFile('contents.html');
//$body             = eregi_replace("[\]",'',$body);

//$mail->IsSMTP();
$mail->SMTPAuth   = true;                  // enable SMTP authentication
//$mail->SMTPSecure = "ssl";                 // sets the prefix to the servier
$mail->Host       = "poczta.o2.pl";      // sets GMAIL as the SMTP server
$mail->Port       = 587;                   // set the SMTP port

$mail->Username   = "testowy13@o2.pl";  // GMAIL username
$mail->Password   = "qwerty";            // GMAIL password

$mail->From       = "testowy13@o2.pl";
$mail->FromName   = "notice";
$mail->Subject    = "New Offer notice";
$mail->AltBody    = "New Offer notice"; //Text Body
$mail->WordWrap   = 50; // set word wrap

$mail->MsgHTML("New Offer notice");

$mail->AddReplyTo("testowy13@o2.pl","notice");

//$mail->AddAttachment("/path/to/file.zip");             // attachment
//$mail->AddAttachment("/path/to/image.jpg", "new.jpg"); // attachment

$mail->AddAddress("izabela.szczepanik@gazeta.pl","First Last");

$mail->IsHTML(true); // send as HTML

if(!$mail->Send()) {
  echo "Mailer Error: " . $mail->ErrorInfo;
} else {
  echo "Message has been sent";
}




// $mail = new PHPMailer();

// $mail->IsSMTP();
// $mail->SMTPAuth = true; // enable SMTP authentication
// $mail->SMTPSecure = "ssl"; // sets the prefix to the servier
// $mail->Host = "smtp.gmail.com";
// $mail->Port = 465;
   
   // $mail->PluginDir = "../../PHPMailer/";
   // $mail->From = "izsz.neubloc@gmail.com"; //adres naszego konta
   // $mail->FromName = "phpMailer tester";//nag³ówek From


   // $mail->Username = "izsz.neubloc@gmail.com";//nazwa u¿ytkownika
   // $mail->Password = "Magic9B@ll";//nasze has³o do konta SMTP


   // $mail->SetLanguage("en", "../../PHPMailer/language/");
   
   // $mail->Subject = "Mail testowy";//temat maila
   
   // // w zmienn¹ $text_body wpisujemy treœæ maila
   // $text_body = "Czeœæ, chyba phpMailer dzia³a \n\n";
   // $text_body .= "Na zawsze Twój, \n";
   // $text_body .= "PHPMailer";
   
   // $mail->Body = $text_body;
   // // adresatów dodajemy poprzez metode 'AddAddress'
   // $mail->AddAddress("izabela.szczepanik@gazeta.pl","iza");
   // //$mail->AddAddress("franek@gdziestam.pl","Franek");
   
   // if(!$mail->Send())
   // echo "There has been a mail error <br>";
   // echo $mail->ErrorInfo."<br>";
   
   // // Clear all addresses and attachments
   // $mail->ClearAddresses();
   // $mail->ClearAttachments();
   // echo "mail sent <br>";

?>



</body>
</html>
