<?php
include_once('./__init.php');
// 내용
$sql = " select * from {$g5['content_table']} where co_id = '{$co_id}' ";
$co = sql_fetch($sql);
if (!$co['co_id'])
    alert('등록된 내용이 없습니다.');

$pid = $co['co_id'];

include_once('./app_head.php');

$co_content = $co['co_mobile_content'] ? $co['co_mobile_content'] : $co['co_content'];
$str = conv_content($co_content, $co['co_html'], $co['co_tag_filter_use']);

// $src 를 $dst 로 변환
unset($src);
unset($dst);
$src[] = "/{{쇼핑몰명}}|{{홈페이지제목}}/";
$dst[] = $config['cf_title'];
$src[] = "/{{회사명}}|{{상호}}/";
$dst[] = $default['de_admin_company_name'];
$src[] = "/{{대표자명}}/";
$dst[] = $default['de_admin_company_owner'];
$src[] = "/{{사업자등록번호}}/";
$dst[] = $default['de_admin_company_saupja_no'];
$src[] = "/{{대표전화번호}}/";
$dst[] = $default['de_admin_company_tel'];
$src[] = "/{{팩스번호}}/";
$dst[] = $default['de_admin_company_fax'];
$src[] = "/{{통신판매업신고번호}}/";
$dst[] = $default['de_admin_company_tongsin_no'];
$src[] = "/{{사업장우편번호}}/";
$dst[] = $default['de_admin_company_zip'];
$src[] = "/{{사업장주소}}/";
$dst[] = $default['de_admin_company_addr'];
$src[] = "/{{운영자명}}|{{관리자명}}/";
$dst[] = $default['de_admin_name'];
$src[] = "/{{운영자e-mail}}|{{관리자e-mail}}/i";
$dst[] = $default['de_admin_email'];
$src[] = "/{{정보관리책임자명}}/";
$dst[] = $default['de_admin_info_name'];
$src[] = "/{{정보관리책임자e-mail}}|{{정보책임자e-mail}}/i";
$dst[] = $default['de_admin_info_email'];

$str = preg_replace($src, $dst, $str);

$content_skin_url  = get_skin_url('content', $co['co_mobile_skin']);
add_stylesheet('<link rel="stylesheet" href="'.$content_skin_url.'/style.css">', 0);
?>
<article id="ctt" class="ctt_<?php echo $co_id; ?>">
    <header>
        <h1><?php echo $co['co_subject']; ?></h1>
    </header>

    <div id="ctt_con">
        <?php echo $str; ?>
    </div>
</article>
<?php
include_once('./app_tail.php');
?>