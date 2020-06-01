<?php namespace App\Controllers;


use App\Models\KorisnikModel;
use App\Models\RegKorisnikModel;
use App\Models\ModeratorModel;
use App\Models\JePutovaoModel;
use App\Models\SeOdnosiNaModel;

/**
* Gost – klasa koja predstavlja kontroler za gosta
* Olivera Radojkovic 2017/560, Nikola Bulatovic 2017/33
* @version 1.0
*/


class Gost extends BaseController
{
    //Funkcija za prikaz pocetne stranice za gosta
    //@return void
    public function index(){
        $this->prikaz('pocetna', []);
    }
    //Funkcija za prikaz stranica sa menijem za gosta
    //@param $page, $data
    //@return void
    protected function prikaz($page, $data) {
        $data['controller']='Gost';
        echo view('sablon/header_gost');
        echo view ("stranice/$page", $data);
    }
    //Funkcija za prikaz stranice login
    //@param $por
    //@return void
    public function login($por=null){
        $this->prikaz('login', ['poruka'=>$por]);
    }
    //Funkcija za prikaz stranice kreiranjeNaloga i ispis eventualnih gresaka
    //@param $por 
    //@return void
    public function kreiranje($por=null){
        $this->prikaz('kreiranjeNaloga', ['poruka'=>$por]);
    }
    
    //Funkcija za kreiranje naloga, unose se: username, password, ime, prezime, godiste, email i pol 
    //Ide na Gost/login ako je uspesno kreiran nalog
    public function kreirajNalog(){
    
      if(!$this->validate(['username'=>'trim|required|alpha_dash|min_length[5]|max_length[16]',
            'password'=>'trim|required|min_length[5]|max_length[25]|alpha_numeric', 
            'ime'=>'trim|required|min_length[3]|max_length[30]|alpha',
            'prezime'=>'trim|required|min_length[3]|max_length[30]|alpha',
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
               'pol'=>[                 
                 'required'=> 'Ovo polje je obavezno'
                  
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
                 'max_length' => 'Maksimalna dužina polja je 30 karaktera',
                  'alpha'=>'Ovo polje mora da sadrži samo slova'
            ],
              'prezime'=>[
                 'min_length' => 'Minimalna dužina polja je 5 karaktera',
                 'required'=> 'Ovo polje je obavezno',
                 'max_length' => 'Maksimalna dužina polja je 30 karaktera',
                  'alpha'=>'Ovo polje mora da sadrži samo slova'
            ]]
              )){
            return $this->prikaz('kreiranjeNaloga', 
                ['errors'=>$this->validator->getErrors()]);
       }
      
        //ubacimo u bazu ako je sve ok
        
               
        $kormod=new KorisnikModel();
       
        $kor=$kormod->find($this->request->getVar('username'));
        if($kor!=null){
           
        return  $this->kreiranje('Korisničko ime već postoji!');}

        $pol=$this->request->getVar('pol');
        if($pol==1){ 
            $pol='M';            
        }
        else{
            $pol='Ž';            
        }
           
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
         
            }
    
      //Funkcija za logovanje korisnika, koristi username i password  
       //Ide na KorisnikM/index ako se ulogovao kao korisnik, a na Moderator/index u slucaju da je moderator
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
     
        
        if($kor==null){
        return $this->login('Korisnik ne postoji');}
        if($kor->Password!=$this->request->getVar('lozinka')){
        return $this->login('Pogrešna lozinka');}
        
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
       
    }

    //Funkcija za prikaz stranice IdealnoPutovanje i ispis eventualnih gresaka
    //@param $por 
    //@return void
    public function idealno_putovanje($poruka=null) {
        $this->prikaz('IdealnoPutovanje', ['poruka'=>$poruka]);
    }
 
     //Funkcija za pronalazak idealnog putovanja za gosta, na osnovu cekiranih filtera
    //@return void
    
    public function pronadji_idealno() {
        $db = \Config\Database::connect();

        $saputnik=$_POST['radio'];
       
       if($_POST['radio1']==1) {
        $u1=0;
        $u2=18;
        }
        else if($_POST['radio1']==2) {
            $u1=18;
            $u2=35;
            }
        else if($_POST['radio1']==3) {
            $u1=35;
            $u2=55;
                }
        else
        {
            $u1=55;
            $u2=120;
        }
    
    
    
    $trajanje=$_POST['radio3'];

    
    $tip=$_POST['radio2'];
    
    $upit= "SELECT * FROM putovanje p, destinacija d
    WHERE d.IdDestinacije=p.IdDestinacije AND IdPutovanja = 
    (SELECT IdPutovanja
    FROM 
    (SELECT COUNT(*) AS Zadovoljeni, IdPutovanja FROM (SELECT IdPutovanja FROM putovanje p WHERE Trajanje = $trajanje
    UNION ALL
    SELECT IdPutovanja FROM putovanje p WHERE Saputnik = '$saputnik'
    UNION ALL
    SELECT IdPutovanja FROM putovanje p, destinacija d WHERE d.IdDestinacije = p.IdDestinacije AND  d.Tip = '$tip'
    UNION ALL
    SELECT IdPutovanja FROM putovanje p WHERE DonjiUzrast=$u1 AND GornjiUzrast=$u2) AS Kriterijumi GROUP BY IdPutovanja ORDER BY Zadovoljeni DESC LIMIT 1)AS BrojKriterijuma ) ";
       $query=$db->query($upit);
       $nadjeno=$query->getResult();
       $iddest=$nadjeno[0]->IdDestinacije;
       $db = \Config\Database::connect();
       $upit2="SELECT * FROM Komentar, SeOdnosiNa WHERE Komentar.IdKom=SeOdnosiNa.IdKom AND SeOdnosiNa.IdDestinacije=$iddest";
       $query2=$db->query($upit2);
       $nadjeno2=$query2->getResult();
       $arr=[];
       $arr[0]=$nadjeno;
       $arr[1]=$nadjeno2;
       $this->prikaz('PredlogPutovanja', ['arr'=>$arr]);
    }
}
