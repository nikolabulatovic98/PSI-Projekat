<?php namespace App\Controllers;

use App\Models\KorisnikModel;
use App\Models\RegKorisnikModel;
use App\Models\ModeratorModel;
use App\Models\JePutovaoModel;
use App\Models\DestinacijeModel;
use App\Models\KomentarModel;
use App\Models\SeOdnosiNaModel;
use CodeIgniter\Database\Query;

/**
* KorisnikM – klasa koja predstavlja kontroler za registrovanog korisnika
* Olivera Radojkovic 2017/560, Nikola Bulatovic 2017/33
* @version 1.0
*/

class KorisnikM extends BaseController

{ 
    //Funkcija za prikaz pocetne stranice za registrovanog korisnika
    //@return void
    public function index(){
        $this->prikaz('pocetnaKorisnik', []);    
    }
    //Funkcija za prikaz stranica sa menijem za korisnika
     //@param $page, $data
    //@return void
    protected function prikaz($page, $data) {
        $data['controller']='KorisnikM';
        $data['korisnik']=$this->session->get('korisnik');
        echo view('sablon/header_korisnik',$data);
        echo view("stranice/$page", $data);
    }
    //Funkcija za prikaz stranice promenaLozinke i ispis eventualnih gresaka
    //@param $poruka
    //@return void
    public function promena_lozinke($poruka=null){     
        return $this->prikaz('promenaLozinke',['poruka'=>$poruka]);
    }
    //Funkcija za promenu lozinke, koristi staru lozinku i unetu novu lozinku
    public function promenaLoz(){
       
        if(!$this->validate(['password'=>'required', 'new'=>'required|min_length[5]|max_length[25]|alpha_numeric', 'new2'=>'required|matches[new]|min_length[5]|max_length[25]|alpha_numeric'],
                ['password'=>[
                 'required'=> 'Ovo polje je obavezno',
                ],
                 'new'=>[
                 'alpha_numeric'=>'Ovo polje mora da sadrži samo slova i cifre',
                 'min_length' => 'Minimalna dužina polja je 5 karaktera',
                 'required'=> 'Ovo polje je obavezno',
                 'max_length' => 'Maksimalna dužina polja je 25 karaktera'
                ],
                 'new2'=>[
                 'matches'=>'Pogrešno uneta šifra', 
                 'alpha_numeric'=>'Ovo polje mora da sadrži samo slova i cifre',
                 'min_length' => 'Minimalna dužina polja je 5 karaktera',
                 'required'=> 'Ovo polje je obavezno',
                 'max_length' => 'Maksimalna dužina polja je 25 karaktera'
                ]])) 
                 {
            
                return $this->prikaz('promenaLozinke', ['errors'=>$this->validator->getErrors()]);
            }
         //provera da li je to njegova sifra
            $korModel=new KorisnikModel();
            $prom=$this->session->get('korisnik');
            $db= \Config\Database::connect();
            $upit="SELECT * FROM korisnik WHERE Username='$prom->Username'";
            $query=$db->query($upit);
            $nadjeno=$query->getResult();
                 
            
            if($nadjeno[0]->Password!=$this->request->getVar('password')){
            return $this->promena_lozinke('Pogrešna stara lozinka');}
           
          //promena u bazi
            
            $korModel->update($prom->Username,['Password'=>$this->request->getVar('new')]);
            
              
            
          return $this->promena_lozinke('Uspeno ste promenili lozinku!');
    }
    
    //Funkcija kojom se registrovani korisnik izloguje
    //ide na Gost/index
    public function izlogujse() {
            $this->session->destroy();
           return  redirect()->to(site_url('/')); //podrazumevano
        }
        
       //Funkcija za prikaz stranice ZahtevModerator i ispis poruka
       //@param $poruka
         public  function Postani_moderator($poruka=null){
             //return $this->prikaz('ZahtevModerator', ['poruka'=>$poruka]);
      
            
             $ime=$this->session->get('korisnik');
          
             $regModel=new RegKorisnikModel();
          
             $reg=$regModel->find($ime->Username);
          
          
                $zahtev=$reg->Zahtev;
        
             if($zahtev=="Poslato")
               $poruka="Poslali ste zahtev, admin će vas ubrzo obavestiti!";
             if($zahtev=="Odbijen")
                  $poruka="Vas zahtev je odbijen!";
          
          if($zahtev=="Odobren"){
              $pom=$ime->Username;
               $poruka="Vaš zahtev je odobren, možete početi sa radom. Vaš username za moderatora je: "
                       . "M".$pom.", a šifra ista kao i za Vaš korisnički nalog.";
          
          }
        return $this->prikaz('ZahtevModerator', ['poruka'=>$poruka]);
           
         
       }
       
       //Funkcija kojom registrovani korisnik moze da zatrazi da postane moderator
       //Vraca poruku o poslatom zahtevu
       public function zahtevPozitivan() {

           $regModel=new RegKorisnikModel();
           $korisnik=$this->session->get('korisnik');
         
           $reg=$regModel->where('Username', $korisnik->Username)->findAll();
         
           
           //moguce vrednost [Poslato,Odobren,Null,Odbijen]
           
           if($reg[0]->Zahtev==null){ //zahtev jos nije zatrazen
              $regModel->update($reg[0]->Username,['Zahtev'=>"Poslato"]);
               
             return $this->Postani_moderator ("Uspešno ste poslali zahtev!");
           }
           if($reg[0]->Zahtev=="Poslato"){ //vec poslat zahtev
               
               return $this->Postani_moderator("Već ste poslali zahtev, admin će vas ubrzo obavestiti!");
               
           }
            if($reg[0]->Zahtev=="Odobren"){//Admin odobrio
              
              
               return $this->Postani_moderator("Vaš zahtev je odobren, možete početi sa radom. Vaš username za moderatora je: M$korisnik->Username, a šifra ista kao i za Vaš korisničko nalog.");
           }
           if($reg[0]->Zahtev=="Odbijen"){//Admin odbio zahtev
               
               
               
               return $this->Postani_moderator("Vas zahtev je odbijen!");
           }
           
               
    
       }
       
       //Funkcija za prikaz stranice dodavanjePutovanja i ispis eventualnih gresaka
       ////@param $poruka
       //@return void
       public function dodajPutovanje($poruka=null) {
      
            
            $destModel=new DestinacijeModel();
            $destinacije=$destModel->findAll();
    
  
     $this->prikaz('dodavanjePutovanja', ['destinacije'=> $destinacije,'poruka'=>$poruka]);
        
        
       }
      
       
       //Funkcija za belezenje putovanja od strane registrovanog korisnika, korisnik unosi destinaciju, trajanje, saputnika i komentar
       //@ return redirect()->to(site_url("KorisnikM/dodajPutovanje")) za dodavanje novih putovanja
       public function dodajPutsubmit(){
           
          //provera unetih podataka
      
              if(!$this->validate(['SAPUTNIK'=>'required', 'DESTINACIJA'=>'required' ,'KOMENTAR'=>'required','TRAJANJE'=>'required'],
                   ['TRAJANJE'=>[
                     'required'=> 'Ovo polje je obavezno',
                    ], 
                      ['SAPUTNIK'=>[
                     'required'=> 'Ovo polje je obavezno',
                    ],                       
                       'DESTINACIJA'=>['required'=>'Ovo polje je obavezno']
                       ],
                    
                         [ 'KOMENTAR'=>[
                     'required'=> 'Ovo polje je obavezno'
                    ]]])){
                    return $this->dodajPutovanje("Niste uneli sva polja ispravno!");
        
                    }
                   
                    
                    
                    $putovaoModel= new JePutovaoModel();
                     $korisnik=$this->session->get('korisnik');
                 
                     
                     
                    $destModel=new DestinacijeModel();  
                    
                    $data = $this->request->getVar('DESTINACIJA');
                    $whatIWant = substr($data, strpos($data, "/") + 1);    
                        
                  
                    $dest=$destModel->where('ImeDestinacije', $whatIWant)->findAll();
                     
         
                    $id=$dest[0]->IdDestinacije;
                     
                     if($this->request->getVar('rdiobtn')=="1"){
                        $ocena=1;
                     }
                      if($this->request->getVar('rdiobtn')=="2"){
                        $ocena=2;
                     }
                      if($this->request->getVar('rdiobtn')=="3"){
                        $ocena=3;
                     }
                      if($this->request->getVar('rdiobtn')=="4"){
                        $ocena=4;
                     }
                      if($this->request->getVar('rdiobtn')=="5"){
                        $ocena=5;
                     }
                    
                    
                     
                     $putovaoModel->insert([
                        'Username'=>$korisnik->Username,
                         'Trajanje'=>$this->request->getVar('TRAJANJE'),
                         'Saputnik'=>$this->request->getVar('SAPUTNIK'),
                         'IdDestinacije'=>$id,
                         'Ocena'=>$ocena
                     ]);
                     
                     $komModel=new KomentarModel();
                     
                   $komModel->insert([
                         'Username'=>$korisnik->Username,
                          'Tekst'=>$this->request->getVar('KOMENTAR')
                     ]);
                    
                
                   
                   
                 
                
                           $data1 = $this->request->getVar('KOMENTAR');;    
                  
                    $kom=$komModel->where('Tekst', $data1,'Username',$korisnik->Username)->find();
                   
             
                 
                $niz=[];
         
                 
            foreach ($kom as $elem) {
        
                 array_push($niz, $elem->IdKom);
                  }
                 
             
             
                        
                   $odnosi=new SeOdnosiNaModel();
                   
                  $posl= array_pop($niz);
                
                   
                   $odnosi->insert([
                        'IdDestinacije'=>$id,
                        'IdKom'=> $posl
                   ]);
                    
                 
                    return redirect()->to(site_url("KorisnikM/dodajPutovanje"));

                 
                   
                   
       }
      //Funkcija za prikaz stranice pretragaPoFilterima i ispis eventualnih gresaka 
       //@param $poruka
       //@return void
    public function pretraga($por=null){
        $this->prikaz('pretragaPoFilterima', ['poruka'=>$por]);
    }
       //Funkcija pomocu koje registrovani korisnik moze da pretrazi destinacije po odgovarajucim filterima koje cekira
        //@return void
    public function pretrazi() {
           $db = \Config\Database::connect();
           $upit="SELECT ImeDrzave,ImeDestinacije, destinacija.IdDestinacije from destinacija, putovanje where destinacija.IdDestinacije = putovanje.IdDestinacije";
           
          $saputnik=(string)$this->request->getVar('saputnik');
        if ($saputnik) 
           $upit=$upit." and putovanje.Saputnik = '$saputnik'";
        
     
         $trajanje=(string)$this->request->getVar('trajanje');
         if($trajanje) 
             $upit=$upit." and putovanje.Trajanje = '$trajanje'";
         
   
         
         $uzrast=$this->request->getVar('Uzrast');
         if($uzrast) {
             if($this->request->getVar('Uzrast')==1) {
                $u1=0;
                $u2=18;
                }
             else if($this->request->getVar('Uzrast')==2) {
                $u1=18;
                $u2=35;
                }
            else if($this->request->getVar('Uzrast')==3) {
                $u1=35;
                $u2=55;
                }
        else
        {
            $u1=55;
            $u2=120;
        }
    
    $upit=$upit." and putovanje.DonjiUzrast = '$u1' and putovanje.GornjiUzrast = '$u2'";
         }
         
         
         $ocena=(string)$this->request->getVar('ocena');
         
        if($ocena) $upit=$upit." and (SELECT AVG(Ocena) from jeputovao where jeputovao.IdDestinacije=destinacija.IdDestinacije)>='$ocena'";
         
         
        $vrsta=(string)$this->request->getVar('vrsta');
        
        if($vrsta) $upit=$upit." and destinacija.Tip = '$vrsta'";
        
        if($ocena==null and $vrsta==null and $trajanje==null and $this->request->getVar('Uzrast')==null and $saputnik==null)
            return $this->pretraga("Morate označiti bar jedan filter!");
         
         $query=$db->query($upit);
         
         $nadjeno=$query->getResult();
         
         $this->prikaz('pretragaPoFilterima', ['nadjeno'=>$nadjeno]);

         
     
       }  
      
      
    
    
    //Funkcija pomocu koje registrovani korisnik moze da vidi sva svoja zabelezena putovanja
       //@return void
    public function mojaPutovanja(){
         $db = \Config\Database::connect();
         
         $korisnik=$this->session->get('korisnik');
         $name=$korisnik->Username;
         
         $upit="SELECT ImeDrzave, ImeDestinacije, Tekst from destinacija, komentar,jeputovao, seodnosina where destinacija.IdDestinacije = jeputovao.IdDestinacije and "
                 . "jeputovao.Username='$name' and komentar.Username='$name' and seodnosina.IdDestinacije = destinacija.IdDestinacije and seodnosina.IdKom=komentar.IdKom GROUP BY ImeDrzave, ImeDestinacije, Tekst";
           
           $query=$db->query($upit);
         
          $nadjeno=$query->getResult();
         
          $this->prikaz('MojaPutovanja', ['nadjeno'=>$nadjeno]);
    }
    //Funkcija pomocu koje registrovani korisnik moze da vidi top 5 najposecenijih destinacija
    //@return void
    public function najposecenije(){
        $db = \Config\Database::connect();
        
        $upit="SELECT ImeDrzave,ImeDestinacije,Opis, COUNT(jeputovao.IdDestinacije) AS broj FROM destinacija,jeputovao,putovanje "
                . "WHERE destinacija.IdDestinacije=jeputovao.IdDestinacije AND destinacija.IdDestinacije=putovanje.IdDestinacije GROUP BY "
                . "jeputovao.IdDestinacije ORDER BY broj DESC LIMIT 5";
        
        $query=$db->query($upit);
         
          $nadjeno=$query->getResult();
         
          $this->prikaz('najposecenije', ['nadjeno'=>$nadjeno]);
        
    }
    //Funkcija za prikaz stranice IdealnoPutovanje i ispis eventualnih poruka
    //@param $poruka
    //@return void
    public function idealno_putovanje($poruka=null) {
        $this->prikaz('IdealnoKorisnik', ['poruka'=>$poruka]);
    }
    //Funkcija pomocu koje registrovani korisnik moze da pronadje svoje idealno putovanje, na osnovu filtera koje je cekirao
    //@return void
    public function pronadji_idealno() {
        $db = \Config\Database::connect();
        $korisnik=$this->session->get('regkorisnik');
        $name=$korisnik->Username;
        $godiste= 2020 - $korisnik->Godiste;
      
        $saputnik=$_POST['radio'];

       
       if($godiste>=0 and $godiste<18) {
            $u1=0;
            $u2=18;
        }
            else if($godiste>=18 and $godiste<35) {
                $u1=18;
                $u2=35;
            }
            else if($godiste>=35 and $godiste<55) {
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
   (SELECT COUNT(*) AS Zadovoljeni, IdPutovanja FROM (SELECT IdPutovanja FROM putovanje p WHERE Trajanje = $trajanje AND NOT EXISTS (SELECT * FROM jeputovao jp where p.IdDestinacije = jp.IdDestinacije AND jp.username = '$name')
   UNION ALL
   SELECT IdPutovanja FROM putovanje p WHERE Saputnik = '$saputnik' AND NOT EXISTS (SELECT * FROM jeputovao jp where p.IdDestinacije = jp.IdDestinacije AND jp.username = '$name')
   UNION ALL
   SELECT IdPutovanja FROM putovanje p, destinacija d WHERE d.IdDestinacije = p.IdDestinacije AND  d.Tip = '$tip' AND NOT EXISTS (SELECT * FROM jeputovao jp where p.IdDestinacije = jp.IdDestinacije AND jp.username = '$name')
   UNION ALL
   SELECT IdPutovanja FROM putovanje p WHERE DonjiUzrast=$u1 AND GornjiUzrast=$u2 AND NOT EXISTS (SELECT * FROM jeputovao jp where p.IdDestinacije = jp.IdDestinacije AND jp.username = '$name')) AS Kriterijumi GROUP BY IdPutovanja ORDER BY Zadovoljeni DESC LIMIT 1)AS BrojKriterijuma ) ";
  
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
    //Funkcija pomocu koje korisnik, kada pretrazuje destinacije po odredjenim filterima, moze da vidi njihove opise
    //@return void
    public function vidiopis($ID=null){
        
         $db = \Config\Database::connect();
         $upit="SELECT ImeDrzave,ImeDestinacije, Opis from destinacija, putovanje where destinacija.IdDestinacije = $ID and putovanje.idDestinacije=$ID";
         $query=$db->query($upit);
         $nadjeno=$query->getResult();
        $this->prikaz('opis', ['nadjeno'=>$nadjeno]);
    }
       
       
}