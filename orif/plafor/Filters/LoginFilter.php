<?php


namespace Plafor\Filters;


use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\View\View;

class LoginFilter implements \CodeIgniter\Filters\FilterInterface
{


    /**
     * @inheritDoc
     */
    public function before(RequestInterface $request, $arguments = null)
    {
        try {
            // TODO: Implement before() method.
            $session = service('session');
            if ($arguments !== null) {
                if ($session->get('user_access') !== null && $session->get('user_access') < $arguments[0]) {

                } elseif ($session->get('logged_in') != true) {
                    return redirect()->to(base_url('user/auth/login'));
                }
            }

        }catch (\mysqli_sql_exception $e){

        }

    }

    /**
     * @inheritDoc
     */
    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        // TODO: Implement after() method.
    }
}