<?php

include_once('./common.php');

include_once ("./jl/JlConfig.php");

//$a = $jl->getUserAgent();
//echo $_SERVER['REMOTE_ADDR'];
//var_dump($a);

echo "서버 타임존: " . date_default_timezone_get() . "\n";

// 현재 시각 출력
echo "현재 시간: " . date('Y-m-d H:i:s') . "\n";

echo $jl->getTime(4);
?>

<!--<div id="app">-->
<!--    <test-test></test-test>-->
<!--</div>-->

<?php
//$jl->vueLoad("app");
//$jl->componentLoad("test");
?>