<?php
include_once('./_common.php');

$mb_id = $member['mb_id'];
$it_id = $wr_id;
$it_tot_price = $hap_tot;
$it_tot_price2 = $hap_tot2;
$ct_time = date('Y-m-d H:i:s');

// 바로구매
if($ct_direct == 'y'){
	$ct_status = '대기';

	// 보유포인트 체크
	$sql="select sum(po_point) as total from g5_point where mb_id='$mb_id' and po_rel_table != '@login'";
	$result=sql_query($sql);
	$row=sql_fetch_array($result);
	$mb_point = ($row[total])? $row[total] : 0;

	if((int)$hap_tot2 > (int)$mb_point){
		alert("보유 포인트가 부족합니다.");
		exit;
	} 

	$ctc_sql = " select *,count(*) as cnt from g5_ptmall_cart where mb_id='{$mb_id}' and it_bo_table='{$bo_table}' and it_id='{$it_id}' and ct_status='대기' and ct_direct='y' ";
	$ctc_row = sql_fetch($ctc_sql);

	if($ctc_row['cnt'] == 0){	// 장바구니에 해당 제품이 비어 있을때
		/* 장바구니 등록 STR */
		$ct_sql = " insert into g5_ptmall_cart set 
		mb_id = '{$mb_id}',
		it_bo_table = '{$bo_table}',
		it_id = '{$it_id}',
		it_img = '{$it_img}',
		it_name = '{$it_name}',
		it_price = '{$it_price}',
		it_price2 = '{$it_price2}',
		it_tot_price = '{$it_tot_price}',
		it_tot_price2 = '{$it_tot_price2}',
		it_fee = '{$it_fee}',
		ct_status = '{$ct_status}',
		ct_time = '{$ct_time}',
		ct_direct = '{$ct_direct}',
		opt_cnt = '".count($opt_cnt)."'
		";
		sql_query($ct_sql);
		$ct_idx = sql_insert_id();
		/* 장바구니 등록 END */

		/* 옵션 등록 STR */
		// 옵션있을때
		if(count($opt_cnt) > 0){
			for($o=0; $o<count($opt_cnt); $o++){
				$opt1_arr = explode('|',$opt1[$o]);
				$opt2_arr = explode('|',$opt2[$o]);
				$opt3_arr = explode('|',$opt3[$o]);

				$opt_sql = " insert into g5_ptmall_cart_opt set 
				ct_idx = '{$ct_idx}',
				mb_id = '{$mb_id}',
				opt_sort = '{$o}',
				opt1_idx = '{$opt1_arr[0]}',
				opt1_name = '{$opt1_arr[1]}',
				opt1_price = '{$opt1_arr[2]}',
				opt1_price2 = '{$opt1_arr[4]}',
				opt1_value = '{$opt1[$o]}',
				opt2_idx = '{$opt2_arr[0]}',
				opt2_name = '{$opt2_arr[1]}',
				opt2_price = '{$opt2_arr[2]}',
				opt2_price2 = '{$opt2_arr[4]}',
				opt2_value = '{$opt2[$o]}',
				opt3_idx = '{$opt3_arr[0]}',
				opt3_name = '{$opt3_arr[1]}',
				opt3_price = '{$opt3_arr[2]}',
				opt3_price2 = '{$opt3_arr[4]}',
				opt3_value = '{$opt3[$o]}',
				opt_quantity = '{$quantity[$o]}',
				opt_tot_price = '{$opt_tot_price[$o]}',
				opt_tot_price2 = '{$opt_tot_price2[$o]}'
				";
				sql_query($opt_sql);
			}
		}
		/* 옵션 등록 END */

		/* 주문 등록 STR */
		$order_sql = " insert into g5_ptmall_order set
		mb_id = '{$member['mb_id']}',
		mb_name = '{$member['mb_name']}',
		mb_hp = '{$member['mb_hp']}'
		";
		sql_query($order_sql);
		$od_idx = sql_insert_id();
		/* 주문 등록 END */

		/* 장바구니에 주문번호 삽입 STR */
		$ct_up_sql = " update g5_ptmall_cart set od_idx='{$od_idx}' where ct_idx='{$ct_idx}' ";
		sql_query($ct_up_sql);
		/* 장바구니에 주문번호 삽입 END */


	} else {	// 장바구니에 해당 제품이 있을때

		$ct_idx = $ctc_row['ct_idx'];

		/* 옵션 초기화 (삭제) STR */
		$opt_del_sql = " delete from g5_ptmall_cart_opt where ct_idx='{$ct_idx}' ";
		sql_query($opt_del_sql);
		/* 옵션 초기화 (삭제) END */

		/* 옵션 등록 STR */
		// 옵션있을때
		if(count($opt_cnt) > 0){
			for($o=0; $o<count($opt_cnt); $o++){
				$opt1_arr = explode('|',$opt1[$o]);
				$opt2_arr = explode('|',$opt2[$o]);
				$opt3_arr = explode('|',$opt3[$o]);

				$opt_sql = " insert into g5_ptmall_cart_opt set 
				ct_idx = '{$ct_idx}',
				mb_id = '{$mb_id}',
				opt_sort = '{$o}',
				opt1_idx = '{$opt1_arr[0]}',
				opt1_name = '{$opt1_arr[1]}',
				opt1_price = '{$opt1_arr[2]}',
				opt1_price2 = '{$opt1_arr[4]}',
				opt1_value = '{$opt1[$o]}',
				opt2_idx = '{$opt2_arr[0]}',
				opt2_name = '{$opt2_arr[1]}',
				opt2_price = '{$opt2_arr[2]}',
				opt2_price2 = '{$opt2_arr[4]}',
				opt2_value = '{$opt2[$o]}',
				opt3_idx = '{$opt3_arr[0]}',
				opt3_name = '{$opt3_arr[1]}',
				opt3_price = '{$opt3_arr[2]}',
				opt3_price2 = '{$opt3_arr[4]}',
				opt3_value = '{$opt3[$o]}',
				opt_quantity = '{$quantity[$o]}',
				opt_tot_price = '{$opt_tot_price[$o]}',
				opt_tot_price2 = '{$opt_tot_price2[$o]}'
				";
				sql_query($opt_sql);
			}
		}
		/* 옵션 등록 END */

		if($ctc_row['od_idx'] == ''){
			/* 주문 등록 STR */
			$order_sql = " insert into g5_ptmall_order set
			mb_id = '{$member['mb_id']}',
			mb_name = '{$member['mb_name']}',
			mb_hp = '{$member['mb_hp']}'
			";
			
			sql_query($order_sql);
			$od_idx = sql_insert_id();
			/* 주문 등록 END */
		}else{
			$od_idx = $ctc_row['od_idx'];
			$order_sql = " update g5_ptmall_order set
			mb_id = '{$member['mb_id']}',
			mb_name = '{$member['mb_name']}',
			mb_hp = '{$member['mb_hp']}' 
			where od_idx = '{$od_idx}'
			";
			sql_query($order_sql);
		}
		
		/* 장바구니 업데이트 STR */
		$ct_sql = " update g5_ptmall_cart set  
		od_idx = '{$od_idx}',
		it_bo_table = '{$bo_table}',
		it_img = '{$it_img}',
		it_name = '{$it_name}',
		it_price = '{$it_price}',
        it_price2 = '{$it_price2}',
		it_tot_price = '{$it_tot_price}',
        it_tot_price2 = '{$it_tot_price2}',
		it_fee = '{$it_fee}',
		ct_status = '{$ct_status}',
		ct_time = '{$ct_time}',
		ct_direct = '{$ct_direct}',
		opt_cnt = '".count($opt_cnt)."' 
		where ct_idx = '{$ct_idx}'
		";
		sql_query($ct_sql);
		/* 장바구니 업데이트 END */
	}

	goto_url(G5_BBS_URL.'/ptmall_order.php?od_idx='.$od_idx);
}




// 장바구니 담기
if($ct_direct == 'n'){
	$ct_status = '대기';

	$ctc_sql = " select *,count(*) as cnt from g5_ptmall_cart where mb_id='{$mb_id}' and it_bo_table='{$bo_table}' and it_id='{$it_id}' and ct_status='대기' and ct_direct='n' ";
	$ctc_row = sql_fetch($ctc_sql);

	if($ctc_row['cnt'] == 0){	// 장바구니에 해당 제품이 비어 있을때
		$ct_sql = " insert into g5_ptmall_cart set 
		mb_id = '{$mb_id}',
		it_bo_table = '{$bo_table}',
		it_id = '{$it_id}',
		it_img = '{$it_img}',
		it_name = '{$it_name}',
		it_price = '{$it_price}',
		it_price2 = '{$it_price2}',
		it_tot_price = '{$it_tot_price}',
		it_tot_price2 = '{$it_tot_price2}',
		it_fee = '{$it_fee}',
		ct_status = '{$ct_status}',
		ct_time = '{$ct_time}',
		ct_direct = '{$ct_direct}',
		opt_cnt = '".count($opt_cnt)."'
		";
		sql_query($ct_sql);
		$ct_idx = sql_insert_id();

		// 옵션있을때
		if(count($opt_cnt) > 0){
			for($o=0; $o<count($opt_cnt); $o++){
				$opt1_arr = explode('|',$opt1[$o]);
				$opt2_arr = explode('|',$opt2[$o]);
				$opt3_arr = explode('|',$opt3[$o]);

				$opt_sql = " insert into g5_ptmall_cart_opt set 
				ct_idx = '{$ct_idx}',
				mb_id = '{$mb_id}',
				opt_sort = '{$o}',
				opt1_idx = '{$opt1_arr[0]}',
				opt1_name = '{$opt1_arr[1]}',
				opt1_price = '{$opt1_arr[2]}',
				opt1_price2 = '{$opt1_arr[4]}',
				opt1_value = '{$opt1[$o]}',
				opt2_idx = '{$opt2_arr[0]}',
				opt2_name = '{$opt2_arr[1]}',
				opt2_price = '{$opt2_arr[2]}',
				opt2_price2 = '{$opt2_arr[4]}',
				opt2_value = '{$opt2[$o]}',
				opt3_idx = '{$opt3_arr[0]}',
				opt3_name = '{$opt3_arr[1]}',
				opt3_price = '{$opt3_arr[2]}',
				opt3_price2 = '{$opt3_arr[4]}',
				opt3_value = '{$opt3[$o]}',
				opt_quantity = '{$quantity[$o]}',
				opt_tot_price = '{$opt_tot_price[$o]}',
				opt_tot_price2 = '{$opt_tot_price2[$o]}'
				";
				sql_query($opt_sql);
			}
		}
	} else {	// 장바구니에 해당 제품이 있을때
		// 옵션있을때
		if(count($opt_cnt) > 0){
			$total_sum = 0;
			$total_sum2 = 0;
			for($o=0; $o<count($opt_cnt); $o++){
				$opt1_arr = explode('|',$opt1[$o]);
				if($opt1_arr[0] == '') $opt1_arr[0] = 0;
				if($opt1_arr[2] == '') $opt1_arr[2] = 0;

				$opt2_arr = explode('|',$opt2[$o]);
				if($opt2_arr[0] == '') $opt2_arr[0] = 0;
				if($opt2_arr[2] == '') $opt2_arr[2] = 0;

				$opt3_arr = explode('|',$opt3[$o]);
				if($opt3_arr[0] == '') $opt3_arr[0] = 0;
				if($opt3_arr[2] == '') $opt3_arr[2] = 0;

				$chk_sql = " select *,count(*) as cnt from g5_ptmall_cart_opt where ct_idx='{$ctc_row['ct_idx']}' and mb_id='{$mb_id}' and opt1_idx='{$opt1_arr[0]}' and opt2_idx='{$opt2_arr[0]}' and opt3_idx='{$opt3_arr[0]}' ";
				$chk_row = sql_fetch($chk_sql);
				if($chk_row['cnt'] > 0){
					$opt_quantity = $chk_row['opt_quantity'] + $quantity[$o];	// 옵션 개수 더하기
					$opt_tot_price_val = ($ctc_row['it_price'] + $opt1_arr[2] + $opt2_arr[2] + $opt3_arr[2]) * $opt_quantity;	// 옵션 총금액 구하기
					$opt_tot_price_val2 = ($opt1_arr[4] + $opt2_arr[4] + $opt3_arr[4]) * $opt_quantity;	// 옵션 총마일리지 구하기

					$up_sql = " update g5_ptmall_cart_opt set 
					opt1_name = '{$opt1_arr[1]}', 
					opt1_price = '{$opt1_arr[2]}',
					opt1_value = '{$opt1[$o]}',
					opt2_name = '{$opt2_arr[1]}', 
					opt2_price = '{$opt2_arr[2]}',
					opt2_value = '{$opt2[$o]}',
					opt3_name = '{$opt3_arr[1]}', 
					opt3_price = '{$opt3_arr[2]}',
					opt3_value = '{$opt3[$o]}',
					opt_quantity = '{$opt_quantity}',
					opt_tot_price = '{$opt_tot_price_val}',
                    opt_tot_price2 = '{$opt_tot_price_val2}' 
					where cto_idx = '{$chk_row['cto_idx']}'
					";
					sql_query($up_sql);
				}else{
					$ms_sql = " select max(opt_sort) as max from g5_ptmall_cart_opt where ct_idx='{$ctc_row['ct_idx']}' and mb_id='{$mb_id}' ";
					$ms_row = sql_fetch($ms_sql);
					
					$opt_sql = " insert into g5_ptmall_cart_opt set 
					ct_idx = '{$ctc_row['ct_idx']}',
					mb_id = '{$mb_id}',
					opt_sort = '".($ms_row['max']+1)."',
					opt1_idx = '{$opt1_arr[0]}',
					opt1_name = '{$opt1_arr[1]}',
					opt1_price = '{$opt1_arr[2]}',
					opt1_price2 = '{$opt1_arr[4]}',
					opt1_value = '{$opt1[$o]}',
					opt2_idx = '{$opt2_arr[0]}',
					opt2_name = '{$opt2_arr[1]}',
					opt2_price = '{$opt2_arr[2]}',
					opt2_price2 = '{$opt2_arr[4]}',
					opt2_value = '{$opt2[$o]}',
					opt3_idx = '{$opt3_arr[0]}',
					opt3_name = '{$opt3_arr[1]}',
					opt3_price = '{$opt3_arr[2]}',
					opt3_price2 = '{$opt3_arr[4]}',
					opt3_value = '{$opt3[$o]}',
					opt_quantity = '{$quantity[$o]}',
					opt_tot_price = '{$opt_tot_price[$o]}',
					opt_tot_price2 = '{$opt_tot_price2[$o]}'
					";
					sql_query($opt_sql);
				}
			}

			$select_opt_sql = " select * from g5_ptmall_cart_opt where ct_idx='{$ctc_row['ct_idx']}' and mb_id='{$mb_id}' ";
			$select_opt_qry = sql_query($select_opt_sql);
			$select_opt_num = sql_num_rows($select_opt_qry);
			for($oo=0; $oo<$select_opt_num; $oo++){
				$select_opt_row = sql_fetch_array($select_opt_qry);
				$total_sum += $select_opt_row['opt_tot_price'];
			}
			$update_sql = " update g5_ptmall_cart set it_img='{$it_img}', it_name='{$it_name}', it_price='{$it_price}', it_tot_price='{$total_sum}', opt_cnt='{$oo}' where ct_idx='{$ctc_row['ct_idx']}' ";
			sql_query($update_sql);

		}else{	// 옵션이 없을때
			$ct_sql = " insert into g5_ptmall_cart set 
			mb_id = '{$mb_id}',
			it_bo_table = '{$bo_table}',
			it_id = '{$it_id}',
			it_img = '{$it_img}',
			it_name = '{$it_name}',
			it_price='{$it_price}',
			it_tot_price = '{$it_tot_price}',
			it_fee = '{$it_fee}',
			ct_status = '{$ct_status}',
			ct_time = '{$ct_time}',
			ct_direct = '{$ct_direct}',
			opt_cnt = '".count($opt_cnt)."'
			";
			sql_query($ct_sql);
		}
	}
}


if($buy_mode == 'select'){
	/* 주문 등록 STR */
	$order_sql = " insert into g5_ptmall_order set
	mb_id = '{$member['mb_id']}',
	mb_name = '{$member['mb_name']}',
	mb_hp = '{$member['mb_hp']}'
	";
	sql_query($order_sql);
	$od_idx = sql_insert_id();
	/* 주문 등록 END */
	
	if(count($ct_chk) > 0){
		for($ct=0; $ct<count($ct_chk); $ct++){
			$up_sql = " update g5_ptmall_cart set od_idx='{$od_idx}' where ct_idx='{$ct_chk[$ct]}' ";
			sql_query($up_sql);
		}
	}

	goto_url(G5_BBS_URL.'/ptmall_order.php?od_idx='.$od_idx);
}



if($buy_mode == 'all'){
	/* 주문 등록 STR */
	$order_sql = " insert into g5_ptmall_order set
	mb_id = '{$member['mb_id']}',
	mb_name = '{$member['mb_name']}',
	mb_hp = '{$member['mb_hp']}'
	";
	sql_query($order_sql);
	$od_idx = sql_insert_id();
	/* 주문 등록 END */

	
	$up_sql = " update g5_ptmall_cart set od_idx='{$od_idx}' where mb_id='{$member['mb_id']}' and ct_status='대기' and ct_direct='n' ";
	sql_query($up_sql);

	goto_url(G5_BBS_URL.'/ptmall_order.php?od_idx='.$od_idx);
}
?>
