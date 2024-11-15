<?
	$site_path = '../';
	$site_url = '../';
	if(!isset($ss[1])) $ss[1] = '-1';
	require_once($site_path."include/admin.lib.inc.php");
 
 header( "Content-type: application/vnd.ms-excel; charset=euc-kr");
 header( "Content-Disposition: attachment; filename=회원목록.xls" );
 header( "Content-Description: PHP4 Generated Data" );
 print("<meta http-equiv=\"Content-Type\" content=\"application/vnd.ms-excel; charset=euc-kr\">"); 

  $qstr='';
	for($i=0;$i<count($ss_key);$i++) {
    switch ($ss_key[$i]) {
			/***********************************************************************/
			// 검색어로 검색
			// "아이디","이름","이메일","닉네임","주민번호"
			case 0 : 
				if(!empty($kw)) {
					switch ($ss[$ss_key[$i]]) {
						case 0 : 
									$qstr .= " AND `mb_id` LIKE '%$kw%'";
									break;
						case 1 : 
									$qstr .= " AND `mb_name` LIKE '%$kw%'";
									break;
						case 2 : 
									$qstr .= " AND `mb_email` LIKE '%$kw%'";
									break;
						case 3 : 
									$qstr .= " AND `mb_nick` LIKE '%$kw%'";
									break;
						case 4 : 
									$jumin = get_password_str($kw);
									$qstr .= " AND `mb_jumin` LIKE '$jumin'";
									break;
					}
				}
				break; 
			/***********************************************************************/
			// 필터 조건에 의한 필터링
      case 1 : // 회원구분
				if($ss[$ss_key[$i]] != '-1') {
					$qstr .= " AND '{$ss[$ss_key[$i]]}' =  `mb_state` ";
				}
				break;
    }
	}

  if (empty($ot)) $ot = 10;
  switch ($ot) {
    case 10 : $ostr .= " ORDER BY mb_num DESC";		break;
    case 20 : $ostr .= " ORDER BY UserID,RegDate DESC";						break;
    case 30 : $ostr .= " ORDER BY Origin,RegDate DESC";						break;
    case 40 : $ostr .= " ORDER BY RegDate DESC";									break;
    case 50 : $ostr .= " ORDER BY LastUpdate DESC,RegDate DESC";	break;
  }

	$dbqry="
		SELECT count(*) as row_count 
		FROM `$db_table_member`
		WHERE mb_id != 'lets080' $qstr
	";
	$rs = query($dbqry,$dbcon);
	fetch($rs,array("row_count"));
	
	$page_info=rg_navigation($page,$row_count,20,10);

?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=euc-kr">
</head>
<body bgcolor=white> 
<table cellspacing='0' cellpadding='2' border='1' bordercolor='black'>
          <tr> 
            <td>아이디</td>
            <td>닉네임</td>
            <td>이름</td>
            <td>이메일</td>
            <td>전화번호</td>
            <td>핸드폰번호</td>
            <td>우편번호</td>
            <td>주소</td>
            <td>상세주소</td>
            <td>자기소개</td>
            <td>회원등급</td>
            <td>회원상태</td>
            <td>가입일</td>
          </tr>
          <?
	$dbqry="
		SELECT *
		FROM `$db_table_member`
		WHERE mb_id != 'lets080' $qstr
		$ostr";
	
	$rs=query($dbqry,$dbcon);
	$no = $page_info[total_rows]-$page_info[offset]+1;
	for ($i=0;$i<mysql_num_rows($rs);$i++) {
		$R=mysql_fetch_array($rs);
		$no--;
?>
          <tr> 
            <td><?=$R[mb_id]?></td>
            <td><?=$R[mb_nick]?></td>
            <td><?=$R[mb_name]?></td>
            <td><?=$R[mb_email]?></td>
            <td><?=$R[mb_tel]?></td>
            <td><?=$R[mb_mobile]?></td>
            <td><?=$R[mb_post]?></td>
            <td><?=$R[mb_address1]?></td>
            <td><?=$R[mb_address2]?></td>
            <td><?=$R[mb_greet]?></td>
            <td><?=$R[mb_level]?></td>
            <td><?=$mb_states[$R[mb_state]]?></td>
            <td><?=rg_date($R[mb_reg_date],'%Y-%m-%d')?></td>
          </tr>
          <?

	}
?>
        </table>
</body>
</html>

