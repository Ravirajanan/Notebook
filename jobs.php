<?php
include('./classes/DB.php');
include('./classes/Login.php');
include('./classes/Post.php');
include('./classes/Image.php');
include('./classes/Notify.php');
include('header.php');
$quizs = "";
$verified = False;
$isFollowing = False;
if (isset($_GET['token'])) {
    echo '<div>';
    echo '<h1 style="color:black;    padding: 10px 0px;border-bottom: 5px solid rgb(238, 238, 238);margin: 10px 35px;margin-right:38px;"> SEARCHING A job-- </h1></div>';
    echo '<div style="float: left; max-width:1000px;min-width:1000px;">';
    if (DB::query('SELECT token FROM login_tokens WHERE token=:token', array(':token'=>$_GET['token']))) {
        $token= DB::query('SELECT token FROM login_tokens WHERE token=:token', array(':token'=>$_GET['token']))[0]['token'];
        $userid = DB::query('SELECT user_id FROM login_tokens WHERE token=:token', array(':token'=>$_GET['token']))[0]['user_id'];
        $branch = DB::query('SELECT branch FROM users WHERE id=:id', array(':id'=>$userid))[0]['branch'];
        $followerid = Login::isLoggedIn();
        if (isset($_POST['filter'])){
            if(!empty($_POST['active'])){
                $i = 0;
                
                $list = $_POST['active'];
                
                
                $jobs=DB::query('SELECT * FROM jobs WHERE userid=:userid', array(':userid'=>$userid));
            foreach ($jobs as $selected){
             if (in_array($selected['branch'], $list)){
                
                DB::query('UPDATE jobs SET active=1 where userid=:userid AND branch=:branch',array(':userid'=>$userid,':branch'=>$selected['branch']));
             }
             elseif(!in_array($selected['branch'], $list)){
                 DB::query('UPDATE jobs SET active=0 where userid=:userid AND branch=:branch',array(':userid'=>$userid,':branch'=>$selected['branch']));
            }     
            }        
            
            
            }else{
                $jobs=DB::query('SELECT * FROM jobs WHERE userid=:userid', array(':userid'=>$userid));
            foreach ($jobs as $selected){
                DB::query('UPDATE jobs SET active=0 where userid=:userid AND branch=:branch',array(':userid'=>$userid,':branch'=>$selected['branch']));
            }
            } 
        }
        if(isset($_GET['jobid'])){
            $id=$_GET['jobid'];
            if(DB::query('SELECT jobtitle_data,joblink FROM jobsdata WHERE id=:id', array(':id'=>$id))){
             $details=DB::query('SELECT jobtitle_data FROM jobsdata WHERE id=:id', array(':id'=>$id))[0]['jobtitle_data'];
             $details2=DB::query('SELECT joblink FROM jobsdata WHERE id=:id', array(':id'=>$id))[0]['joblink'];
             echo '<div style="
    border: 3px solid #eee;
    text-align:justify;
    box-shadow: 10px 10px 3px #eee;
    margin: 10px 50px;
    width: 1125px;
"><h1 style="
        text-align: -webkit-center;
    height: auto;
    width: auto;
    margin: 0px;
    border-bottom:3px solid #eee;
    padding: 10px 10px 10px 60px;
">'.$details.'</h1>
            <p style="
        text-align: justify;
    height: auto;
    width: auto;
    margin: 10px 50px;
    padding: 10px;
">'.$details2.'</p></div>';
            }
        }
        else{
        if(DB::query('SELECT * FROM jobs WHERE userid=:userid', array(':userid'=>$userid))){
            $jobs=DB::query('SELECT * FROM jobs WHERE userid=:userid AND active=1', array(':userid'=>$userid));
            if(!empty($jobs)){
                $o=0;
            foreach($jobs as $p){
                $details=DB::query('SELECT * FROM jobsdata WHERE branch=:branch', array(':branch'=>$p['branch']));
                foreach($details as $nan){
                    $o=$o+1;
                    echo '<a id="clicktoshow" href="jobs.php?token='.$token.'&jobid='.$nan['id'].'"style="cursor:pointer;"><div  style="width: 400px;float: left;margin: 10px 35.5px;border: 2px solid rgb(238, 238, 238);max-height: 150px;
min-height: 150px;overflow:hidden;
box-shadow: 10px 10px 5px rgb(238, 238, 238);">';
                  
                    echo '<h1 style="height:130px;margin-top:10px;margin-bottom:10px;overflow:hidden">'.$nan['jobtitle_data'].'</h1>';
                    
                    echo '</div></a>';
                }
            
            
            }
        if($o == 0){
            
                 echo '<p style="
    width: 900px;
    text-align: center;
    padding: 50px 0;
    background-color: #fff;
    border: 3px solid #eee;
    margin-left: 50px;
    margin-top: 50px;
    font-size: 40px;
    box-shadow: 10px 10px 5px rgb(238, 238, 238);
">NO Jobs on selected stream will find some for u</p>';
            }
        
        }else{
            echo '<p style="
    width: 900px;
    text-align: center;
    padding: 50px 0;
    background-color: #fff;
    border: 3px solid #eee;
    margin-left: 50px;
    margin-top: 50px;
    font-size: 40px;
    box-shadow: 10px 10px 5px rgb(238, 238, 238);
">SELECT some thing to check for JOBS</p>';
        }
        }
    }
    echo '</div>';

echo'
<html>
    <head>
        <title>NOTEBOOK</title>
    <script src="js/jquery-3.2.1.js"></script>
    <meta charset="utf-8">
    <meta name="viewport" content="width=fixed,maximum-scale=1.0, initial-scale=1.0, user-scalable=no">
     <link rel="stylesheet" href="css/job_style.css">
     <script type="text/javascript" src="js/jquery.min.js"></script>    
    </head>';
    $actived = 'checked';
     if(!isset($_GET['jobid'])){
           
     $details=DB::query('SELECT * FROM jobs WHERE userid=:userid', array(':userid'=>$userid));
                foreach($details as $nan){
                    $actived = 'checked';
                    if($nan['active'] == '0'){
                        $actived ='';
                    }
                   
    echo'
<form method="post" style="float:left;width:210px;">
    <div class="nick">
    <div class="nandu"><p>'.$nan['branch'].'</p></div><div class="hasini"><input type="checkbox"  name="active[]" value="'.$nan['branch'].'" '.$actived.' ></input></div></div>
    ';
                }echo'
    <input type="submit" style="
    color: white;
    border: none;
    outline: none;
        margin-top: 10px;
    width: 100px;
    font-size: 15px;
    font-family: segoe ui;
    height: 30px;
    background-color: #0078d7;
    margin-left: 100px;
" name="filter" value="Submit">

</form>
</html>';
    }}
}
?>