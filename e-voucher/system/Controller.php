<?php

/**
 * This file is part of CodeIgniter 4 framework.
 *
 * (c) CodeIgniter Foundation <admin@codeigniter.com>
 *
 * For the full copyright and license information, please view
 * the LICENSE file that was distributed with this source code.
 */

namespace CodeIgniter;

use CodeIgniter\HTTP\Exceptions\HTTPException;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\Validation\Exceptions\ValidationException;
use CodeIgniter\Validation\Validation;
use Config\Services;
use Psr\Log\LoggerInterface;

use App\Models\LoginModel;
use App\Models\SettingsModel;
use App\Models\UserModel;
use App\Models\VoucherModel;

/**
 * Class Controller
 */
class Controller
{
    /**
     * Helpers that will be automatically loaded on class instantiation.
     *
     * @var array
     */
    protected $helpers = [];

    /**
     * Instance of the main Request object.
     *
     * @var RequestInterface
     */
    protected $request;

    /**
     * Instance of the main response object.
     *
     * @var ResponseInterface
     */
    protected $response;

    /**
     * Instance of logger to use.
     *
     * @var LoggerInterface
     */
    protected $logger;

    /**
     * Should enforce HTTPS access for all methods in this controller.
     *
     * @var int Number of seconds to set HSTS header
     */
    protected $forceHTTPS = 0;

    /**
     * Once validation has been run, will hold the Validation instance.
     *
     * @var Validation
     */
    protected $validator;

    /**
     * Constructor.
     *
     * @throws HTTPException
     */
    public function initController(RequestInterface $request, ResponseInterface $response, LoggerInterface $logger)
    {
        $this->request  = $request;
        $this->response = $response;
        $this->logger   = $logger;

        if ($this->forceHTTPS > 0) {
            $this->forceHTTPS($this->forceHTTPS);
        }

        // Autoload helper files.
        helper($this->helpers);
    }

    /**
     * A convenience method to use when you need to ensure that a single
     * method is reached only via HTTPS. If it isn't, then a redirect
     * will happen back to this method and HSTS header will be sent
     * to have modern browsers transform requests automatically.
     *
     * @param int $duration The number of seconds this link should be
     *                      considered secure for. Only with HSTS header.
     *                      Default value is 1 year.
     *
     * @throws HTTPException
     */
    protected function forceHTTPS(int $duration = 31536000)
    {
        force_https($duration, $this->request, $this->response);
    }

    /**
     * Provides a simple way to tie into the main CodeIgniter class and
     * tell it how long to cache the current page for.
     */
    protected function cachePage(int $time)
    {
        CodeIgniter::cache($time);
    }

    /**
     * Handles "auto-loading" helper files.
     *
     * @deprecated Use `helper` function instead of using this method.
     *
     * @codeCoverageIgnore
     */
    protected function loadHelpers()
    {
        if (empty($this->helpers)) {
            return;
        }

        helper($this->helpers);
    }

    /**
     * A shortcut to performing validation on input data. If validation
     * is not successful, a $errors property will be set on this class.
     *
     * @param array|string $rules
     * @param array        $messages An array of custom error messages
     */
    protected function validate($rules, array $messages = []): bool
    {
        $this->validator = Services::validation();

        // If you replace the $rules array with the name of the group
        if (is_string($rules)) {
            $validation = config('Validation');

            // If the rule wasn't found in the \Config\Validation, we
            // should throw an exception so the developer can find it.
            if (! isset($validation->{$rules})) {
                throw ValidationException::forRuleNotFound($rules);
            }

            // If no error message is defined, use the error message in the Config\Validation file
            if (! $messages) {
                $errorName = $rules . '_errors';
                $messages  = $validation->{$errorName} ?? [];
            }

            $rules = $validation->{$rules};
        }

        return $this->validator->withRequest($this->request)->setRules($rules, $messages)->run();
    }
    

    public $session;
    public $loginModel;
    public $settingsModel;
    public $userModel;
    public $voucherModel;
    public $permission;

    // var $permission = array();

    public function __construct() 
    {
        helper('form');
        $this->session = \Config\Services::session();
        $this->loginModel = new LoginModel();
        $this->settingsModel = new SettingsModel();
        $this->userModel = new UserModel();
        $this->voucherModel = new VoucherModel();
        $this->permission = array();

        $permissionData = array();
        if (!session()->has('logged_user')) {
            return redirect()->to('/login');
        }else {
            $user_id = session()->get('logged_user');
            $userData = $this->userModel->getUserData($user_id);
            $userRole = unserialize($userData['user_role']);
            $all_roles = $this->settingsModel->getUserRoles();
            $permissionData = '';
            foreach ($all_roles as $roles) {
                if($userRole) { 
                    if(in_array($roles['role_id'], $userRole)) { 
                        $permissionData = $this->settingsModel->getUserRole($roles['role_id']); 
                    } 
                }
            }            
            $data['user_permission'] = unserialize($permissionData['permissions']);
            $this->permission = unserialize($permissionData['permissions']);
        }
    }
}
