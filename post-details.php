<!DOCTYPE html>
<html lang="en">
    <head>
        <title></title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href="css/post_details.css" rel="stylesheet">
    </head>
    <body>
<?php
    include('./classes/DB.php');
    include('./classes/Login.php');
    include('./classes/Post.php');
    include('./classes/Image.php');
    include('./classes/comment.php');
    include('./classes/Notify.php');
    include('header.php');
    if (isset($_GET['token'])){
        if (DB::query('SELECT token FROM login_tokens WHERE token=:token', array(':token'=>$_GET['token']))) {
            if (Login::isLoggedIn()){
                $token= DB::query('SELECT token FROM login_tokens WHERE token=:token', array(':token'=>$_GET['token']))[0]['token'];
                $userid = DB::query('SELECT user_id FROM login_tokens WHERE token=:token', array(':token'=>$_GET['token']))[0]['user_id'];
                $username = DB::query('SELECT username FROM users WHERE id=:id', array(':id'=>$userid))[0]['username'];
                $profile_pic = DB::query('SELECT profile_pic FROM users WHERE id=:id', array(':id'=>$userid))[0]['profile_pic'];
                $email = DB::query('SELECT email FROM users WHERE id=:id', array(':id'=>$userid))[0]['email'];
                $branch = DB::query('SELECT branch FROM users WHERE id=:id', array(':id'=>$userid))[0]['branch'];
                if(isset($_GET['post'])){
                    $nid = $_GET['post'];
                    $p = 0;
                    echo '<div class="post_details">';
                    $p = DB::query('SELECT * FROM posts WHERE id=:nid ', array(':nid'=>$nid));
                    foreach($p as $post){
                        $name = DB::query('SELECT username FROM users WHERE id=:nid ', array(':nid'=>$post['user_id']))[0]['username'];
                        echo '<div class="data">
                        <h1>'.$name.'</h1>
                         <h2>'.$post['body'].'</h2>
                        <h3>'.$post['likes'].'</h3>
                        <h4>'. $post['posted_at'].'</h4></div>';
                    }
                    echo '<div class="comments">';
                    $p = DB::query('SELECT * FROM comments WHERE post_id=:post_id ', array(':post_id'=>$nid));
                    foreach($p as $post){
                        echo '<div class="comment">
                        '.$post['comment'].';
                        '.$post['posted_at'].'</div>';
                    }
                
                    if(isset($_POST['commentbody'])){
                        Comment::createcomment($_POST['commentbody'],$nid,$userid);
                    }
                
                echo "<div class='add-comment'></form>
                    <form action='post-details.php?token=".$token."&post=".$nid."' method='post'>
                    <textarea name='commentbody' rows='3' cols='auto'></textarea>
                    <input type='submit' name='comment' value='Comment'>
                    </form></div></div></div>
                    ";
                }
            }
        }
    }
?>

    
    </body>
</html>