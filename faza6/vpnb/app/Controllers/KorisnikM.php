<?php namespace App\Controllers;

use App\Models\KorisnikModel;
use App\Models\RegKorisnikModel;
use App\Models\ModeratorModel;
use App\Models\AutorModel;
use App\Models\JePutovaoModel;
use App\Models\DesinacijeModel;

class KorisnikM extends BaseController
{
    public function index(){
        $this->prikaz('pocetnaKorisnik', []);
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
        
       public function Postani_moderator(){
          // echo"Moderator";
           return $this->prikaz('ZahtevModerator', []);
           
       }
       public function zahtevPozitivan() {
           echo"Vasa prijava je evidentirana, admin ce vas obavestiti! ";
           //povratatak na pocetnu;
       }
       public function dodajPutovanje($poruka=null) {
        //   $destModel=new DestinacijeModel();
         //  $destinacije=$destModel->findAll();
        //  return  $this->prikaz('dodavanjePutovanja', ['destinacije'=> $destinacije,'poruka'=>$poruka]);
            return $this->prikaz('dodavanjePutovanja', []);
       }
       public function dodajPutsubmit(){
           
           echo"Ispis";
       }
}
