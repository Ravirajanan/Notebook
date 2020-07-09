<?php
include('./classes/DB.php');
include('./classes/Login.php');
include('header.php');
if (!Login::isLoggedIn()) {
        die("Not logged in.");
}
if (isset($_POST['confirm'])) {
        if (isset($_POST['alldevices'])) {
                DB::query('DELETE FROM login_tokens WHERE user_id=:userid', array(':userid'=>Login::isLoggedIn()));
        } else {
                if (isset($_COOKIE['SNID'])) {
                        DB::query('DELETE FROM login_tokens WHERE token=:token', array(':token'=>sha1($_COOKIE['SNID'])));
                }
                setcookie('SNID', '1', time()-3600);
                setcookie('SNID_', '1', time()-3600);
        }
        header("location:login.php?");
}
?>
<html>
<head>
        <title>NOTEBOOK</title>
        <link rel="stylesheet" href="style_logout.css">
</head>

<body>
        <div>
<h1 class="logout_div1_h1">CLOSE</h1>
  </div>
<div class="logout_div1">
<p class='logout_div1_p'>would U like to CLOSE</p>
</div>
<div class="logout_div2">
<form action="logout.php" method="post"><p class="logout_div2_p">CLOSE on all devices -</p>
        <input class="logout_div2_cb" type="checkbox" name="alldevices" value="alldevices"> </input>
        <br />
        <input class="logout_div2_bt" type="submit" name="confirm" value="OKAY">
</form>
</div>
</body>
</html>