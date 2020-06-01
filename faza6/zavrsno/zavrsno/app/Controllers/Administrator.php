<?php namespace App\Controllers;

use App\Models\AdminModel;
use App\Models\KorisnikModel;

/**
* Gost – klasa koja predstavlja kontroler za administratora
* Janko Nikodinovic 2017/622, Danilo Drobnjak 2017/685
* @version 1.0
*/

class Administrator extends BaseController
{    //Funkcija za priaz Adminove pocetne stranice: loginAdmin
    public function index(){
         $this->prikaz1('loginAdmin', []);
    }
    
    //Funkcija za prikaz stranice loginAdmin i ispis eventualnih gresaka 
    //@param $por
     public function login($por=null){
        $this->prikaz1('loginAdmin', ['poruka'=>$por]);
    }
    
    //Funkcija za prebacivanje na kontroler AdministratorUkloni pomocu koga admin moze da obrise nalog nekom korisniku
     public function izbacivanje(){
     //  $this->prikaz1('ajaxsearch', []);
      return redirect()->to(site_url('AdministratorUkloni')); 
    }
    
    //Funkcija za prikaz stranica sa menijem za admina
    //@param $page,$data
    protected function prikaz($page, $data) {
        $data['controller']='Administrator';
        $data['admin']=$this->session->get('admin');
        echo view("sablon/header_admin", []);
        echo view("stranice/$page", $data);
    }
    
    //Funkcija za prikaz stranica bez menija
    //@param $page,$data
    protected function prikaz1($page, $data) {
        $data['controller']='Administrator';
        $data['admin']=$this->session->get('admin');
        echo view("stranice/$page", $data);
    }
    
    //Funkcija za logovanje administratora, koristi username i password
  public function loginSubmit(){
        if(!$this->validate(['korime'=>'required', 'lozinka'=>'required'])){
            return $this->prikaz1('loginAdmin', 
                ['errors'=>$this->validator->getErrors()]);
        }
        $adminModel=new AdminModel();
        
        $admin=$adminModel->find($this->request->getVar('korime'));
     
        
        if($admin==null)
            return $this->login('Pogrešno korisničko ime');
        if($admin->Password!=$this->request->getVar('lozinka'))
            return $this->login('Pogrešna lozinka');
        
           
               
               $this->session->set('admin', $admin);      
               return redirect()->to(site_url('Administrator/inbox'));                      
          
    }
    
    //Funkcija kojom se administrator izloguje
         public function izlogujse() {
            $this->session->destroy();
           return  redirect()->to(site_url('Administrator/index')); //podrazumevano
        }
        
        //Fja koja prikazuje Administratorove zahteve korisnika da postanu moderatori
        public function inbox(){
         
          return redirect()->to(site_url('AdministratorInbox')); 
            
        }
        
    
        
       
  }