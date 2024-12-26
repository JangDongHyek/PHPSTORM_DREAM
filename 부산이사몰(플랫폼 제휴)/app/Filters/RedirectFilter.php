<?php

namespace App\Filters;

use App\Controllers\_common\Account;
use App\Controllers\_common\AccountController;
use App\Controllers\_common\Error;
use CodeIgniter\Filters\FilterInterface;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use Config\App;

class RedirectFilter implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    {
        $currentHost = $request->getServer('HTTP_HOST');
        $config = new App();
        $baseURL = rtrim($config->baseURL, '/'); // baseURL의 끝 슬래시 제거
        $path = ltrim($request->getUri()->getPath(), '/'); // 요청 경로의 앞 슬래시 제거

        // baseURL 과 다르면 리디렉션
        if (!isWordInString($baseURL, $currentHost)) {
            return redirect()->to($baseURL . '/' . $path); // 경로를 합칠 때 슬래시 추가
        }
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        // 후처리 로직
    }
}