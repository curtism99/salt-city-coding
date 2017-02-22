<?php
$name;$email;$comments;$captcha;
if(isset($_POST['name'])){
    $name=filter_input(INPUT_POST, 'name', FILTER_SANITIZE_STRING);
}if(isset($_POST['email'])){
    $email=filter_input(INPUT_POST, 'email', FILTER_SANITIZE_STRING);
}if(isset($_POST['comments'])){
    $comments=filter_input(INPUT_POST, 'comments', FILTER_SANITIZE_STRING);
}if(isset($_POST['company'])) {
    $company=filter_input(INPUT_POST, 'company', FILTER_SANITIZE_STRING);
}if(isset($_POST['telephone'])) {
    $telephone=filter_input(INPUT_POST, 'telephone', FILTER_SANITIZE_STRING);
}if(isset($_POST['g-recaptcha-response'])){
    $captcha=$_POST['g-recaptcha-response'];
}
if(!$captcha){
    die("1");
}
$response=file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=6LenRBoTAAAAAOQzGLJxZuJlZvyFhOPJq1agDWJr&response=".$captcha."&remoteip=".$_SERVER['REMOTE_ADDR']);
if($response.success==false) {
    echo '<h2>You are spammer !</h2>';
    die("2");
} else {
    $notice = "Got past captcha";
             $headers = "MIME-Version: 1.0" . "\r\n";
        $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
        $headers .= "From: Salt City Coding <comments@saltcitycoding.com> \r\n";
        $subject = "Question or Comment Submitted";
        $body = "Begin message from website: <br><br>
                    Name: " . $name . "<br>
                    E-mail: " . $email . "<br>
                    Comments: " . $comments . "
                    <br><br>
                    ---------------------";

        mail("curtismullins@gmail.com", $subject, $body, $headers);
    die("3");

}

die("4");

?>
