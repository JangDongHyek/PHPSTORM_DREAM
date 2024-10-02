<?php
require_once("Jl.php");
include_once("JlModel.php");

try {
    $jl = new Jl();
    include_once $jl->ROOT."/common.php";
}catch (Exception $e) {
    echo $e;
}
?>