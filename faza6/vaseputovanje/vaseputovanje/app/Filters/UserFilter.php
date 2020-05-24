<?php namespace App\Filters;

use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\Filters\FilterInterface;

class UserFilter implements FilterInterface
{
    public function before(RequestInterface $request)
    {
        $session=session();
        if(!$session->has('regkorisnik')) {
            
            if($session->has('moderator')) return redirect()->to(site_url('Moderator'));
        
           else return redirect()->to(site_url('Gost'));
        }
    }

    //--------------------------------------------------------------------

    public function after(RequestInterface $request, ResponseInterface $response)
    {
        // Do something here
    }
}