<?
include_once('./_common.php');

$g5['title'] = '마이페이지';
include_once('./_head.php');

$sql ="select * from g5_write_apply01 where mb_id = '{$member['mb_id']}' ";
$reulst_edu = sql_query($sql);
$sql ="select * from g5_write_apply02 where mb_id = '{$member['mb_id']}' ";
$reulst_certify = sql_query($sql);
$sql ="select * from g5_member_annualfee where mb_id = '{$member['mb_id']}' ";
$reulst_fee = sql_query($sql);
$sql ="select * from g5_write_apply03 where mb_id = '{$member['mb_id']}' ";
$reulst_academy = sql_query($sql);
$today_y = date("Y");
$sql ="select * from g5_member_annualfee where mb_id = '{$member['mb_id']}' and pay_year = '{$today_y}' ";
$value_flg = sql_fetch($sql);

$sql ="select * from g5_board where bo_table = 'apply01' ";
$info_app01 = sql_fetch($sql);
$arr_cate = explode('|', $info_app01['bo_category_list']);


?>
	
	<div class="user_info">
		<div class="icon_user"></div>
		<div class="txt_user">
			<h3><?=$member['mb_name']?></h3><span>님 환영합니다.</span>
			<ol>
				<li><em>입회비 : </em><span class="<?if($member['mb_1']!=1) echo 'no'; ?>"><?if($member['mb_1']==1) echo '납부'; else echo '미납';?></span></li>
				<!-- <li><em>연회비 : </em><span class="no"><?if($value['pay_flg']=='' || empty($value['idx'])) echo '미납'; else echo '납부'?></span></li> -->
			</ol>
		</div>
		<ul>
			<li class=""><a href="<?php echo G5_BBS_URL ?>/register_form.php?w=u&mb_id=<?=$member['mb_id']?>">정보수정</a></li>
		</ul>
	</div>
	<div class="area_apply v2">
		<div class="title">
			<h3>연회비 납부현황</h3>
		</div>
		<div class="area_table">
			<table>
				<colgroup class="hidden-xs">
					<col style="width:15%">
					<col style="width:15%">
					<col style="width:15%">
					<col style="width:15%">
					<col style="width:20%">
				</colgroup>
				<thead>
					<tr>
						<th scope="col">년도</th>
						<th scope="col">납부일시</th>
						<th scope="col">금액</th>
						<th scope="col">납부여부</th>
						<th scope="col">비고</th>
					</tr>
				</thead>
				<tbody>
				<?
							for ($i=0; $row=sql_fetch_array($reulst_fee); $i++){
				?>
					<tr>
						<td class="td_subject"><?=$row['pay_year']?></td>
						<td><?=$row['pay_date']?></td>
						<td><?=number_format($row['pay_value'])?></td>
						<td class="td_status"><span class="npass"><?=$row['pay_flg']?></span></td>
						<td><?=$row['pay_text']?></td>
					</tr>	
				<!-- 	<tr>
						<td class="td_subject">2020년</td>
						<td>2020-01-14</td>
						<td>30.000원</td>
						<td class="td_status"><span class="pass">납부</span></td>
						<td></td>
					</tr> -->
					<?}if($i==0){?>
							<tr><td class="nodata" colspan=5>등록된 내역이 없습니다.</td></tr>
					<?}?>
					<!--<tr><td class="nodata" colspan=5>내역이 없습니다.</td></tr>-->				
				</tbody>
			</table>	
		</div>
	</div>

	<div class="area_apply">
		<div class="title">
			<h3>워크숍/학술대회 접수현황</h3>
			<a class="btn_more" href="<?php echo G5_BBS_URL ?>/board.php?bo_table=apply03">+더보기</a>
		</div>
		<div class="area_table">
			<table>
				<thead>
					<tr>
						<th scope="col">번호</th>
						<th scope="col">워크숍/학술대회명</th>
						<th scope="col">접수기간</th>
						<th scope="col">행사기간</th>
						<th scope="col">비용</th>
						<th scope="col">이수현황</th>
						<th scope="col">수료증</th>
					</tr>
				</thead>
				<tbody>
					<!-- 목록 5개-->
					<?
							$real_cnt =0;
							for ($i=0; $row=sql_fetch_array($reulst_academy); $i++){

								$sql ="select * from g5_write_academy where wr_id = {$row['wr_4']}";
								$info_wr = sql_fetch($sql);
								if($info_wr['wr_id']==''){
									continue;
								}
								$real_cnt ++;
								switch($row['wr_5']){
										case 1: $flg_state = 'npass';
													$txt_state = '미완료';
													break;
										case 2: $flg_state = 'pass';
													$txt_state = '완료';
													break;
										case 3: $flg_state = 'cancle';
													$txt_state = '환불';
													break;
										default :	$flg_state = 'npass';
														$txt_state = '미완료';
								}
							if(!empty($row['wr_6'])){
									$file_href = G5_DATA_URL."/file/apply03/".$row['wr_6'];
							}
							else{
									$file_href = "javascript:alert('파일이 존재하지 않습니다.')";
							}
								
					?>
					<tr>
						<td class="td_number"><?=$i+1?></td>
						<td class="td_subject">
							<a href="<?php echo G5_BBS_URL?>/board.php?bo_table=academy&wr_id=<?=$row['wr_4']?>">
									<?=$info_wr['wr_subject']?>
							</a>
						</td>
						<td class="td_data01"><span class="m_data">접수기간</span><?=$info_wr['wr_1']?> ~ <br><?=$info_wr['wr_2']?></td>
						<td class="td_data02"><span class="m_data">교육기간</span><?=$info_wr['wr_3']?> ~ <br><?=$info_wr['wr_4']?></td>
						<td class="td_price"><?=number_format($info_wr['wr_5']);?>원</td>
						<td class="td_status"><span class="<?=$flg_state?>"><?=$txt_state?></span></td>
						<td class="td_certify"><a href="<?=$file_href?>" class="btn_downloads"><em><span class="m_txt">수료증</span>다운받기</em></a></td>
					</tr>	
					<?} if($real_cnt==0)echo '<tr><td class="nodata" colspan=7>신청한 내역이 없습니다.</td></tr>';?>					
				</tbody>
			</table>	
		</div>
	</div>
	<div class="area_apply">
		<div class="title">
			<h3>교육신청현황<em>사례발표는 수료증이 없습니다.</em></h3>
			<a class="btn_more" href="<?php echo G5_BBS_URL ?>/board.php?bo_table=apply01&sca=<?=$arr_cate[0]?>">+더보기</a>
		</div>
		<div class="area_table">
			<table>
				<thead>
					<tr>
						<th scope="col">번호</th>
						<th scope="col">교육명</th>
						<th scope="col">접수기간</th>
						<th scope="col">교육기간</th>
						<th scope="col">교육비용</th>
						<th scope="col">이수현황</th>
						<th scope="col">수료증</th>
					</tr>
				</thead>
				<tbody>
					<!-- 목록 5개-->
					<?
							$real_cnt=0;
							for ($i=0; $row=sql_fetch_array($reulst_edu); $i++){

								$sql ="select * from g5_write_edu where wr_id = {$row['wr_4']}";
								$info_wr = sql_fetch($sql);
								if($info_wr['wr_id']==''){
									continue;
								}
								$real_cnt ++;
								switch($row['wr_5']){
										case 1: $flg_state = 'npass';
													$txt_state = '미완료';
													break;
										case 2: $flg_state = 'pass';
													$txt_state = '완료';
													break;
										case 3: $flg_state = 'cancle';
													$txt_state = '환불';
													break;
										default :	$flg_state = 'npass';
														$txt_state = '미완료';
								}
							if(!empty($row['wr_6'])){
									$file_href = G5_DATA_URL."/file/apply01/".$row['wr_6'];
							}
							else{
									$file_href = "javascript:alert('파일이 존재하지 않습니다.')";
							}
								
					?>
					<tr>
						<td class="td_number"><?=$i+1?></td>
						<td class="td_subject">
							<a href="<?php echo G5_BBS_URL?>/board.php?bo_table=edu&wr_id=<?=$row['wr_4']?>">
									<?=$info_wr['wr_subject']?>
							</a>
						</td>
						<td class="td_data01"><span class="m_data">접수기간</span><?=$info_wr['wr_1']?> ~ <br><?=$info_wr['wr_2']?></td>
						<td class="td_data02"><span class="m_data">교육기간</span><?=$info_wr['wr_3']?> ~ <br><?=$info_wr['wr_4']?></td>
						<td class="td_price"><?=number_format($info_wr['wr_5']);?>원</td>
						<td class="td_status"><span class="<?=$flg_state?>"><?=$txt_state?></span></td>
						<td class="td_certify"><a href="<?=$file_href?>" class="btn_downloads"><em><span class="m_txt">수료증</span>다운받기</em></a></td>
					</tr>	
					<?} if($real_cnt==0)echo '<tr><td class="nodata" colspan=7>신청한 내역이 없습니다.</td></tr>';?>					
				</tbody>
			</table>	
		</div>
	</div>
	<div class="area_apply">
		<div class="title">
			<h3>자격시험 신청현황</h3>
			<a class="btn_more" href="<?php echo G5_BBS_URL ?>/board.php?bo_table=apply02">+더보기</a>
		</div>
		<div class="area_table">
			<table>
				<thead>
					<tr>
						<th scope="col">번호</th>
						<th scope="col">교육명</th>
						<th scope="col">접수기간</th>
						<th scope="col">응시일</th>
						<th scope="col">응시비용</th>
						<th scope="col">합격여부</th>
						<th scope="col">자격증</th>
					</tr>
				</thead>
				<tbody>

					<?

							for ($i=0; $row=sql_fetch_array($reulst_certify); $i++){

								$sql ="select * from g5_write_certify where wr_id = {$row['wr_4']}";
								$info_wr = sql_fetch($sql);
								if($info_wr['wr_id']==''){
									continue;
								}
								switch($row['wr_5']){
										case 1: $flg_state = 'npass';
													$txt_state = '불합격';
													break;
										case 2: $flg_state = 'pass';
													$txt_state = '합격';
													break;
										case 3: $flg_state = 'cancle';
													$txt_state = '취소';
													break;
									default :	$flg_state = 'npass';
													$txt_state = '심사중';
								}

							if(!empty($row['wr_6'])){
									$file_href = G5_DATA_URL."/file/apply02/".$row['wr_6'];
							}
							else{
									$file_href = "javascript:alert('파일이 존재하지 않습니다.')";
							}
								
					
					?>
					
					<tr>
						<td class="td_number">1</td>
						<td class="td_subject">

							<a href="<?php echo G5_BBS_URL?>/board.php?bo_table=certify&wr_id=<?=$row['wr_4']?>">
								<?=$info_wr['wr_subject']?>
							</a>
						</td>
						<td class="td_data01"><span class="m_data">접수기간</span><?=$info_wr['wr_1']?> ~ <br><?=$info_wr['wr_2']?></td>
						<td class="td_data02"><span class="m_data">응시일</span><?=$info_wr['wr_3']?> ~ <br><?=$info_wr['wr_4']?></td>
						<td class="td_price"><?=number_format($info_wr['wr_5']);?>원</td>
						<td class="td_status"><span class="<?=$flg_state?>"><?=$txt_state?></span></td>
						<td class="td_certify"><a href="<?=$file_href?>" class="btn_downloads"><em><span class="m_txt">자격증</span> 다운받기</em></a></td>
					</tr>
					<?}  if($i==0)echo '<tr><td class="nodata" colspan=7>신청한 내역이 없습니다.</td></tr>';?>				
					<!--
					<?php if (count($list) == 0) { echo '<tr><td colspan=7"'.$colspan.'" class="empty_table">게시물이 없습니다.</td></tr>'; } ?>
					-->
				</tbody>
			</table>	
		</div>
	</div>

    <div class="area_apply">
        <div class="title">
            <h3>인형/도서 구매내역</h3>
            <a class="btn_more" href="<?php echo G5_BBS_URL ?>/board.php?bo_table=order_list">+더보기</a>
        </div>
        <div class="area_table">
            <table>
                <thead>
                <tr>
                    <th scope="col">구매번호</th>
                    <th scope="col">상품명</th>
                    <th scope="col">가격</th>
                    <th scope="col">구매수량</th>
                    <th scope="col">배송비</th>
                    <th scope="col">추가금액</th>
                    <th scope="col">합계</th>
                    <th scope="col">배송여부</th>
                    <th scope="col">상세보기</th>
                </tr>
                </thead>
                <tbody>

                <?
                $sql = "select * from `g5_order_list` where `mb_id` = '$member[mb_id]' and `bo_table` = 'store' and `state` > 1 order by `idx` desc limit 5";
                $re = sql_query($sql);
                for ($i=0; $row=sql_fetch_array($re); $i++){

                    $state = "";
                    if($row['state'] == 1 || $row['state'] == 2){
                        $state = "결제완료";
                    } else if($row['state'] == 3){
                        $state = "배송완료";
                    } else if($row['state'] == 4){
                        $state = "결제취소";
                    } else {
                        continue;
                    }
                    ?>

                    <tr>
                        <td class="td_number"><?=$row['buy_no']?></td>
                        <td class="td_data01"><a><?=$row['item_title']?></a></td>
						<td class="td_price"><span class="m_data">가격</span><?=number_format($row['item_cost']);?>원</td>
                        <td class="td_price"><span class="m_data">구매수량</span><?=number_format($row['item_count']);?>개</td>
                        <td class="td_price"><span class="m_data">구매수량</span><?=number_format($row['ship_cost']);?>원</td>
                        <td class="td_price"><span class="m_data">구매수량</span><?=number_format($row['add_cost']);?>원</td>
                        <td class="td_price"><?=number_format($row['sum_cost']);?>원</td>
                        <td class="td_status"><?=$state?></td>
                        <td class="td_detail"><a class="btn-detail" href="./order_view.php?idx=<?=$row['idx']?>">상세보기</a></td>
                    </tr>
                <?}  if($i==0)echo '<tr><td class="nodata" colspan=7>구매한 내역이 없습니다.</td></tr>';?>
                <!--
					<?php if (count($list) == 0) { echo '<tr><td colspan=7"'.$colspan.'" class="empty_table">구매한 내역이 없습니다.</td></tr>'; } ?>
					-->
                </tbody>
            </table>
        </div>
    </div>

<?
include_once('./_tail.php');
?>