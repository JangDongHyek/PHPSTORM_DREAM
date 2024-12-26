<?php

namespace App\Models;

use App\Models\Traits\BuilderTrait;
use CodeIgniter\Model;

class CompanyModel extends BaseModel
{
    use BuilderTrait;

    protected $table = 'bm_company';

    // 업체 수정
    public function updateCompany($idx = [], $company = []): bool
    {
        try {
            $builder = $this->getBuilder('bm_company');
            $builder->set($company)
                ->set('updated_at', 'now()', false)
                ->where('idx', $idx)
                ->update();
            return true;
        } catch (\Exception $e) {
            log_message('error', "업체수정실패: " . $e->getMessage());
            return false;
        }
    }

    //이사업체 목록
    public function getCompanyList($param = []): array
    {
        $builder = $this->getBuilder('bm_company', 'a');
        $builder->select('a.*, b.mb_id, b.sns_type, b.company_name as mb_company')
            ->join('bm_member b', 'b.idx = a.mb_idx ', 'left')
            ->where('b.del_yn', 'N')
            ->where('b.left_at IS NULL')
            ->where('a.del_yn', 'N')
            ->where('a.del_at IS NULL')
            ->orderBy('idx', 'DESC');


        if (empty($param['admin'])) $builder->groupBy('a.mb_idx');

        if (!empty($param['stx'])) {
            if($param['sfl']){
                switch ($param['sfl']) {
                    case 'companyName': // 업체
                        $builder->like('a.company_name', $param['stx']);
                        break;
                    case 'addr': // 주소
                        $builder->like('a.addr', $param['stx']);
                        break;
                    case 'cpTel': // 전화번호
                        $builder->like('a.cp_tel', $param['stx']);
                        break;
                    case 'district': // 지역구
                        $builder->like('area_gu', $param['stx']);
                        break;
                }
            }else{
                $builder->like('a.company_name', $param['stx']);
            }
        }

        if (!empty($param['mbIdx'])) $builder->where('mb_idx', $param['mbIdx']);
        if (!empty($param['areaSi'])) $builder->where('area_si', $param['areaSi']);
        if (!empty($param['cp_type'])) $builder->where('a.cp_type', $param['cp_type']);

        if (!empty($param['areaGu'])) {
            if ($param['areaGu'] != 'all') {
                $builder->where('area_gu', $param['areaGu']);
            }
        }

        if (!empty($param['service'])) {
            $builder->like('service_type', $param['service']);
        }

        // 페이지
        // $totalCount = $builder->countAllResults(false); // 쿼리 리셋 방지
        // $paging = getPaging($param['page'] ?? 1, $totalCount, $param['listRow'] ?? 0);
        // if (($param['limitCnt'] ?? 0) > 0) {
        //     $builder->limit($param['limitCnt']);
        // } else {
        //     $builder->limit($paging['listRows'], $paging['formRecord']);
        // }
        // 페이징
        if ($param['isPaging'] ?? true) {
            $totalCount = $builder->countAllResults(false); // 쿼리 리셋 방지
            $paging = getPaging($param['page'] ?? 1, $totalCount, $param['listRow'] ?? 0);
            if (($param['limitCnt'] ?? 0) > 0) $builder->limit($param['limitCnt']);
            else $builder->limit($paging['listRows'], $paging['formRecord']);
        }

        $query = $builder->get();

        return [
            'listData' => $query->getResultArray(),
            'paging' => $paging,
        ];
    }


    //업체 정보
    public function getCompanyByIdxC($idx = 0): array
    {
        $builder = $this->getBuilder('bm_company');
        $builder->select('*')
            ->where('del_at IS NULL')
            ->where('del_yn', 'N');

        if (!empty($idx)) $builder->where('idx', $idx);

        return $builder->get()->getRowArray();
    }


    //업체 삭제
    public function deleteCompany($idx = []): bool
    {
        try {
            $builder = $this->getBuilder('bm_company');
            $builder->set('del_yn', 'Y')
                ->set('del_at', 'now()', false)
                ->where($idx)
                ->update();
            return true;
        } catch (\Exception $e) {
            log_message('error', "삭제실패: " . $e->getMessage());
            return false;
        }
    }

    // 접속 카운트
    public function updateReadCnt($idx = 0): void
    {
        try {
            $builder = $this->getBuilder('bm_company');
            $builder->set('read_cnt', 'read_cnt+1', false)
                ->where('idx', $idx)
                ->update();

        } catch (\Exception $e) {
            log_message('error', '조회수실패: ' . $e->getMessage());
        }
    }

    public function getCompanyRandTop($cpType = 0, $topLimit = 0, $param=[], $service = '', $type = '', $areaGu = '' ): array
    {
        $builder = $this->getBuilder($this->table);
        $builder->select('*')
            ->where('del_yn','N')
            ->where('cp_type', $cpType)
            ->orderBy('RAND()');
        if ($topLimit != 0) $builder->limit($topLimit);
        if(!empty($type)) $builder->where('area_si',$type);
        if(!empty($param['type'])) $builder->where('area_si',REGION[$param['type']]);
        if(!empty($param['service'])) $builder->like('service_type',$param['service']);
        if(!empty($param['reg'])) $builder->where('area_gu',$param['reg']);
        if(!empty($service)) $builder->like('service_type', $service);
        if ($areaGu !== 'all'){
            if(!empty($areaGu)) $builder->where('area_gu' , $areaGu);
        }



        return $builder->get()->getResultArray();
    }


}