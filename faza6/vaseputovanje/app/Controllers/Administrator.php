<?php namespace App\Controllers;

use App\Models\AdminModel;



class Administrator extends BaseController
{
    public function index(){
         $this->prikaz1('loginAdmin', []);
    }
     public function login($por=null){
        $this->prikaz1('loginAdmin', ['poruka'=>$por]);
    }
     public function izbacivanje(){
        $this->prikaz('adminIzbacivanje', []);
    }
    
    protected function prikaz($page, $data) {
        $data['controller']='Administrator';
        $data['admin']=$this->session->get('admin');
        echo view("sablon/header_admin", []);
        echo view("stranice/$page", $data);
    }
    protected function prikaz1($page, $data) {
        $data['controller']='Administrator';
        $data['admin']=$this->session->get('admin');
        echo view("stranice/$page", $data);
    }
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
               return redirect()->to(site_url('Administrator/izbacivanje'));                      
          
    }
         public function izlogujse() {
            $this->session->destroy();
           return  redirect()->to(site_url('Administrator/index')); //podrazumevano
        }
        
        
        public function inbox(){
         
              $this->prikaz('AdminInbox', []);
        }
        
        public function inboxChecked() {
            echo "Proba";
        }
    
   
}
