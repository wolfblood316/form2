<?php

//print "included OK";     // uncomment  to check the page is included in the form



// You should not need to edit anything below here, unless you wish to add or remove form fields
//for your form.

$name 			= 		'Write your name here.';
$email			= 		'Write your email address';
$message 		= 		'Write your message here.';



if(@$_POST['submitted'])
{
	//create vars from user input
	$name 			= 		@$_POST['name'];
	$email			= 		@$_POST['email'];
	$message 		= 		@$_POST['message'];
	
	
	// if magic quotes on, remove Magic Quotes effect
	if ( get_magic_quotes_gpc() ) 
	{ 
	  $name = stripslashes($name);
	  $email = stripslashes($email);
	  $message = stripslashes($message);
	}
	
	
	//Validate user input. Create error array to store errors
	
	$error_msg =  array();
	
	$valid = verifyAlphaNum($name, 'Write your name here.');
	
	if(!$valid)
	{
		$error_msg[] = 'Please provide a valid name.';
		$name_error = '<span class="error">Name must be letters, numbers, spaces, and dashes only.</span>';
	}
	
	$valid = verifyEmail($email, 'Write your email address');
	
	if(!$valid)
	{
		$error_msg[] = 'Please provide a valid email address.';
		$email_error = '<span class="error">Email must be a valid format (e.g. john@yahoo.com).</span>';
	}
	
	$message = cleanText($message);
	
	if($message == 'Write your message here.')
	{
		$error_msg[] = 'Please provide a valid message.';
		$message_error = "<span class=\"error\">Message can only contain letters, numbers and basic punctuation \" ' - ? ! </span>";
		
	}



	// if no errors, send email
	if(count($error_msg) === 0)
	{

		$headers  = "MIME-Version: 1.0"."\r\n";
		$headers .= "Content-type: text/html; charset=utf-8"."\r\n";

		/* additional headers */
		$headers .= 'From:' . FROM_ADDRESS ."\r\n";
		$headers .= 'Reply-To:' . REPLY_TO ."\r\n";
		
		//prepare for sending email
		$destination		= 	DESTINATION_EMAIL;
		$subject			= 	MESSAGE_SUBJECT;
		$body				=	"$name \r\n<br/> $email \r\n<br /> $message";

		
		if(mail($destination, $subject, $body, $headers))
		{
		
			// test to see if form data is received.
			echo "<h1>Thanks for providing your insight</h1>";
			echo "<p>Your message has been sent. Below is the info you provided:</p>";
			echo "<ul>";
			echo "<li>".$name."</li>";
			echo "<li>".$email."</li>";
			echo "<li>".$message."</li>";
			echo "</ul>";
			echo "<a href=\"". REDIRECT_URL ."\">Go Back to Home Page</a>";
			exit();
		}
		
	}//end if count
	
} //ends if submitted






function verifyAlphaNum ($testString, $defaultText) {
	//check if field hasn't changed from default text
	if($testString == $defaultText || $testString == "") return false;
	// Check for letters, numbers and dash, period, space and single quote only. 
	return (preg_match("/^([[:alnum:]]|-|\.| |')+$/", $testString));
}	

function verifyEmail ($testString, $defaultText) {
	//check if field hasn't changed from default text
	if($testString == $defaultText || $testString == "") return false;
	// Check for a valid email address 
	return (preg_match("/^([[:alnum:]]|_|\.|-)+@([[:alnum:]]|\.|-)+(\.)([a-z]{2,4})$/", $testString));
}	

function verifyPhone ($testString, $defaultText) {
	//check if field hasn't changed from default text
	if($testString == $defaultText || $testString == "") return false;
	// Check for only numbers, dashes and spaces in the phone number 
	return (preg_match('/^([[:digit:]]| |-)+$/', $testString));
}


function cleanText ($testString) {
	$testString =  strip_tags($testString);
	$testString = htmlspecialchars($testString);
	//$testString= mysql_real_escape_string($testString);
	
	return 	$testString;
}

?>