<?php namespace App\Controllers;

use App\Models\VestModel;
use App\Models\AutorModel;
use App\Models\KorisnikModel;
use App\Models\RegKorisnikModel;
use App\Models\ModeratorModel;



class Gost extends BaseController
{
    public function index(){
       // $vestModel=new VestModel();
       // $vesti=$vestModel->findAll();
        $this->prikaz('pocetna', []);
    }
    protected function prikaz($page, $data) {
        $data['controller']='Gost';
        echo view('sablon/header_gost');
        echo view ("stranice/$page", $data);
        //echo view('sablon/footer');
    }
    
    public function login($por=null){
        $this->prikaz('login', ['poruka'=>$por]);
    }
    public function kreiranje($por=null){
        $this->prikaz('kreiranjeNaloga', ['poruka'=>$por]);
    }
    
    public function kreirajNalog(){
    
      if(!$this->validate(['username'=>'trim|alpha_dash|required|min_length[5]|max_length[16]',
            'password'=>'trim|required|min_length[5]|max_length[25]|alpha_numeric', 
            'ime'=>'trim|required|min_length[3]|max_length[30]',
            'prezime'=>'trim|required|min_length[3]|max_length[30]',
            'god'=>'trim|required|min_length[4]|max_length[4]', 
            'email'=>'trim|required|max_length[40]',
            'pol'=>'required'],
              ['god'=>[
                 'alpha_dash'=>'Ovo polje mora da sadrži samo slova, cifre i donju crtu',
                 'min_length' => 'Minimalna dužina polja je 4 karaktera',
                 'required'=> 'Ovo polje je obavezno',
                 'max_length' => 'Maksimalna dužina polja je 4'
            ],
              'email'=>[                 
                 'required'=> 'Ovo polje je obavezno',
                  'max_length' => 'Maksimalna dužina polja je 40 karaktera'
            ],
             'username'=>[
                 'alpha_dash'=>'Ovo polje mora da sadrži samo slova, cifre i donju crtu',
                 'min_length' => 'Minimalna dužina polja je 5 karaktera',
                 'required'=>'Ovo polje je obavezno',
                 'max_length' => 'Maksimalna dužina polja je 16 karaktera'
            ],
              'password'=>[
                  'alpha_numeric'=>'Ovo polje mora da sadrži samo slova i cifre',
                 'min_length' => 'Minimalna dužina polja je 5 karaktera',
                 'required'=> 'Ovo polje je obavezno',
                 'max_length' => 'Maksimalna dužina polja je 25 karaktera',
                 'alpha_numeric'=>'Ovo polje mora da sadrži samo slova i cifre'
            ],
              'ime'=>[
                 'min_length' => 'Minimalna dužina polja je 3 karaktera',
                 'required'=> 'Ovo polje je obavezno',
                 'max_length' => 'Maksimalna dužina polja je 30 karaktera'
            ],
              'prezime'=>[
                 'min_length' => 'Minimalna dužina polja je 5 karaktera',
                 'required'=> 'Ovo polje je obavezno',
                 'max_length' => 'Maksimalna dužina polja je 30 karaktera'
            ]]
              )){
            return $this->prikaz('kreiranjeNaloga', 
                ['errors'=>$this->validator->getErrors()]);
       }
      
        //ubacimo u bazu ako je sve ok
        //gde ide?
        
       
       $kormod=new KorisnikModel();
       
        $kor=$kormod->find($this->request->getVar('username'));
        if($kor!=null) 
           
         return  $this->kreiranje('Korisničko ime već postoji!');
      
        
        
       //
        $pol=$this->request->getVar('pol');
        if($pol==1) $pol='M';
        else
            $pol='Ž';
           // 'Pol'=>$this->request->getVar('pol'),//apdejt
        $kormod->insert([
            'Username'=>$this->request->getVar('username'),
            'Pol'=>$pol,
            'Password'=>$this->request->getVar('password'),
            'Ime'=>$this->request->getVar('ime'),
            'Prezime'=>$this->request->getVar('prezime')
        ]);
        $regmod=new RegKorisnikModel();
         $regmod->insert([
            'Username'=>$this->request->getVar('username'),
            'Email'=>$this->request->getVar('email'),
             'Godiste'=>$this->request->getVar('god')
        ]);
        
         return redirect()->to(site_url('Gost/login'));
            //na koju stranu da skocimo
            }
    
    public function loginSubmit(){
        if(!$this->validate(['korime'=>'required', 'lozinka'=>'required'],
                ['korime'=>[
                 'required'=> 'Ovo polje je obavezno',
                ],'lozinka'=>[
                 'required'=> 'Ovo polje je obavezno',
                ]
                   ])){
            return $this->prikaz('login', 
                ['errors'=>$this->validator->getErrors()]);
        }
        $korModel=new KorisnikModel();
        
        $kor=$korModel->find($this->request->getVar('korime'));
     
        
        if($kor==null)
            return $this->login('Korisnik ne postoji');
        if($kor->Password!=$this->request->getVar('lozinka'))
            return $this->login('Pogrešna lozinka');
        
           $regModel=new RegKorisnikModel();
           $moder=new ModeratorModel();
           
           $m=$moder->find($this->request->getVar('korime'));
            $r=$regModel->find($this->request->getVar('korime'));
           if($m==null){
               //echo "Registrovani korisnik"; 
               //skace na stranicu za korisnika
               
               $this->session->set('korisnik', $kor);  
               $this->session->set('regkorisnik', $r);
               
               return redirect()->to(site_url('KorisnikM'));
               
           }
           else
           {
             
           //skace na stranicu za moderatora
            $this->session->set('korisnik', $kor);
            $this->session->set('moderator', $m);
            
            return redirect()->to(site_url('Moderator'));
        
           }
        
   
        //return redirect()->to(site_url('Korisnik'));
        
        
        
        
    }
}
