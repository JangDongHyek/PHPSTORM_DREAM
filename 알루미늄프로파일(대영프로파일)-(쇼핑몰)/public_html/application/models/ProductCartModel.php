<?php
/**
 * 장바구니
 */
class ProductCartModel extends CI_Model
{
    public function __construct()
	{
		$this->load->database();
	}

	// 장바구니 등록전 인덱스 조회
	public function getCartIdx($productIdx = 0, $memberId = ''): array
	{
        $productIdx = explode(',', $productIdx);

        $sql = "SELECT GROUP_CONCAT(idx) AS idx FROM bs_product_cart WHERE add_cart_yn = 'Y' AND product_idx IN ? AND mb_id = ?";
        $query = $this->db->query($sql, [$productIdx, $memberId]);
        // log_message('debug', $this->db->last_query());
        $row = $query->row();

        return ($row && $row->idx) ? explode(',', $row->idx) : array();
	}

	// 장바구니 등록/수정
	public function registerCart($cartData = array(), $isModify = false)
	{
        try {
            if(!$isModify) {
                // 등록
                $productIdx = explode(',', $cartData['product_idx']); // 상품인덱스
                $productCnt = explode(',', $cartData['product_cnt']); // 상품수량
                $cartIdx = array(); // 장바구니인덱스

                foreach ($productIdx as $key => $idx) {
                    $sql = "INSERT INTO bs_product_cart SET
                        add_cart_yn = ?,
                        mb_id = ?, 
                        product_idx = ?,
                        product_cnt = ?, 
                        cut_length = ?,
                        processing_idx = ?,
                        add_option_idx = ?,
                        add_option = ?,
                        essential_option_idx = ?,
                        essential_option = ?,
                        reg_date = now()
                    ";
                    $this->db->query($sql, [$cartData['add_cart_yn'], $cartData['memberId'], $idx, $productCnt[$key],$cartData['cut_length'],$cartData['processing_idx'],
                        $cartData['add_option_idx'], $cartData['add_option'], $cartData['essential_option_idx'], $cartData['essential_option'] ]);
                    $idx = $this->db->insert_id();
                    $cartIdx[] = $idx;
                }

                // 인덱스 리턴
                return $cartIdx;
            }
            else {
                // 수정
                $productCnt = explode(',', $cartData['product_cnt']); // 상품수량
                $cartIdx = $cartData['idx']; // 장바구니인덱스

                foreach ($cartIdx as $key => $idx) {
                    $sql = "UPDATE bs_product_cart SET product_cnt = product_cnt + ? WHERE idx = ?";
                    $this->db->query($sql, [$productCnt[$key], $idx]);
                    // log_message('debug', $this->db->last_query());
                }

                return true;
            }

        } catch (\Exception $e) {
            log_message('error', "장바구니 신규등록 실패" . $e->getMessage());
            return 0;
        }
	}

	// 장바구니 목록
	public function getCartList($selectCartIdxArr = array(), $memberId = ''): array
	{
		$sqlCommon = (count($selectCartIdxArr) == 0) ?
			" AND A.add_cart_yn = 'Y' " : // 장바구니 페이지
			" AND A.idx IN (" . implode(",", $selectCartIdxArr) . ") "; // 주문서 페이지

        if(!empty($memberId)) $sqlCommon .= " AND A.mb_id = ? ";

		$sql = "SELECT A.idx AS cart_idx, A.reg_date AS cart_date, A.product_cnt, 
            A.cut_length, A.processing_idx,A.add_option_idx,A.add_option,A.essential_option_idx,A.essential_option,
			B.idx AS product_idx, B.prod_name, B.shipping_free_yn, B.file_name_list, B.pay_method_list, B.category, B.prod_price, B.soldout_yn 
			FROM bs_product_cart A
			INNER JOIN bs_product B ON A.product_idx = B.idx
			WHERE B.del_yn = 'N' AND B.use_yn = 'Y'
			{$sqlCommon}
			ORDER BY A.idx DESC;
		";
		$query = $this->db->query($sql, [$memberId]);

		$listData = [];

		foreach ($query->result_array() as $row) {
			// 썸네일
			$row['prod_thumb'] = ASSETS_URL . '/' . getProductThumbnail($row['file_name_list']);

			$listData[] = $row;
		}

		return $listData;
	}

	// 장바구니 삭제
	public function deleteCartItem($cartIdxArr = array(), $ordIdx = 0, $isClear = false, $memberId = '')
	{
		try {
            // 장바구니 비우기
            if($isClear) {
                $sql = "DELETE FROM bs_product_cart WHERE mb_id = ?";
                return $this->db->query($sql, [$memberId]);
            }
            else {
                if (count($cartIdxArr) > 0) {
                    $sql = "DELETE FROM bs_product_cart WHERE idx IN ?";
                    return $this->db->query($sql, [$cartIdxArr]);

                } else if ($ordIdx > 0) {
                    $sql = "DELETE FROM bs_product_cart WHERE ord_idx = ?";
                    return $this->db->query($sql, [$ordIdx]);

                } else {
                    return true;
                }
            }

		} catch (Exception $e) {
			log_message('error', $e->getMessage());
			return false;
		}
	}

	// 장바구니 삭제용 주문인덱스 추가
	public function updateCartOrderInx($cartIdxArr = array(), $ordIdx = 0) // :void
	{
		try {
			if (count($cartIdxArr) > 0) {
				$sql = "UPDATE bs_product_cart SET ord_idx = ? WHERE idx IN ?";
				$this->db->query($sql, [$ordIdx, $cartIdxArr]); // 리턴필요없음
			}

		} catch (\Exception $e) {
			log_message('error', "장바구니 주문인덱스 업데이트 실패" . $e->getMessage());
		}
	}

    // 장바구니 수량 업데이트
    public function updateCartOptionCount($cartIdx = 0, $count = 0): bool
    {
        try {
            $sql = "UPDATE bs_product_cart SET product_cnt = ? WHERE idx = ?";
            $this->db->query($sql, [$count, $cartIdx]);
            return true;

        } catch (\Exception $e) {
            log_message('error', "장바구니 수량 변경 실패" . $e->getMessage());
            return false;
        }
    }
}
