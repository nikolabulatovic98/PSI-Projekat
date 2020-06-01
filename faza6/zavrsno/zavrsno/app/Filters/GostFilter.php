<?php namespace App\Filters;

use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\Filters\FilterInterface;

/**
* UserFilter – filter za gosta
* Nikola Bulatovic 2017/33
* @version 1.0
*/

class GostFilter implements FilterInterface
{
    public function before(RequestInterface $request)
    {
        $session=session();
        if($session->has('korisnik')) {
            if($session->has('regkorisnik')) return redirect()->to(site_url('KorisnikM'));
            else if($session->has('moderator')) return redirect()->to(site_url('Moderator'));
        }
        else if($session->has('admin')) return redirect()->to(site_url('AdministratorInbox'));
         
    }

    //--------------------------------------------------------------------

    public function after(RequestInterface $request, ResponseInterface $response)
    {
        // Do something here
    }
}