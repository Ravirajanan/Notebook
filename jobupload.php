<?php
include('./classes/DB.php');
include('./classes/Login.php');
include('./classes/Post.php');
include('./classes/Image.php');
include('./classes/Notify.php');
$quizs = "";
$verified = False;
$isFollowing = False;
if (isset($_GET['token'])){
    if (DB::query('SELECT token FROM login_tokens WHERE token=:token', array(':token'=>$_GET['token']))) {
        $token= DB::query('SELECT token FROM login_tokens WHERE token=:token', array(':token'=>$_GET['token']))[0]['token'];
        $userid = DB::query('SELECT user_id FROM login_tokens WHERE token=:token', array(':token'=>$_GET['token']))[0]['user_id'];
        $username = DB::query('SELECT username FROM users WHERE id=:id', array(':id'=>$userid))[0]['username'];
        $branch = DB::query('SELECT branch FROM users WHERE id=:id', array(':id'=>$userid))[0]['branch'];
        if($username == 'raviraja' OR 'reddy'){
            if(isset($_POST['submit'])){
                if(isset($_POST['new'])){
                    $description = $_POST['new'];
                    $link = $_POST['link'];
                    $bran = $_POST['branch'];
                    DB::query('INSERT INTO jobsdata VALUES (\'\',:branch, :jobtitle_data, :joblink)',array(':branch'=>$bran,':jobtitle_data'=>$description,':joblink'=>$link));

                }
            }
            echo '<form method="post">
                <input type="textarea" name="new"></input>
                <input type="textarea" name="link"></input>
                 <select name="branch">
                    <option value="construction">Construction</option>
                    <option value="electrical">Electrical</option>
                    <option value="electronics">Electronics</option>
                    <option value="software">Software</option>
                     <option value="mechanical">Mechanical</option>
                </select>
                <input type="submit" name="submit" value="submit"></input>
                </form>
            ';
        }else{
            echo 'not an authorised user only for admins i am soo sorry';
        }
    }
}
?>