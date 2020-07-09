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
                $branch = DB::query('SELECT branch FROM users WHERE id=:id', array(':id'=>$userid))[0]['branch'];
                $username = DB::query('SELECT username FROM users WHERE id=:id', array(':id'=>$userid))[0]['username'];
                

                echo '<div class="one">';
                echo '<div class="one_one" >';


                echo '<h2>REQUESTS</h2>';
                echo '<br />';
                $i=0;
               $friends = DB::query('SELECT user_id FROM followers WHERE follower_id=:follower_id', array(':follower_id'=>$userid));
               foreach($friends as $p){
                   $i=$i+1;
                   echo '<div class="name_box2" onmousemove="document.getElementById(\'yes'.$i.'\').style.display=\'block\'" onmouseout="document.getElementById(\'yes'.$i.'\').style.display=\'none\'" >';
                   $name = DB::query('SELECT username FROM users WHERE id=:id', array(':id'=>$p['user_id']))[0]['username'];
                   echo '<a class= "name_links" >'.$name.'</a>';
                   echo '<div class="yes" id="yes'.$i.'">';
                   echo '<a class="request"  >YES</a>';
                   echo '<a class= "request2" >NO</a>';
                   echo '</div>';
                  echo '</div>';
               }                

                 echo '<h2>BOOKS</h2>';
                 echo '<br />';
                $friends = DB::query('SELECT user_id FROM followers WHERE follower_id=:follower_id', array(':follower_id'=>$userid));
                foreach($friends as $p){
                    echo '<div class="name_box">';
                    $name = DB::query('SELECT username FROM users WHERE id=:id', array(':id'=>$p['user_id']))[0]['username'];
                    echo '<a class= "name_links" href ="buddy_details.php?token='.$token.'&username='.$name.'">'.$name.' Notebook</a>';
                   echo '</div>';
                }echo '</div>';

                echo '<div class="one_two">';
                
                echo '<div >';
                echo "<form method='post'>";
                 echo '<h2 style="text-align:left;">EXPLORE</h2>';
                 echo '<div>';
                 echo '<div style="width:100%;height:40px;">';
    echo '<input class="search-box" style="float:right;text-align:center;font-family:segoe ui;"  type="search" name="search" placeholder="search a BOOK"></input>';
    echo '</div>';
    echo '<div>';
    if(isset($_POST['search'])){
        if(isset($_POST['search'])){
            $search = $_POST['search'];
            if ($search != ''){
            $search = '%'.$search.'%';
            
            if(DB::query('SELECT * FROM users WHERE username LIKE :search',array(':search'=>$search))){
                $result = DB::query('SELECT * FROM users WHERE username LIKE :search',array(':search'=>$search));
                 echo '<h2 style="text-align:left;">search results</h2>';
                 echo '<div style="float:left;width:100%;">';
                foreach($result as $p2){
                    
                    echo '<div class="name_box" style="width: 46%;float:left;margin: 0.5% 2%;">';
                    echo '<a class= "name_links" href ="buddy_details.php?token='.$token.'&username='.$p2['username'].'">'.$p2['username'].' Notebook</a>';
                   echo '</div>';
                }
                echo '</div>';
            }else{
                 echo '<div class="name_box" style="margin:2% 0% 2% 2%;width:98%">';
                    echo '<p class= "name_links">No Notebooks Sorry</p>';
                   echo '</div>';
            }
        }}
    }echo '</div>';
    echo '<br/>';
        echo '</div>';
        
    
    echo '</div>';
    
    echo '<div style="width:100%;">';
    echo '<div class="two_one"  ">';
                 
                echo '<h2>ALL</h2>'; 
                $friends = DB::query('SELECT username FROM users WHERE username!=:username', array(':username'=>$username));
                foreach($friends as $p){
                   echo '<div class="name_box">';
                    echo '<a class= "name_links" href ="buddy_details.php?token='.$token.'&username='.$p['username'].'">'.$p['username'].' Notebook</a>';
                    echo '</div>';

                }
                echo '</div>';
                echo '<div class="two_two">';
                echo '<h2>'.$branch.'</h2>';
                 
                $friends = DB::query('SELECT username FROM users WHERE username!=:username AND branch=:branch', array(':username'=>$username,':branch'=>$branch));
                foreach($friends as $p){
                    echo '<div class="name_box">';
                    echo '<a class= "name_links" href ="buddy_details.php?token='.$token.'&username='.$p['username'].'">'.$p['username'].' Notebook</a>';
                    echo '</div>';
                    
                }
                
                echo '</div>';
                echo '</div>';
                echo '</div>';
        }echo '</div>';
         } else {
                    die ('Not logged in');
                }
}

?>
<html>
    <head>
        <script src="js/jquery-3.2.1.js"></script>
        <meta charset="utf-8">
        <meta name="viewport" content="width=fixed,maximum-scale=1.0, initial-scale=1.0, user-scalable=no">
        <title>NOTEBOOK</title>
        <link rel="stylesheet" href="friends-style.css">
    </head>
</html>