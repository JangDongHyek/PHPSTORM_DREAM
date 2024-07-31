<?php
namespace App\Controllers;
use App\Models\GmAc\PayModel;
use App\Models\GmarketApiModel;
use CodeIgniter\Model;
use Lazzard\FtpClient\Connection\FtpSSLConnection;
use Lazzard\FtpClient\Config\FtpConfig;
use Lazzard\FtpClient\FtpClient;
use App\Helpers\ftp_helper;

class PayController extends BaseController{

    public function test($to = 'World')
    {
        echo "Hello {$to}!".PHP_EOL;
        phpinfo();
    }

    // 배치키요청
    public function OrderKeyMobile(){
        return view('pay/order_key_mobile',$this->data);
    }

    // KCP 거래등록
    public function OrderKeyApproval(){
        return view('pay/order_key_approval',$this->data);
    }

    // KCP PASS,CARD 등록
    public function OrderKeyMobilePop(){
        return view('pay/order_key_mobile_pop',$this->data);
    }

    // 결과
    public function OrderKeyMobileResult(){
        $post = $this->data;

        $resultData['res_cd'] = $post['res_cd'];
        $resultData['res_msg'] = $post['res_msg'];
        $resultData['ordr_idxx'] = $post['ordr_idxx'];
        $resultData['good_mny'] = $post['good_mny'];
        $resultData['good_name'] = $post['good_name'];
        $resultData['buyr_name'] = $post['buyr_name'];
        $resultData['card_cd'] = $post['card_cd'];
        $resultData['card_name'] = $post['card_name'];
        $resultData['batch_key'] = $post['batch_key'];
        $resultData['pass'] = $post['pass'];
        $resultData['mb_id'] = $post['member']['mb_id'];

        log_message('pay','OrderKeyMobileResult: '. print_r($post,true));
        $payModel = new PayModel();
        $resultData['result'] = $payModel->setPayKey($resultData);

        return view('pay/order_key_mobile_result',$resultData);
    }

    // 배치키로 주문요청
    public function OrderPay(){
        $post = $this->data;
        $payModel = new PayModel();
        $resultData['key_list'] = $payModel->getPayKeyByMbid($post['member']['mb_id']);
        return view('pay/order_pay',$resultData);
    }

    // KCP 등록
    public function OrderPayPop(){
        return view('pay/order_pay_pop',$this->data);
    }

    // 결과
    public function OrderPayResult(){
        $post = $this->data;
        $post['res_msg'] = iconv("euc-kr","utf-8",$post['res_msg']);
        $post['good_name'] = iconv("euc-kr","utf-8",$post['good_name']);
        $post['card_name'] = iconv("euc-kr","utf-8",$post['card_name']);
        $post['buyr_name'] = iconv("euc-kr","utf-8",$post['buyr_name']);

        $resultData['res_cd'] = $post['res_cd'];
        $resultData['res_msg'] = $post['res_msg'];
        $resultData['tno'] = $post['tno'];
        $resultData['amount'] = $post['amount'];
        $resultData['pay_method'] = $post['pay_method'];
        $resultData['ordr_idxx'] = $post['ordr_idxx'];
        $resultData['good_mny'] = $post['good_mny'];
        $resultData['good_name'] = $post['good_name'];
        $resultData['buyr_name'] = $post['buyr_name'];
        $resultData['buyr_tel2'] = $post['buyr_tel2'];
        $resultData['buyr_mail'] = $post['buyr_mail'];
        $resultData['card_cd'] = $post['card_cd'];
        $resultData['card_no'] = $post['card_no'];
        $resultData['card_name'] = $post['card_name'];
        $resultData['app_time'] = $post['app_time'];
        $resultData['app_no'] = $post['app_no'];
        $resultData['quota'] = $post['quota'];
        $resultData['bt_batch_key'] = $post['bt_batch_key'];
        $resultData['mb_id'] = $post['member']['mb_id'];

        //log_message('error','OrderPayResult: '. print_r($post,true));
        log_message('pay','OrderPayResult: '. print_r($post,true));
        $payModel = new PayModel();
        $resultData['result'] = $payModel->setPay($resultData);


        return view('pay/order_pay_result',$resultData);
    }

    // 가상계좌 발급
    public function OrderVcnt(){
        $post = $this->data;
        $resultData['mb_id'] = $post['member']['mb_id'];
        return view('pay/order_vcnt',$resultData);
    }

    // KCP 등록
    public function OrderVcntPop(){
        return view('pay/order_vcnt_pop',$this->data);
    }

    // KCP NOTI
    public function OrderVcntNoti(){
        //https://testadmin.kcp.co.kr/Modules/Noti/TEST_Vcnt_Noti.jsp 테스트 노티보내는곳
        $post = $this->data;

        if ( $post['tx_cd'] == "TX00" ){
            $resultData['site_cd'] = $post['site_cd'];
            $resultData['tno'] = $post['tno'];
            $resultData['order_no'] = $post['order_no'];
            $resultData['tx_cd'] = $post['tx_cd'];
            $resultData['tx_tm'] = $post['tx_tm'];
            $resultData['ipgm_name'] = $post['ipgm_name'];
            $resultData['ipgm_mnyx'] = $post['ipgm_mnyx'];
            $resultData['bank_code'] = $post['bank_code'];
            $resultData['account'] = $post['account'];
            $resultData['noti_id'] = $post['noti_id'];
            $resultData['op_cd'] = $post['op_cd'];
            $resultData['remitter'] = $post['remitter'];
            $resultData['noti_hash'] = $post['noti_hash'];

            /* 값은오지만 안쓰는 컬럼
            $resultData['ordr_idxx'] = $post['ordr_idxx'];
            $resultData['cash_a_no'] = $post['cash_a_no'];
            $resultData['ipgm_stat'] = $post['ipgm_stat'];
            $resultData['opt01'] = $post['opt01'];
            $resultData['ipgm_name'] = $post['ipgm_name'];
            $resultData['cash_self_force_yn'] = $post['cash_self_force_yn'];
            $resultData['totl_mnyx'] = $post['totl_mnyx'];
            $resultData['char_set'] = $post['char_set'];
            $resultData['noti_cnt'] = $post['noti_cnt'];
            */

            // DB 처리 코드 삽입
            $payModel = new PayModel();
            $resultData['vcnt_list'] = $payModel->setVcntNotiByTno($resultData);
        }else{
            log_message('pay','OrderVcntNoti: '. print_r($_POST,true));
        }
        return view('pay/order_vcnt_noti',$this->data);
    }

    // 결과
    public function OrderVcntResult(){
        $post = $this->data;
        $post['res_msg'] = iconv("euc-kr","utf-8",$post['res_msg']);
        $post['good_name'] = iconv("euc-kr","utf-8",$post['good_name']);
        $post['buyr_name'] = iconv("euc-kr","utf-8",$post['buyr_name']);
        $post['bankname'] = iconv("euc-kr","utf-8",$post['bankname']);

        $resultData['res_cd'] = $post['res_cd'];
        $resultData['res_msg'] = $post['res_msg'];
        $resultData['ordr_idxx'] = $post['ordr_idxx'];
        $resultData['va_uniq_key'] = $post['va_uniq_key'];
        $resultData['tno'] = $post['tno'];
        $resultData['good_mny'] = $post['good_mny'];
        $resultData['good_name'] = $post['good_name'];
        $resultData['buyr_name'] = $post['buyr_name'];
        $resultData['buyr_tel1'] = $post['buyr_tel1'];
        $resultData['buyr_tel2'] = $post['buyr_tel2'];
        $resultData['buyr_mail'] = $post['buyr_mail'];
        $resultData['bankname'] = $post['bankname'];
        $resultData['bankcode'] = $post['bankcode'];
        $resultData['depositor'] = $post['depositor'];
        $resultData['account'] = $post['account'];
        $resultData['app_time'] = $post['app_time'];
        $resultData['pass'] = $post['pass'];

        $resultData['mb_id'] = $post['member']['mb_id'];

        //log_message('error','OrderPayResult: '. print_r($post,true));
        log_message('pay','OrderVcntResult: '. print_r($post,true));
        $payModel = new PayModel();
        $resultData['result'] = $payModel->setVcnt($resultData);


        return view('pay/order_vcnt_result',$resultData);
    }

    // 가상계좌 발급취소요청
    public function OrderVcntCancle(){
        $post = $this->data;
        $resultData['mb_id'] = $post['member']['mb_id'];
        $payModel = new PayModel();
        $resultData['vcnt_list'] = $payModel->getVcntTnoByMbid($post['member']['mb_id']);

        return view('pay/order_vcnt_cancle',$resultData);
    }

    // KCP 등록 취소요청
    public function OrderVcntCanclePop(){
        return view('pay/order_vcnt_cancle_pop',$this->data);
    }

    // 취소요청 결과
    public function OrderVcntCancleResult(){
        $post = $this->data;
        $post['res_msg'] = iconv("euc-kr","utf-8",$post['res_msg']);


        $resultData['cancle_res_cd'] = $post['res_cd'];
        $resultData['cancle_res_msg'] = $post['res_msg'];
        $resultData['tno'] = $post['tno'];
        $resultData['mb_id'] = $post['member']['mb_id'];


        log_message('pay','OrderVcntCancleResult: '. print_r($post,true));
        $payModel = new PayModel();
        $resultData['result'] = $payModel->setVcntCancle($resultData);

        return view('pay/order_vcnt_cancle_result',$resultData);
    }

    // 매입요청하기
    public function OrderPerchaseRequest(){

        $post = $this->data;
        $resultData['mb_id'] = $post['member']['mb_id'];
        $payModel = new PayModel();
        $resultData['tx_cd'] = 'TX00';
        $resultData['vcnt_noti'] = $payModel->getVcntNoti($resultData);

        return view('pay/order_perchase_request',$resultData);
    }

    // 매입요청 파일생성
    public function OrderPerchase($tno = 0){

        $post = $this->data;
        if(!$tno){
            $tno = $post['tno'];
        }


        $resultData['mb_id'] = $post['member']['mb_id'];
        $payModel = new PayModel();
        $resultData['vcnt_noti'] = $payModel->getVcntNotiBytno($tno);
        $resultData['vcnt_noti']['status'] = 'up';

        $resultData['purchase_list'] = $payModel->setPurchase($resultData['vcnt_noti']);
        return view('pay/order_perchase',$resultData);
    }

    // 매입요청 파일 업로드
    public function OrderPerchaseUp(){

        error_reporting( E_ALL );
        ini_set( "display_errors", 1 );
        helper('ftp');

        $host = 'dreamforone.co.kr';
        $port = 21;
        $login = '33pay';
        $password = 'ny!1qw0x';

        //$ftp = new ftp_controller();
        $ftp = new ftp_helper();
        $conn_id = $ftp->ftp_connect($host);
        if (!$conn_id) {
            die('Could not connect to FTP server');
        }

        $ftp->ftp_login($conn_id, $login, $password);
        $ftp->ftp_pasv($conn_id, true);

        $contents = $ftp->ftp_nlist($conn_id, "/public_html/");
        if ($contents === false) {
            die('Could not list directory contents');
        }



        var_dump($contents);
        exit();

        //$test = $ftp->count();
        $size = $ftp->dirSize('/public_html/img/landing');

        //var_dump($size);
        $total = $ftp->countItems('/public_html/data/file/contract', 'file');
        // scan the current directory and returns the details of each item
        $items = $ftp->scanDir();
        var_dump($connect_result);
        echo '$size = '.$size.'<br>';
        echo '$total = '.$total.'<br>';
        echo '$items = '.var_dump($items).'<br>';
        log_message('alert','OrderPerchaseUp $connect_result:'.print_r($connect_result,true));
        log_message('alert','OrderPerchaseUp $login_result:'.print_r($login_result,true));
        log_message('alert','OrderPerchaseUp $size:'.print_r($size,true));
        log_message('alert','OrderPerchaseUp $total:'.print_r($total,true));
        exit();

        exit($login_result);

        $items = $ftp->scanDir('.', true);
        echo 'items:'.print_r($items,true).'\n';
        //var_dump($ftp->scanDir('.', true));
        //$img = $ftp->search('/(.*)\.jpg$/i');

        //var_dump(print_r($ftp));
        exit();
        exit();
        $ftp->isDir('public_html/data/file/contract');
        //$size = $ftp->dirSize('public_html/data/file/contract');
        //$total = $ftp->count();
        //$total = $ftp->countItem('public_html/data/file/contract/');
        //log_message('alert','OrderPerchaseUp total:'.$total);
        log_message('alert','OrderPerchaseUp items:'.print_r($size,true));



        return $this->response->setJSON($ftp);

        exit();
        //var_dump($ftp->scanDir('.', true));

        $payModel = new PayModel();
        $resultData['vcnt_noti'] = $payModel->getVcntNotiBytno($tno);
        $resultData['vcnt_noti']['status'] = 'up';

        $resultData['purchase_list'] = $payModel->setPurchase($resultData['vcnt_noti']);
        exit();
        return view('pay/order_perchase',$resultData);
    }
    public function OrderPerchaseUp2(){
        $host = '210.122.73.81'; //real
        $host = '210.122.176.81'; //test
        $host = 'dreamforone.kr'; //test
        $login = 'b2p_sftp';
        $login = 'root';
        $password = 'b2p1234@!';
        $password = '!@3dnfl182';

        try {
            if (!extension_loaded('ftp')) {
                throw new \RuntimeException("FTP extension not loaded.");
            }

            $connection = new FtpSSLConnection($host, $login, $password);
            var_dump($connection);
            exit(0);
            $connection->open();


            $config = new FtpConfig($connection);
            $config->setPassive(true);
            $client = new FtpClient($connection);
            print_r($client->getFeatures());
            $connection->close();

        } catch (Throwable $ex) {
            print_r($ex->getMessage());
        }

        $client->listDir('public_html/data/file/contract/');

        log_message('alert','OrderPerchaseUp items 2222:'.print_r('g2',true));
        //log_message('alert','OrderPerchaseUp items 2222:'.print_r($client,true));

        var_dump($client);
        exit(0);
        return $this->response->setJSON('g2');

        //var_dump($ftp->scanDir('.', true));

        $payModel = new PayModel();
        $resultData['vcnt_noti'] = $payModel->getVcntNotiBytno($tno);
        $resultData['vcnt_noti']['status'] = 'up';

        $resultData['purchase_list'] = $payModel->setPurchase($resultData['vcnt_noti']);
        exit();
        return view('pay/order_perchase',$resultData);
    }
}