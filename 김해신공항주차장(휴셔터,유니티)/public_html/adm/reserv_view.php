<?php
include_once('./_common.php');

include_once(G5_PATH.'/head.sub.php');
$sql = " select * from g5_write_b_reserv where wr_id='$wr_id'";
$row=sql_fetch($sql);
?>
<!-- 가격 모달창 시작 -->
<? /*
  <div class="modal fade" id="myModal" role="dialog"> <!-- 사용자 지정 부분① : id명 -->
    <div class="modal-dialog">

      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">×</button>
          <h4 class="modal-title">예상금액 계산하기</h4> <!-- 사용자 지정 부분② : 타이틀 -->
        </div>

        <div class="modal-body">
          <dl>
              <dt>총예상 결제금액</dt>
              <dd>
                    <ul>
                        <li>전차종 1일 5,000원 입니다 - 평일,주말,공휴일 상관없이 일괄 적용됩니다 </li>
                        <li>시간당 요금은 1시간 2,000원 입니다 30분 이상은 1시간 요금이 적용됩니다 </li>
                        <li>차량을 맡기는 시점부터 계산되어 집니다 </li>
                    </ul>
              </dd>
              <dd>
                  <div class="tbl">
                      <table summary="주차비결제금액">
                        <colgroup>
                            <col style="width:30%" />
                            <col style="width:*" />
                        </colgroup>
                        <tbody>
                            <tr>
                                <th>주차비결제금액</th>
                                <td id="price"></td>
                            </tr>
                        </tbody>
                      </table>
                  </div>
              </dd>
          </dl>
          
          <dl>
              <dt>날짜범위</dt>
              <dd>
                      <div class="tbl">
                          <table summary="날짜범위">
                            <colgroup>
                                <col style="width:30%" />
                                <col style="width:*" />
                            </colgroup>
                            <tbody>
                                <tr>
                                    <th>접수예정시간</th>
                                    <td id="start_date"></td>
                                </tr>
                                <tr>
                                    <th>도착시간</th>
                                    <td id="end_date"></td>
                                </tr>
                            </tbody>
                          </table>
                      </div>
              </dd>
          </dl> 
           
          <dl>  
              <dt>일수</dt>
              <dd>
                      <div class="tbl">
                        <table summary="일수">
                        <colgroup>
                            <col style="width:30%" />
                            <col style="width:*" />
                        </colgroup>
                        <tbody>
                            <tr>
                                <th>일수(시간)</th>
                                <td id="day"></td>
                            </tr>
                        </tbody>
                      </table>
                  </div>
              </dd>
          </dl>
          
          <dl>
		  <dt>명절,성수기</dt>
          <dd>
              <ul>
                  <li>명절,성수기는 요금이 변동될수 있습니다.</li>
                  <li>명절,성수기는 요금은 따로 문의를 해주시기 바랍니다.</li>
              </ul>
          </dd>
          </dl>
        </div>

        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">창닫기</button>
        </div>
      </div>
    </div>
  </div>*/?>
<!-- //가격 모달창 -->
<table width="100%" border="0" align="center" cellpadding="2" cellspacing="2" align='center'>


	<tr>
		<td height='15'></td>
	</tr>
	<tr>
		<td align='center'>
	
			<table width='98%' cellpadding='0' cellspacing='0' border='0'>
				<tr>
					<td height='700' bgcolor='#ffffff' align='center' valign='top'>



						<table width='95%' border='0' cellpadding='1' cellspacing='4' align='center' style='font-size:13px;'>
							<tr>
								<td colspan='2' style='font-size:17px; color:#285F9E'><b>● 기본정보</b>
							</tr>
							<tr>
								<td colspan='2' height='1' bgcolor='#efefef'></td>
							</tr>
							<tr > 
								<td width='200' height='30'><b>등록자/스탭</td>
								<td bgcolor='#ffffff'>
									<table cellpadding='2' cellspacing='2' border='0' style='font-size:13px;'>
										<tr>
											<td><?=$row[wr_15]?></td>
										</tr>
									</table>
								</td>
							</tr>
							<tr>
								<td colspan='2' height='1' bgcolor='#efefef'></td>
							</tr>
							<tr > 
								<td  height='30'><b>주차장위치</td>
								<td bgcolor='#ffffff'>
									<table cellpadding='2' cellspacing='2' border='0' style='font-size:13px;'>
										<tr>
											<td><?=$row[wr_subject]?></td>
										</tr>
									</table>
								</td>
							</tr>
							<tr>
								<td colspan='2' height='1' bgcolor='#efefef'></td>
							</tr>
							<tr> 
								<td height='30'><b>탑승인원</td>
								<td bgcolor='#ffffff'>
									<table cellpadding='2' cellspacing='2' border='0' style='font-size:13px;'>
										<tr>
											<td><?php echo $row[wr_23]?></td>
										</tr>
									</table>
								</td>
							</tr>
								<td height='30'><b>수하물</td>
								<td bgcolor='#ffffff'>
									<table cellpadding='2' cellspacing='2' border='0' style='font-size:13px;'>
										<tr>
											<td><?php echo $row[wr_24]?></td>
										</tr>
									</table>
								</td>
							</tr>
							<tr> 
								<td height='30'><b>국제/국내</td>
								<td bgcolor='#ffffff'>
									<table cellpadding='2' cellspacing='2' border='0' style='font-size:13px;'>
										<tr>
											<td><?=$row[wr_4]?></td>
										</tr>
									</table>
								</td>
							</tr>
							<tr>
								<td colspan='2' height='1' bgcolor='#efefef'></td>
							</tr>
							<tr > 
								<td  height='30'><b>구분</td>
								<td bgcolor='#ffffff'>
									<table cellpadding='2' cellspacing='2' border='0' style='font-size:13px;'>
										<tr>
											<td><?=$row[wr_16]?></td>
										</tr>
									</table>
								</td>
							</tr>
							<tr>
								<td colspan='2' height='1' bgcolor='#efefef'></td>
							</tr>

							<tr > 
								<td  height='30' ><b>고객성명</td>
								<td bgcolor='#ffffff'>
									<table cellpadding='2' cellspacing='2' border='0' style='font-size:13px;'>
										<tr>
											<td><?=$row[wr_name]?></td>
										</tr>
									</table>
								</td>
							</tr>

							<tr>
								<td colspan='2' height='1' bgcolor='#efefef'></td>
							</tr>

							<tr> 
								<td  height='30'><b>차량기종</td>
								<td bgcolor='#ffffff'>
									<table width='98%' cellpadding='2' cellspacing='2' border='0' style='font-size:13px;'>
										<tr>
											<td><?=$row[wr_5]?></td>
										</tr>
										
									</table>
								</td>
							</tr>

							<tr>
								<td colspan='2' height='1' bgcolor='#efefef'></td>
							</tr>

							<tr> 
								<td  height='30'><b>차량번호</td>
								<td bgcolor='#ffffff'>
									<table width='98%' cellpadding='2' cellspacing='2' border='0' style='font-size:13px;'>
										<tr>
											<td><?=$row[wr_6]?></td>
										</tr>

									</table>
								</td>
							</tr>
							<tr>
								<td colspan='2' height='1' bgcolor='#efefef'></td>
							</tr>

							<tr> 
								<td height='30'><b>핸드폰 번호</td>
								<td bgcolor='#ffffff'>
									<table width='98%' cellpadding='2' cellspacing='2' border='0' style='font-size:13px;'>
										<tr>
											<td><?=$row[wr_3]?></td>
										</tr>
									</table>
								</td>
							</tr>





							<tr>
								<td height='30'></td>
							</tr>


							<tr>
								<td colspan='2' style='font-size:17px; color:#285F9E'><b>● 여행정보</b>
							</tr>


							<tr>
								<td colspan='2' height='1' bgcolor='#efefef'></td>
							</tr>

							<tr> 
								<td  height='30'><b>입국항공편명</td>
								<td bgcolor='#ffffff'>
									<table width='98%' cellpadding='2' cellspacing='2' border='0' style='font-size:13px;'>
										<tr>
											<td><?=$row[wr_17]?></td>
										</tr>
									</table>		
								</td>
							</tr>
							<tr>
								<td height='30'></td>
							</tr>


							<tr>
								<td colspan='2' style='font-size:17px; color:#285F9E'><b>● 주차요금계산</b>
							</tr>
							<tr>
								<td colspan='2' height='1' bgcolor='#efefef'></td>
							</tr>


							<tr> 
								<td  height='30'><b>공항도착 예정시간</td>
								<td bgcolor='#ffffff'>
									<table width='98%' cellpadding='2' cellspacing='2' border='0' style='font-size:13px;'>
										<tr>
											<td>
												<?=$row[wr_1]?><br>
											</td>

										</tr>
									</table>					
								
								</td>
							</tr>

							<tr> 
								<td  height='30'><b>입국기 도착시간</td>
								<td bgcolor='#ffffff'>
									<table width='98%' cellpadding='2' cellspacing='2' border='0' style='font-size:13px;'>
										<tr>
											<td>
												<?=$row[wr_2]?><br>
											</td>

										</tr>
									</table>
								</td>
							</tr>
							<tr> 
								<td  height='30'><b>요금</td>
								<td bgcolor='#ffffff'>
									<table width='98%' cellpadding='2' cellspacing='2' border='0' style='font-size:13px;'>
										<tr>
											<td><?=$row[wr_25]?></td>
										</tr>
									</table>
								</td>
							</tr>
							<tr> 
								<td  height='30'><b>총금액</td>
								<td bgcolor='#ffffff'>
									<table width='98%' cellpadding='2' cellspacing='2' border='0' style='font-size:13px;'>
										<tr>
											<td><?=number_format($row[wr_8])?>원</td>
										</tr>
									</table>
								</td>
							</tr>


							<tr>
								<td height='30'></td>
							</tr>


							<tr>
								<td colspan='2' style='font-size:17px; color:#285F9E'><b>● 기록정보</b>
							</tr>

							<tr>
								<td colspan='2' height='1' bgcolor='#efefef'></td>
							</tr>
							<tr> 
								<td  height='30'><b>주차위치</td>
								<td bgcolor='#ffffff'>
									<table cellpadding='2' cellspacing='2' border='0' style='font-size:13px;'>
										<tr>
											<td><?=$row[wr_9]?></td>
										</tr>

									</table>		
								</td>
							</tr>

							<tr>
								<td colspan='2' height='1' bgcolor='#efefef'></td>
							</tr>

							<!--<tr> 
								<td  height='30'><b>주행거리</td>
								<td bgcolor='#ffffff'>
									<table width='98%' cellpadding='2' cellspacing='2' border='0' style='font-size:13px;'>
										<tr>
											<td>km (단위:km)</td>
										</tr>
									</table>		
								</td>
							</tr>

							<tr>
								<td colspan='2' height='1' bgcolor='#efefef'></td>
							</tr>-->

							<tr> 
								<td  height='30'><b>입차시간</td>
								<td bgcolor='#ffffff'>
									<table width='98%' cellpadding='2' cellspacing='2' border='0' style='font-size:13px;'>
										<tr>
											<td><?=$row[wr_19]?></td>
										</tr>

									</table>		
								</td>
							</tr>
							<tr>
								<td colspan='2' height='1' bgcolor='#efefef'></td>
							</tr>

							<tr> 
								<td  height='30'><b>출차시간</td>
								<td bgcolor='#ffffff'>
									<table width='98%' cellpadding='2' cellspacing='2' border='0' style='font-size:13px;'>
										<tr>
											<td><?=$row[wr_17]?></td>
										</tr>
									</table>		
								</td>
							</tr>
							<tr>
								<td height='30'></td>
							</tr>


							<tr>
								<td colspan='2' style='font-size:17px; color:#285F9E'><b>● 기타정보</b>
							</tr>

							<tr>
								<td colspan='2' height='1' bgcolor='#efefef'></td>
							</tr>
							<tr> 
								<td  height='30'><b>키보관여부</td>
								<td bgcolor='#ffffff'>
									<table width='98%' cellpadding='2' cellspacing='2' border='0'>
										<tr>
											<td><?=$row[wr_12]?></td>
										</tr>
									</table>	
								</td>
							</tr>
							<tr>
								<td colspan='2' height='1' bgcolor='#efefef'></td>
							</tr>
							<tr> 
								<td  height='30'><b>특기사항</td>
								<td bgcolor='#ffffff'>
									<table width='98%' cellpadding='2' cellspacing='2' border='0'>
										<tr>
											<td><?=$row[wr_content]?></td>
										</tr>

									</table>	
								</td>
							</tr>

							<tr>
								<td colspan='2' height='1' bgcolor='#efefef'></td>
							</tr>
						</table>




						<table cellpadding='2' cellspacing='2' border='0' align='center'>
							<tr>
								<td><a href='javascript:window.close();'><img src='http://ap.nehard.kr/skin_385/images/btn_ok.png' border='0'></a></td>
							</tr>
						</table>
						</form>



 						<table cellpadding='2' cellspacing='2' border='0' align='center'>
							<tr>
								<td height='10'></td>
							</tr>
						</table>

								

 
 

								
					</td>
				</tr>
			</table>

					
					
		</td>
	</tr>
	<tr>
		<td height='15'></td>
	</tr>
</table>