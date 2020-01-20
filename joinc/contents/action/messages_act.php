<?php
	//session_start();
	function isEmail($email) {
		return(preg_match("/^[-_.[:alnum:]]+@((([[:alnum:]]|[[:alnum:]][[:alnum:]-]*[[:alnum:]])\.)+(ad|ae|aero|af|ag|ai|al|am|an|ao|aq|ar|arpa|as|at|au|aw|az|ba|bb|bd|be|bf|bg|bh|bi|biz|bj|bm|bn|bo|br|bs|bt|bv|bw|by|bz|ca|cc|cd|cf|cg|ch|ci|ck|cl|cm|cn|co|com|coop|cr|cs|cu|cv|cx|cy|cz|de|dj|dk|dm|do|dz|ec|edu|ee|eg|eh|er|es|et|eu|fi|fj|fk|fm|fo|fr|ga|gb|gd|ge|gf|gh|gi|gl|gm|gn|gov|gp|gq|gr|gs|gt|gu|gw|gy|hk|hm|hn|hr|ht|hu|id|ie|il|in|info|int|io|iq|ir|is|it|jm|jo|jp|ke|kg|kh|ki|km|kn|kp|kr|kw|ky|kz|la|lb|lc|li|lk|lr|ls|lt|lu|lv|ly|ma|mc|md|me|mg|mh|mil|mk|ml|mm|mn|mo|mp|mq|mr|ms|mt|mu|museum|mv|mw|mx|my|mz|na|name|nc|ne|net|nf|ng|ni|nl|no|np|nr|nt|nu|nz|om|org|pa|pe|pf|pg|ph|pk|pl|pm|pn|pr|pro|ps|pt|pw|py|qa|re|ro|ru|rw|sa|sb|sc|sd|se|sg|sh|si|sj|sk|sl|sm|sn|so|sr|st|su|sv|sy|sz|tc|td|tf|tg|th|tj|tk|tm|tn|to|tp|tr|tt|tv|tw|tz|ua|ug|uk|um|us|uy|uz|va|vc|ve|vg|vi|vn|vu|wf|ws|ye|yt|yu|za|zm|zw)$|(([0-9][0-9]?|[0-1][0-9][0-9]|[2][0-4][0-9]|[2][5][0-5])\.){3}([0-9][0-9]?|[0-1][0-9][0-9]|[2][0-4][0-9]|[2][5][0-5]))$/i",$email));
	}

	$name 		= stripslashes($_POST['name']);
	$email 		= stripslashes($_POST['email']);
	$phone 		= stripslashes($_POST['phone']);
	$subject	= stripslashes($_POST['subject']);
	$message 	= stripslashes($_POST['message']);
	$captcha 	= stripcslashes($_POST['captcha_code']);
	
	//echo $name.'-'.$email.'-'.$phone.'-'.$subject.'-'.$message.'-'.$captcha.$_SESSION['captcha_code'];die();

	if(trim($name) == '')
	{
		echo "<script>alert('Maaf! Nama tidak boleh kosong.'); window.location = 'contact';</script>";
	}
	else if(trim($email) == '')
	{
		echo "<script>alert('Maaf! Email tidak boleh kosong.'); window.location = 'contact';</script>";
	}
	else if(!isEmail($email))
	{
		echo "<script>alert('Maaf! Email tidak valid. Terimakasih'); window.location = 'contact';</script>";
	}
	else if(trim($phone) == '')
	{
		echo "<script>alert('Maaf! Nomer telephone tidak boleh kosong.'); window.location = 'contact';</script>";
	}
	else if(trim($subject) == '')
	{
		echo "<script>alert('Maaf! Nomer telephone tidak boleh kosong.'); window.location = 'contact';</script>";
	}
	else if(trim($message) == '')
	{
		echo "<script>alert('Maaf! Catatan Pesan tidak boleh kosong.'); window.location = 'contact';</script>";
	}
	else
	{
		if(get_magic_quotes_gpc())
		{
			$message = stripslashes($message);
		}
		// if(!empty($_POST['captcha_code']))
		if(empty($_POST['captcha_code']))
		{
			// if(empty($_SESSION['captcha_code'] ) || strcasecmp($_SESSION['captcha_code'], $_POST['captcha_code']) != 0)
			if( !empty($_POST['captcha_code']) )
			{
				// Captcha verification is incorrect.
				echo "<script>alert('Maaf! Captcha tidak sesuai. Harap Ulangi lagi. Terimakasih.'); window.location = 'contact';</script>";
			}
			else
			{
					//data yang akan di insert berbentuk array
					$form_data = array(
					    "name" 			=> "$name",
					    "email"			=> "$email",
						"phone"			=> "$phone",
						"subject"		=> "$subject",
						"message"		=> "$message",
						"status"		=> "0"
					);

					//proses insert ke database
		            $database->insert($table="messages", $array=$form_data);
					
				echo "<script>alert('Thank you $name, Your Message Delivered Successfully.'); window.location = 'contact';</script>";
			}
		}
		else
		{
			echo "<script>alert('Maaf! Captcha tidak boleh kosong.'); window.location = 'contact';</script>";
		}
	}

?>
