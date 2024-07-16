<?php
include_once('./_common.php');

$sql = " select * from g5_community_answer where idx = {$idx} ";
$row = sql_fetch($sql);

//해시태그
$an_tag = explode(',',$row['an_hashtag']);
$an_hashtag = '';
for($k=0; $k<count($an_tag); $k++) {
    $an_hashtag .= '<li class="tag_'.($k+1).'"><span class="tag_word">'.$an_tag[$k].'<button type="button" class="btn_close" onclick="del_hash('.($k+1).');"></button></span></li>';
}

die(json_encode(array('an_contents'=>$row['an_contents'], 'input_an_hashtag'=>$row['an_hashtag'], 'an_hashtag'=> $an_hashtag, 'an_open'=>$row['an_open'])));
?>