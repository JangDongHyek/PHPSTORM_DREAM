<?php

namespace App\Logging;

use CodeIgniter\Log\Handlers\FileHandler;

class MonthlyFileHandler extends FileHandler
{
    public function __construct(array $config)
    {
        parent::__construct($config);

        // 월별 폴더 경로 생성
        $monthPath = $this->path . date('Y-m') . '/';

        // 월별 폴더가 없으면 생성
        if (!is_dir($monthPath)) {
            mkdir($monthPath, 0777, true);
        }

        // 월별 폴더 경로를 사용하여 로그 파일 경로 설정
        $this->path = $monthPath;
    }
}
