<?php  
include('./classes/DB.php');
include('./classes/Login.php');
include('./classes/Post.php');
include('./classes/Image.php');
include('./classes/Notify.php');
include('header.php');
$num = 1;
$userid1 = $userid;
function xx($one,$two,$three,$userid1){
    if(!DB::query('SELECT userid,ques_id FROM chall_ans WHERE userid = :userid AND ques_id=:ques_id',array(':userid'=> $userid1,':ques_id'=>$one)))
    {DB::query('INSERT INTO chall_ans VALUES (\'\', :ques_id, :userid, :clicked, :actual)',array(':ques_id'=>$one,':userid'=> $userid1 , ':actual'=>$two, ':clicked'=>$three));}
}
$numn = 1;
echo '<h1 style="margin: 30px 15px 10px 15px; border-bottom: #eee solid 3px;">Can you Answer...</h1>';
$challenges = DB::query('SELECT * FROM question WHERE challenge = :challenge',array(':challenge'=> $num));
foreach($challenges as $post){
    
   
    echo '<div class="box">';
    echo '<div class="question"><h1>'.$post['question'].'</h1></div>';
    echo '<div id='.$numn.'>';
    $numn++;
    for($i=1;$i<=5;$i++){
        if($post['option'.$i] != ''){
        echo '<div class="options"   ><h3 class="12" onclick="xx('.$post['id'].','.$post['answer'].','.$i.','.$userid1.')" id = "'.$post['id'].'k'.$i.'" style="margin:0px;">'.$post['option'.$i].'</h3></div>';
        echo
        '<script type="text/javascript">
        $(document).ready(function()
        {
            
        $("#'.$post['id'].'k'.$i.'").click(function()
        {
            document.getElementById("'.$post['id'].'exp").style.display="block";
            if ('.$i.'=='.$post['answer'].'){
                document.getElementById("'.$post['id'].'k'.$post['answer'].'").style.color="blue";
            }else{
                document.getElementById("'.$post['id'].'k'.$post['answer'].'").style.color="blue";}
                for( j=1;j<=5;j++){
                    if (j !='.$post['answer'].'){
                document.getElementById("'.$post['id'].'k"+j).style.color="red";
                }}
            
                
        return false;
        });
    
        });</script>';
    }
    }   
  
    
    echo '</div>';
    $user = DB::query('SELECT username FROM users WHERE id = :id',array(':id'=> $post['userid']))[0]['username'];
    echo '<h3 style="text-align:right;">Posted By '.$user.'</h3>';
    echo '<h3 style="display:none" id= "'.$post['id'].'exp" ;><span style="color:green;font-variant-caps:all-small-caps;">EXPLINATION:-</span>'.$post['explination'].'</h3>';
echo '</div>';


}

?>
<html>
<head>
    <title>only new style</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=fixed,maximum-scale=1.0, initial-scale=1.0, user-scalable=no">
     <link rel="stylesheet" href="css/challenge.css">
</head>
<body>
   
</body>