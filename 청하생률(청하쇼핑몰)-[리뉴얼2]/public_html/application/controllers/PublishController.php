<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * 디자이너 퍼블
 */
class PublishController extends CI_Controller {

    //mall
    public function eventPage()
    {
        $data = [
            'pid' => 'event', // views/_common/header.php
        ];

        render('mall/event', $data);
    }

    public function guidePage()
    {
        $data = [
            'pid' => 'guide', // views/_common/header.php
        ];

        render('mall/guide', $data);
    }

    public function greetPage()
    {
        $data = [
            'pid' => 'greet', // views/_common/header.php
        ];

        render('mall/greet', $data);
    }
    public function privacyPage()
    {
        $data = [
            'pid' => 'privacy', // views/_common/header.php
        ];

        render('mall/privacy', $data);
    }
    public function provisionPage()
    {
        $data = [
            'pid' => 'provision', // views/_common/header.php
        ];

        render('mall/provision', $data);
    }


    //adm
    public function admIndexPage()
    {
		if (!loginCheck(true)) return;

        $data = [
            'pid' => 'adm_index' // views/_common/header.php
        ];

		render('adm/index', $data, true);
    }
}
