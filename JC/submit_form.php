<?php
	if(!isset($_POST['submit']))
	{
		echo "error; you need to submit the form!";
	}

    $email_subject = "Devis";
    $first_name = $_POST['skill_fname'];
	$last_name = $_POST['skill_lname'];
    $email_cust = $_POST['skill_email'];
    $telephone = $_POST['skill_phone']; 
    $delay = $_POST['skill_delay'];
	$bill = $_POST['skill_bill'];
	$description = $_POST['skill_description'];
	$skill = $_POST['skill_field'];
	
	if(empty($first_name)||empty($last_name)||empty($email_cust)||empty($telephone)||empty($description)) 
	{
		echo "Veuillez remplir tous les champs obligatoires !";
		exit;
	}

	if(IsInjected($email_cust))
	{
		echo "Email invalide !";
		exit;
	}
	
    $email_from = 'kuzanisu@gmail.com';
    $email_subject = "Devis $skill pour $last_name $first_name";
    $email_body = "$last_name $first_name\n$telephone\n$email_cust\n\nDomaine : $skill\nDélais: $delay\nBudget: $bill €\n\nDescription:\n$description".

	$to = "kuzanisu@gmail.com";
	$headers = "From: $email_cust \r\n";
	$headers .= "Reply-To: $visitor_email \r\n";
	mail($to,$email_subject,$email_body,$headers);
	
	function IsInjected($str)
	{
		$injections = array('(\n+)',
              '(\r+)',
              '(\t+)',
              '(%0A+)',
              '(%0D+)',
              '(%08+)',
              '(%09+)'
              );
		$inject = join('|', $injections);
		$inject = "/$inject/i";
		if(preg_match($inject,$str))
		{
			return true;
		}
		else
		{
			return false;
		}
	}
 ?>
