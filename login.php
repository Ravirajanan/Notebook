<?php
include('classes/DB.php');
include('classes/Mail.php');
$wrong_username = 'none';
$what_wrong = '';
if (isset($_POST['login'])) {
        $_SESSION['username']= $_POST['username'];
        $username = $_POST['username'];
        $password = $_POST['password'];
        if (DB::query('SELECT username FROM users WHERE username=:username', array(':username'=>$username))) {
                if (password_verify($password, DB::query('SELECT password FROM users WHERE username=:username', array(':username'=>$username))[0]['password'])) {
                        echo 'Logged in!';
                        $cstrong = True;
                        $token = bin2hex(openssl_random_pseudo_bytes(64, $cstrong));
                        
                        $user_id = DB::query('SELECT id FROM users WHERE username=:username', array(':username'=>$username))[0]['id'];
                        DB::query('INSERT INTO login_tokens VALUES (\'\', :token, :user_id)', array(':token'=>sha1($token), ':user_id'=>$user_id));
                        setcookie("SNID", $token, time() + 60 * 60 * 24 * 7, '/', NULL, NULL, TRUE);
                        setcookie("SNID_", '1', time() + 60 * 60 * 24 * 3, '/', NULL, NULL, TRUE);
                       $token = DB::query('SELECT token FROM login_tokens WHERE user_id=:user_id', array(':user_id'=>$user_id))[0]['token'];
                       header("location:profile.php?token=$token");
                } else { $wrong_username = 'block';
                $what_wrong = 'password';
                }
        } else {
                $what_wrong = 'username';
                  $wrong_username = 'block';
                        
        }
}
if (isset($_POST['createaccount'])) {
        $_SESSION['username2']= $_POST['username2'];
        $_SESSION['email2']= $_POST['email2'];
        $_SESSION['branch']= $_POST['branch'];
        $username = $_POST['username2'];
        $email = $_POST['email2'];
        $password = $_POST['password2'];
        $password2 = $_POST['password22'];
        $branch = $_POST['branch'];
        $college = $_POST['college'];
        $location = $_POST['location'];
        if (!DB::query('SELECT username FROM users WHERE username=:username', array(':username'=>$username))) {
                if (strlen($username) >= 3 && strlen($username) <= 32) {
                        if (preg_match('/[a-zA-Z0-9_]+/', $username)) {
                                if (strlen($password) >= 6 && strlen($password) <= 60) {
                                        if($password == $password2){
                                if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
                                        if($branch != ''){
                                if (!DB::query('SELECT email FROM users WHERE email=:email', array(':email'=>$email))) {
                                        DB::query('INSERT INTO users VALUES (\'\', :username, :password, :email, \'1\', \'\',:branch,:college,:location)', array(':username'=>$username, ':password'=>password_hash($password, PASSWORD_BCRYPT), ':email'=>$email, ':branch'=>$branch,':college'=>$college, ':location'=>$location ));
                                        Mail::sendMail('Welcome to our Social Network!', 'Your account has been created!', $email);
                                        $what_wrong = 'Congrats-Login into ur account';
                                        $wrong_username = 'block';
                                        $user_id = DB::query('SELECT id FROM users WHERE username=:username', array(':username'=>$username))[0]['id'];
                                        $active = 0;
                                        $p = DB::query('SELECT * FROM branch');
                                        foreach($p as $ping){
                                                DB::query('INSERT INTO jobs VALUES(\'\', :userid, :branch, :active)',array(':userid'=>$user_id,':active'=>$active,':branch'=>$ping['branch_name']));
                                        }
                                } else {
                                        $wrong_username = 'block';
                $what_wrong = 'Email in use!';
                                }
                                }else{
                                        $wrong_username = 'block';
                $what_wrong ='Select Branch';
                                }
                        } else {
                                        $wrong_username = 'block';
                $what_wrong = 'Invalid email!';
                                }
                        }else{
                                $wrong_username = 'block';
                $what_wrong = 'password not matched';
                        }

                        } else {
                                $wrong_username = 'block';
                $what_wrong = 'Invalid password!';
                        }
                        } else {
                                $wrong_username = 'block';
                $what_wrong = 'Invalid username';
                        }
                } else {
                        $wrong_username = 'block';
                $what_wrong = 'Invalid username';
                }
        } else {
                $wrong_username = 'block';
                $what_wrong = 'User already exists!';
        }
}
?>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Untitled</title>
         <link rel="stylesheet" href="css/name_style.css">
    <link rel="stylesheet" href="css/login_notebook_style.css">
</head>

<body>
   <!--<header class="login_header" >
             <p class="login_name" >NOTEBOOK</p>   
   </header>--><body>
    <div class="container">
        <span data-title="N">N</span>
        <span data-title="O">O</span>
        <span data-title="T">T</span>
        <span data-title="E">E</span>
        <span data-title="B">B</span>
        <span data-title="O">O</span>
        <span data-title="O">O</span>
        <span data-title="K">K</span>
        </div>
</body>
  <div class="wrapper" id="wrapper" style="top:42%;bottom:42%;left:0;right:0;">
      <div style="border-bottom: 3px solid #eee;width:149px;padding-right:8px;height:40px;float:right;">   
              <?php 
              $border = '3px solid #337ab7';
              if(isset($_GET['id'])){
$id=$_GET['id'];
if ($id == 1 ){
      echo'<div class="one" id="one"><a class="mode" href="login.php?id=100" style="width:auto; ">Login</a></div>';
      echo '<div class="two" id="two"><a class="mode" href="login.php?id=1" style="width:auto;border-bottom:'.$border.'">signin</a></div>';
      }
      else{echo'<div class="one" id="one"><a class="mode" href="login.php?id=100" style="width:auto;border-bottom:'.$border.' ">Login</a></div>';
      echo '<div class="two" id="two"><a class="mode" href="login.php?id=1" style="width:auto;">signin</a></div>';
      }}

else{echo'<div class="one" id="one"><a class="mode" href="login.php?id=100" style="width:auto;border-bottom:'.$border.' ">Login</a></div>';
      echo '<div class="two" id="two"><a class="mode" href="login.php?id=1" style="width:auto;">signin</a></div>';}?>
      </div>
    </div>
<?php

if(isset($_GET['id'])){
$id=$_GET['id'];
if ($id == 100 ){
echo '<div id="id01" class="modal" >
        <p class="name">Login</p>
        <form method="post" class="form-signin">
                <div style="float:left;width:100%">
                <p >Username</p>
            <input class="form-control" type="text" name="username" value="'.@$_SESSION['username'].'" required placeholder="User Name"  id="username"></div>
            <div style="float:left;width:100%">

                
            <p style="padding-right: 6.5px;">Password</p>
            <input class="form-control" type="password" name="password" required placeholder="Password" id="password">
            </div>
            <div id="wrong" style="display:'.$wrong_username.';width:100%">
            <p style="width: 746px;
    text-align: right;
    padding: 10px;
    margin: 0 20px 0 0;
    border: 2px solid #eee;
    background-color: #b3d9ff;text-align:right;">check '.$what_wrong.'</p></div>
            <div style="float: right; width: 100%; margin-top: 20px;">
              
            <input type="submit" action="profile.php?token=<?php echo $token; ?>" class="btnbtn-primarybtn-blockbtn-lgbtn-signin"  name="login" value="Login"  id="login">
                </div>
        </form><a href="forgot-password.php" class="mode2" style="border-bottom:none;float:left;">Forgot your password?</a>
</div>';}
elseif($id == 1){
echo'
<div id="id02" class="modal">
         <p class="name">sign in</p>
        <form  class="form-signin"method="post">
                <div style="float:left;width:100%">
                <p >Username</p>
            <input class="form-control" type="text" name="username2" value="'.@$_SESSION['username2'].'" required placeholder="User Name" autofocus=""  id="inputUsername"></div>
            <div style="float:left;width:100%">
                    <p style="padding-left:41px;"> Email</p>
            <input class="form-control" type="email" name="email2" value="'.@$_SESSION['email2'].'" required placeholder="Email" autofocus="" id="inputEmail"></div>
            <div style="float:left;width:100%">
            <p style="padding-left:25px;"> College</p>
    <input class="form-control" type="text" name="college"  required placeholder="College" autofocus="" id="collegename"></div> 
            <div style="float:left;width:100%">
            <p style="padding-right: 6.5px;">Password</p>
            <input class="form-control" type="password"  name="password2" required placeholder="Password" id="inputPassword"></div>
            <div style="float:left;width:100%">
            <p style="padding-right: 6.5px;"></p>
            <input class="form-control" style="margin-left:102px;" type="password" name="password22" required placeholder="Re-Enter Password" id="inputPassword"></div>
             <div style="float:left;width:100%"><p style="padding-left: 30px;">branch</p><div style="float: left; width: 25%; margin: 20px;"><select required style="width: 100px; border: 2px solid grey; color: black; border-radius: 3px;" name="branch">
                     <option value=""></option>
<option  value="civil">CIVIL</option>
<option value="mech">MECH</option>
<option value="ece">ECE</option>
<option  value="cse">CSE</option>
</select></div>
<div style="float:left;width:55%;padding-left:9px;">
<input class="form-control" style="width:70%;text-align:right;"type="text"  name="location" required placeholder="Location" id="location">
<p style="padding-left: 10.5px;">Location</p></div>
</div>
            <div id="wrong" style="display:'.$wrong_username.';width:100%">
            <p style="width: 746px;
    text-align: right;
    padding: 10px;
    margin: 0 20px 0 0;
    border: 2px solid #eee;
    background-color: #b3d9ff;text-align:right;">'.$what_wrong.'</p></div>
                
            <div style="float: right; width: 100%; margin-top: 20px;">
                <input type="submit" class="btnbtn-primarybtn-blockbtn-lgbtn-signin"  name="createaccount" value="SIGN IN"></div>
        </form>
</div>';}}
else{
      echo '<div id="id01" class="modal" >
        <p class="name">Login</p>
        <form method="post" class="form-signin">
                <div style="float:left;width:100%">
                <p >Username</p>
            <input class="form-control" type="text" name="username" value="'.@$_SESSION['username'].'" required placeholder="User Name"  id="username"></div>
            <div style="float:left;width:100%">
                    
            
            <p style="padding-right: 6.5px;">Password</p>
            <input class="form-control" type="password" name="password"  required placeholder="Password" id="password">
            </div>
            <div id="wrong" style="display:'.$wrong_username.';width:100%;">
            <p style="    display: block;
    width: 746px;
    text-align: right;
    padding: 10px;
    margin: 0 20px 0 0;
    border: 2px solid #eee;
    background-color: #b3d9ff;text-align:right;">check '.$what_wrong.'</p></div>
            <div style="float: right; width: 100%; margin-top: 20px;">
              
            <input type="submit" action="profile.php?token=<?php echo $token; ?>" class="btnbtn-primarybtn-blockbtn-lgbtn-signin"  name="login" value="Login"  id="login">
                </div>
        </form><a href="forgot-password.php" class="mode2" style="border-bottom:none;float:left;">Forgot your password?</a>
</div>';  
}

?>
     
       
    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/bootstrap/js/bootstrap.min.js"></script>
    
    
    
</body>

