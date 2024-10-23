<?php

namespace App\Controllers;

use App\Models\MemberModel;
use CodeIgniter\Controller;
use CodeIgniter\HTTP\CLIRequest;
use CodeIgniter\HTTP\IncomingRequest;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
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
     * @var array
     */
    protected $helpers = [];

    /**
     * Be sure to declare properties for any property fetch you initialized.
     * The creation of dynamic property is deprecated in PHP 8.2.
     */
    // protected $session;

    /**
     * @return void
     */
    public function initController(RequestInterface $request, ResponseInterface $response, LoggerInterface $logger)
    {
        // Do Not Edit This Line
        parent::initController($request, $response, $logger);

        $session = session();

        $this->data = array();

        // 모든 GET 및 POST 파라미터를 $this->data에 자동으로 추가
        $vars = $this->request->getVar();
        if (is_object($vars)) {
            $vars = (array) $vars;
        }
        $this->data = array_merge($this->data, $vars);

        // 모든 변수를 순회하면서 sql_real_escape_string으로 처리
        /*
        foreach ($vars as $key => $value) {
            if(is_string($value)){
                if (is_array($value)) {
                    foreach ($value as $subKey => $subValue) {
                        if(is_string($subValue) && !empty($subValue)){
                            $subValue = trim($subValue);
                            $subValue = json_decode(json_encode($subValue), true);
                            $vars[$key][$subKey] = sql_real_escape_string($subValue);
                        }else{
                            $vars[$key][$subKey] = $subValue;
                        }
                    }
                } else {
                    if(is_string($value) && !empty($value)){
                        $value = trim($value);
                        $value = json_decode(json_encode($value), true);
                        $vars[$key] = sql_real_escape_string($value);
                    }else{
                        $vars[$key] = $value;
                    }
                }
            }
        }
        $this->data = array_merge($this->data, $vars);
        */

        if(isset($this->data['pass'])){
            $session->set("is_pass", $this->data['pass']);
        }
        $this->data['pass'] = $session->get('is_pass');

        // 로그인 유지할 수 있도록
        if ($session->get('is_login')) {
            $this->memberModel = new MemberModel();
            $this->data['member'] = $this->memberModel->getMember($session->get('in_mb_id'));
            $session->set('member', $this->data['member']);
        }
    }
}
