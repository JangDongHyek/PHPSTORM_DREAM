<?php
require_once("Jl.php");
include_once("JlFile.php");
include_once("JlModel.php");
include_once("JlCsv.php");
include_once("JlService.php");
include_once(dirname(__FILE__) ."/external/JlKakao.php");
include_once(dirname(__FILE__) ."/external/JlNaver.php");

try {
    $jl = new Jl();
}catch (Exception $e) {
    echo $e;
}
?>