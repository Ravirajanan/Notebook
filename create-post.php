<?php
include('./classes/DB.php');
include('./classes/Login.php');
include('./classes/Post.php');
include('./classes/Image.php');
include('./classes/Notify.php');
include('header.php');
$username = "";
$verified = False;
$isFollowing = False;
if (isset($_GET['token'])) {
        if (Login::isLoggedIn()) {
        $userid = Login::isLoggedIn();
        $showTimeline = True;

        if (DB::query('SELECT token FROM login_tokens WHERE token=:token', array(':token'=>$_GET['token']))) {
                $token= DB::query('SELECT token FROM login_tokens WHERE token=:token', array(':token'=>$_GET['token']))[0]['token'];
                $userid = DB::query('SELECT user_id FROM login_tokens WHERE token=:token', array(':token'=>$_GET['token']))[0]['user_id'];
                $username = DB::query('SELECT username FROM users WHERE id=:id', array(':id'=>$userid))[0]['username'];
                $verified = DB::query('SELECT verified FROM users WHERE id=:id', array(':id'=>$userid))[0]['verified'];
                $email = DB::query('SELECT email FROM users WHERE id=:id', array(':id'=>$userid))[0]['email'];
                $branch = DB::query('SELECT branch FROM users WHERE id=:id', array(':id'=>$userid))[0]['branch'];
                $followerid = Login::isLoggedIn();
                

                if (isset($_POST['post'])) {
                        if ($_FILES['postimg']['size'] == 0) {
                               Post::createPost($_POST['posttitle'],$_POST['postbody'], Login::isLoggedIn(), $userid, $branch);
                            
                        $sec = "1";
                        
                        echo '<html>
                        <head><meta http-equiv="header" content="'.$sec.'";URL="profile.php?token='.$token.'"></head>
                        </html>';
                        } else {
                                $image = Image::uploadImage($_FILES['postimg']);
                                $postid = Post::createImgPost($_POST['posttitle'],$_POST['postbody'], Login::isLoggedIn(), $image, $userid, $branch);
                                
                               $sec = "1";
                        echo $postId;
                        echo $commentBody;
                        echo '<html>
                        <head><meta http-equiv="refresh" content="'.$sec.'";URL="profile.php?token='.$token.'"></head>
                        </html>';
                        }
                } 
        } else {
                die('User not found!');
        }       
        }
}else{
    die('not logged in');
}

?>
<head>
    <title>NOTEBOOK</title>
    <script src="ckeditor/ckeditor.js"> </script>
</head>
<form  method="post" enctype="multipart/form-data" >

        <h3>TITLE</h3>
        <textarea name="posttitle" style="width: 96%;margin:0% 2%; height: 50px;"></textarea>
        <h3>Post Body</h3>
        <textarea name="postbody" id="" cols="30" rows="10" style="width: 96%;margin:0% 2%;"></textarea> </textarea>
        <br /><h3 style="margin: 2%;width: 12%;float: left;padding: 0% 0% 0% 2%;" >Upload an image:</h3>
        <input type="file" style="float:left;margin:2%;" name="postimg">
        <input type="submit" style="float:left;margin:2%;" name="post" value="Post" >
</form>