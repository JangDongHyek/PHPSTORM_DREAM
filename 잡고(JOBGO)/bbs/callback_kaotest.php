<?php
include_once('./_common.php');
include_once("../jl/Jl.php");

$jl = new Jl();

echo G5_URL;
$_SESSION['ss_sns'] = "kaka22o";
set_session("ss_sns","kakazzzz");
goto_url($jl->URL.'/bbs/register_new_form.php?sns=Y');
