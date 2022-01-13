<?php


namespace Plafor\Filters;


use CodeIgniter\HTTP\RedirectResponse;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\View\View;

class LoginFilter implements \CodeIgniter\Filters\FilterInterface
{


    /**
     * @inheritDoc
     * This function permit to delete user from plafor/apprentice/delete_user instead
     * of using user/admin/delete_user
     */
    public function before(RequestInterface $request, $arguments = null)
    {
        try {
            $appStatusFile=fopen(WRITEPATH.'appStatus.json','r');
            if (json_decode(fread($appStatusFile,100))->initialized!=false) {
                $session = service('session');
                if ($arguments !== null) {
                    if ($session->get('user_access') !== null && $session->get('user_access') < $arguments[0]) {

                    } elseif ($session->get('logged_in') != true) {
                        return redirect()->to(base_url('user/auth/login'));
                    }
                }
            }
        }catch (\mysqli_sql_exception $e){

        }
        return $this->redirectToPlaforDeleteUser();


    }

    /**
     * @inheritDoc
     */
    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        // TODO: Implement after() method.
    }

    /**
     *This function permit to delete user from plafor/apprentice/delete_user instead
     *of using user/admin/delete_user
     * @return RedirectResponse
     */
    private function redirectToPlaforDeleteUser(){
        if((boolean)strpos($_SERVER['REQUEST_URI'],'user/admin/delete_user')){
            $value=str_replace('plafor/public/user/admin/delete_user','plafor/apprentice/delete_user',$_SERVER['REQUEST_URI']);
            return redirect()->to(base_url($value));
        }
    }
}