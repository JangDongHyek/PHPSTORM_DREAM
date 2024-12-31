<?php
namespace App\Controllers\api;

use App\Controllers\BaseController;
use App\Libraries\Jl;
use App\Libraries\JlModel;
use App\Libraries\JlFile;
use App\Libraries\JlService;
class JlController extends BaseController
{
    private $service;

    public function __construct() {
        $this->service = new JlService($_POST,$_FILES);
    }

    public function method() {
        echo $this->service->jsonEncode($this->service->method());
    }

}