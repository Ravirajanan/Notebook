<?php
include('./classes/DB.php');
include('./classes/Login.php');
include('./classes/Post.php');
include('./classes/Image.php');
include('./classes/Notify.php');
include('header.php');
$option1 = ' ';
$option2 = ' ';
$option3 = ' ';
$option4 = ' ';
$option5 = ' ';
$i=2;
if (isset($_GET['token'])) {
    if (DB::query('SELECT token FROM login_tokens WHERE token=:token', array(':token'=>$_GET['token']))) {
        $token= DB::query('SELECT token FROM login_tokens WHERE token=:token', array(':token'=>$_GET['token']))[0]['token'];
        $userid = DB::query('SELECT user_id FROM login_tokens WHERE token=:token', array(':token'=>$_GET['token']))[0]['user_id'];
        $branch = DB::query('SELECT branch FROM users WHERE id=:id', array(':id'=>$userid))[0]['branch'];
        if(Login::isLoggedIn()){
            if(isset($_POST['post'])){
                if(isset($_POST['question'])){
                    $question = $_POST['question'];
                    if(!empty($question)){
                    if(isset($_POST['option'])){
                        $option = $_POST['option'];
                        if(!empty($option)){
                            $count = count($option);

                        for($j = 0;$j<$count;$j++){
                            $k=$j+1;
                            ${'option'.$k} = $option[$j];    
                        }
                            $ans = $_POST['answer'];
                            $exp = $_POST['explination'];
                            DB::query('INSERT INTO question VALUES (\'\', :userid, :question, :option1,:option2,:option3,:option4,:option5, :answer , :explination , 0)', array(':userid'=>$userid,':answer'=>$ans, ':question'=>$question,':option1'=>$option1,':option2'=>$option2,':option3'=>$option3,':option4'=>$option4,':option5'=>$option5,':explination'=>$exp));

                        }else{ echo 'write options'; }
                    }
                } else { echo 'write question'; }
                }  
            }
            if(isset($_POST['challange'])){
                if(isset($_POST['question'])){
                    $question = $_POST['question'];
                    if(!empty($question)){
                    if(isset($_POST['option'])){
                        $option = $_POST['option'];
                         if(!empty($option)){
                             $count = count($option);

                             for($j = 0;$j<$count;$j++){
                                $k=$j+1;
                                ${'option'.$k} = $option[$j];    
                            }
                                $ans = $_POST['answer'];
                                $exp = $_POST['explination'];
                                DB::query('INSERT INTO question VALUES (\'\', :userid, :question, :option1,:option2,:option3,:option4,:option5, :answer , :explination , 1)', array(':userid'=>$userid,':answer'=>$ans, ':question'=>$question,':option1'=>$option1,':option2'=>$option2,':option3'=>$option3,':option4'=>$option4,':option5'=>$option5,':explination'=>$exp));
    
                            }else{ echo 'write options'; }
                    }
                } else { echo 'write question'; }
                }  
            }
            
           echo '<form method="post">
            <input type="text" name="question" value="">question</input>';
            if(isset($_POST['add'])){
                if($_POST['add'] != 'remove'){
                   
                    $i=$i+$_POST['add'];
                    
                }else{
                    $i == 2;
                }
            }
            for($z = 1;$z<=$i;$z++){
           echo ' 
            <input type="text" name="option[]" value="">ip</input>';}
            echo '
            
                 <input type="submit" name="add" value="remove">
                <input type="submit" name="add" value="1">
                <input type="submit" name="add" value="2">
                <input type="submit" name="add" value="3">
            '; 
            echo '<p>answer</p><select name="answer">
                <option value=""></option>';
                for($z = 1;$z<=$i;$z++){
                    echo '<option  value="'.$z.'">'.$z.'</option>';
                }
            echo '</select>
            <input type="text" name="explination" value="">explination</input>
            <input type="submit" name="post" value="post">
            <input type="submit" name="challange" value="challenge">
            </form>';
        }
    }
}

?>

