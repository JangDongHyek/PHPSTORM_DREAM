<?php

namespace App\Controllers;

use App\Models\VisitorsModel;
use CodeIgniter\Controller;
use CodeIgniter\HTTP\CLIRequest;
use CodeIgniter\HTTP\IncomingRequest;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use Config\Services;
use Psr\Log\LoggerInterface;

/**
 * Class BaseController
 *
 * BaseController provides a convenient place for loading components
 * and performing functions that are needed by all your controllers.
 * Extend this class in any new controllers:
 *     class Home extends BaseController
 *
 * For security be sure to declare any new methods as protected or private.
 */
abstract class BaseController extends Controller
{
    /**
     * Instance of the main Request object.
     *
     * @var CLIRequest|IncomingRequest
     */
    protected $request;

    /**
     * An array of helpers to be loaded automatically upon
     * class instantiation. These helpers will be available
     * to all other controllers that extend BaseController.
     *
     * @var list<string>
     */
    protected $helpers = [];

    /**
     * Be sure to declare properties for any property fetch you initialized.
     * The creation of dynamic property is deprecated in PHP 8.2.
     */
    protected $session;
    protected int $mbIdx = 0;
    protected array $member = [];
    protected array $visitorStats = []; // 방문자 통계 저장


    /**
     * @return void
     */
    public function initController(RequestInterface $request, ResponseInterface $response, LoggerInterface $logger)
    {
        // Do Not Edit This Line
        parent::initController($request, $response, $logger);

        // Preload any models, libraries, etc, here.

        // E.g.: $this->session = \Config\Services::session();

        $this->session = Services::session();
        $member = $this->session->get('member') ?? [];
        $this->mbIdx = $member['idx'] ?? 0;
        $this->member = $member;

        // 방문자 데이터 처리
        $this->handleVisitorData();
    }

    /**
     * Handles visitor data including logging IP and retrieving visitor stats.
     *
     * @return void
     */
    protected function handleVisitorData(): void
    {
        // IP 주소 가져오기
        $ipAddress = $this->request->getIPAddress();

        // VisitorsModel 인스턴스 생성
        $visitorsModel = new VisitorsModel();

        // 방문자 데이터 삽입
        $data = [
            'ip_address' => $ipAddress,
        ];
        $visitorsModel->addVisitor($data);

        // 오늘 및 총 방문자 수 가져오기
        $this->visitorStats = $visitorsModel->getVisitorCount($data);
    }
}
