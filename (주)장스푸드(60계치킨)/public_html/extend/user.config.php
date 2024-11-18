<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

// 게시판관리자
if ($bo_table == 'fran03' && $is_admin != 'super')
{
    if ($member['mb_level'] == 3) $is_admin = 'board';
    if ($is_admin == 'board') $board['bo_admin'] = $member['mb_id'];
}
?>