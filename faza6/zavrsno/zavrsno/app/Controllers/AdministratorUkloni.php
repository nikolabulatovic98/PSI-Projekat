<?php namespace App\Controllers;

use App\Models\AdminModel;
use App\Models\KorisnikModel;

/**
* AdministratorInbox – administratorova klasa za brisanje korisnika
* Janko Nikodinovic 2017/622, Danilo Drobnjak 2017/685
* @version 1.0
*/

class AdministratorUkloni extends BaseController
{
    //Funkcija kojom se uklanja registrovani korisnik ili moderator iz baze
    public function ukloni() {
        
        $user=$this->request->getVar('fname');
      
        $korModel=new KorisnikModel();
        $korisnik=$korModel->find($user);
        if($korisnik==null)
           return $this->prikaz1('ukloniKor',['poruka'=>'Korisnik ne postoji!']);
        else{
           
            $kor=$korisnik->Username;
            //brisanje
            
            
             $db = \Config\Database::connect();
        $builder = $db->table('korisnik');
         $upit="DELETE FROM korisnik WHERE korisnik.Username='$kor'";
           
           $query=$db->query($upit);
       $nadjeno=$query->getResult();
       
       //regKorisnik
       
        $db = \Config\Database::connect();
        $builder = $db->table('registrovanikorisnik');
         $upit="DELETE FROM registrovanikorisnik WHERE registrovanikorisnik.Username='$kor'";
           
           $query=$db->query($upit);
       $nadjeno=$query->getResult();
       
       //moderator
       
        $db = \Config\Database::connect();
        $builder = $db->table('moderator');
         $upit="DELETE FROM moderator WHERE moderator.Username='$kor'";
           
           $query=$db->query($upit);
       $nadjeno=$query->getResult();
       
       return redirect()->to(site_url('AdministratorUkloni')); 
     
    }
    }
    
    //Funkcija za prikaz stranica
    protected function prikaz1($page, $data) {
      
        $data['controller']='Administrator';
        $data['admin']=$this->session->get('admin');
      
        echo view("stranice/$page", $data);
       
         
    }
    //Funkcija za prikaz pocetne stranice za kontroler AdministratorUkloni: ukloniKor
    public function index() {
        $this->prikaz1('ukloniKor', []);
    }
    
   //ajax php fja koja izbacuje ponudjene korisnike prilikom pretrage za uklanjanje korisnika
   public function gethint(){
     $korModel=new KorisnikModel();
     $kor=$korModel->findAll();
     
     foreach ($kor as $value) {
         $a[]=$value->Username;
     }

// get the q parameter from URL
$q = $_REQUEST["q"];

$hint = "";

// lookup all hints from array if $q is different from ""
if ($q !== "") {
  $q = strtolower($q);
  $len=strlen($q);
  foreach($a as $name) {
    if (stristr($q, substr($name, 0, $len))) {
      if ($hint === "") {
        $hint = $name;
      } else {
        $hint .= ", $name";
      }
    }
  }
}

// Output "no suggestion" if no hint was found or output correct values
echo $hint === "" ? "Takav korisnik ne postoji" : $hint;
    }
    
}