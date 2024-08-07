<?php
include_once("./_common.php");
echo getCurl("https://www.dhlottery.co.kr/common.do?method=getLottoNumber&drwNo=".$drwNo,"json");
?>