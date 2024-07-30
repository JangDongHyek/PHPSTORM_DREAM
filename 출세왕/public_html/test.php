<?php
include_once('./_common.php');


$re = send_fcm("otest1","타이틀","내용");


var_dump($re);

/*
header('Access-Control-Allow-Origin: *');
header('Access-Control-Max-Age: 86400');
header('Access-Control-Allow-Headers: x-requested-with');
header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS');

include_once('./_common.php');

?>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script>
    listing();
    function listing() {

        $.ajax({
            type: "GET",
            url: "https://cafe.naver.com/ca-fe/cafes/18950490/member-level",
            data: {},
            success: function (response) {
               console.log(response)
            }
        })
    }
</script>
