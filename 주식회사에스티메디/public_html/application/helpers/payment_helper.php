<?php
/**
 * 결제로그 작성 헬퍼
 */
if (! function_exists('write_payment_log')) {
	function write_payment_log(array $logData)
	{
		$year = date('Y');
		$month = date('m');

		// CI3에서는 'application/logs' 디렉토리가 기본 로그 파일 저장소입니다.
		$logFilePath = APPPATH . "logs/payment-{$year}-{$month}/";

		if (!file_exists($logFilePath)) {
			mkdir($logFilePath, 0777, true);
		}

		$logFileName = $logFilePath . "payment_log_" . date('Y-m-d') . ".log";

		// 배열을 JSON 문자열로 변환합니다.
		$logDataJson = "==========================================\n";
		$logDataJson .= date("Y-m-d H:i:s") . "\n";
		$logDataJson .= json_encode($logData, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);

		// 파일에 데이터를 추가합니다. 파일이 없으면 생성하고, 데이터가 있으면 추가합니다.
		file_put_contents($logFileName, $logDataJson . PHP_EOL, FILE_APPEND);
	}
}
