<?php

/**
 * 프로젝트 기본설정
 */
class ConfigModel extends CI_Model
{
	public function __construct()
	{
		$this->load->database();
	}

	// 시스템 기본설정 정보
	public function getSystemConfig($column = "*"): array
	{
		$sql = "SELECT {$column} FROM bs_config LIMIT 1";
		$query = $this->db->query($sql);

		return $query->row_array() ?? array();
	}

	// 기본배송비 수정
	public function updateDeliveryFee($feeData=array()): bool
	{
		try {
			$sql = "UPDATE bs_config SET 
                cf_delivery_fee = ?, 
                cf_free_ship_over_amt = ?,
                mod_date = now()
            ";
			$this->db->query($sql, [$feeData['deliveryFee'], $feeData['freeShipOverAmt']]);

			if($this->db->affected_rows() > 0) return true;
			else throw new \Exception('query: '.$this->db->last_query());

		} catch (\Exception $e) {
			log_message('error', "기본배송비 업데이트 실패 - " . $e->getMessage());
			return false;
		}
	}




}
