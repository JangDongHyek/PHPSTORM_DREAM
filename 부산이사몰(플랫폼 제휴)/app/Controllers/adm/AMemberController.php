<?php

namespace App\Controllers\adm;

use App\Controllers\BaseController;
use App\Models\CompanyModel;
use App\Models\MemberModel;

class AMemberController extends BaseController
{
    //회원목록
    public function member(): string
    {
        $get = $this->request->getGet();

        $param = [
            'page' => $get['page'] ?? 1,
            'type' => $get['type'] ?? 'all',
            'state' => $get['state'] ?? '',
            'sfl' => $get['sfl'] ?? '',
            'stx' => $get['stx'] ?? ''
        ];

        $resultData = (new MemberModel())->getMemberList($param);

        $data = array_merge($resultData, [
            'param' => $param,
            'type' => $get['type'],
            'pid' => 'adm_member',
            'isAdmPage' => true,
        ]);

        return render('adm/member/member', $data);
    }

    // 회원 상세/등록
    public function memberForm($idx = null): string
    {
        $get = $this->request->getGet();

        if ($idx != null) {
            $member = (new MemberModel())->getMemberInfoIdx($idx);
            $companyList = (new CompanyModel())->getCompanyList(['mbIdx' => $idx, 'limitCnt' => 200, 'admin' => 'Y'])['listData'];
        }

        $data = [
            'lv' => $get['lv'],
            'pid' => 'adm_member_form',
            'isAdmPage' => true,
            'member' => $member ?? [],
            'company_list' => $companyList ?? [],
        ];

        return render('adm/member/member_form', $data);
    }
}
