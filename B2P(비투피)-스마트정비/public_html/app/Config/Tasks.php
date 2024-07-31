<?php

namespace Config;

use CodeIgniter\Tasks\Config\Tasks as BaseTasks;
use CodeIgniter\Tasks\Scheduler;

class Tasks extends BaseTasks
{
    /**
     * Register any tasks within this method for the application.
     *
     * @param Scheduler $schedule
     * https://tasks.codeigniter.com/basic-usage/ 사용법
     */
    public function init(Scheduler $schedule)
    {   
        //$schedule->url(base_url('order/test'))->cron('* * * * *');
        $schedule->url(base_url('order/GetOrder/1/GM'))->everyFiveMinutes();
        $schedule->url(base_url('order/GetOrder/2/GM'))->everyFiveMinutes();
        $schedule->url(base_url('order/GetOrder/3/GM'))->everyFiveMinutes();
        $schedule->url(base_url('order/GetOrder/4/GM'))->everyFiveMinutes();
        $schedule->url(base_url('order/GetOrder/5/GM'))->everyFiveMinutes();

        $schedule->url(base_url('order/GetOrder/1/AC'))->everyFiveMinutes();
        $schedule->url(base_url('order/GetOrder/2/AC'))->everyFiveMinutes();
        $schedule->url(base_url('order/GetOrder/3/AC'))->everyFiveMinutes();
        $schedule->url(base_url('order/GetOrder/4/AC'))->everyFiveMinutes();
        $schedule->url(base_url('order/GetOrder/5/AC'))->everyFiveMinutes();

        
        //발송마감일 지난애들 자동발송처리(우리db만)
        //$schedule->url(base_url('order/OrderSendTransDueDate'))->everyFiveMinutes();
        
        //배송-> 자동 구매결정완료
        $schedule->url(base_url('order/OrderDeliTransDueDate'))->everyFiveMinutes();
        //log_message('error','cron : 실행중');

		// 엑셀업로드 -> DB
/*		$schedule->call(function () {
			$goodsController = new \App\Controllers\GoodsController();
			$goodsController->cronExcelToDB();
		})->everyMinute();*/

		// DB -> API
/*		$schedule->call(function () {
			$goodsController = new \App\Controllers\GoodsController();
			$goodsController->cronDBToApi();
		})->everyMinute();*/
    }
}