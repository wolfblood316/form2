<?php
	
	// * IMPORTANT * Set your email information here
	define('DESTINATION_EMAIL','adrianlandin@yahoo.com');
	define('MESSAGE_SUBJECT','form Demo');
	define('REPLY_TO', 'adrianlandin@yahoo.com');
	define('FROM_ADDRESS', 'adrianlandin@yahoo.com');
	define('REDIRECT_URL', 'http://yahoo.com/');
	
	require_once('validation.php');

?>

<!doctype html>
<html>
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">

		<title></title>
		<meta name="description" content="">
		<meta name="author" content="">
		<meta name="viewport" content="width=device-width,initial-scale=1">
	
		<style type="text/css">
            #home .home-lk,
            #about .about-lk,
            #contact .contact-lk{
                color:red;
                font-weight:bold;
            }
		
			input,textarea,label {display:block;margin-bottom: 15px;}
			label {margin-bottom: 0px;}
			.error{color:red;}
			form{width:300px;}
		</style>
	</head>

	<body id="contact">
        
        <?php include('inc/header.inc.php'); ?>
        
		<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
			<fieldset>
				<p>
					<label for="name">Name:</label><?php echo @$name_error; ?>
					<input type="text" id="name" name="name" value="<?php echo @$name ?>" class="required" />
				</p>
				<p>
					<label for="email">Email:</label><?php echo @$email_error; ?>
					<input type="text" id="email" name="email" value="<?php echo @$email ?>" class="email required" />
				</p>
				<p>
					<label for="message">Message:</label><?php echo @$message_error; ?>
					<textarea cols="45" rows="7" id="message" name="message" class="required"><?php echo @$message ?></textarea>
				</p>
				<input name="submitted" type="submit" value="Send" />
			</fieldset>
		</form>
        
<?php include('inc/footer.inc.php'); ?>
        
	</body>
</html>
