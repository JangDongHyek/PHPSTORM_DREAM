<?php

namespace App\Models;

use App\Models\Traits\BuilderTrait;

class VisitorsModel extends BaseModel
{
    use BuilderTrait;
    protected $table = 'bm_visitors';

    //방문자 insert
    public function addVisitor($data = [])
    {

        $today = date('Y-m-d');

        $builder = $this->getBuilder($this->table);
        /*$builder->select('*')
            ->like('created_at', $today)
            ->where('ip_address', $data['ip_address']);
        $row = $builder->get()->getRowArray();
        if(!$row){
            $builder->insert($data);
        }*/
        $builder->insert($data);
    }

    // 방문자 수 오늘 , 총
    public function getVisitorCount($data = []): array
    {
        $today = date('Y-m-d');

        $builder = $this->getBuilder($this->table);
        $builder->select('*')
            ->like('created_at', $today);
        $todayCount = $builder->countAllResults(false); // 쿼리 리셋 방지

        $builder2 = $this->getBuilder($this->table);
        $totalCount = $builder2->countAllResults(false);
        return [
            'todayCount' => $todayCount, // 오늘
            'totalCount' => $totalCount+11976288 // 총
        ];
    }
}