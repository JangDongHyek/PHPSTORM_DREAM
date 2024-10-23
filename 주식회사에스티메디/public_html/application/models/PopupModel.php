<?php
/**
 * 팝업관리
 */
class PopupModel extends CI_Model
{
    public function __construct()
    {
        $this->load->database();
    }

    // 팝업 등록/수정
    public function registerPopup($popupData, $isModify = false): bool
    {
        $gubun = ($isModify) ? "수정" : "등록";
        try {
            // 1. 등록
            if (!$isModify) {
                $this->db->insert('bs_popup', $popupData);
            } // 2. 수정
            else {
                $this->db->where('idx', $popupData['idx']);
                $this->db->update('bs_popup', $popupData);
            }
            // log_message('debug', $this->db->last_query());
            return true;

        } catch (\Exception $e) {
            log_message('error', "팝업 DB {$gubun} 실패" . $e->getMessage());
            return false;
        }
    }

    // 팝업 상세
    public function getPopup($idx = 0): array
    {
        $sql = "SELECT * FROM bs_popup WHERE idx = ?";
        $query = $this->db->query($sql, [$idx]);
        $row = $query->row();

        // 배열로 반환
        return $row ? get_object_vars($row) : [];
    }

    // 팝업 목록
    public function getPopupList($param = array(), $target = 'C'): array
    {
        // 공통쿼리
        $sqlCommon = "FROM bs_popup WHERE target = '{$target}' ";

        // 검색
        if (!empty($param['stx'])) {
            switch ($param['sfl']) {
                case "title" : // 제목
                    $sqlCommon .= " AND title LIKE '%{$param['stx']}%'";
                    break;
            }
        }

        // 페이징
        $totalCountSql = "SELECT COUNT(*) AS cnt {$sqlCommon}";
        $totalCountRow = $this->db->query($totalCountSql)->row();
        $totalCount = ($totalCountRow && $totalCountRow->cnt) ? $totalCountRow->cnt : 0; // 전체 수
        $paging = getPaging($param['page'], $totalCount);

        // 목록
        $sql = "SELECT * {$sqlCommon}
                ORDER BY start_date DESC
                LIMIT {$paging['formRecord']}, {$paging['listRows']}
        ";
        $query = $this->db->query($sql);

        $resultData['listData'] = $query->result_array();
        $resultData['paging'] = $paging;

        return $resultData;
    }

    // (오늘) 팝업 노출
    // $position = 0: 로그인전, 1:로그인후
    public function getTodayPopup($position = 0): array
    {
        $today = date('Y-m-d H:i:s');
        $sql = "SELECT * FROM bs_popup 
            WHERE start_date <= ? AND end_date >= ?
            AND display_position = ?
            ORDER BY idx DESC";
        $query = $this->db->query($sql, [$today, $today, $position]);
        return $query->result_array();
    }

    // 팝업 삭제
    public function deletePopup($idxArr): bool
    {
        try {
            $sql = "DELETE FROM bs_popup WHERE idx IN ?";
            $this->db->query($sql, [$idxArr]);
            return true;

        } catch (\Exception $e) {
            log_message('error', '팝업 삭제실패=>' . $e->getMessage());
            return false;
        }
    }
}