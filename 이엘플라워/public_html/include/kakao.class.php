<?php
class KakaPay{
	private $adminKey=""; // admin 
	private $cid="";//가맹점 코드
	private $tid="";//결제고유번호
	private $pg_token="";//결제완료시 토큰
	private $partner_order_id="";//주문번호
	private $partner_user_id="";//사용자아이디
	private $item_name="";//상품명
	private $quantity=0;//갯수
	private $total_amount=0;//가격
	private $tax_free_amount=0;//택배비
	private $approval_url="http://www.elflower.co.kr/market/cart/order_ok.html";//결제성공시 url
	private $cancel_url="http://www.elflower.co.kr/market/cart/kakao_cancel.php";//결제 취소시 url
	private $fail_url="http://www.elflower.co.kr/market/cart/kakao_failed.php";//결제 실패시 url
	private $type="0";//준비인지 요청인지 구분
	private $pay_url=array();//결제 준비 승인 url
	private $headers= Array(
								'Authorization: KakaoAK f67d586e5915fd23cb2369e0ce0358a5',
								'Content-type: application/x-www-form-urlencoded;charset=utf-8'
                );
	private $params=array();
	//생성자에 결제준비인지 승인인지 url 주소를 미리 세팅하기
	public function __construct($type,$list,$device){
		$this->pay_url=array(
										"1"=>'https://kapi.kakao.com/v1/payment/ready',
										"2"=>'https://kapi.kakao.com/v1/payment/approve'
									);
		$this->type=$type;
		$this->cid=$list[cid];
		$this->tid=$list[tid];
		$this->pg_token=$list[pg_token];
		$this->adminKey=$list[adminKey];
		$this->partner_order_id=$list[order_id];
		$this->partner_user_id=$list[user_id];
		$this->item_name=$list[item_name];
		$this->quantity=$list[quantity];
		$this->total_amount=$list[total_amount];
		$this->tax_free_amount=$list[free_amount];
		if($device=="pc"){
			$this->approval_url="http://www.elflower.co.kr/market/cart/kakao_success.php";
			$this->cancel_url="http://www.elflower.co.kr/market/cart/kakao_cancel.php";
			$this->fail_url="http://www.elflower.co.kr/market/cart/kakao_failed.php";
		}else{
			$this->approval_url="http://www.elflower.co.kr/mobile/cart/kakao_success.php";
			$this->cancel_url="http://www.elflower.co.kr/mobile/cart/kakao_cancel.php";
			$this->fail_url="http://www.elflower.co.kr/mobile/cart/kakao_failed.php";
		}

	}

	//결제준비할 때 파라미터
	public function readyKakaoPay(){
		$params = array(
				'cid'               => $this->cid,                                    // 가맹점코드 10자
				'partner_order_id'  => $this->partner_order_id,                   // 주문번호
				'partner_user_id'   => $this->partner_user_id,                   // 유저 id
				'item_name'         => $this->item_name,               // 상품명
				'quantity'          => $this->quantity,                    // 상품 수량
				'total_amount'      => $this->total_amount,                // 상품 총액
				'tax_free_amount'   => $this->tax_free_amount,                                     // 상품 비과세 금액
				'vat_amount' => 0,
				'approval_url'      => $this->approval_url,                           // 결제성공시 콜백url 최대 255자
				'cancel_url'        => $this->cancel_url,
				'fail_url'          => $this->fail_url,
		);
		$this->params=$params;
		
	}
	//결제승인시 파라미터 
	public function successKakaoPay(){
		$params = array(
				'cid'               => $this->cid,                                    // 가맹점코드 10자
				'tid'               => $this->tid,                                    // 가맹점 결제코드 10자
				'partner_order_id'  => $this->partner_order_id,                   // 주문번호
				'partner_user_id'   => $this->partner_user_id,                   // 유저 id
				'pg_token'         => $this->pg_token
		);
		$this->params=$params;
	}
	//카카오페이 실행하기
	public function execKakaoPay(){
		$curl = curl_init();

		curl_setopt( $curl, CURLOPT_URL, $this->pay_url[$this->type]);
		curl_setopt( $curl, CURLOPT_BINARYTRANSFER, 1);
		curl_setopt( $curl, CURLOPT_HTTPHEADER, $this->headers);
		curl_setopt( $curl, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt( $curl, CURLOPT_POST, true );
		curl_setopt( $curl, CURLOPT_POSTFIELDS, http_build_query($this->params) );
		$gData = curl_exec( $curl );
		curl_close($curl);
		$strArrResult = json_decode($gData);

		
		
		return $strArrResult;
	}
	
}
?>