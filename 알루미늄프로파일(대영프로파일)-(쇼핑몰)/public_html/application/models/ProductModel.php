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
		$sql = "SELECT * FROM bs_product WHERE del_yn = 'N' AND idx = ?";
		$query = $this->db->query($sql, array($idx));

		return $query->row_array() ?? array();
	}

	// 상품 목록
	public function getProductList($param = array()): array
	{
		// 공통쿼리
		$sqlCommon = "FROM bs_product WHERE del_yn = 'N' ";

		// 검색
		if ($param['stx'] != "") {
			switch ($param['sfl']) {
				case "title" :      // 상품명
					$sqlCommon .= "AND prod_name LIKE '%{$param['stx']}%' ";
					break;
				case "content" :      // 상세설명
					$sqlCommon .= "AND content LIKE '%{$param['stx']}%' ";
					break;
			}
		}

        // 노출,미노출 선택시
        if ($param['use_yn']) $sqlCommon .= " AND use_yn = '{$param['use_yn']}'";

		// 카테고리 선택시
		if ($param['cate']) $sqlCommon .= " AND category = '{$param['cate']}'";
		// 사용분류 선택시
		if ($param['isUse']) $sqlCommon .= " AND use_yn = '" . strtoupper($param['isUse']) . "'";
		// 배송 선택시
		if ($param['isShipFree']) $sqlCommon .= " AND shipping_free_yn = '" . strtoupper($param['isShipFree']) . "'";
		// 임시품절
		if ($param['soldOut']) $sqlCommon .= " AND soldout_yn = '{$param['soldOut']}' ";
		// MD추천
		if ($param['mdRec']) $sqlCommon .= " AND md_rec_yn = '{$param['mdRec']}' ";
        // 초성검색
        if ($param['initial']) $sqlCommon .= "AND first_consonant = '{$param['initial']}' ";
        // 카테고리검색
        if ($param['category']) $sqlCommon .= "AND (category_parent = '{$param['category']}' OR category_child = '{$param['category']}') ";

		// 페이징
		$totalCountSql = "SELECT COUNT(*) AS cnt {$sqlCommon}";
		$totalCountRow = $this->db->query($totalCountSql)->row();
		$totalCount = ($totalCountRow && $totalCountRow->cnt) ? $totalCountRow->cnt : 0; // 전체 수
		$paging = getPaging($param['page'], $totalCount);

		$sqlOrderBy = " ORDER BY prod_order DESC, idx DESC ";
        switch ($param['order']) {
            case "data":
                $sqlOrderBy = " ORDER BY idx DESC "; // 등록일순
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
					prod_order = ?,
					prod_price = ?
					WHERE idx = ?
            	";
				$data['price'] = extractNumbers($data['price']);
				$data['order'] = extractNumbers($data['order']);
				$this->db->query($sql, array($data['shipFreeYn'], $data['useYn'], $data['order'], $data['price'], $data['idx']));
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

	//카테고리 상품 카운트
    // 상품 상세
    public function getCategoryCount($idx)
    {
        $this->db->or_where(array(
            "category_parent" => $idx,
            "category_child" => $idx
        ));
        $this->db->where("use_yn","Y");
        $this->db->where("del_yn","N");

        $count = $this->db->count_all_results('bs_product');

        return $count;
    }

}
