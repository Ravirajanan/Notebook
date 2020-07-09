<?php
include('./classes/DB.php');
include('./classes/Login.php');
include('./classes/Post.php');
include('./classes/Comment.php');
include('./classes/Notify.php');
include('header.php');
$branch= "";
$showcivilTimeline = False;
if(isset($_GET['token'])){
$token=$_GET['token'];
if (Login::isLoggedIn()) {
        $userid = Login::isLoggedIn();
        $showcivilTimeline = True;
} else {
        echo 'Not logged in';
}
if (isset($_GET['token'])){
 if (DB::query('SELECT token FROM login_tokens WHERE token=:token', array(':token'=>$_GET['token']))) {
         $userid=DB::query('SELECT user_id FROM login_tokens WHERE token=:token', array(':token'=>$_GET['token']))[0]['user_id'];
               $branch=DB::query('SELECT branch FROM users WHERE id=:id', array(':id'=>$userid))[0]['branch'];
 }else{  die('not an user');}
}else{
        die ('not logged in');
}
if (isset($_GET['postid'])) {
        Post::likePost($_GET['postid'], $userid);
}
if(isset($_POST['comment'])){
        Comment::createcomment($_POST['commentbody'],$_POST['postid'],$userid);
}


}
else {die('Not an specified user');}


?>






<html>
<head>
    <title>only new style</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=fixed,maximum-scale=1.0, initial-scale=1.0, user-scalable=no">
     <link rel="stylesheet" href="style2.css">
</head>
<body>
    <h1><?php echo $branch; ?></h1>
     <?php
   
            $i = 1;$float='left';
$posts = DB::query('SELECT posts.image,posts.id,posts.title, posts.body, posts.likes, users.`username`,posts.`branchid` FROM users, posts
WHERE posts.user_id
AND users.id = posts.user_id
AND user_id
AND posts.branchid = :branchid
ORDER BY posts.likes DESC;', array(':branchid'=>$branch));  
foreach($posts as $post) {
$report = 0 ;
echo '<div style="width:950px;float:left;margin:0 150px;">';
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
            
            echo '<div class="yeswanth"><a role="presentation" class="name2" style="border-bottom: 2.5px solid #eee;;float:'.$float.';" href="#">'.$post['username'].'</a> </div>'; 
            echo '<a style="text-decoration:none;color:black;" href="post-details.php?token='.$token.'&post='.$post['id'].'"><div style="height:auto;width:100%;float:'.$float.';"> ';
            echo '<p class="post-username-style" style="width:100%;text-align:'.$float.';font-family:segoe ui;">'.$post['title'].'</p>';
            if ($post['image'] == 0 or $post['image'] == ''){
            echo '<div><p class="post-content-style" style="float:'.$float.';font-family:segoe ui;text-align:justify;">'.$post['body'].'</p></div>
            </div>';
            }else{
                   echo '<div ><img src="'.$dir.$post['image'].'" style="float:'.$float.';width:29%;margin-right:1%;margin-left:1%;" width="150px" height="200px">
                   <p class="post-content-style" style="float:'.$float.';font-family:segoe ui;width:69%;text-align:'.$float.';">'.$post['body'].'</p>
                   
                   </a></div>
            </div>'; 
            }
        echo '<div style="height:40px;padding-right:10px">';
                if (!DB::query('SELECT post_id FROM post_likes WHERE post_id=:postid AND user_id=:userid', array(':postid'=>$post['id'], ':userid'=>$userid))) {
        echo '<a role="presentation"  class="name2" name="like" style="font-weight:bold;float:'.$float.';" href="index.php?token='.$token.'&postid='.$post['id'].'"><span>'.$post['likes'].' </span>LIKE</a>';
        } else {
        echo '<a role="presentation" class="name2" style="color:darkred;font-weight:bold;float:'.$float.';" name="unlike" href="index.php?token='.$token.'&postid='.$post['id'].'">UNLIKE</a>';
        }
            
        echo "<a class='name2' id=".$post['id']." style='width:auto;float:".$float.";'>Comments</a>";
                echo '<a role="presentation" name="report" class="name2" style="float:'.$float.';" href="branch.php?token='.$token.'&notes='.$post['id'].'">Add-Note</a>';
                  echo '<a role="presentation" name="report" class="name2"  style="float:'.$float.';"  href="branch.php?token='.$token.'&report='.$post['id'].'">Report</a>';
                  echo "<div class='yeswanth' id=".$i." style='width: 100%; border: 2px solid rgb(238, 238, 238); float: left; height: auto; padding: 4% 0px; margin: 5px 0px;display:none;'></form>
                  <form style='float: left; height: 40px; width: 90%; padding: 0px 5%; z-index: 0;' method='post'>
                  <textarea style='border: 2px solid rgb(238, 238, 238); height: 40px; float: left; resize: none; width: 700px;' name='commentbody' rows='3' cols='auto'></textarea>
                  <input name='postid' value=".$post['id']." style='display: none;'></input>
                  <input style='float: left; padding: 7px; background-color: white; box-shadow: none; font-family: segoe ui; height: 45px; border: medium none;' type='submit' name='comment' value='Comment'>
                  </form></div>
                  ";
          

echo "</div></div>";
        echo "
        </div>   
        
               ";
        echo '</div>';
    echo'</div>';
    echo '</div>';
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
    
}
?>
  
        
 <script>
// Get the modal
var modal = document.getElementById('id01');

// When the user clicks anywhere outside of the modal, close it
window.onclick = function(event){
        if(event.target == modal){
                modal.style.display="none";
        }
}
</script>
</body>
</html>