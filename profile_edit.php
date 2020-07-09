<?php

include('./classes/DB.php');
include('./classes/Login.php');
include('./classes/Post.php');
include('./classes/Comment.php');
include('./classes/Notify.php');
include('header.php');
$dir='uploads/';

if(isset($_POST['submit'])){
    $unnew = $_POST['username'];
    $bnew = $_POST['branch'];
    $cnew = $_POST['college'];
    $lnew = $_POST['location'];
    DB::query('UPDATE users SET username=:username,branch=:branch,college=:college,location=:location WHERE id=:userid', array(':userid'=>$userid,':username'=>$unnew,':branch'=>$bnew,':college'=>$cnew,':location'=>$lnew));
}
$token= DB::query('SELECT token FROM login_tokens WHERE token=:token', array(':token'=>$_GET['token']))[0]['token'];
$userid = DB::query('SELECT user_id FROM login_tokens WHERE token=:token', array(':token'=>$_GET['token']))[0]['user_id'];
$username = DB::query('SELECT username FROM users WHERE id=:id', array(':id'=>$userid))[0]['username'];
$verified = DB::query('SELECT verified FROM users WHERE id=:id', array(':id'=>$userid))[0]['verified'];
$profile_pic = DB::query('SELECT profile_pic FROM users WHERE id=:id', array(':id'=>$userid))[0]['profile_pic'];
$email = DB::query('SELECT email FROM users WHERE id=:id', array(':id'=>$userid))[0]['email'];
$branch = DB::query('SELECT branch FROM users WHERE id=:id', array(':id'=>$userid))[0]['branch'];
$college = DB::query('SELECT college FROM users WHERE id=:id', array(':id'=>$userid))[0]['college'];
$location = DB::query('SELECT location FROM users WHERE id=:id', array(':id'=>$userid))[0]['location'];

?>
<!DOCTYPE html>
<html>
<head>
    <title>only new style</title>
    <script src="js/jquery-3.2.1.js"></script>
    <meta charset="utf-8">
    <meta name="viewport" content="width=fixed,maximum-scale=1.0, initial-scale=1.0, user-scalable=no">
     
    <script type="text/javascript" src="js/jquery.min.js"></script>
</head>
<body>
    <h1>EDIT</h1>
    <form method='post' >
        <input type="text" name="username" value="<?php echo $username;?>"></input>
        <select name="branch">
                <option value="<?php echo $branch;?>"><?php echo $branch;?></option>
                <option value="civil">CIVIL</option>
                <option value="mech">MECH</option>
                <option value="ece">ECE</option>
                <option value="cse">CSE</option>
        </select>
        
        <input type="text" name="college" value="<?php echo $college;?>">
        <input type="text" name="location" value="<?php echo $location;?>">
        <img src="<?php echo $dir;echo $profile_pic;?>" alt="">
        <input type="submit" name="submit" value="submit">
    </form>
</body>