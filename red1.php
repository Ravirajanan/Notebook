<?php
class Post {
        public static function createPost($postbody, $loggedInUserId, $profileUserId, $branch) {
                if (strlen($postbody) > 160 || strlen($postbody) < 1) {
                        die('Incorrect length!');
                }
                if ($loggedInUserId == $profileUserId) {
                        DB::query('INSERT INTO posts VALUES (\'\', :postbody, NOW(), :userid, 0, :branch)', array(':postbody'=>$postbody, ':userid'=>$profileUserId,':branch'=>$branch));
                } else {
                        die('Incorrect user!');
                }
        }
        public static function likePost($postId, $likerId) {
                if (!DB::query('SELECT user_id FROM post_likes WHERE post_id=:postid AND user_id=:userid', array(':postid'=>$postId, ':userid'=>$likerId))) {
                        DB::query('UPDATE posts SET likes=likes+1 WHERE id=:postid', array(':postid'=>$postId));
                        DB::query('INSERT INTO post_likes VALUES (\'\', :postid, :userid)', array(':postid'=>$postId, ':userid'=>$likerId));
                } else {
                        DB::query('UPDATE posts SET likes=likes-1 WHERE id=:postid', array(':postid'=>$postId));
                        DB::query('DELETE FROM post_likes WHERE post_id=:postid AND user_id=:userid', array(':postid'=>$postId, ':userid'=>$likerId));
                }
        }
        public static function displayPosts($userid, $username, $loggedInUserId) {
                $dbposts = DB::query('SELECT * FROM posts WHERE user_id=:userid ORDER BY id DESC', array(':userid'=>$userid));
                $posts = "";
                foreach($dbposts as $p) {
                        if (!DB::query('SELECT post_id FROM post_likes WHERE post_id=:postid AND user_id=:userid', array(':postid'=>$p['id'], ':userid'=>$loggedInUserId))) {
                                $posts .= htmlspecialchars($p['body'])."
                                <form action='profile.php?username=$username&postid=".$p['id']."' method='post'>
                                        <input type='submit' name='like' value='Like'>
                                        <span>".$p['likes']." likes</span>
                                </form>
                                <hr /></br />
                                ";
                        } else {
                                $posts .= htmlspecialchars($p['body'])."
                                <form action='profile.php?username=$username&postid=".$p['id']."' method='post'>
                                        <input type='submit' name='unlike' value='Unlike'>
                                        <span>".$p['likes']." likes</span>
                                </form>
                                <hr /></br />
                                ";
                        }
                }
                return $posts;
        }
}
?>
