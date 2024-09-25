<?php
echo $user_model->primary;
?>
<div>
    test
</div>

<?
try {
    $jl->jsLoad();
}catch (Exception $e){
    echo $e->getMessage();
}
?>