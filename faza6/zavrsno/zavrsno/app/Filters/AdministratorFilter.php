<?php namespace App\Filters;

use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\Filters\FilterInterface;

/**
* UserFilter – filter za administratora
* Nikola Bulatovic 2017/33
* @version 1.0
*/

class AdministratorFilter implements FilterInterface
{
    public function before(RequestInterface $request) {
        $session=session();
        if(!$session->has('admin')) {
            
            if($session->has('regkorisnik')) return redirect()->to(site_url('KorisnikM'));
            else if ($session->has('moderator')) return redirect()->to(site_url('Moderator'));
        
           else return redirect()->to(site_url('Gost'));
        }
    }
    //--------------------------------------------------------------------

    public function after(RequestInterface $request, ResponseInterface $response)
    {
        // Do something here
    }
}