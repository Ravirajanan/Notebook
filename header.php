<?php
$username = "";
$dir='uploads/';
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
                $profile_pic = DB::query('SELECT profile_pic FROM users WHERE id=:id', array(':id'=>$userid))[0]['profile_pic'];
                $email = DB::query('SELECT email FROM users WHERE id=:id', array(':id'=>$userid))[0]['email'];
                $branch = DB::query('SELECT branch FROM users WHERE id=:id', array(':id'=>$userid))[0]['branch'];
                $followerid = Login::isLoggedIn();
echo '              
<!DOCTYPE html>
<html>
<head>
    <title>NOTEBOOK</title>
    <script src="js/jquery-3.2.1.js"></script>
    <meta charset="utf-8">
    <meta charset="utf-8" />
    <link href="css/floating-style.css" rel="stylesheet" />
    <meta name="viewport" content="width=fixed,maximum-scale=1.0, initial-scale=1.0, user-scalable=no">
     <link rel="stylesheet" href="profile-style.css">
     <script type="text/javascript" src="js/jquery.min.js"></script>
        
</head>
<body>
    <header >
        <div class="information-container">
            <div class="company">
                <a role="presentation" class="name" href="#">NOTE BOOK</a>
                    </div>            
            <form>
                        <div class="search-box">
                            <input class="know" type="search" required placeholder="Search.." style="font-family: calibri;">
                        </div>
            </form>
            <div class="name-network">
                <a class="name-links" href="logout.php?token='.$token.'">Close</a>
                <a class="name-links" href="profile.php?token='.$token.'">INDEX</a>


                <a class="name-links" href="branch.php?token='. $token.'">'.$branch.'</a>
                <a class="name-links" href="jobs.php?token='.$token.'">Job</a>
                <ul id="nav">
<li id="notification_li">
<span id="notification_count">3</span>
<a href="#" id="notificationLink">Notifications</a>
<div id="notificationContainer">
<div id="notificationTitle">Notifications</div>
<div id="notificationsBody" class="notifications">';
        if (DB::query('SELECT * FROM notifications WHERE receiver=:userid', array(':userid'=>$userid))) {
        $notifications = DB::query('SELECT * FROM notifications WHERE receiver=:userid ORDER BY id DESC', array(':userid'=>$userid));
        foreach($notifications as $n) {
                if ($n['type'] == 1) {
                        $senderName = DB::query('SELECT username FROM users WHERE id=:senderid', array(':senderid'=>$n['sender']))[0]['username'];
                        if ($n['extra'] == "") {
                                echo "You got a notification!<hr />";
                        } else {
                                $extra = json_decode($n['extra']);
                                echo $senderName." mentioned you in a post! - ".$extra->postbody."<hr />";
                        }
                } else if ($n['type'] == 2) {
                        $senderName = DB::query('SELECT username FROM users WHERE id=:senderid', array(':senderid'=>$n['sender']))[0]['username'];
                        if($username == $senderName){ $senderName = 'You';}
                        
                        echo '<p class="notifiername">'.$senderName.' <p class="notitype">liked your post! </p></p><hr />';
                       
                }
        }
} echo'
</div>
<div id="notificationFooter"><a style="float:none;color:#0078d7;" href="#">See All</a></div>
</div>
</li>   
 </div>
   </div>       
    </header>';
//echo '<a > clocl</a>';


    /*echo'<header class="bottom" >
        <div class="information-container" style="float:right;width:580px;margin:0 335px;">
            <div class="company">
                <a class="name-links" onclick="topFunction()" style="cursor:pointer;" id="myBtn">go to top</a>
                 <a class="name-links" href="friends.php?token='.$token.'">Friends</a>
                <a class="name-links" href="question.php?token='.$token.'">Question</a>
                <a class="name-links" href="profile.php?token='.$token.'">Index</a>
                
                

                <a class="name-links" href="branch.php?token='. $token.'">'.$branch.'</a>
                <a class="name-links" href="index.php?token='.$token.'">Timeline</a>
                    </div>            
            
 
 </div>      
    </header>';*/
    echo '
    <body>
    
        <div class="control-center">
    
            <div class="option-btn"></div>
            <ul class="left-sidebar">
                <li><a class="hai" href="index.php?token='.$token.'">TIMELINE</a></li>
                <li>POST</li>
                <li><a class="hai" href="branch.php?token='. $token.'">'.$branch.'</a></li>
                <li><a class="hai" href="friends.php?token='.$token.'">Books</a></li>
            </ul>
        </div>
    
        <script src="js/sjquery.min.js"></script>
        <script>
            $(document).on("click", ".option-btn", function() {
                $(this).toggleClass("open");
                $(".control-center").toggleClass("open");
            })
        </script>
    </body>
        
    ';
        }
    }
}
?>
<html>

<script type="text/javascript" >
$(document).ready(function()
{
$("#notificationLink").click(function()
{
$("#notificationContainer").fadeToggle(300);
$("#notification_count").fadeOut("slow");
return false;
});
$("#myBtn").click(function()
{
    $("html,body").animate({scrollTop: 0},600);
    return false;
});



//Document Click
$(document).click(function()
{
$("#notificationContainer").hide();
});
//Popup Click
$("#notificationContainer").click(function()
{
return false
});

});
</script>
</html>
