<?php
namespace App\Libraries;

namespace App\Controllers\app;
use App\Controllers\BaseController;

use App\Libraries\Jl;
use App\Libraries\JlModel;
//use PHPUnit\Util\Exception;


class TestController extends BaseController
{
    /**
     * 퍼블리싱 컨트롤러
     *
     */

    // 메인
    public function test()
    {
        //try {
        //    $jl = new Jl();
        //    echo 1;
        //    throw new \Exception("12");
        //}catch(\Exception $e) {
        //    echo $e->getMessage();
        //}

        $jl = new Jl();
        $user_model = new JlModel(array("table" => "user"));
        $data = [
            'pid' => 'index',
            "jl" => $jl,
            "user_model" => $user_model
        ];

        return render('app/test', $data);
    }


}