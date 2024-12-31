<?php
require_once("Jl.php");
include_once("JlFile.php");
include_once("JlModel.php");
include_once("JlCsv.php");
include_once("JlService.php");

try {
    $jl = new Jl();
}catch (Exception $e) {
    echo $e;
}
?>