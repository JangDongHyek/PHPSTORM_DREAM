<?php
include_once("Jl.php");
include_once("JlFile.php");
include_once("JlCsv.php");

try {
    $jl = new Jl();
}catch (Exception $e) {
    echo $e;
}
?>