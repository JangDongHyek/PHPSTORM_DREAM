<?php
include_once('./_common.php');

/** 기업의뢰 - 의뢰상세자료 비밀번호 확인 **/

$ci_password = sql_fetch(" select * from g5_company_inquiry where idx = '{$idx}' ")['ci_password']; // 의뢰 자료 비밀번호

if($ci_password != $password) {
    die('fail');
}
?>

<ul class="file_list">
<?php
$filecount = sql_fetch(" select count(*) as count from g5_company_inquiry_img where company_inquiry_idx = {$idx}; ")['count'];
if($filecount > 0) {
    $file_sql = " select * from g5_company_inquiry_img where company_inquiry_idx = {$idx} order by idx; ";
    $file_result = sql_query($file_sql);

    for($i=0; $row=sql_fetch_array($file_result); $i++) {
    ?>
    <li class="file_<?=$i?>">
        <!--https://www.podosea.com/bbs/file_download.php?mode=chat&temp=${data.server_file_name}&real=${data.file_name}-->
        <span class="fileName"><a href="javascript:fileDownload('company_inquiry', '<?=$row['img_file']?>', '<?=$row['img_source']?>');"><?=$row['img_source']?></a></span>
    </li>
    <?php
    }
}
?>
</ul>