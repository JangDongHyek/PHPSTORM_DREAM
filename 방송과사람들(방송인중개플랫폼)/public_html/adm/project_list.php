<?php
$sub_menu = "260000";
include_once('./_common.php');

include_once('../jl/JlConfig.php');

auth_check($auth[$sub_menu], 'r');



$g5['title'] = '프로젝트관리';
include_once('./admin.head.php');


?>
<div id="app">
    <adm-project-list></adm-project-list>
</div>


<?php $jl->vueLoad("app");?>

<?php $jl->componentLoad("adm/project");?>
<?php $jl->componentLoad("item");?>




<?php

?>
