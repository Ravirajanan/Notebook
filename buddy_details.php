<?php
include('./classes/DB.php');
include('./classes/Login.php');
include('./classes/Post.php');
include('./classes/Image.php');
include('./classes/Notify.php');
include('header.php');
include('./classes/request.php');
$username = "";
$dir='uploads/';
$verified = False;
$isFollowing = False;
if (isset($_GET['token'])) {
    if (DB::query('SELECT token FROM login_tokens WHERE token=:token', array(':token'=>$_GET['token']))) {
        $userid2 = DB::query('SELECT user_id FROM login_tokens WHERE token=:token',array(':token'=>$_GET['token']))[0]['user_id'];
        if(isset($_GET['username'])){
            if (DB::query('SELECT username FROM users WHERE username=:username', array(':username'=>$_GET['username']))) {            
                $userid = DB::query('SELECT id FROM users WHERE username=:username', array(':username'=>$_GET['username']))[0]['id'];
                $username = DB::query('SELECT username FROM users WHERE id=:id', array(':id'=>$userid))[0]['username'];
                $verified = DB::query('SELECT verified FROM users WHERE id=:id', array(':id'=>$userid))[0]['verified'];
                $email = DB::query('SELECT email FROM users WHERE id=:id', array(':id'=>$userid))[0]['email'];
                $branch = DB::query('SELECT branch FROM users WHERE id=:id', array(':id'=>$userid))[0]['branch'];
                $profile_pic = DB::query('SELECT profile_pic FROM users WHERE id=:id', array(':id'=>$userid))[0]['profile_pic'];
                $college = DB::query('SELECT college FROM users WHERE id=:id', array(':id'=>$userid))[0]['college'];
                $location = DB::query('SELECT location FROM users WHERE id=:id', array(':id'=>$userid))[0]['location'];
                $followerid = Login::isLoggedIn();
                if (isset($_GET['postid'])) {
                    Post::likePost($_GET['postid'], $userid2);
                }
                if (isset($_GET['notes'])) {
                    Post::notePost($_GET['notes'], $userid);
                }
                if (isset($_GET['request'])) {
                    Post::sendrequest($_GET['request'],$userid,$userid2);
                }
            }
            else{
                die ('not an user');
            }
        }    
    }
    
}
else{
    die('check');
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>only new style</title>
    <script src="js/jquery-3.2.1.js"></script>
    <meta charset="utf-8">
    <meta name="viewport" content="width=fixed,maximum-scale=1.0, initial-scale=1.0, user-scalable=no">
     <link rel="stylesheet" href="profile-style.css">
     <link rel="stylesheet" href="style2.css">
     <script type="text/javascript" src="js/jquery.min.js"></script>
</head>
<body>
<?php
if(DB::query('SELECT * FROM followers WHERE user_id=:user_id AND follower_id=:follower_id',array(':follower_id'=>$followerid, ':user_id'=>$userid))){
echo '<a role="presentation"  class="profile-data-buttons2" style="color:black;" id="edit">friends</a>';}
else{
    if(DB::query('SELECT * FROM requests WHERE user_id=:user_id AND request_id=:request_id',array(':request_id'=>$userid2, ':user_id'=>$userid))){
        echo '<a role="presentation"  class="profile-data-buttons2" style="color:black;" id="edit">Request-sent</a>';}
    else{    
    echo '<a role="presentation"  class="profile-data-buttons2" style="color:black;"href="buddy_details.php?token='.$token.'&username='.$username.'&request=ok" id="edit">Add Friend</a>';
}}
?>
<div id="100" style="float: left; width: 100%;" >
<div class="profile-pic">
        
        <div >
            <img src="<?php echo$dir.$profile_pic;?>" width="95%" height="235px" class="profile-image">
        </div>
        <h2>A Word about you</h2>
        <h3>THERE IS NO TOMORROW_END TONIGHT</h3>
</div>
<div class="profie-details">
        <h1 class="profie-name"><?php echo $username;?></h1>
        <h3> <?php echo $email;?></h3>
        <h1><?php echo $branch;?></h1>
        <?php 
        if($college){ echo '<h2>College</h2>
        <h3>'.$college.'</h3>';}
        if($location){ echo '<h2>Address</h2>
        <h3>'.$location.'</h3>';}?>
</div>
</div>
<?php

echo '<h1>NOTES</h1>';
$i = 1;$float='left';
$followingposts = DB::query('SELECT posts.image,posts.id,posts.title,posts.user_id, posts.body, posts.likes FROM posts 
WHERE posts.user_id = :postid
ORDER BY posts.likes DESC;',array(':postid'=>$userid));
foreach($followingposts as $post) {
        $report = 0 ;
        $i=$i+1;
        if(!DB::query('SELECT report FROM reports WHERE postid = :postid AND userid=:userid', array(':postid'=>$post['id'], ':userid'=>$userid ))){
          
        $report = DB::query('SELECT report FROM reports WHERE postid = :postid AND userid=:userid', array(':postid'=>$post['id'], ':userid'=>$userid ));

 echo '<div class="post" style="float:'.$float.'">';
        echo'<div class="contents" style="float:'.$float.'">';
            
            
            
            echo '
            <div class="post-style">';
            
             
            echo '<div style="height:auto;width:100%;float:'.$float.';"> ';
            echo '<p class="post-username-style" style="width:100%;text-align:'.$float.';font-family:segoe ui;">'.$post['title'].'</p>';
            if ($post['image'] == 0 or $post['image'] == ''){
            echo '<div><p class="post-content-style" style="float:'.$float.';font-family:segoe ui;text-align:justify;">'.$post['body'].'</p></div>
            </div>';
            }else{
                   echo '<div ><img src="'.$dir.$post['image'].'" style="float:'.$float.';width:29%;margin-right:1%;margin-left:1%;" width="150px" height="200px">
                   <p class="post-content-style" style="float:'.$float.';font-family:segoe ui;width:69%;text-align:'.$float.';">'.$post['body'].'</p>
                   
                   </div>
            </div>'; 
            }
        echo '<div style="height:40px;padding-right:10px">';
               if (!DB::query('SELECT post_id FROM post_likes WHERE post_id=:postid AND user_id=:userid', array(':postid'=>$post['id'], ':userid'=>$userid2))) {
        echo '<a role="presentation"  class="name2" name="like" style="font-weight:bold;float:'.$float.';" href="buddy_details.php?token='.$token.'&username='.$username.'&postid='.$post['id'].'"><span>'.$post['likes'].' </span>LIKE</a>';
        } else {
        echo '<a role="presentation" class="name2" style="color:darkred;font-weight:bold;float:'.$float.';" name="unlike" href="buddy_details.php?token='.$token.'&username='.$username.'&postid='.$post['id'].'">UNLIKE</a>';
        }
            
       
        echo '<a role="presentation" name="report" class="name2" style="float:'.$float.';" href="buddy_details.php?token='.$token.'&username='.$username.'&notes='.$post['id'].'">Add-Note</a>';
          
         

echo "</div></div>";
        echo "
        </div>   
        
               ";
        echo '</div>';
    echo'</div>';
        
    
        }
}
?>
</body>
</html>