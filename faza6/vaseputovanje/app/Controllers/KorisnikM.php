<?php namespace App\Controllers;

use App\Models\KorisnikModel;
use App\Models\RegKorisnikModel;
use App\Models\ModeratorModel;
use App\Models\AutorModel;
use App\Models\JePutovaoModel;
use App\Models\DestinacijeModel;
use App\Models\KomentarModel;
use App\Models\SeOdnosiNaModel;
use CodeIgniter\Database\Query;

class KorisnikM extends BaseController

{
    
    public function index(){
        $this->prikaz('pocetnaKorisnik', []);
       // $model=new KorisnikModel();
     // echo $this->$model->customQuery();
        /*
      $db = \Config\Database::connect();
      $drzava="Italija";
      $upit="SELECT count(*) as Broj, ImeDrzave from destinacija group by ImeDrzave";
$query = $db->query($upit);
foreach ($query->getResult() as $row)
{
    echo $row->ImeDrzave;
    echo " ";
    echo $row->Broj;
    echo "<br>";
   
}



*/


        
      //  $query = $db->query("SELECT ImeDestinacije FROM destinacija WHERE ImeDrzave='Italija' ");
       
    }
    
    protected function prikaz($page, $data) {
        $data['controller']='KorisnikM';
        $data['korisnik']=$this->session->get('korisnik');
        echo view('sablon/header_korisnik',$data);
        echo view("stranice/$page", $data);
    }
    
    public function promena_lozinke($poruka=null){
          
        return $this->prikaz('promenaLozinke',['poruka'=>$poruka]);
    }
    
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
            if($prom->Password!=$this->request->getVar('password'))
              return $this->promena_lozinke('Pogresna stara lozinka');
           
          //promena u bazi
            
            $korModel->update($prom->Username,['Password'=>$this->request->getVar('new')]);
            
              //gde da skoci??
             echo 'Korisnik';
           //return redirect()->to(site_url('KorisnikM'));
    }
    
    
    public function izlogujse() {
            $this->session->destroy();
           return  redirect()->to(site_url('/')); //podrazumevano
        }
        
       public function Postani_moderator($poruka=null){
          // echo"Moderator";
           return $this->prikaz('ZahtevModerator', ['poruka'=>$poruka]);
           
       }
       public function zahtevPozitivan() {
         
     
            /*
          $korModel= new RegKorisnikModel();
          $kor=$korModel->find($this->session->get('korisnik'));
          $korisnik=$this->session->get('korisnik');
         //Poslato,Odobren,Null,Odbijen
          if($kor[0]->Zahtev== null){
          $korModel->update($korisnik->Username,['Zahtev'=>"Poslato"]);
          
             return $this->Postani_moderator ("Uspešno ste poslali poruku!");
          
          }
          else
              return $this->Postani_moderator ("Već ste poslali zahteva za moderatora");
*/
           $regModel=new RegKorisnikModel();
           $korisnik=$this->session->get('korisnik');
         
           $reg=$regModel->where('Username', $korisnik->Username)->findAll();
         
           
           //moguce vrednost [Poslato,Odobren,Null,Odbijen]
           
           if($reg[0]->Zahtev==null){ //zahtev jos nije zatrazen
              $regModel->update($reg[0]->Username,['Zahtev'=>"Poslato"]);
               
             return $this->Postani_moderator ("Uspešno ste poslali poruku!");
           }
           if($reg[0]->Zahtev=="Poslato"){ //vec poslat zahtev
               
               return $this->Postani_moderator("Već ste poslali zahtev, admin će vas ubrzo obavestiti!");
               
           }
           if($reg[0]->Zahtev=="Odbren"){//Admin odobrio
               
               
               return $this->Postani_moderator("Vaš zahtev je odobren, napravljen je vaš moderator nalog. Možete ga koristiti!");
           }
           if($reg[0]->Zahtev=="Odbijen"){//Admin odbio zahtev
               
               
               
               return $this->Postani_moderator("Vas zahtev je odbijen!");
           }
           
               
    
       }
       public function dodajPutovanje($poruka=null) {
      
            
      $destModel=new DestinacijeModel();
     $destinacije=$destModel->findAll();
    
  
     $this->prikaz('dodavanjePutovanja', ['destinacije'=> $destinacije,'poruka'=>$poruka]);
        
        
       }
      
       
       
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
                    //upisivanje u bazu
                    
                    
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
                    
                
                   
                   
                    //,['Username', $korisnik->Username]
                
                           $data1 = $this->request->getVar('KOMENTAR');;    
                  
                    $kom=$komModel->where('Tekst', $data1,'Username',$korisnik->Username)->find();
                    //$idK=$kom->Username;
                     
         
                    
                //   echo "$kom";
            
             
                 
                $niz=[];
         
                 
            foreach ($kom as $elem) {
        // $niz.push($elem->IdKom);
                 array_push($niz, $elem->IdKom);
                  }
                 
             
             
                        
                   $odnosi=new SeOdnosiNaModel();
                   
                  $posl= array_pop($niz);
                 // echo $posl;
                   
                   $odnosi->insert([
                        'IdDestinacije'=>$id,
                        'IdKom'=> $posl
                   ]);
                    
                 
                    return redirect()->to(site_url("KorisnikM/dodajPutovanje"));

                 
                   
                   
       }
       
       public function pretraga($por=null){
        $this->prikaz('pretragaPoFilterima', ['poruka'=>$por]);
    }
       
     public function pretrazi() {
           $db = \Config\Database::connect();
           $upit="SELECT ImeDrzave, ImeDestinacije from destinacija, putovanje where destinacija.IdDestinacije = putovanje.IdDestinacije";
           
          $saputnik=(string)$this->request->getVar('saputnik');
        if ($saputnik) 
           $upit=$upit." and putovanje.Saputnik = '$saputnik'";
        
       
         
      //    echo $upit;
          
         $trajanje=(string)$this->request->getVar('trajanje');
         if($trajanje) 
             $upit=$upit." and putovanje.Trajanje = '$trajanje'";
         
         
                 
                // echo $this->request->getVar('trajanje');
         
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

         
     //    if(!$query->getResult()) echo "Nije pronadjena nijedna takva destinacija";
         
     //    else {
         
         
     /*    foreach ($query->getResult() as $row)
{
    echo $row->ImeDestinacije;
    echo ", ";
    echo $row->ImeDrzave;
    echo "<br>";
   
}

         }
         
         
         
          
          
           
           
          
          
          
*/
       }  
       
       public function IdealnoPutovanje($por=null){
        $this->prikaz('IdealnoPutovanje', ['poruka'=>$por]);
    }
    
    public function idealno() {
        
    }
       
       
}