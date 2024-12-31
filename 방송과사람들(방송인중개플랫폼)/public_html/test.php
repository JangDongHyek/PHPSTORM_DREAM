<?php

include_once('./common.php');


include_once ("./jl/JlConfig.php");
?>

<div id="app">
    <test-test></test-test>
</div>

<?php
$jl->vueLoad("app");
$jl->componentLoad("test");
?>