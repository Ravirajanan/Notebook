<?php
include('./classes/DB.php');
include('./classes/Login.php');
if (Login::isLoggedIn()) {
        $userid = Login::isLoggedIn();

} else {
        die ('Not logged in');
}
if (isset($_POST['upload']))
{
  $target ="images/".basename($_FILES['image']['name']);
  $image = $_FILES['image']['name'];
  $sql = DB::query("UPDATE users SET image='$image' WHERE id='$userid'");
  if (move_uploaded_file($_FILES['image']['tmp_name'],$target))
  {
    echo "uploaded";
  }
  else {
    echo "error";
  }
}
?>
<form action="reddy.php" method="post" enctype="multipart/form-data">
  <input type="hidden" name="MAX_FILE_SIZE" value="4100000">
  <input type="file" name="image">
  <input type="submit" value="Upload image" name="upload">
</form>
<?php

$stmt->DB::query('SELECT image FROM users WHERE id = :userid',array(':userid'=> $userid));
$stmt->execute();
if($stmt->rowCount()>0)
{
while($row=$stmt->fetch(PDO::FETCH_ASSOC))
{
  extract($row);

}
}
?>