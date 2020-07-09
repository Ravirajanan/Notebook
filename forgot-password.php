<?php
include('./classes/DB.php');
include('./classes/Mail.php');
$wrong_username = 'none';
$what_wrong = '';
$user_id="";
if (isset($_POST['resetpassword'])) {
        $cstrong = True;
        $email=$_POST['email'];
        $token = bin2hex(openssl_random_pseudo_bytes(64, $cstrong));
        if(DB::query('SELECT email FROM users WHERE email=:email', array(':email'=>$_POST['email']))){
        $user_id = DB::query('SELECT id FROM users WHERE email=:email', array(':email'=>$email))[0]['id'];
        //DB::query('INSERT INTO password_tokens VALUES (\'\', :token, :user_id)', array(':token'=>sha1($token), ':user_id'=>$user_id));
        //Mail::sendMail('Forgot Password!', "<a href='http://localhost/tutorials/sn/change-password.php?token=$token'>http://localhost/tutorials/sn/change-password.php?token=$token</a>", $email);
        $wrong_username="block";
        $what_wrong="Email Sent";
        }
        else{
                $wrong_username="block";
                $what_wrong="Check Email";
        }
        
}
?>
<html>
        <head>
        <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">        
        <title>Forgot-password</title>
        <link rel="stylesheet" href="css/name_style.css">
        <link rel="stylesheet" href="css/login_notebook_style.css">
        </head>
        <body>
        <div style="border-bottom: 3px solid #337ab7;padding-bottom:25px;" class="container">
        <span data-title="N">N</span>
        <span data-title="O">O</span>
        <span data-title="T">T</span>
        <span data-title="E">E</span>
        <span data-title="B">B</span>
        <span data-title="O">O</span>
        <span data-title="O">O</span>
        <span data-title="K">K</span>
        </div>
        <p class="name" style="font-size:50px;padding-left:25px;">Forgot password..</p>
        <p class="name" style="color:black;font-size:larger;padding:0 25px 0 25px;">Don't worry about it, enter your registerd email below and an alternate password is sent to your email and by that you can login and you can change your password in your profile edit...</p> 
        <form method="post" class="form-signin">
        <div style="float:left;width:100%">
        <p style="padding-left:41px;"> Email</p>
    <input class="form-control" type="text" name="email" value="" required placeholder="Registered Email"  id="email"></div>
    <?php echo'<div id="wrong" style="display:'.$wrong_username.';";width:100%">
            <p style="width:79.5%;
    text-align: right;
    padding: 10px;
    margin: 0 0 0 9.5%;
    border: 2px solid #eee;
    background-color: #b3d9ff;text-align:right;">'.$what_wrong.'</p></div>';
    ?>
    <div style="float: right; width: 100%; margin-top: 20px;">
                <input type="submit" class="btnbtn-primarybtn-blockbtn-lgbtn-signin"  name="resetpassword" value="GENERATE"></div>
</form>    
 </body>

</html>