<?php
$sub_menu = '280100'; //'100310';
include_once('./_common.php');

auth_check($auth[$sub_menu], "r");

if( !isset($g5['new_win_table']) ){
    die('<meta charset="utf-8">/data/dbconfig.php 파일에 <strong>$g5[\'new_win_table\'] = G5_TABLE_PREFIX.\'new_win\';</strong> 를 추가해 주세요.');
}
//내용(컨텐츠)정보 테이블이 있는지 검사한다.
if(!sql_query(" DESCRIBE {$g5['new_win_table']} ", false)) {
    if(sql_query(" DESCRIBE {$g5['g5_shop_new_win_table']} ", false)) {
        sql_query(" ALTER TABLE {$g5['g5_shop_new_win_table']} RENAME TO `{$g5['new_win_table']}` ;", false);
    } else {
        $query_cp = sql_query(" CREATE TABLE IF NOT EXISTS `{$g5['new_win_table']}` (
                      `nw_id` int(11) NOT NULL AUTO_INCREMENT,
                      `nw_device` varchar(10) NOT NULL DEFAULT 'both',
                      `nw_begin_time` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
                      `nw_end_time` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
                      `nw_disable_hours` int(11) NOT NULL DEFAULT '0',
                      `nw_left` int(11) NOT NULL DEFAULT '0',
                      `nw_top` int(11) NOT NULL DEFAULT '0',
                      `nw_height` int(11) NOT NULL DEFAULT '0',
                      `nw_width` int(11) NOT NULL DEFAULT '0',
                      `nw_subject` text NOT NULL,
                      `nw_content` text NOT NULL,
                      `nw_content_html` tinyint(4) NOT NULL DEFAULT '0',
                      PRIMARY KEY (`nw_id`)
                    ) ENGINE=MyISAM DEFAULT CHARSET=utf8 ", true);
    }
}

$g5['title'] = '팝업관리';
include_once (G5_ADMIN_PATH.'/admin.head.php');

$sql_common = " from {$g5['new_win_table']} ";

// 테이블의 전체 레코드수만 얻음
$sql = " select count(*) as cnt " . $sql_common;
$row = sql_fetch($sql);
$total_count = $row['cnt'];

// 페이징
$list_rows = 20;	//$config['cf_page_rows'];				// 한페이지 글 개수
$total_page  = ceil($total_count / $list_rows);				// 전체페이지
if ((int)$page > $total_page) $page = $total_page;

if ($page < 1) $page = 1;
$from_record = ($page - 1) * $list_rows;					// 시작 열
$sql_limit = " LIMIT {$from_record}, {$list_rows}";			// 리스트 sql에 limit 추가

$list_page_rows = 10;										// 한블록 개수
$list_no = $total_count - ($list_rows * ($page - 1));		// 글번호(내림차순)

$sql = "select * $sql_common order by nw_id desc {$sql_limit}";
$result = sql_query($sql);
?>

    <div class="local_ov01 local_ov">전체 <?php echo $total_count; ?>건</div>

    <div class="btn_add01 btn_add">
        <a href="./newwinform.php">팝업등록</a>
    </div>

    <div class="tbl_head01 tbl_wrap">
        <table>
            <caption><?php echo $g5['title']; ?> 목록</caption>
            <colgroup>
                <col width="5%">
                <col width="*">
                <col width="*">
                <col width="10%">
                <col width="10%">
                <col width="*">
                <!--<col width="5%">
                <col width="5%">
                <col width="5%">
                <col width="5%">-->
                <col width="*">
            </colgroup>
            <thead>
            <tr>
                <th scope="col" rowspan="2">No.</th>
                <th scope="col">제목</th>
                <th scope="col" rowspan="2">이미지</th>
                <th scope="col" rowspan="2">시작일시</th>
                <th scope="col" rowspan="2">종료일시</th>
                <th scope="col" rowspan="2">시간</th>
                <!--<th scope="col" rowspan="2">좌측위치</th>
                <th scope="col" rowspan="2">상단위치</th>
                <th scope="col" rowspan="2">넓이</th>
                <th scope="col" rowspan="2">높이</th>-->
                <th scope="col" rowspan="2">관리</th>
            </tr>
            <tr>
                <th scope="col">연결URL</th>
            </tr>
            </thead>
            <tbody>
            <?php
            for ($i=0; $row=sql_fetch_array($result); $i++) {
                $bg = 'bg'.($i%2);
                ?>
                <tr class="<?php echo $bg; ?>" style="text-align:center;">
                    <td rowspan="2"><?=$list_no?></td>
                    <td><?php echo $row['nw_subject']; ?></td>
                    <td rowspan="2"><img src="<?=G5_DATA_URL?>/popup/<?=$row['nw_file']?>" style="height: 80px;"></td>
                    <td rowspan="2"><?=substr($row['nw_begin_time'], 0, 10)?></td>
                    <td rowspan="2"><?=substr($row['nw_end_time'], 0, 10)?></td>
                    <td rowspan="2"><?php echo $row['nw_disable_hours']; ?>시간</td>
                    <!--<td rowspan="2"><?php /*echo $row['nw_left']; */?>px</td>
                <td rowspan="2"><?php /*echo $row['nw_top']; */?>px</td>
                <td rowspan="2"><?php /*echo $row['nw_width']; */?>px</td>
                <td rowspan="2"><?php /*echo $row['nw_height']; */?>px</td>-->
                    <td rowspan="2">
                        <a href="./newwinform.php?w=u&amp;nw_id=<?php echo $row['nw_id']; ?>">수정</a>
                        <a href="./newwinformupdate.php?w=d&amp;nw_id=<?php echo $row['nw_id']; ?>" onclick="return delete_confirm(this);">삭제</a>
                    </td>
                </tr>
                <tr class="<?php echo $bg; ?>" style="text-align: center;">
                    <td>
                        <? if ($row['nw_link'] != "") { ?>
                            <!--<a href="<?=$row['nw_link']?>" class="btn_frmline" target="_blank">이동</a>-->
                            <?=$row['nw_link']?>
                        <? } else { ?>
                            -
                        <? } ?>
                    </td>
                </tr>
                <?php
                $list_no--;
            }

            if ($i == 0) {
                echo '<tr><td colspan="11" class="empty_table">등록된 팝업이 없습니다.</td></tr>';
            }
            ?>
            </tbody>
        </table>
    </div>

<? echo get_paging($list_page_rows, $page, $total_page, '?'); ?>

<?php
include_once (G5_ADMIN_PATH.'/admin.tail.php');
?>