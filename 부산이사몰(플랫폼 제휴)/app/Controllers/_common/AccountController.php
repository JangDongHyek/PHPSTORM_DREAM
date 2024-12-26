<?php

namespace App\Controllers\_common;

use App\Controllers\BaseController;
use App\Models\CompanyModel;
use App\Models\EstimateModel;
use App\Models\MemberModel;
use App\Services\AccountService;
use App\Services\BaroSendMessagesService;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\Session\Session;

class AccountController extends BaseController
{
    protected string $loginUrl;
    private AccountService $accountService;

    public function __construct()
    {
        $this->loginUrl = base_url() . 'login';
        $this->accountService = new AccountService();
    }

    // 로그인
    public function login(): string
    {
        $data = [
            'pid' => 'app_login',
        ];

        return render('app/account/login', $data);
    }

    //로그아웃
    public function logout($target = 'app'): ResponseInterface
    {
        setcookie(LOGIN_TOKEN_KEY, '', time() - 3600, "/", "", false, true);

        //세션 초기화
        $session = session();
        $session->remove('member');// 특정 세션 변수 삭제
        $session->destroy(); // 세션 파괴

        $url = $this->loginUrl ?? '/'; // 기본 URL을 메인 페이지로 설정
        return redirect()->to($url);
    }

    //  회원가입
    public function signUp(): string
    {
        $data = [
            'pid' => 'app_sign_up',
        ];

        return render('app/account/sign_up', $data);
    }

    // 아이디비밀번호 찾기
    public function findPw(): string
    {
        $data = [
            'pid' => 'app_find_pw',
        ];

        return render('app/account/find_pw', $data);
    }

    //아이디 찾기
    public function postGetUserFindId(): ResponseInterface
    {
        $post = $this->request->getPost();

        $member = [
            'mb_name' => $post['mbName'],
            'mb_hp' => $post['mbHp'] ?? '',
            'biz_no' => $post['bizNo'] ?? '',
        ];
        $resultData['result'] = (new MemberModel())->memberFindId($member);

        return $this->response->setJSON($resultData);
    }

    //휴대폰 인증
    public function postGetUserFindPass(): ResponseInterface
    {
        $post = $this->request->getPost();

        if($post['memberId']){
            $row = (new MemberModel())->getMemberById($post['memberId']);
        }else{
            $row = (new MemberModel())->getMemberPhone($post['phone']);
        }

        if($post['memberId']){
            if (empty($row)) {
                $resultData['message'] = '아이디를 잘못 입력했습니다.';
                return $this->response->setJSON($resultData);
            }
        }
        /*else{
            if (!empty($row)){
                $resultData['message'] = '등록되어 있는 전화번호가 있습니다';
                return $this->response->setJSON($resultData);
            }
        }*/

        $rand_num = sprintf('%06d', rand(000000, 999999));

        $receiver = [
            [
                'name' => $row['mb_name'],
                'number' => $post['phone']
            ]
        ];

        $message = '[본인확인] 인증번호 [' . $rand_num . '] 를 입력해 주세요.';

        $baroService = new BaroSendMessagesService();
        $response = $baroService->sendMessages($receiver,$message);

        session()->set('randNum', $rand_num);

        return $this->response->setJSON(['result' => true, 'message' => '인증에 성공했습니다.', 'rand_num' => $rand_num]);
    }

    //인증이 확인
    public function postGetAuthenticateUser(): ResponseInterface
    {
        $post = $this->request->getPost();

        $randNum = session()->get('randNum');
        if ($post['authCode'] === $randNum) {
            session()->remove('randNum');

            return $this->response->setJSON(['result' => true, 'message' => '인증에 성공했습니다.']);
        }

        return $this->response->setJSON(['result' => false, 'message' => '인증 코드가 잘못되었습니다.']);
    }


    // 아이디 중복확인
    public function postCheckId(): ResponseInterface
    {
        $post = $this->request->getJSON(true);
        $resultData = ['result' => false];

        $resultData['message'] = $this->accountService->validateMemberInfo('duplicateId', $post['input']);
        if ($resultData['message'] == '') {
            $resultData['result'] = true;
        }

        return $this->response->setJSON($resultData);
    }

    //회원 승인 상태값 변경
    public function addReportPost(): ResponseInterface
    {
        $post = $this->request->getPost();
        $resultData = ['success' => true];

        foreach ($post['idx'] as $value) {
            $data = ['state' => $post['status']];
            $condition = ['idx' => $value];
            $updateResult = (new MemberModel())->updateMember($data, $condition);

            if (!$updateResult) {
                $resultData['success'] = false;
                break;
            }
        }

        return $this->response->setJSON($resultData);

    }

    //회원가입 처리
    public function postSignUp(): ResponseInterface
    {
        helper('member');
        $post = $this->request->getPost();

        $resultData = ['result' => false];
        $snsType = session()->get('snsType') ?? '';
        $snsId = session()->get('snsId') ?? '';

        $standardUserId = removeWhitespace($post['mb_id'] ?? ''); // 일반회원가입시 아이디

        if (!empty($standardUserId)) {
            $userId = $standardUserId;
            $password = password_hash($post['mb_password'] ?? '0000', PASSWORD_DEFAULT);
        } else {
            if (empty($snsType) || empty($snsId)) {
                $resultData['message'] = '소셜로그인 정보를 가져오지 못했어요.<br>로그인 페이지로 이동합니다.';
                $resultData['redirect'] = base_url('/login');
                return $this->response->setJSON($resultData);
            }

            // 소셜회원가입시 아이디, 비번 임의 생성
            $userId = createUserId($snsType);
            $password = password_hash($userId, PASSWORD_DEFAULT);
        }

        //회원가입
        $member = [
            'mb_id' => $userId,
            'mb_password' => $password,
            'mb_name' => $post['mb_name'] ?? '',
            'mb_hp' => $post['mb_hp'] ?? '',
            'mb_email' => $post['mb_email'] ?? '',
            'company_name' => $post['company_name'] ?? '',
            'biz_no' => $post['biz_no'] ?? '',
            'mb_level' => $post['mb_level'] ?? '',
            'sns_type' => $snsType,
            'sns_uniq_id' => $snsId,
            'state' => ($post['mb_level'] === '2') ? 'N' : 'W',
        ];

        $resultData['result'] = (new MemberModel())->insertMember($member);

        if ($resultData['result'] && $member['mb_level'] == '2') {
            // 회원세션생성 & 로그인일자 업데이트
            $this->accountService->createMemberSession($member['mb_id']);
        }

        return $this->response->setJSON($resultData);
    }


    //회원 수정 처리
    public function postSignUpload(): ResponseInterface
    {
        helper('member');
        $post = $this->request->getPost();

        $member = [
            'mb_name' => $post['mb_name'] ?? '',
            'mb_hp' => $post['mb_hp'] ?? '',
            'mb_email' => $post['mb_email'] ?? '',
            'company_name' => $post['company_name'] ?? '',
            'biz_no' => $post['biz_no'] ?? '',
            'mb_level' => $post['mb_level'] ?? '',
        ];

        //return $this->response->setJSON($member);
        if (!empty($post['mb_password'])) {
            $member['mb_password'] = password_hash($post['mb_password'], PASSWORD_DEFAULT);
        }

        $resultData['result'] = (new MemberModel())->updateMember($member, ['idx' => $post['idx']]);

        return $this->response->setJSON($resultData);
    }

    //일반 로그인 처리
    public function postLogin(): ResponseInterface
    {
        $post = $this->request->getJSON(true);
        $resultData = ['result' => false];

        $id = trim($post['id']);
        $password = trim($post['password']);
        $target = $post['target'] ?? ''; // 로그인경로 (admin)

        $memberModel = new MemberModel();
        $member = $memberModel->getMemberById($id);

        if (empty($member)) {
            $resultData['message'] = '아이디 또는 비밀번호를 잘못 입력했습니다.';
            return $this->response->setJSON($resultData);
        }

        //회원정보 검사
        $message = $this->accountService->validateLogin($member, $password);
        if (!empty($message)) {
            $resultData['message'] = $message;
            return $this->response->setJSON($resultData);
        }

        //회원세션 생성
        $this->accountService->createMemberSession($member['mb_id']);

        //암호화 쿠키저장
        helper('encryption');
        $encId = encryptData($member['mb_id']);
        $expire = time() + (86400 * 3);// 3일
        $dataToStore = json_encode([
            'id' => $encId,
            'ip' => $_SERVER['REMOTE_ADDR'],
            'agent' => $_SERVER['HTTP_USER_AGENT'],
        ]);

        $encLoginData = encryptData($dataToStore);
        setcookie(LOGIN_TOKEN_KEY, $encLoginData, $expire, "/", "", false, true);

        $resultData['result'] = true;
        $resultData['redirectURL'] = session()->get('redirectUrl') ?? '';
        $resultData['mb_level'] = $member['mb_level'];

        return $this->response->setJSON($resultData);
    }

    // 회원 지역 목록
    public function postSearchArea(): ResponseInterface
    {
        $post = $this->request->getJSON(true);
        $si = $post['si'] ?? '';

        $resultData = (!empty($si)) ? getSiGuData($si) : [];

        return $this->response->setJSON($resultData);
    }

    // 회원 탈퇴
    public function postUserSecession():ResponseInterface
    {
        $post = $this->request->getPost();
        $resultData = ['success' => true];

        $data = [
            'left_at' => date('Y-m-d H:i:s'),
            'del_yn' => 'Y'
        ];

        $condition = $post;
        $updateResult = (new MemberModel())->updateData($data,$condition);

        if (!$updateResult) {
            $resultData['success'] = false; // 업데이트 실패 시 false로 설정
        }else{
            setcookie(LOGIN_TOKEN_KEY, '', time() - 3600, "/", "", false, true);

            //세션 초기화
            $session = session();
            $session->remove('member');// 특정 세션 변수 삭제
            $session->destroy(); // 세션 파괴
        }

        return $this->response->setJSON($resultData);
    }

    //업체 등록
    public function postcompanyUp(): ResponseInterface
    {
        $post = $this->request->getPost();
        $file = $this->request->getFile('mainImg');
        $shortsVideoFile = $this->request->getFile('shortsVideo');
        $imgLink = '';
        $videoLink = '';


        $folder = $post['mbidx'];
        $uploadPath = UPLOAD_FOLDERS['COMPANY']['path'] . $folder . '/';
        if (!file_exists($uploadPath)) mkdir($uploadPath, 0777, true);

        if ($file !== null && $file->isValid() && !$file->hasMoved()) {
            $newName = $file->getRandomName();
            $file->move($uploadPath, $newName);

            // 사진 크기 조절
            $imagePath = $uploadPath . $newName;
            $image = service('image');
            $image->withFile($imagePath)
                ->resize(900, 500, true)
                ->save($imagePath);
            $imgLink = $folder . '/' . $newName;
        }

        // 숏츠 비디오 처리
        if ($shortsVideoFile && $shortsVideoFile->isValid() && !$shortsVideoFile->hasMoved()) {
            $newVideoName = $shortsVideoFile->getRandomName();
            $shortsVideoFile->move($uploadPath, $newVideoName);
            $videoLink = $folder . '/' . $newVideoName;
        } else {
            $videoLink = $post['noshortsVideo'];
        }

        $company = [
            'mb_idx' => $post['mbidx'],
            'company_name' => $post['companyName'], //업체명
            'area_si' => $post['areaSi'], //지역
            'area_gu' => $post['areaGu'], //구
            'zip_code' => $post['zcode'], //우편번호
            'addr' => $post['addr'], //주소
            'addr_detail' => $post['addrDetail'], //상세 주소
            'cp_tel' => $post['cpTel'], // 연락처
            'cp_desc' => $post['cpDesc'], //간단설명
            'service_type' => $post['serviceTypes'], //서비스 콘마로 구분
            'grant' => $post['grant'], //관허
            'main_img' => $imgLink, // 이미지
            'shorts_video' => $videoLink, // 숏츠 비디오 링크 추가
            'hompage_link' => $post['hompageLink'], // 홈페이지
            'blog_link' => $post['blogLink'], //블로그
            'instar_link' => $post['instarLink'], //인스타
            'youtube_link' => $post['youtubeLink'],// 유튜브
            'tiktok_link' => $post['tiktokLink'], // 틱톡
            'service_desc' => $post['serviceDesc'], //서비스 설명
            'cp_type' => $post['cpType'] // 노출 위치
        ];

        $resultData['result'] = (new CompanyModel())->insertData($company);

        return $this->response->setJSON($resultData);
    }

    //업체 수정
    public function postCompanyUpdate(): ResponseInterface
    {
        $post = $this->request->getPost();
        $file = $this->request->getFile('mainImg');
        $shortsVideoFile = $this->request->getFile('shortsVideo');
        $imgLink = '';
        $videoLink = '';

        $folder = $post['mbidx'];
        $uploadPath = UPLOAD_FOLDERS['COMPANY']['path'] . $folder . '/';
        if (!file_exists($uploadPath)) mkdir($uploadPath, 0777, true);
        // 메인 이미지 처리
        if ($file->isValid() && !$file->hasMoved()) {
            $newName = $file->getRandomName();
            $file->move($uploadPath, $newName);

            // 사진 크기 조절
            $imagePath = $uploadPath . $newName;
            $image = service('image');
            $image->withFile($imagePath)
                ->resize(900, 500, true)
                ->save($imagePath);
            $imgLink = $folder . '/' . $newName;

        } else {
            $imgLink = $post['nomainImg'];
        }

        // 숏츠 비디오 처리
        if ($shortsVideoFile && $shortsVideoFile->isValid() && !$shortsVideoFile->hasMoved()) {
            $newVideoName = $shortsVideoFile->getRandomName();
            $shortsVideoFile->move($uploadPath, $newVideoName);
            $videoLink = $folder . '/' . $newVideoName;
        } else {
            $videoLink = $post['noshortsVideo'];
        }

        $company = [
            'mb_idx' => $post['mbidx'],
            'company_name' => $post['companyName'], //업체명
            'area_si' => $post['areaSi'], //지역
            'area_gu' => $post['areaGu'], //구
            'zip_code' => $post['zcode'], //우편번호
            'addr' => $post['addr'], //주소
            'addr_detail' => $post['addrDetail'], //상세 주소
            'cp_tel' => $post['cpTel'], // 연락처
            'cp_desc' => $post['cpDesc'], //간단설명
            'service_type' => $post['serviceTypes'], //서비스 콘마로 구분
            'grant' => $post['grant'], //관허
            'main_img' => $imgLink, // 이미지
            'shorts_video' => $videoLink, // 숏츠 비디오 링크 추가
            'hompage_link' => $post['hompageLink'], // 홈페이지
            'blog_link' => $post['blogLink'], //블로그
            'instar_link' => $post['instarLink'], //인스타
            'youtube_link' => $post['youtubeLink'],// 유튜브
            'tiktok_link' => $post['tiktokLink'], // 틱톡
            'service_desc' => $post['serviceDesc'], //서비스 설명
            'cp_type' => $post['cpType'] // 노출 위치
        ];

        $resultData['result'] = (new CompanyModel())->updateCompany($post['idx'], $company);

        return $this->response->setJSON($resultData);
    }

    //업체 삭제
    public function deleteCompany(): ResponseInterface
    {

        $post = $this->request->getPost();
        $resultData = ['success' => true];

        foreach ($post['idx'] as $value) {
            $condition = ['idx' => $value];
            $updateResult = (new CompanyModel())->deleteCompany($condition);
            if (!$updateResult) {
                $resultData['success'] = false;
                break;
            }
        }
        return $this->response->setJSON($resultData);
    }

    //이사견적 신청
    public function postEstimate(): ResponseInterface
    {
        $post = $this->request->getPost();

        $estimate = [
            'mb_idx' => $post['mbidx'],
            'sched_date' => $post['schedDate'],
            'service_type' => $post['movingType'],
            'origin' => $post['origin'],
            'bourne' => $post['bourne'],
            'mb_name' => $post['mbName'],
            'mb_hp' => $post['mbHp']
        ];
        if (!$post['estIdx']) {
            $resultData['result'] = (new EstimateModel())->insertEstimate($estimate);
        } else {
            $resultData['result'] = (new EstimateModel())->updateEstimate($estimate, ['idx' => $post['estIdx']]);
        }
        return $this->response->setJSON($resultData);
    }

    //견적신청 관리 승인/취소
    public function postChangeAuth(): ResponseInterface
    {
        $post = $this->request->getPost();
        $resultData = ['success' => true];
        $estModel = new EstimateModel();

        foreach ($post['idx'] as $idx) {
            $changState = $post['auth'] == 'Y' ? 'Y' : 'N';
            $condition = ['idx' => $idx];
            $data = ['state' => $changState];
            $updateResult = $estModel->updateEstimate($data, $condition);

            $baroService = new BaroSendMessagesService();

            $result = (new MemberModel())->kakaoTalList();
            $variables = [];

            foreach ($result as $list){
                if (isset($list['mb_hp'])) {
                    $phoneNumber = str_replace('-', '', $list['mb_hp']);
                    $variables[] = ['number' => $phoneNumber];
                }
            }

            $baroService->sendKakaoTalkMessages($variables, 'NEW_ORDER', '견적 신청 접수 안내', BAROBILL_KAKAO, 'E', BAROBILL_SMS, $idx);

            if (!$updateResult) {
                $resultData['success'] = false;
                break;
            }
        }

        return $this->response->setJSON($resultData);
    }

    //이사견적 상태 변경
    public function postEstimateAuth(): ResponseInterface
    {
        $post = $this->request->getPost();
        $resultData = ['success' => true];
        $estModel = new EstimateModel();

        foreach ($post['idx'] as $index => $idx) {
            $condition = ['idx' => $idx];
            $state = $post['auth'][$index];
            $data = ['service_state' => $state];
            $updateResult = $estModel->updateEstimate($data, $condition);

            if (!$updateResult) {
                $resultData['success'] = false;
                break;
            }

        }
        return $this->response->setJSON($resultData);
    }

    //비밀번호 변경
    public function postUpdatePassword(): ResponseInterface
    {
        $post = $this->request->getPost();
        $resultData = ['result' => false];

        $member['mb_password'] = password_hash($post['mbPassword'], PASSWORD_DEFAULT);

        $resultData['result'] = (new MemberModel())->updateMember($member, ['mb_id' => $post['mbId']]);

        return $this->response->setJSON($resultData);
    }

    // 소셜 로그인 처리
    public function handleSocialLogin($snsType, $snsId, array $etc, $response)
    {
        $memberModel = new MemberModel();
        $mb_id = generateRandomId();

        $referrer = session()->get('login_referrer');
        if (empty($referrer) === false) $referrer = base_url('/');

        $password = password_hash('0000', PASSWORD_DEFAULT);

        $member = $memberModel->getMemberById(null, $snsType, $snsId);

        session()->remove('login_referrer');
        if (empty($member)) {
            $memberData = [
                'sns_type' => $snsType,
                'sns_uniq_id' => $snsId,
                'mb_hp' => $response['mobile'] ?? formatPhoneNumber($response['phone_number']),
                'mb_name' => $response['name'],
                'mb_id' => $mb_id,
                'mb_password' => $password,
                'state' => 'N'
            ];
            $data = $memberModel->insertData($memberData);
            if ($data) {
                $this->accountService->createMemberSession($mb_id);
                return redirect()->to($referrer);
            }
        } else {
            //회원정보 검사
            $message = $this->accountService->validateLogin($member);
            if (!empty($message)) {
                return (new ErrorController())->errorMessage($message, $referrer);
            }

            // 회원세션생성
            $this->accountService->createMemberSession($member['mb_id']);

            return redirect()->to($referrer);
        }
    }
}


