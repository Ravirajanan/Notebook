<?php
include('./classes/DB.php');
include('./classes/Login.php');
include('./classes/Post.php');
include('./classes/Comment.php');
include('./classes/Notify.php');
include('header.php');
$showTimeline = False;
$dir='uploads/';
if(isset($_GET['token'])){
        if (DB::query('SELECT token FROM login_tokens WHERE token=:token', array(':token'=>$_GET['token']))) {
        $token=$_GET['token'];
        $userid = DB::query('SELECT user_id FROM login_tokens WHERE token=:token', array(':token'=>$_GET['token']))[0]['user_id'];
        $branch = DB::query('SELECT branch FROM users WHERE id=:id', array(':id'=>$userid))[0]['branch'];

if (Login::isLoggedIn()) {
        $userid = Login::isLoggedIn();
        $showTimeline = True;
} else {
        die ('Not logged in');
}
if (isset($_GET['postid'])) {
        Post::likePost($_GET['postid'], $userid);
}
if(isset($_POST['comment'])){
        Comment::createcomment($_POST['commentbody'],$_POST['postid'],$userid);
}

if (isset($_GET['report'])) {
        Post::reportPost($_GET['report'], $userid);
}
if (isset($_GET['notes'])) {
        Post::notePost($_GET['notes'], $userid);
}
if (isset($_POST['searchbox'])) {
        $tosearch = explode(" ", $_POST['searchbox']);
        if (count($tosearch) == 1) {
                $tosearch = str_split($tosearch[0], 2);
        }
        $whereclause = "";
        $paramsarray = array(':username'=>'%'.$_POST['searchbox'].'%');
        for ($i = 0; $i < count($tosearch); $i++) {
                $whereclause .= " OR username LIKE :u$i ";
                $paramsarray[":u$i"] = $tosearch[$i];
        }
        $users = DB::query('SELECT users.username FROM users WHERE users.username LIKE :username '.$whereclause.'', $paramsarray);
        print_r($users);
        $whereclause = "";
        $paramsarray = array(':body'=>'%'.$_POST['searchbox'].'%');
        for ($i = 0; $i < count($tosearch); $i++) {
                if ($i % 2) {
                $whereclause .= " OR body LIKE :p$i ";
                $paramsarray[":p$i"] = $tosearch[$i];
                }
        }
        $posts = DB::query('SELECT posts.body FROM posts WHERE posts.body LIKE :body '.$whereclause.'', $paramsarray);
        echo '<pre>';   
        echo $posts;
        echo '</pre>';
}
}
else {die('Not an specified user');}
} 
else {die ('not logged in');}
?>




<html>
<head>
    <title>NOTEBOOK</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=fixed,maximum-scale=1.0, initial-scale=1.0, user-scalable=no">
     <link rel="stylesheet" href="style2.css">
</head>
<body>
        
    <h1 style="border-bottom: 3px solid #eee;margin-bottom:0px;">TIMELINE</h1>
 

     <?php
   
                $questappear=1; $kill = 1;$ki=1;
           $i = 1;$float='left';
           
        $followingquestion = DB::query('SELECT question.userid,question.id,question.question,question.option1,question.option2,question.option3,question.option4,question.option5 FROM question,users, followers 
        WHERE question.userid = followers.user_id
        AND users.id = question.userid
        AND follower_id = :userid 
        ORDER BY question.id DESC;', array(':userid'=>$userid));
$followingposts = DB::query('SELECT posts.image,posts.id,posts.title,posts.user_id, posts.body, posts.likes, users.`username` FROM users, posts, followers 
WHERE posts.user_id = followers.user_id
AND users.id = posts.user_id
AND follower_id = :userid 
ORDER BY posts.likes DESC;', array(':userid'=>$userid));
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
        echo '<div style="width:950px;float:left;margin:0 150px;">';
 echo '<div class="post" style="float:'.$float.'">';
        echo'<div class="contents" style="float:'.$float.'">';
            
            
            
            echo '
            <div class="post-style">';
            
            echo '<div class="yeswanth"><a role="presentation" class="name2" style="border-bottom: 2.5px solid #eee;float:'.$float.';" href="buddy_details.php?token='.$token.'&username='.$post['username'].'">'.$post['username'].'</a> </div>'; 
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
                echo '<a role="presentation" name="report" class="name2" style="float:'.$float.';" href="index.php?token='.$token.'&notes='.$post['id'].'">Add-Note</a>';
                  echo '<a role="presentation" name="report" class="name2"  style="float:'.$float.';"  href="index.php?token='.$token.'&report='.$post['id'].'">Report</a>';
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
  
        

</script>
</body>
</html>