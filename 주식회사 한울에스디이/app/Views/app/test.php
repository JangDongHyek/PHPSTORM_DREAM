<?php
echo $user_model->primary;
?>
<div id="app">
    <test-component></test-component>
    <test2-component></test2-component>
</div>

<div id="app2">
    <test-component></test-component>
    <test2-component></test2-component>
</div>

<div id="app3">

</div>

<div></div>
<?
try {
    $jl->vueLoad('app');
    $jl->componentLoad('test');

    $jl->vueLoad('app2');

}catch (Exception $e){
    echo $e->getMessage();
}
?>