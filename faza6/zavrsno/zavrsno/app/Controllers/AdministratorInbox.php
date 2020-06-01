<?php namespace App\Controllers;

use App\Models\AdminModel;
use App\Models\KorisnikModel;
use App\Models\RegKorisnikModel;
use App\Models\JePutovaoModel;
use App\Models\KomentarModel;
use App\Models\ModeratorModel;

/**
* AdministratorInbox – administratorova klasa za odobravanje zahteva za moderatora
* Janko Nikodinovic 2017/622, Danilo Drobnjak 2017/685
* @version 1.0
*/


class AdministratorInbox extends BaseController
{
    //funkcija za prikaz pocente stranice kontrolera Administrator Inbox: AdminInbox
   public function index($poruka=null){
       $korModel=new RegKorisnikModel();
       $dest=$korModel->findAll();
       
       $dest=$korModel->where('Zahtev', 'Poslato')->find();
       
       //ispitati kada nema zahteva da se ispise neka poruka
       
  
       $this->prikaz1('AdminInbox', ['destinacije'=> $dest,'poruka'=>$poruka]);
   }
   
   //Funkcija za prikaz stranica
   //@param $page,$data
     protected function prikaz1($page, $data) {
      
        $data['controller']='Administrator';
        $data['admin']=$this->session->get('admin');
      
        echo view("stranice/$page", $data);
       
         
    }
    //Funkcija kojom se proverava da li je administrator odobrio zahtev ili ne
    //ako je zahtev odobren korisnik se dodaje u tabelu moderatora
    public function inboxChecked() {
           //moguce vrednost [Poslato,Odobren,Null,Odbijen]
        
         $korisnik= $this->request->getVar('KORISNICI');
         
         $korModel=new RegKorisnikModel();
         if($korisnik==null) {
             
              return redirect()->to(site_url('AdministratorInbox')); 
             
         }  else{         
       if ($this->request->getVar('rdiobtn')==1){ //pozitivan zahtec
           
             $korModel->update($korisnik,['Zahtev'=>'Odobren']);
              $kormod=new KorisnikModel();
              $prom=$kormod->where('Username', $korisnik)->find();
             
            //insert u korisnika
             $pol=$prom[0]->Pol;
             $password=$prom[0]->Password;
             $Ime=$prom[0]->Ime;
             $prezime=$prom[0]->Prezime;
            
             $korisnik="M".$korisnik;
             $kormod->insert([
                 'Username'=>$korisnik,
                 'Pol'=>$pol,
                 'Password'=>$password,
                 'Ime'=>$Ime,
                 'Prezime'=>$prezime
                     
                     
             ]);
             
             
             //insert u moderatora
             
             $modModel=new ModeratorModel();
             
             $modModel->insert([
                 'Username'=>$korisnik
             ]);
             
           
       }
       else{// negativan zahtev
           
           
           
          $korModel->update($korisnik,['Zahtev'=>'Odbijen']);
           
           
       }
    return redirect()->to(site_url('AdministratorInbox')); 
         }
    }
    //fja ajax prikazivanje komentare korisnika nakon izabranog korisnika iz padajuce liste
    public function dohV() {
         
           $q=$_GET["q"];
         
           
           
           
          
           echo "<p style=font-size:22px;color:white >Komentari ovoga korisnika su: ";
           echo "<br>";
           echo "<br>";echo "<br>";
         
           
           $komentar=new KomentarModel();
           $prom=$komentar->where('Username', $q)->find();
        
           foreach ($prom as $value) {
               echo $value->Tekst."<br>";
                 echo "<br>";echo "<br>";
           }
           
       }
}