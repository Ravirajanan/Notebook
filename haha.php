<?php
include('./classes/DB.php');
include('./classes/Login.php');
include('./classes/Post.php');
include('./classes/Image.php');
include('./classes/Notify.php');
include('./classes/comment.php');
include('header.php');
$username = "";
$dir='uploads/';
$verified = False;
$isFollowing = False;
if (isset($_GET['token'])) {
        if (DB::query('SELECT token FROM login_tokens WHERE token=:token', array(':token'=>$_GET['token']))) {
                $token= DB::query('SELECT token FROM login_tokens WHERE token=:token', array(':token'=>$_GET['token']))[0]['token'];
                $userid = DB::query('SELECT user_id FROM login_tokens WHERE token=:token', array(':token'=>$_GET['token']))[0]['user_id'];
                $username = DB::query('SELECT username FROM users WHERE id=:id', array(':id'=>$userid))[0]['username'];
                $verified = DB::query('SELECT verified FROM users WHERE id=:id', array(':id'=>$userid))[0]['verified'];
                $profile_pic = DB::query('SELECT profile_pic FROM users WHERE id=:id', array(':id'=>$userid))[0]['profile_pic'];
                $email = DB::query('SELECT email FROM users WHERE id=:id', array(':id'=>$userid))[0]['email'];
                $branch = DB::query('SELECT branch FROM users WHERE id=:id', array(':id'=>$userid))[0]['branch'];
                $college = DB::query('SELECT college FROM users WHERE id=:id', array(':id'=>$userid))[0]['college'];
                $location = DB::query('SELECT location FROM users WHERE id=:id', array(':id'=>$userid))[0]['location'];
                $followerid = Login::isLoggedIn();
                if (isset($_POST['follow'])) {
                        if ($userid != $followerid) {
                                if (!DB::query('SELECT follower_id FROM followers WHERE user_id=:userid AND follower_id=:followerid', array(':userid'=>$userid, ':followerid'=>$followerid))) {
                                        if ($followerid == 6) {
                                                DB::query('UPDATE users SET verified=1 WHERE id=:userid', array(':userid'=>$userid));
                                        }
                                        DB::query('INSERT INTO followers VALUES (\'\', :userid, :followerid)', array(':userid'=>$userid, ':followerid'=>$followerid));
                                } else {
                                        echo 'Already following!';
                                }
                                $isFollowing = True;
                        }
                }
                if (isset($_POST['unfollow'])) {
                        if ($userid != $followerid) {
                                if (DB::query('SELECT follower_id FROM followers WHERE user_id=:userid AND follower_id=:followerid', array(':userid'=>$userid, ':followerid'=>$followerid))) {
                                        if ($followerid == 6) {
                                                DB::query('UPDATE users SET verified=0 WHERE id=:userid', array(':userid'=>$userid));
                                        }
                                        DB::query('DELETE FROM followers WHERE user_id=:userid AND follower_id=:followerid', array(':userid'=>$userid, ':followerid'=>$followerid));
                                }
                                $isFollowing = False;
                        }
                }
                if (DB::query('SELECT follower_id FROM followers WHERE user_id=:userid AND follower_id=:followerid', array(':userid'=>$userid, ':followerid'=>$followerid))) {
                        //echo 'Already following!';
                        $isFollowing = True;
                }
                if (isset($_POST['deletepost'])) {
                        if (DB::query('SELECT id FROM posts WHERE id=:postid AND user_id=:userid', array(':postid'=>$_GET['postid'], ':userid'=>$followerid))) {
                                DB::query('DELETE FROM posts WHERE id=:postid and user_id=:userid', array(':postid'=>$_GET['postid'], ':userid'=>$followerid));
                                DB::query('DELETE FROM post_likes WHERE post_id=:postid', array(':postid'=>$_GET['postid']));
                                echo 'Post deleted!';
                        }
                }
                if(isset($_POST['comment'])){
                        Comment::createcomment($_POST['commentbody'],$_POST['postid'],$userid);
                }
                if (isset($_GET['postid']) && !isset($_POST['deletepost'])) {
                        Post::likePost($_GET['postid'], $followerid);
                }
                
        } else {
                die('User not found!');
        }
        
}
else{
        die ('check the page');
}

/*<!--<h1><?php echo $username; ?>'s Profile<?php if ($verified) { echo ' - Verified'; } ?></h1>
<form action="profile.php?token=<?php echo $token; ?>" method="post">
        <?php
        if ($userid != $followerid) {
                if ($isFollowing) {
                        echo '<input type="submit" name="unfollow" value="Unfollow">';
                } else {
                        echo '<input type="submit" name="follow" value="Follow">';
                }
        }
        ?>
</form>
-->*/


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
    <div class="profile-links">
            <form method="post">
        <a role="presentation" href="profile.php?token=<?php echo$token; ?>&id=100" class="profile-data-buttons" id="home">About</a>
        <a role="presentation" href="profile.php?token=<?php echo$token; ?>&id=101" class="profile-data-buttons" id="notes">Notes</a>
        <a role="presentation" href="profile.php?token=<?php echo$token; ?>&id=102" class="profile-data-buttons" id="posts">Posts</a>
        <a  role="presentation" href="create-post.php?token=<?php echo$token; ?>" class="profile-data-buttons" id="posts">cPosts</a>
        </form>
    </div>
<div class="about" id="change">
  <div>



          <div id="1020" style= "display:block;width:950px;float:left;margin:0 150px;">
          <?php
           $i = 1;$float='left';
$followingposts = DB::query('SELECT * FROM posts WHERE user_id=:user_id', array(':user_id'=>$userid));
foreach($followingposts as $post) {
        $report = 0 ;
        
        if(!DB::query('SELECT report FROM reports WHERE postid = :postid AND userid=:userid', array(':postid'=>$post['id'], ':userid'=>$userid ))){
          
        $report = DB::query('SELECT report FROM reports WHERE postid = :postid AND userid=:userid', array(':postid'=>$post['id'], ':userid'=>$userid ));
        if ($report != 1){
        if ($i % 2 == 0){
                $float='right';
                $i=$i+1;
        }else{
                $float='left';
                $i=$i+1;
        }
 echo '<div class="post" style="float:'.$float.'">';
        echo'<div class="contents" style="float:'.$float.'">';
            
            
            
            echo '
            <div class="post-style">';
            
            echo '<div class="yeswanth"><a role="presentation" class="name2" style="border-bottom: 2.5px solid #eee;float:'.$float.';" href="#">'.$username.'</a> </div>'; 
            echo '<a href="post-details.php?token='.$token.'&post='.$post['id'].'"><div style="height:auto;width:100%;float:'.$float.';color: black;"> ';
            echo '<p class="post-username-style" style="width:100%;text-align:'.$float.';font-family:segoe ui;">'.$post['title'].'</p>';
            if ($post['image'] == 0 or $post['image'] == ''){
            echo '<div><p class="post-content-style" style="float:'.$float.';font-family:segoe ui;text-align:justify;">'.$post['body'].'</p>
            </div></a>';
            }else{
                   echo '<div><img src="'.$dir.$post['image'].'" style="float:'.$float.';width:29%;margin-right:1%;margin-left:1%;" width="150px" height="200px">
                   <p class="post-content-style" style="float:'.$float.';font-family:segoe ui;width:69%;text-align:'.$float.';">'.$post['body'].'</p>
                   
                   </div>'; 
            }
        echo '<div style="height:40px;padding-right:10px">';
                if (!DB::query('SELECT post_id FROM post_likes WHERE post_id=:postid AND user_id=:userid', array(':postid'=>$post['id'], ':userid'=>$userid))) {
        echo '<a role="presentation"  class="name2" name="like" style="font-weight:bold;float:'.$float.';" href="profile.php?token='.$token.'&id='.$id.'&postid='.$post['id'].'"><span>'.$post['likes'].' </span>LIKE</a>';
        } else {
        echo '<a role="presentation" class="name2" style="color:darkred;font-weight:bold;float:'.$float.';" name="unlike" href="profile.php?token='.$token.'&id='.$id.'&postid='.$post['id'].'">UNLIKE</a>';
        }
            
            echo "<a class='name2' id=".$post['id']." style='width:auto;float:".$float.";'>Comments</a>";
                
        
                
        
echo "<div class='yeswanth' id=".$i." style='width: 100%; border: 2px solid rgb(238, 238, 238); float: left; height: auto; padding: 4% 0px; margin: 5px 0px;display:none;'></form>
        <form style='float: left; height: 40px; width: 90%; padding: 0px 5%; z-index: 0;' method='post'>
        <textarea style='border: 2px solid rgb(238, 238, 238); height: 40px; float: left; resize: none; width: 700px;' name='commentbody' rows='3' cols='auto'></textarea>
        <input name='postid' value=".$post['id']." style='display: none;'></input>
        <input style='float: left; padding: 7px; background-color: white; box-shadow: none; font-family: segoe ui; height: 45px; border: medium none;' type='submit' name='comment' value='Comment'>
        </form></div>
        ";


        echo "
        </div>   
        
               ";
        echo '</div>';
    echo'</div></div></div>';
    
    echo 
'<script type="text/javascript">
$(document).ready(function()
{
$("#'.$post['id'].'").click(function()
{
$("#'.$i.'").fadeToggle(0);

return false;
});
});</script>';
        }
        }
?>
</div>
 



<div>

        <div id="1001" style="display:block;width:950px;float:left;margin:0 150px;">
<?php        $i = 1;$float='left';
        $noid = DB::query('SELECT * FROM notes WHERE userid=:userid ORDER BY id DESC', array(':userid'=>$userid));
        foreach($noid as $nid) {
         $dbposts = DB::query('SELECT * FROM posts WHERE id=:nid ', array(':nid'=>$nid['postid']));
                foreach($dbposts as $p) {
                        $name=DB::query('SELECT username FROM users WHERE id=:id ', array(':id'=>$p['user_id']))[0]['username'];
                                if ($i % 2 == 0){
                $float='right';
                $i=$i+1;
        }else{
                $float='left';
                $i=$i+1;
        }
 echo '<div class="post" style="float:'.$float.'">';
        echo'<div class="contents" style="float:'.$float.'">';
            
            
            
            echo '
            <div class="post-style">';
            
            echo '<div class="yeswanth"><a role="presentation" class="name2" style="border-bottom: 2.5px solid #eee;float:'.$float.';" href="#">'.$name.'</a> </div>'; 
            echo '<a href="post-details.php?token='.$token.'&post='.$p['id'].'"><div style="height:auto;width:100%;float:'.$float.';color: black;"> ';
            echo '<p class="post-username-style" style="width:100%;text-align:'.$float.';font-family:segoe ui;">'.$p['title'].'</p>';
            if ($p['image'] == 0 or $p['image'] == ''){
            echo '<div><p class="post-content-style" style="float:'.$float.';font-family:segoe ui;text-align:justify;">'.$p['body'].'</p></div>
            </div></a>';
            }else{
                   echo '<div><img src="'.$dir.$p['image'].'" style="float:'.$float.';width:29%;margin-right:1%;margin-left:1%;" width="150px" height="200px">
                   <p class="post-content-style" style="float:'.$float.';font-family:segoe ui;width:69%;text-align:'.$float.';">'.$p['body'].'</p>
                   
                   </div>
            </div>'; 
            }
        echo '<div style="height:40px;padding-right:10px">';
               
            
            echo "<a class='name2' id=".$p['id']." style='width:auto;float:".$float.";'>Comments</a>";
                
        
                
        
echo "<div class='yeswanth' id=".$i." style='width: 100%; border: 2px solid rgb(238, 238, 238); float: left; height: auto; padding: 4% 0px; margin: 5px 0px;display:none;'></form>
        <form style='float: left; height: 40px; width: 90%; padding: 0px 5%; z-index: 0;' method='post'>
        <textarea style='border: 2px solid rgb(238, 238, 238); height: 40px; float: left; resize: none; width: 700px;' name='commentbody' rows='3' cols='auto'></textarea>
        <input name='postid' value=".$p['id']." style='display: none;'></input>
        <input style='float: left; padding: 7px; background-color: white; box-shadow: none; font-family: segoe ui; height: 45px; border: medium none;' type='submit' name='comment' value='Comment'>
        </form></div>
        ";
        echo "
        </div>   
        
               ";
        echo '</div>';
    
     
      echo 
'<script type="text/javascript">
$(document).ready(function()
{
$("#'.$p['id'].'").click(function()
{
$("#'.$i.'").fadeToggle(0);

return false;
});
});</script>';
                }
        }
       ?>
</div>
</div>
<div>
        <div id="100" style="display:block;">
                <?php
echo '<div class="profile-pic">';

        echo'
        <div >
            <img src="'.$dir.$profile_pic.'" width="95%" height="235px" class="profile-image">
        </div>';
        echo'
        <h2>A Word about you</h2>
        <h3>THERE IS NO TOMORROW_END TONIGHT</h3>
</div>
<div class="profie-details">
        <h1 class="profie-name">'.$username.'</h1>
        <h3> '.$email.'</h3>
        <h1>'.$branch.'</h1>';
        if($college){ echo '<h2>College</h2>
                <h3>'.$college.'</h3>';}
                if($location){ echo '<h2>Address</h2>
                <h3>'.$location.'</h3>';}
'</div>
';

echo '<div class="profile-links" style="width:50px;float:right;margin-top: -3px;
border-bottom: 0px solid rgb(238, 238, 238);">
<a role="presentation" onclick="document.getElementById(\'id02\').style.display=\'block\'" class="profile-data-buttons2" style="color:black;" id="edit">Edit</a>
</div>
';

}
?>
</div>
</div>
<?php   
        if(isset($_POST['update'])){
                 $usernamenew = $_POST['usernamenew'];
                $emailnew = $_POST['emailnew'];
                $branchnew = $_POST['branchnew'];
                if(isset($_FILES['postimg'])){
                if ($_FILES['postimg']['size'] == 0) {
                        $result = DB::query('UPDATE users  SET username=:usernamenew,email=:emailnew,branch=:branchnew WHERE id=:userid',array(':userid'=>$userid,':usernamenew'=>$usernamenew, ':emailnew'=>$emailnew, ':branchnew'=>$branchnew) );
                } else {
                       $image = Image::uploadImage($_FILES['postimg']);
                       
                        $result = DB::query('UPDATE users  SET username=:usernamenew,email=:emailnew,branch=:branchnew,profile_pic=:profile_pic WHERE id=:userid',array(':userid'=>$userid,':usernamenew'=>$usernamenew, ':emailnew'=>$emailnew, ':branchnew'=>$branchnew,':profile_pic'=>$image)); 
                       
                }
                }
        }
        
?>
    

    <div id="id02" class="modal">
        <form action="profile.php?token=<?php echo $token;?>" enctype="multipart/form-data" class="form-signin" method="post">
            <input class="form-control" type="text" name="usernamenew" required="" value="<?php  echo $username;?>" placeholder="User Name" autofocus="" id="inputUsername">
            <input class="form-control" type="email" name="emailnew" required="" value="<?php  echo $email;?>" placeholder="Email" autofocus="" id="inputEmail">
            New image: <input type="file" name="postimg">
            <br/>
            <select name="branchnew">
                <option value="civil">CIVIL</option>
                <option value="mech">MECH</option>
                <option value="ece">ECE</option>
                <option value="cse">CSE</option>
        </select>


            <div style="    padding: 10px;
    width: 70%;
    height: 48px;
    margin: 0px;"><button type="button" onclick="document.getElementById('id02').style.display='none'" class="cancelbtn">Cancel</button> 
                <input type="submit"  class="submitbutton" style=" width: 35%;" name="update" value="Submit"></div>
        </form>
</div>
<script>
        function hide(var show,var hide1,var hide2)
        {
                document.getElementById('show').style.display='block';
                document.getElementById('hide1').style.display='none';
                document.getElementById('hide2').style.display='none';
        }
</script>
</body>
</html>
