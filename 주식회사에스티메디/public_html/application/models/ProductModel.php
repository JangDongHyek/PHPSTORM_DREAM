<?php

/**
 * 상품관리
 */
class ProductModel extends CI_Model
{
	public function __construct()
	{
		$this->load->database();
	}

	// 상품 등록/수정
	public function registerProduct($productData = array()): bool
	{
		try {
			if ($productData['idx'] == 0) { // 등록
				$result = $this->db->insert('bs_product', $productData);
			} else { // 수정
				$this->db->where('idx', $productData['idx']);
				$result = $this->db->update('bs_product', $productData);
                log_message('debug','registerProduct update : '. $result);
			}

			return $result;

		} catch (Exception $e) {
			log_message('error', $e->getMessage());
			return false;
		}
	}

	// 상품 상세
	public function getProductById($idx = 0): array
	{
        $member = $this->session->userdata('member');

        if($member['mb_id'] == 'admin'){
            $sql = "SELECT * FROM bs_product WHERE USE_GU_YN = 'Y' AND idx = ?";
        }else{
            $sql = "SELECT * FROM bs_product WHERE del_yn = 'N' AND USE_GU_YN = 'Y' AND idx = ?";
        }

		$query = $this->db->query($sql, array($idx));

		return $query->row_array() ?? array();
	}

    // 상품 상세 제품코드
    public function getProductByPRODUCT_CD($idx = 0): array
    {
        $member = $this->session->userdata('member');

        if($member['mb_id'] == 'admin'){
            $sql = "SELECT * FROM bs_product WHERE USE_GU_YN = 'Y' AND PRODUCT_CD = ?";

        }else{
            $sql = "SELECT * FROM bs_product WHERE del_yn = 'N' AND USE_GU_YN = 'Y' AND PRODUCT_CD = ?";

        }

        $query = $this->db->query($sql, array($idx));

        return $query->row_array() ?? array();
    }

	// 상품 목록
	public function getProductList($param = array()): array
	{
		// 공통쿼리
		$sqlCommon = "FROM bs_product WHERE USE_GU_YN = 'Y' ";

		// 검색
		if ($param['stx'] != "") {
			switch ($param['sfl']) {
				case "title" :      // 상품명
					$sqlCommon .= "AND prod_name LIKE '%{$param['stx']}%' ";
					break;
				case "PRODUCT_NM" :      // 제품명
					$sqlCommon .= "AND ( PRODUCT_NM LIKE '%{$param['stx']}%' or keyword LIKE '%{$param['stx']}%' or CONS_CD_NM LIKE '%{$param['stx']}%' ) ";
					break;
                case "CONS_CD" :      // 성분코드
                    $sqlCommon .= "AND CONS_CD LIKE '%{$param['stx']}%' ";
                    break;
                case "CONS_CD_SEQ" :      // 성분코드SEQ
                    $sqlCommon .= "AND CONS_CD_SEQ LIKE '%{$param['stx']}%' ";
                    break;
                case "CONS" :      // 성분분류코드
                    $sqlCommon .= "AND CONS LIKE '%{$param['stx']}%' ";
                    break;
                case "CONS_NM" :      // 성분분류명
                    $sqlCommon .= "AND CONS_NM LIKE '%{$param['stx']}%' ";
                    break;
				case "content" :      // 상세설명
					$sqlCommon .= "AND content LIKE '%{$param['stx']}%' ";
					break;
                case "PRODUCT_CD" :      // 제품코드
                    $sqlCommon .= "AND PRODUCT_CD LIKE '%{$param['stx']}%' ";
                    break;
			}


		}
		// 카테고리 선택시
		if ($param['cate']) $sqlCommon .= " AND category = '{$param['cate']}'";
		// 사용분류 선택시
		if ($param['isUse']) $sqlCommon .= " AND use_yn = '" . strtoupper($param['isUse']) . "'";
		if ($param['del_yn']) $sqlCommon .= " AND del_yn = '" . strtoupper($param['del_yn']) . "'";

        if($param['member'] != 'admin'){
            $sqlCommon .= " AND use_yn = 'Y' AND del_yn = 'N'";
        }else{

        }
        
        //240726 단위가 1단위(T,C,정 등)인 상품은 표시안되게
        if ($param['PRODUCT_STANDARD']) $sqlCommon .= "AND PRODUCT_STANDARD not LIKE '1_' ";

		// 배송 선택시
		if ($param['isShipFree']) $sqlCommon .= " AND shipping_free_yn = '" . strtoupper($param['isShipFree']) . "'";
		// 임시품절
		if ($param['soldOut']) $sqlCommon .= " AND soldout_yn = '{$param['soldOut']}' ";
		// MD추천
		if ($param['mdRec']) $sqlCommon .= " AND md_rec_yn = '{$param['mdRec']}' ";
        // 초성검색
        if ($param['initial']) $sqlCommon .= "AND first_consonant = '{$param['initial']}' ";


		// 페이징
		$totalCountSql = "SELECT COUNT(*) AS cnt {$sqlCommon}";
		$totalCountRow = $this->db->query($totalCountSql)->row();
		$totalCount = ($totalCountRow && $totalCountRow->cnt) ? $totalCountRow->cnt : 0; // 전체 수
		$paging = getPaging($param['page'], $totalCount);

		//$sqlOrderBy = " ORDER BY prod_order DESC, idx DESC ";
		$sqlOrderBy = " ORDER BY prod_order DESC , PRODUCT_CD DESC  ";

        $member = $this->session->userdata('member');

        if($member['INSU_CHECK'] == 'Y'){
            $sqlOrderBy = "ORDER BY CASE
                WHEN `INSU_PRICE` = 0 THEN 2 
                ELSE 	1 
        END , prod_order DESC, INSU_PRICE ASC";
        }else{
            $sqlOrderBy = "ORDER BY CASE
                WHEN `prod_price` = 0 THEN 2 
                ELSE 	1 
        END , prod_order DESC, prod_price ASC";
        }

        //log_message('error','list: INSU_CHECK'.print_r($member,true));

        switch ($param['order']) {
            case "PRODUCT_CD":
                $sqlOrderBy = " ORDER BY PRODUCT_CD DESC "; // 등록일순
                break;
            case "date":
                $sqlOrderBy = " ORDER BY idx DESC "; // 등록일순
                break;
            case "prod_order":
                $sqlOrderBy = " ORDER BY prod_order DESC "; // 우선순위
                break;
            case "name":
                $sqlOrderBy = " ORDER BY prod_name ASC "; // 상품명순
                break;
            case "rowPrice":
                $sqlOrderBy = " ORDER BY prod_price ASC "; // 낮은가격순
                break;
            case "exPrice":
                $sqlOrderBy = " ORDER BY prod_price DESC "; // 높은가격순
                break;
        }

		// 목록
		$sql = "SELECT *
            {$sqlCommon}
            {$sqlOrderBy}
            LIMIT {$paging['formRecord']}, {$paging['listRows']}
        ";
		$query = $this->db->query($sql);

		$resultData = array();
		$resultData['listData'] = $query->result_array();
		$resultData['paging'] = $paging;

		return $resultData;
	}

    // 상품 목록
    public function getProductList_cons($param = array()): array
    {
        // 공통쿼리
        $sqlCommon = "FROM bs_product WHERE USE_GU_YN = 'Y' ";
        $sqlCommon .= "AND CONS_CD LIKE '%{$param['CONS_CD']}%' ";
        // 검색
        if ($param['stx'] != "") {
            switch ($param['sfl']) {
                case "title" :      // 상품명
                    $sqlCommon .= "AND prod_name LIKE '%{$param['stx']}%' ";
                    break;
                case "PRODUCT_NM" :      // 제품명
                    $sqlCommon .= "AND PRODUCT_NM LIKE '%{$param['stx']}%' ";
                    break;
                case "CONS_CD_SEQ" :      // 성분코드SEQ
                    $sqlCommon .= "AND CONS_CD_SEQ LIKE '%{$param['stx']}%' ";
                    break;
                case "CONS" :      // 성분분류코드
                    $sqlCommon .= "AND CONS LIKE '%{$param['stx']}%' ";
                    break;
                case "CONS_NM" :      // 성분분류명
                    $sqlCommon .= "AND CONS_NM LIKE '%{$param['stx']}%' ";
                    break;
                case "content" :      // 상세설명
                    $sqlCommon .= "AND content LIKE '%{$param['stx']}%' ";
                    break;
            }
        }

        if($param['member'] != 'admin'){
            $sqlCommon .= " AND use_yn = 'Y' AND del_yn = 'N'";
        }else{

        }

        //240726 단위가 1단위(T,C,정 등)인 상품은 표시안되게
        if ($param['PRODUCT_STANDARD']) $sqlCommon .= "AND PRODUCT_STANDARD not LIKE '1_' ";

        // 배송 선택시
        if ($param['isShipFree']) $sqlCommon .= " AND shipping_free_yn = '" . strtoupper($param['isShipFree']) . "'";
        // 임시품절
        if ($param['soldOut']) $sqlCommon .= " AND soldout_yn = '{$param['soldOut']}' ";
        // MD추천
        if ($param['mdRec']) $sqlCommon .= " AND md_rec_yn = '{$param['mdRec']}' ";
        // 초성검색
        if ($param['initial']) $sqlCommon .= "AND first_consonant = '{$param['initial']}' ";

        // 페이징
        $totalCountSql = "SELECT COUNT(*) AS cnt {$sqlCommon}";
        $totalCountRow = $this->db->query($totalCountSql)->row();
        $totalCount = ($totalCountRow && $totalCountRow->cnt) ? $totalCountRow->cnt : 0; // 전체 수
        $paging = getPaging($param['page'], $totalCount,24);

        //$sqlOrderBy = " ORDER BY prod_order DESC, idx DESC ";
        //$sqlOrderBy = " ORDER BY prod_order DESC , PRODUCT_CD DESC  ";
        $member = $this->session->userdata('member');
        if($member['INSU_CHECK'] == 'Y'){
            $sqlOrderBy = "ORDER BY CASE
                WHEN `INSU_PRICE` = 0 THEN 2 
                ELSE 	1 
        END , prod_order DESC, INSU_PRICE ASC";
        }else{
            $sqlOrderBy = "ORDER BY CASE
                WHEN `prod_price` = 0 THEN 2 
                ELSE 	1 
        END , prod_order DESC, prod_price ASC";
        }

        //log_message('error','list: INSU_CHECK'.$member);

        switch ($param['order']) {
            case "data":
                $sqlOrderBy = " ORDER BY idx DESC "; // 등록일순
                break;
            case "prod_order":
                $sqlOrderBy = " ORDER BY prod_order DESC "; // 우선순위
                break;
            case "name":
                $sqlOrderBy = " ORDER BY prod_name ASC "; // 상품명순
                break;
            case "rowPrice":
                $sqlOrderBy = " ORDER BY prod_price ASC "; // 낮은가격순
                break;
            case "exPrice":
                $sqlOrderBy = " ORDER BY prod_price DESC "; // 높은가격순
                break;
        }

        // 목록
        $sql = "SELECT *
            {$sqlCommon}
            {$sqlOrderBy}
            LIMIT {$paging['formRecord']}, {$paging['listRows']}
        ";
        $query = $this->db->query($sql);

        $resultData = array();
        $resultData['listData'] = $query->result_array();
        $resultData['paging'] = $paging;
        $resultData['totalCount'] = $totalCount;



        return $resultData;
    }

    // 최근 주문 상품 목록
    public function getProductList_recent($param = array()): array
    {
        $member = $this->session->userdata('member');

        // 공통 쿼리
        $sqlCommon = "FROM bs_order WHERE del_yn = 'N' AND tmp_save_yn = 'N' ";
        if (!$isAdmin){ $sqlCommon .= " AND mb_id = '{$member['mb_id']}'"; };

        // 검색
        if (!empty($param['stx'])) {
            switch ($param['sfl']) {
                case "oName" : // 주문자명 (배송정보-주문자-성함 OR 주문자(회원) 이름)
                    $sqlCommon .= "AND (ord_name LIKE '%{$param['stx']}%' OR (SELECT mb_name FROM bs_member WHERE mb_id = bs_order.mb_id) LIKE '%{$param['stx']}%') ";
                    break;
                case "ordNo" : // 주문번호
                    $sqlCommon .= "AND ord_no LIKE '%{$param['stx']}%' ";
                    break;
                case "rId" : // 주문자아이디
                    $sqlCommon .= "AND mb_id LIKE '%{$param['stx']}%' ";
                    break;
                case "rName" : // 받는사람명
                    $sqlCommon .= "AND rec_name LIKE '%{$param['stx']}%' ";
                    break;
                case "cName": // 한의원명
                    $sqlCommon .= " AND mb_id IN (SELECT mb_id FROM bs_member WHERE cn_name LIKE '%{$param['stx']}%')";
                    break;
                case "item": // 상품명
                    $sqlCommon .= "AND prod_name LIKE '%{$param['stx']}%' ";
                    break;
            }
        }

        // 시작일,종료일
        if (!empty($param['sdt'])) $sqlCommon .= "AND DATE(reg_date) >= '{$param['sdt']}' ";
        if (!empty($param['edt'])) $sqlCommon .= "AND DATE(reg_date) <= '{$param['edt']}' ";
        // 그룹다중선택 (checkbox)
        if (!empty($param['groupIdxList'])) $sqlCommon .= "AND mb_id IN (SELECT mb_id FROM bs_member WHERE group_idx IN ({$param['groupIdxList']}) )";
        // 주문상태, 결제수단
        if (!empty($param['status'])) $sqlCommon .= "AND ord_status = '{$param['status']}' ";
        if (!empty($param['method'])) $sqlCommon .= "AND pay_method = '{$param['method']}' ";

        // select 컬럼추가
        $sqlColumn = "";
        if (!$isAdmin) {
            // 상품 썸네일
            $sqlColumn .= ", (SELECT file_name_list FROM bs_product WHERE idx = 
				(SELECT product_idx FROM bs_order_item WHERE ord_idx = bs_order.idx ORDER BY idx ASC LIMIT 1)) AS file_name_list
			";
        }
        else {
            $sqlColumn .= "
            , (SELECT cn_name FROM bs_member WHERE mb_id = bs_order.mb_id) AS clinicName
            , (SELECT rep_name FROM bs_member WHERE mb_id = bs_order.mb_id) AS clinicDoctorName
            ";
        }

        // 페이징
        $totalCountSql = "SELECT COUNT(*) AS cnt {$sqlCommon}";
        $totalCountRow = $this->db->query($totalCountSql)->row();
        $totalCount = ($totalCountRow && $totalCountRow->cnt) ? $totalCountRow->cnt : 0; // 전체 수
        $paging = getPaging($param['page'], $totalCount);
        $sqlPaging = "LIMIT {$paging['formRecord']}, {$paging['listRows']}";

        $sql = "SELECT * {$sqlColumn}
			{$sqlCommon}
			ORDER BY reg_date DESC, ord_date DESC
			{$sqlPaging}
		";
        $query = $this->db->query($sql);

        $resultData = array();
        foreach ($query->result_array() as $key => $row) {


                // 주문공통 정보
                $this->load->library('OrderLibrary'); // (!)라이브러리 소문자로 호출해야함
                $orderCommon = $this->orderlibrary->getOrderCommonData($row['idx']);

                $orderData = $orderCommon['orderData'];            // 주문서
                $orderItemData = $orderCommon['orderItemData'];        // 주문서 상세
                $payData = $orderCommon['payData'];                // PG 결제

                $row['orderData'] = $orderData;
                $row['orderItemData'] = $orderItemData;
                $row['payData'] = $payData;
                // 주문서공통 끝

            $row['thumbNail'] = getProductThumbnail($row['file_name_list']); // 썸네일

            $resultData['listData'][] = $row;
        }
        $resultData['paging'] = $paging;


        return $resultData;
    }

    // 상품 목록
    public function getProductKeywordList($param = array()): array
    {
        // 공통쿼리
        $sqlCommon = "FROM bs_product WHERE USE_GU_YN = 'Y' ";

        // 검색
        if ($param['stx'] != "") {
            switch ($param['sfl']) {
                case "title" :      // 상품명
                    $sqlCommon .= "AND prod_name LIKE '%{$param['stx']}%' ";
                    break;
                case "PRODUCT_NM" :      // 제품명
                    $sqlCommon .= "AND ( PRODUCT_NM LIKE '%{$param['stx']}%' or keyword LIKE '%{$param['stx']}%' or CONS_CD_NM LIKE '%{$param['stx']}%' ) ";
                    break;
                case "CONS_CD" :      // 성분코드
                    $sqlCommon .= "AND CONS_CD LIKE '%{$param['stx']}%' ";
                    break;
                case "CONS_CD_SEQ" :      // 성분코드SEQ
                    $sqlCommon .= "AND CONS_CD_SEQ LIKE '%{$param['stx']}%' ";
                    break;
                case "CONS" :      // 성분분류코드
                    $sqlCommon .= "AND CONS LIKE '%{$param['stx']}%' ";
                    break;
                case "CONS_NM" :      // 성분분류명
                    $sqlCommon .= "AND CONS_NM LIKE '%{$param['stx']}%' ";
                    break;
                case "content" :      // 상세설명
                    $sqlCommon .= "AND content LIKE '%{$param['stx']}%' ";
                    break;
                case "PRODUCT_CD" :      // 제품코드
                    $sqlCommon .= "AND PRODUCT_CD LIKE '%{$param['stx']}%' ";
                    break;
            }


        }
        // 카테고리 선택시
        if ($param['cate']) $sqlCommon .= " AND category = '{$param['cate']}'";
        // 사용분류 선택시
        if ($param['isUse']) $sqlCommon .= " AND use_yn = '" . strtoupper($param['isUse']) . "'";
        if ($param['del_yn']) $sqlCommon .= " AND del_yn = '" . strtoupper($param['del_yn']) . "'";

        if($param['member'] != 'admin'){
            $sqlCommon .= " AND use_yn = 'Y' AND del_yn = 'N'";
        }else{

        }

        //240726 단위가 1단위(T,C,정 등)인 상품은 표시안되게
        if ($param['PRODUCT_STANDARD']) $sqlCommon .= "AND PRODUCT_STANDARD not LIKE '1_' ";

        // 배송 선택시
        if ($param['isShipFree']) $sqlCommon .= " AND shipping_free_yn = '" . strtoupper($param['isShipFree']) . "'";
        // 임시품절
        if ($param['soldOut']) $sqlCommon .= " AND soldout_yn = '{$param['soldOut']}' ";
        // MD추천
        if ($param['mdRec']) $sqlCommon .= " AND md_rec_yn = '{$param['mdRec']}' ";
        // 초성검색
        if ($param['initial']) $sqlCommon .= "AND first_consonant = '{$param['initial']}' ";


        // 페이징
        $totalCountSql = "SELECT COUNT(*) AS cnt,
        REGEXP_REPLACE(CONS_CD_NM, '[0-9\.]+[a-zA-Z]*\s*\(/\w+\)$', '') AS cleaned_drug_name
         {$sqlCommon}
         
         GROUP BY 
    REGEXP_REPLACE(CONS_CD_NM, '[0-9\.]+[a-zA-Z]*\s*\(/\w+\)$', '')
    
         ";
        $totalCountRow = $this->db->query($totalCountSql)->row();
        $totalCount = ($totalCountRow && $totalCountRow->cnt) ? $totalCountRow->cnt : 0; // 전체 수
        $paging = getPaging($param['page'], $totalCount);

        //$sqlOrderBy = " ORDER BY prod_order DESC, idx DESC ";
        $sqlOrderBy = " ORDER BY prod_order DESC , PRODUCT_CD DESC  ";

        $member = $this->session->userdata('member');

        if($member['INSU_CHECK'] == 'Y'){
            $sqlOrderBy = "ORDER BY CASE
                WHEN `INSU_PRICE` = 0 THEN 2 
                ELSE 	1 
        END , prod_order DESC, INSU_PRICE ASC";
        }else{
            $sqlOrderBy = "ORDER BY CASE
                WHEN `prod_price` = 0 THEN 2 
                ELSE 	1 
        END , prod_order DESC, prod_price ASC";
        }

        //log_message('error','list: INSU_CHECK'.print_r($member,true));

        switch ($param['order']) {
            case "PRODUCT_CD":
                $sqlOrderBy = " ORDER BY PRODUCT_CD DESC "; // 등록일순
                break;
            case "date":
                $sqlOrderBy = " ORDER BY idx DESC "; // 등록일순
                break;
            case "prod_order":
                $sqlOrderBy = " ORDER BY prod_order DESC "; // 우선순위
                break;
            case "name":
                $sqlOrderBy = " ORDER BY prod_name ASC "; // 상품명순
                break;
            case "rowPrice":
                $sqlOrderBy = " ORDER BY prod_price ASC "; // 낮은가격순
                break;
            case "exPrice":
                $sqlOrderBy = " ORDER BY prod_price DESC "; // 높은가격순
                break;
        }

        // 목록
        $sql = "SELECT *,
            REGEXP_REPLACE(CONS_CD_NM, '[0-9\.]+[a-zA-Z]*\s*\(/\w+\)$', '') AS cleaned_drug_name
            {$sqlCommon}
            
            GROUP BY 
            REGEXP_REPLACE(CONS_CD_NM, '[0-9\.]+[a-zA-Z]*\s*\(/\w+\)$', '')
            
            {$sqlOrderBy}
            LIMIT {$paging['formRecord']}, {$paging['listRows']}
        ";
        $query = $this->db->query($sql);

        var_dump($sql);
        $resultData = array();
        $resultData['listData'] = $query->result_array();
        $resultData['paging'] = $paging;

        return $resultData;
    }

	// 상품 목록 일괄수정
	public function updateProductListData($listData = array()): bool
	{
		// 트랜잭션 시작
		$this->db->trans_begin();

		try {
			foreach ($listData as $data) {
				$sql = "UPDATE bs_product SET
					shipping_free_yn = ?,
					use_yn = ?,
					del_yn = ?,
					prod_order = ?,
					prod_price = ?,
					agency_fee = ?
					WHERE idx = ?
            	";
				$data['price'] = extractNumbers($data['price']);
				$data['order'] = extractNumbers($data['order']);
				$this->db->query($sql, array($data['shipFreeYn'], $data['useYn'], 'N',  $data['order'], $data['price'], $data['agency_fee'], $data['idx']));

                log_message('debug','updateProductListData update : '. $sql);
			}

			// 트랜잭션 완료
			$this->db->trans_complete();

			// 트랜잭션 상태 확인
			if ($this->db->trans_status() === FALSE) {
				throw new Exception('트랜잭션 상태가 올바르지 않습니다.');
			}

			return true;

		} catch (Exception $e) {
			// 실패시 롤백
			$this->db->trans_rollback();
			log_message('error', $e->getMessage());
			return false;
		}
	}

	// 상품 삭제
	public function deleteProduct($productIdx = 0): bool
	{
		try {
			$sql = "UPDATE bs_product SET del_yn = 'Y', mod_date = now() WHERE idx = ?";
			return $this->db->query($sql, [$productIdx]);

		} catch (\Exception $e) {
			log_message('error', "상품 삭제 실패" . $e->getMessage());
			return false;
		}
	}

    // API상품 목록가져오기 wc
    public function getApiProductListData($listData = array()): bool
    {
        // 트랜잭션 시작
        $this->db->trans_begin();
        log_message('error', "cron: getApiProductListData 실행" );

        try {
            foreach ($listData as $data) {

                log_message('error', "getApiProductListData data : " . print_r($data,true));
                //log_message('error', "getApiProductListData $data : " . print_r('g3',true));

                $data['first_consonant'] = getFirstConsonant($data['PRODUCT_NM']); // 한글초성뽑기
                $data['PRODUCT_NM'] = trim($data['PRODUCT_NM']);
                $data['PRODUCT_UNIT'] = trim($data['PRODUCT_UNIT']);
                $data['CONS_CD_NM'] = trim($data['CONS_CD_NM']);
                $data['CONS'] = trim($data['CONS']);
                $data['CONS_NM'] = trim($data['CONS_NM']);
                $data['MAKER_NM'] = trim($data['MAKER_NM']);
                $data['ACC_UNIT'] = removeComma($data['ACC_UNIT']); //계산단위
                $data['STOCK_QTY'] = removeComma($data['STOCK_QTY']); //재고수량
                $data['INSU_PRICE'] = removeComma($data['INSU_PRICE']); //보험가
                $data['UNIT_PRICE'] = removeComma($data['UNIT_PRICE']); //단가
                $data['mod_date'] = date("Y-m-d H:i:s"); //단가

                //PRODUCT_CD 유니크키로 설정하구 같은개 있으면 update 아니면 insert
                //$this->db->replace('bs_product', $data);

                $this->db->where('PRODUCT_CD',$data['PRODUCT_CD']);
                $q = $this->db->get('bs_product');

                if ( $q->num_rows() > 0 )
                {
                    $this->db->where('PRODUCT_CD',$data['PRODUCT_CD']);
                    $this->db->update('bs_product',$data);
                } else {
                    $this->db->insert('bs_product',$data);
                }

            }

            // 트랜잭션 완료
            $this->db->trans_complete();

            // 트랜잭션 상태 확인
            if ($this->db->trans_status() === FALSE) {
                throw new Exception('트랜잭션 상태가 올바르지 않습니다.');
            }

            return true;

        } catch (Exception $e) {
            // 실패시 롤백
            $this->db->trans_rollback();
            log_message('error', $e->getMessage());
            return false;
        }
    }

    // 에이전시 수수료 설정
    public function setAgencyFeeData($listData = array()): bool
    {
        // 트랜잭션 시작
        $this->db->trans_begin();
        log_message('error', "cron: setAgencyFeeData 실행" );

        try {
            foreach ($listData as $data) {

                log_message('error', "setAgencyFeeData data : " . print_r($data,true));
                //log_message('error', "getApiProductListData $data : " . print_r('g3',true));

                $data['mb_id'] = trim($data['mb_id']);
                $data['product_idx'] = trim($data['product_idx']);
                $data['fee'] = removeComma(trim($data['fee']));
                $data['up_datetime'] = date("Y-m-d H:i:s"); //단가

                //PRODUCT_CD 유니크키로 설정하구 같은개 있으면 update 아니면 insert
                //$this->db->replace('bs_product', $data);

                $this->db->where('product_idx', $data['product_idx']);
                $this->db->where('mb_id', $data['mb_id']);

                $q = $this->db->get('bs_agency_fee');

                if ( $q->num_rows() > 0 )
                {
                    $this->db->where('product_idx',$data['product_idx']);
                    $this->db->where('mb_id', $data['mb_id']);
                    $this->db->update('bs_agency_fee',$data);
                } else {
                    $this->db->insert('bs_agency_fee', $data);
                }

            }

            // 트랜잭션 완료
            $this->db->trans_complete();

            // 트랜잭션 상태 확인
            if ($this->db->trans_status() === FALSE) {
                throw new Exception('트랜잭션 상태가 올바르지 않습니다.');
            }




            return true;

        } catch (Exception $e) {
            // 실패시 롤백
            $this->db->trans_rollback();
            log_message('error', $e->getMessage());
            return false;
        }



    }

    // 에이전시 수수료 데이터
    public function getAgencyFeeData($product_idx,$mb_id = ''): array
    {
        // 공통쿼리
        $sqlCommon = "FROM bs_agency_fee WHERE product_idx = '{$product_idx}' ";

        if($mb_id){
            $sqlCommon .= " AND mb_id = '{$mb_id}'";
        }
        // 목록
        $sql = "SELECT *
            
            {$sqlCommon}
            
        ";
        $query = $this->db->query($sql);

        $resultData = array();
        $resultData['listData'] = $query->result_array();

        return $resultData;
    }

    // 에이전시 수수료 데이터
    public function setAgencyFeeMinMax($product_idx): array
    {
        // 공통쿼리
        $sqlCommon = "FROM bs_agency_fee WHERE product_idx = '{$product_idx}' ";

        // 목록
        $sql = "SELECT MIN(fee) as agency_fee_min, MAX(fee) as agency_fee_max {$sqlCommon} ";
        $query = $this->db->query($sql);
        $result = $query->row();

        if ($result) {
            // bs_product 테이블 업데이트
            $sql2 = "UPDATE bs_product set agency_fee_min = '{$result->agency_fee_min}',agency_fee_max = '{$result->agency_fee_max}' WHERE idx = '{$product_idx}' ";
            $query2 = $this->db->query($sql2);
        }

        $resultData = array();
        $resultData['listData'] = $query->result_array();
        $resultData['listData1'] = $sql;
        $resultData['listData2'] = $sql2;

        return $resultData;
    }


}
