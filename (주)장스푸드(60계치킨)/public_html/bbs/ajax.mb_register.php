<?php
include_once("./_common.php");

$mb = get_member($val);

if(empty($mb)){
    echo 0;
} else {
    echo 1;
}

?>