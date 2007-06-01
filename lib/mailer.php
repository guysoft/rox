<?php
//Load in the files we'll need
require_once "swift/Swift.php";
require_once "swift/Swift/Connection/SMTP.php";

// -----------------------------------------------------------------------------
// hc_mail is a function to centralise all mail send thru HC 
function bw_mail($to, $the_subject, $text, $extra_headers = "", $FromParam = "", $IdLanguage = 0, $PreferenceHtmlEmail = "yes", $LogInfo = "", $replyto = "",$Greetings="") {
	return bw_sendmail($to, $the_subject, $text, "", $extra_headers, $FromParam, $IdLanguage, $PreferenceHtmlEmail, $LogInfo, $replyto,$Greetings);
}

// -----------------------------------------------------------------------------
// bw_sendmail is a function to centralise all mail send thru HC with more feature 
// $to = email of receiver
// $mail_subject=subject of mail
// $text = text of mail
// $textinhtml = text in html will be use if user preference are html
// $From= from mail (will also be the reply to)
// $deflanguage : default language of receiver
// $PreferenceHtmlEmail : if set to yes member will receive mail in html format, note that it will be force to html if text contain ";&#"
// $LogInfo = used for debugging

function bw_sendmail_swift($to, $mail_subject, $text, $textinhtml = "", $extra_headers = "", $_FromParam = "", $IdLanguage = 0, $PreferenceHtmlEmail = "yes", $LogInfo = "", $replyto = "",$ParamGreetings="") 
{	
	//Start Swift
	$swift =& new Swift(new Swift_Connection_SMTP("localhost"));
	 
	 //Create a message
	$message =& new Swift_Message("My subject");
	//Add some "parts"
	$message->attach(new Swift_Message_Part($text));
	$message->attach(new Swift_Message_Part($textinhtml, "text/html"));
	 
	//Now check if Swift actually sends it
	if ($swift->send($message, $to, $_FromParam)) echo "Sent";
	else echo "Failed";
 
}

// -----------------------------------------------------------------------------
// bw_sendmail is a function to centralise all mail send thru HC with more feature 
// $to = email of receiver
// $mail_subject=subject of mail
// $text = text of mail
// $textinhtml = text in html will be use if user preference are html
// $From= from mail (will also be the reply to)
// $deflanguage : default language of receiver
// $PreferenceHtmlEmail : if set to yes member will receive mail in html format, note that it will be force to html if text contain ";&#"
// $LogInfo = used for debugging

function bw_sendmail($to, $mail_subject, $text, $textinhtml = "", $extra_headers = "", $_FromParam = "", $IdLanguage = 0, $PreferenceHtmlEmail = "yes", $LogInfo = "", $replyto = "",$ParamGreetings="") {
	global $_SYSHCVOL;
	
	if (isset($_SESSION['verbose'])) {
	   $verbose=$_SESSION['verbose'];
	}
	else {
	   $verbose = false;
	}
	
//	if (IsAdmin())  $verbose=1; // set to one for a verbose function
	$FromParam = $_FromParam;
	if ($_FromParam == "")
		$FromParam = $_SYSHCVOL['MessageSenderMail'];

	$From = $FromParam;

	$text = str_replace("<br />", "", $text);

	//	nl2br_inv($text);	// neutralize the nl2br() of ww() and wwinlang()
	$text = str_replace("\r\n", "\n", $text); // solving the century-bug: NO MORE DAMN TOO MANY BLANK LINES!!!

	$use_html = $PreferenceHtmlEmail;
	if ($use_html=="html") $use_html="yes";
	if ($verbose) 
		echo "<br>use_html=[" . $use_html . "] mail to $to<br>\n\$_SERVER['SERVER_NAME']=", $_SERVER['SERVER_NAME'], "<br>\n";
	if (stristr($text, ";&#") != false) { // if there is any non ascii file, force html
		if ($verbose)
			echo "<br>1 <br>\n";
		if ($use_html != "yes") {
			if ($verbose)
				echo "<br> no html 2<br>\n";
			$use_html = "yes";
			if ($LogInfo == "") {
				LogStr("Forcing HTML for message to $to", "hcvol_mail");
			} else {
				LogStr("Forcing HTML <b>$LogInfo</b>", "hcvol_mail");
			}
		}
	}

	$headers = $extra_headers;
	if (!(strstr($headers, "From:")) and ($From != "")) {
		$headers = $headers . "From:" . $From . "\n";
	}
	$headers .= "MIME-Version: 1.0\nContent-type: text/html; charset=utf-8\n";
	if (($use_html == "yes") or (strpos($text, "<html>") !== false)) { // if html is forced or text is in html then add the MIME header
		if ($verbose)
			echo "<br>3<br>";
		$use_html = "yes";
	}

	//	$headers .= "To: $to\n";
	//	$headers .= "Subject: $mail_subject\n";
	//	$headers .= "Return-Path: $From\n";
	//	$headers .= "Organization: " . $_SYSHCVOL['SiteName']."\n";

	if ($replyto != "") {
		$headers = $headers . "Reply-To:" . $replyto;
	}
	if (!(strstr($headers, "Reply-To:")) and ($From != "")) {
		$headers = $headers . "Reply-To:" . $From;
	}
	elseif (!strstr($headers, "Reply-To:")) {
		$headers = $headers . "Reply-To:" . $_SYSHCVOL['MessageSenderMail'];
	}
	$headers .= "\nX-Mailer:PHP"; // mail of client			

	if ($ParamGreetings=="") {
		$Greetings=wwinlang('HCVolMailSignature', $IdLanguage);
	}
	else {
		$Greetings=$ParamGreetings;
	}
	if ($use_html == "yes") {
		if ($verbose)
			echo "<br>4<br>\n";
		if ($textinhtml != "") {
			if ($verbose)
				echo "<br>5 will use text in html paramameter<br>";
			$texttosend = $textinhtml;
		} else {
			if ($verbose)
				echo "<br>6<br>\n";
			$texttosend = $text;
		}
		if (strpos($texttosend, "<html>") === false) { // If not allready html
			if ($verbose)
				echo "<br>7<br>";
			$realtext = "<!DOCTYPE HTML PUBLIC \"-//W3C//DTD HTML 4.0 Transitional//EN\">\n" . "<html>\n<head>\n<title>" . $mail_subject . "</title>\n</head>\n<body bgcolor=#ffffcc>\n" . str_replace("\n", "<br>", $texttosend) .
			$realtext .= "<br>\n<font color=blue>" . $ParamGreetings . "</font>";
			$realtext .= "\n</body>\n</html>";
		} else {
			if ($verbose)
				echo "<br>8<br>\n";
			$realtext = "<!DOCTYPE HTML PUBLIC \"-//W3C//DTD HTML 4.0 Transitional//EN\">\n" . str_replace("\n", "<br>\n", $texttosend); // In this case, its already in html, \n are to replace by <br>
		}
	} else {
		if ($verbose)
			echo "<br>9 <br>\n";
		$text .= "\n" .$ParamGreetings;
		$realtext = str_replace("<br>", "\n", $text);
	}

	if ($verbose)
		echo "<br>10 " . nl2br($realtext) . "<br>\n";

	if ($verbose)
		echo "<br>11 " . nl2br($realtext) . "<br>\n";
	if ($verbose)
		echo "<br>12 " . $realtext . "<br>\n";

	// Debugging trick	
	if ($verbose) {
		echo "<table bgcolor=#ffff99 cellspacing=3 cellpadding=3 border=2><tr><td>";
		echo "\$From:<font color=#6633ff>$From</font> \$To:<font color=#6633ff>$to</font><br>";
		echo "\$mail_subject:<font color=#6633ff><b>", $mail_subject, "</b></font></td>";
		$ss = $headers;
		echo "<tr><td>\$headers=<font color=#ff9933>";
		for ($ii = 0; $ii < strlen($ss); $ii++) {
			//			echo "\$ss[$ii]=",ord($ss{$ii})," [",$ss{$ii},"]<br>";
			$jj = ord($ss {
				$ii });
			if ($jj == 10) {
				echo "\\n<br>";
			}
			elseif ($jj == 13) {
				echo "\\r";
			} else {
				echo chr($jj);
			}
		}
		echo "</font></td>";
		echo "<tr><td><font color=#6633ff>", htmlentities($realtext), "</font></td>";
		if ($use_html == "yes")
			echo "<tr><td>$realtext</td>";
		echo "</table><br>";
	} // end of for $ii
	// end of debugging trick

	// remove new line in $mail_subject because it is not accepted
	if ($verbose)
		echo "<br>13 removing extra \\n from \$mail_subject<br>\n";
	for ($ii = 0; $ii < strlen($mail_subject); $ii++) {
		//	  echo $ii,"-->",$mail_subject{$ii}," ",ord($mail_subject{$ii}),"<br>";;
		if ((ord($mail_subject {
			$ii }) < 32) or (ord($mail_subject {
			$ii }) > 255)) {
			$mail_subject {
				$ii }
			= " ";
			if ($verbose) echo "One weird char removed in subject at ", $ii, " position<br>\n";
		}
	}

	if ($_SERVER['SERVER_NAME'] == 'localhost') { // Localhost don't send mail
		return ("<br><b><font color=blue>" . $mail_subject . "</font></b><br><b><font color=blue>" . $realtext . "</font></b><br>" . " not sent<br>");
	}
	elseif (($_SERVER['SERVER_NAME'] == 'ns20516.ovh.net') or (($_SERVER['SERVER_NAME'] == 'test.bewelcome.org')) or (($_SERVER['SERVER_NAME'] == 'www.bewelcome.org'))) {
		$ret = mail($to, $mail_subject, $realtext, $headers, "-" . $_SYSHCVOL['ferrorsSenderMail']);
		//	  $ret=mail($to,$mail_subject,$realtext,$headers) ;
		if ($verbose) {
			echo "<br>14 <br>\n";
			echo "headers:\n";
			print_r($headers);
			echo "\n<br>to=", $to, "<br>\n";
			echo "subj=", $mail_subject, "<br>";
			echo "text :<i>", htmlentities($realtext), "</i><br>\n";
			echo " \$ret=", $ret, "<br>\n";
		}
		//		echo "Mail sent to $to<br>";
		return ($ret);
	}
}
?>