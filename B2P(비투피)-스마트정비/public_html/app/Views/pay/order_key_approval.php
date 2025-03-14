<?php
header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
header("Cache-Control: no-store");
header("Pragma: no-cache");

require APPPATH . 'ThirdParty/KCP_autoPay/cfg/site_conf_inc.php'; // 환경설정 파일 include
require APPPATH . 'ThirdParty/KCP_autoPay/mobile_auth/js/KCPComLibrary.php'; // library [수정불가]
?>
<?php
// 쇼핑몰 페이지에 맞는 문자셋을 지정해 주세요.
$charSetType      = "utf-8";             // UTF-8인 경우 "utf-8"로 설정

$siteCode         = $_GET[ "site_cd"     ];
$orderID          = $_GET[ "ordr_idxx"   ];
$paymentMethod    = $_GET[ "pay_method"  ];
$escrow           = ( $_GET[ "escw_used"   ] == "Y" ) ? true : false;
$productName      = $_GET[ "good_name"   ];
// 아래 두값은 POST된 값을 사용하지 않고 서버에 SESSION에 저장된 값을 사용하여야 함.
$paymentAmount    = $_GET[ "good_mny"    ]; // 결제 금액
$returnUrl        = $_GET[ "Ret_URL"     ];

// Access Credential 설정
$accessLicense    = "";
$signature        = "";
$timestamp        = "";

// Base Request Type 설정
$detailLevel      = "0";
$requestApp       = "WEB";
$requestID        = $orderID;
$userAgent        = $_SERVER['HTTP_USER_AGENT'];
$version          = "0.1";

try
{
    $payService = new PayService( $g_wsdl );

    $payService->setCharSet( $charSetType );

    $payService->setAccessCredentialType( $accessLicense, $signature, $timestamp );
    $payService->setBaseRequestType( $detailLevel, $requestApp, $requestID, $userAgent, $version );
    $payService->setApproveReq( $escrow, $orderID, $paymentAmount, $paymentMethod, $productName, $returnUrl, $siteCode );

    $approveRes = $payService->approve();

    printf( "%s,%s,%s,%s", $payService->resCD,  $approveRes->approvalKey,
        $approveRes->payUrl, $payService->resMsg );

    //log_message('error','PHP SOAP 모듈 : ' . print_r($payService,true));
    //log_message('error','PHP SOAP 모듈 $_get: ' . print_r($_GET,true));

}
catch (SoapFault $ex )
{
    //log_message('error','PHP SOAP 모듈 : ' . $ex);
    printf( "%s,%s,%s,%s", "95XX", "", "", iconv("UTF-8","UTF-8","연동 오류 (PHP SOAP 모듈 설치 필요)".var_dump($ex)) );
}
?>