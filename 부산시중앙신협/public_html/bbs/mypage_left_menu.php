<?php
$file_sql = " select * from g5_member_img where mb_id = '{$member['mb_id']}' ";
$file_row = sql_fetch($file_sql);
?>

        <div class="left_menu">
            <!--            <h2></h2>-->
            <ul>
               <li>
                   <a href="./mypage.php">마이페이지 홈</a>
               </li>
                <li>
                    <a href="./modify_info.php">
                        내 정보 및 수정
                    </a>
                </li>
                <li>
                    <a href="./rev_list.php">
                        예약 현황
                    </a>
                </li>
                <li>
                    <a href="./point_list.php">
                        포인트 현황
                    </a>
				</li>
                <li>
                    <a href="./coupon_list.php">
                        쿠폰 현황
                    </a>
				</li>
				<? if($is_apple == true) { ?>
					<li>
						<a href="#" onclick="javascript:if(confirm('정말 탈퇴 하시겠습니까?')){location.href='<?php echo G5_BBS_URL ?>/logout.php'}">
							탈퇴하기
						</a>
					</li>
				<?}?>
<!--                <li>-->
<!--                    <a href="--><?php //echo G5_BBS_URL ?><!--/board.php?bo_table=notice">-->
<!--                        공지사항-->
<!--                    </a>-->
<!--                </li>-->
            </ul>
        </div>