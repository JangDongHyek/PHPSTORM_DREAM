<?php
$sub_menu = "240000";
include_once('./_common.php');

include_once('../jl/JlConfig.php');

auth_check($auth[$sub_menu], 'r');



$g5['title'] = '보유기술 관리';
include_once('./admin.head.php');


?>
<div id="app">
    <adm-skills-list></adm-skills-list>
</div>


<?php $jl->vueLoad();?>






<?php
include_once (G5_PATH."/component/skills/adm-skills-list.php");
include_once (G5_PATH."/component/skills/adm-skills-input.php");
include_once (G5_PATH."/component/modal-component.php");
include_once ('./admin.tail.php');
?>
