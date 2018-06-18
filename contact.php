<?php

$nameError = $emailError = $phoneError = $subjectError = $messageError = "";
$name = $email = $phone = $subject = $message = "";

$email_to = "americandefensellc@gmail.com";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name_exp = "/^[A-Za-z .'-]+$/";
    if (empty($_POST["name"])) {
    $nameError = "Name is required";
    } else {
        if(preg_match($name_exp,$name)) {
            $name = test_input($_POST["name"]);
        }
        else {
            $nameError = "The name you entered does not appear to be valid";
        }
    }
    if (empty($_POST["email"])) {
        $emailError = "Email is required";
    } else {
        $email = test_input($_POST["email"]);
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $emailError = "Invalid email format"; 
        }
    }
    if (empty($_POST["phone"])) {
        $phoneError = "Phone is required";
    } else {
        $phone = test_input($_POST["phone"]);
        //eliminate every char except 0-9
        $justNums = preg_replace("/[^0-9]/",'',$phone);
        //if we have 10 digits left, it's probably valid.
        if (strlen($justNums) == 10) {
            $phone = $justNums;
        }
        else {
            $phoneError = "Phone number is invalid";
        }
    }
    if (empty($_POST["subject"])) {
        $subjectError = "Subject is required";
    } else {
        $subject = test_input($_POST["subject"]);
    }
    if (empty($_POST["message"])) {
        $messageError = "Message is required";
    } else {
        $message = test_input($_POST["message"]);
    }
  
    $errorArr = array($nameError,$emailError,$phoneError,$subjectError,$messageError);
    //Filter out any error messages that only contain blank space
    $errorArr = array_filter($errorArr, "test_element");
    
    if (empty($errorArr)){
        //Build email
        $headers = "From: " . $email;
        mail($email_to,$subject,$message,$headers) or die("Error sending email");
    }
    else {
        $errors = "";
        foreach ($errorArr as $value) {
            $errors .= $value . ".";
        }
        die($errors)
    }
}

function test_input($data) {
    $bad = array("content-type","bcc:","to:","cc:","href");
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return str_replace($bad,"",$data);
}

function test_element($var) {
    return trim($var) != '';
}
?>