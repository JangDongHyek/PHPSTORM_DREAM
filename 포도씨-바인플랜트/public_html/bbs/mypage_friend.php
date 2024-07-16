<?
include_once('./_common.php');
$name = "mypage";
$g5['title'] = '나의친구';
include_once('./_head.php');

?>

<? if($name=="mypage") { ?>
	<body<?php echo isset($g5['body_script']) ? $g5['body_script'] : ''; ?> class="mypage">
<?}?>

<?php
// 프로필 모달
include_once('./profile_modal.php');
?>

<link rel="stylesheet" href="<?=G5_URL?>/css/style.css?v=<?= G5_CSS_VER ?>">


    <div id="area_mypage">
		<div class="inr v3">		
			<div id="mypage_wrap">	
				<?php include_once('./mypage_info.php'); ?> 
				<div class="mypage_cont">
					<div class="box">
						<h3>나의 친구</h3>
						<div class="box_cont">					
							<div id="help_list" class="friend inquiry">
								<ul class="list">
                                    <?php
                                    $result = sql_query(" select fri.*, mb.mb_grade, mb.mb_category from g5_like_friend as fri left join g5_member as mb on mb.mb_id = fri.friend_mb_id where fri.mb_id = '{$member['mb_id']}' order by idx desc ");
                                    $i = 0;
                                    while($row = sql_fetch_array($result)) {
                                        $i++;
                                        // 서로친구 확인 (상대방도 나를 관심친구로 등록하였다면 서로친구)
                                        $cnt = 0;
                                        $cnt = sql_fetch(" select count(*) as cnt from g5_like_friend where mb_id = '{$row['friend_mb_id']}' and friend_mb_id = '{$member['mb_id']}' ")['cnt'];
                                    ?>
                                    <li class="help_question">
                                        <a href="javascript:;">
                                            <div id="area_name " onclick="userToggle('list_<?=$row['idx']?>');">
                                            <div class="profile toggle">
                                            <?php echo getProfileImg($row['friend_mb_id'], $row['mb_category']); ?>
                                            </div> <!-- 프로필사진 -->
                                            <div class="profile_info">
                                                <h4 class="toggle"><?=$row['friend_mb_id']?><?=$cnt > 0 ? '<i class="badge">서로친구</i>' : ''; ?></h4><!-- 아이디-->
                                                <div class="list_info">
                                                    <span class="lv"><?=$row['mb_grade']?></span> <!-- 등급 -->
                                                </div>

                                                <!-- 토글메뉴 -->
                                                <ul class="list_<?=$row['idx']?> user_list answer01 sm">
                                                    <li onclick="profileOpen('<?=$row['mb_category']?>', '<?=$row['friend_mb_id']?>')">프로필보기</li>
                                                    <li onclick="likeFriend('<?=$row['friend_mb_id']?>', 'del');">친구삭제</li> <!--친구등록/삭제-->
                                                    <li onclick="chatting('<?=$row['friend_mb_id']?>');">채팅하기</li>
                                                    <li onclick="reportOpen('<?=$row['mb_id']?>', 'g5_helpme_answer', '<?=$row['idx']?>')">신고하기</li>
                                                </ul>
                                                <!-- //토글메뉴 -->
                                            </div>
                                            </div>
                                            <button type="button" class="btn_delete" onclick="likeFriend('<?=$row['friend_mb_id']?>', 'del');">친구삭제</button>
                                        </a>
                                    </li>

                                    <?php
                                    }
                                    if($i == 0) {
                                    ?>
                                    <li class="nodata full">
                                        <p>등록된 내용이 없습니다.</p>
                                    </li>
                                    <?php
                                    }
                                    ?>
								</ul>
							</div>
						</div>
					</div>
				</div>
				<?php include_once('./mypage_menu.php'); ?> 
			</div>			
		</div>
	</div>

<?
include_once ('./fchatting.php'); // 채팅데이터폼
include_once('./_tail.php');
?>

