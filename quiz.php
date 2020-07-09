<?php
include('./classes/DB.php');
include('./classes/Login.php');
include('./classes/Post.php');
include('./classes/quiz.php');
include('./classes/Image.php');
include('./classes/Notify.php');
$quizs = "";
$answer=0;
$verified = False;
$isFollowing = False;
if (isset($_GET['token'])) {
        if (DB::query('SELECT token FROM login_tokens WHERE token=:token', array(':token'=>$_GET['token']))) {
                $token= DB::query('SELECT token FROM login_tokens WHERE token=:token', array(':token'=>$_GET['token']))[0]['token'];
                $userid = DB::query('SELECT user_id FROM login_tokens WHERE token=:token', array(':token'=>$_GET['token']))[0]['user_id'];
                $branch = DB::query('SELECT branch FROM users WHERE id=:id', array(':id'=>$userid))[0]['branch'];
                $followerid = Login::isLoggedIn();
                if (isset($_POST['filter'])) {
                        $branch2=$_POST['branch'];
                        if ($branch2!='all'){
                            if(DB::query('SELECT quiztitle,id FROM qiuz WHERE branch=:branch ORDER BY id DESC', array(':branch'=>$branch2))){
                            $quizs = DB::query('SELECT quiztitle,id FROM qiuz WHERE branch=:branch ORDER BY id DESC', array(':branch'=>$branch2));
                            }
                            if($quizs==''){
                            echo 'no quizs on '.$branch2;
                            }else{
                                foreach($quizs as $p) {
                                    echo '<h1><a href=\'quiz.php?token='.$token.'&quizid='.$p['id'].'\'>'.$p['quiztitle'].'</a></h1>';
                                    echo '<br />';
                                }
                            }
                        }
                        else{
                           
                    if(DB::query('SELECT quiztitle,id FROM qiuz  ORDER BY id DESC')){
                        $quizs = DB::query('SELECT quiztitle,id FROM qiuz  ORDER BY id DESC');
                        
                        }
                        if($quizs==''){
                            echo 'no quizs ';
                        }else{
                            foreach($quizs as $p) {
                                echo '<h1><a href=\'quiz.php?token='.$token.'&quizid='.$p['id'].'\'>'.$p['quiztitle'].'</a></h1>';
                                echo '<br />';
                            }
                        }
                        }
                }
                else {  
                    if(DB::query('SELECT quiztitle,id FROM qiuz  ORDER BY id DESC')){
                        $quizs = DB::query('SELECT quiztitle,id FROM qiuz  ORDER BY id DESC');
                        
                        }
                        if($quizs==''){
                            echo 'no quizs ';
                        }else{
                            foreach($quizs as $p) {
                                echo '<h1><a href=\'quiz.php?token='.$token.'&quizid='.$p['id'].'\'>'.$p['quiztitle'].'</a></h1>';
                                echo '<br />';
                            }
                        }
                }
        
        $no=1;
        if (isset($_GET['quizid'])){    
                $quizid=$_GET['quizid'];
                  $x=quiz::displayquiz($quizid,$no);
                
            }
        if (isset($_POST['forward'])){
            if(isset($_POST['ans'])){
                $choice=$_POST['ans'];
            }
            $x=quiz::displayquiz($quizid,$no);
            $no=$no+1;
            $answer=$answer+$x;
        }
        if (isset($_POST['back'])){
            if($_POST['ans']){
                $choice=$_POST['ans'];
            }
            $x=quiz::displayquiz($quizid,$no);
            $no=$no-1;
            echo 'king';
            $answer=$answer+$x;
        }
        if (isset($_POST['change'])){ 
            $no= $_POST['change'];
            if($_POST['ans']){
                $choice=$_POST['ans'];
            }
            quiz::displayquiz($quizid,$no);
        }
echo $no;
             
                
                            
                 
               
    }
}
?>

<form method='post'>
     <select name="branch">
<option value="all">All</option>
<option value="civil">CIVIL</option>
<option value="mech">MECH</option>
<option value="ece">ECE</option>
<option value="cse">CSE</option>
</select>
 <input type="submit"  name="filter" value="Filter"></div>

</form>
