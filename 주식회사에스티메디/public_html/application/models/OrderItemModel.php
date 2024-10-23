<?php

/**
 * 주문 상품상세정보
 */
class OrderItemModel extends CI_Model
{
	public function __construct()
	{
		$this->load->database();
	}

    // 주문서 상품정보 등록 (호출 모델에서 트랜잭션 사용)
    public function registerOrderItem($orderIdx = 0, $orderDetailData = array()) // :void
    {
        try {
            foreach ($orderDetailData as $key => $data) {
                $data['ord_idx'] = $orderIdx;
                $this->db->insert('bs_order_item', $data);
            }

        } catch (\Exception $e) {
            log_message('error', "주문서 상품정보 등록 실패" . $e->getMessage());
        }

    }

    // 주문서 상품정보 목록
    public function getOrderItemList($orderIdx = 0): array
    {
        $sql = "SELECT A.*, B.*
			FROM bs_order_item A LEFT JOIN bs_product B ON A.product_idx = B.idx  
        	WHERE A.ord_idx = ? ORDER BY A.idx ASC";
        $query = $this->db->query($sql, [$orderIdx]);
        $resultData = array();

        foreach ($query->result_array() as $row) {
            $row['thumbNail'] = ASSETS_URL . '/' . getProductThumbnail($row['file_name_list']); // 썸네일

            $resultData[] = $row;
        }

        return $resultData;
    }


}
