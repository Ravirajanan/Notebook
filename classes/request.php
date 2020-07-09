<?php
class request {
        public static function sendrequest($ok,  $UserId, $requestUserId) {
                if ($ok == 'ok') {
                    DB::query('INSERT INTO addfrnd VALUES (\'\', :user_id,:request_id)' , array(':user_id'=>$UserId, ':request_id'=>$requestUserId ));
                }
        }
    }
?>