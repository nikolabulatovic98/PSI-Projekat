<?php namespace App\Filters;

use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\Filters\FilterInterface;

/**
* UserFilter – filter za moderatora
* Nikola Bulatovic 2017/33
* @version 1.0
*/

class ModeratorFilter implements FilterInterface
{
    public function before(RequestInterface $request)
    {
       
        $session=session();
        if(!$session->has('moderator')) {
            
            if($session->has('regkorisnik')) return redirect()->to(site_url('KorisnikM'));
            else if ($session->has('admin')) return redirect()->to(site_url('AdministratorInbox'));
        
           else return redirect()->to(site_url('Gost'));
        }
    }

    //--------------------------------------------------------------------

    public function after(RequestInterface $request, ResponseInterface $response)
    {
        // Do something here
    }
}

