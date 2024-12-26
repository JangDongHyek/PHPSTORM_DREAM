<?php
namespace App\Models\Transaction;

use App\Models\AdvertsModel;
use App\Models\MemberCardModel;
use CodeIgniter\Model;

class AdvertsCardModel extends Model
{
    //광고 신청
    public function insertAdvertsCard($adverts=[], $card=[]): array
    {
        // 트랜잭션 시작
        $this->db->transStart();
        try{
            //광고 신청
            $isInsert = (new AdvertsModel)->insertData($adverts);
            if (empty($isInsert)) throw new \Exception('광고등록실패');

            $cardIdx = (new MemberCardModel)->insertData($card, true);
            if (empty($cardIdx)) throw new \Exception('카드등록실패');

            // 트랜잭션 완료
            $this->db->transComplete();
            return [
                'result' => true,
                'cardIdx' => $cardIdx,
            ];

        } catch (\Exception $e) {
            $this->db->transRollback(); // 실패시 롤백
            log_message('error', '광고신청롤백: ' . $e->getMessage());
            return [
                'result' => false,
                'cardIdx' => '',
            ];
        }
    }

}