<?php

/**
 * 상품관리
 */
class AddOptionModel extends CI_Model
{
    public function __construct()
    {
        $this->load->database();
    }

    public function postData($data = array())
    {
        try {
            $result = $this->db->insert('bs_add_option', $data);
            return $result;

        } catch (Exception $e) {
            log_message('error', $e->getMessage());
            return false;
        }
    }

    public function putData($data = array())
    {
        try {
            $this->db->where("idx",$data["idx"]);
            $result = $this->db->update('bs_add_option', $data);
            return $result;

        } catch (Exception $e) {
            log_message('error', $e->getMessage());
            return false;
        }
    }

    public function getsData($filter = array(),$like = array()) {
        try {
            $this->db->where($filter);
            $this->db->like($like);
            $query = $this->db->get("bs_add_option");
            $result = $query->result();


            return $result;

        } catch (Exception $e) {
            log_message('error', $e->getMessage());
            return false;
        }
    }

    public function deleteData($filter = array()) {
        try {
            $this->db->where($filter);

            return $this->db->delete("bs_add_option");

        } catch (Exception $e) {
            log_message('error', $e->getMessage());
            return false;
        }
    }
}
