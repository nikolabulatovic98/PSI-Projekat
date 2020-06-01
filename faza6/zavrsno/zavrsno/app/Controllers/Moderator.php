<?php namespace App\Controllers;

use App\Models\VestModel;
use App\Models\AutorModel;
use App\Models\KorisnikModel;
use App\Models\RegKorisnikModel;
use App\Models\ModeratorModel;
use App\Models\DestinacijeModel;
use App\Models\PutovanjeModel;

/**
* Gost – klasa koja predstavlja kontroler za moderatora
* Janko Nikodinovic 2017/622, Danilo Drobnjak 2017/685
* @version 1.0
*/


class Moderator extends BaseController
{
    //Funkcija za prikaz pocetne stranice za moderatora: promenaLozinkeM
   public function index(){
        $this->prikaz('promenaLozinkeM', []);
    }
   
    //Funkcija za prikaz stranica sa menijem za moderatora
    protected function prikaz($page, $data) {
        $data['controller']='Moderator';
        $data['korisnik']=$this->session->get('korisnik');
        echo view('sablon/header_moderator',$data);
        echo view("stranice/$page", $data);
    }
   
    // Funkcija koja vraca prizak stranice za promenu lozinke
    //@return void
    //@param $poruka
    public function promena_lozinke1($poruka=null){
         
        return $this->prikaz('promenaLozinkeM',['poruka'=>$poruka]);
    }
   
    // Funkcija za promenu lozinke, prvo proverava da li su podaci ispravni, i ako jesu menja sifru moderatora, koristi staru i novounetu sifru
    //@return void
    //@param $poruka
    public function promenaLoz1(){
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
            
                return $this->prikaz('promenaLozinkeM', ['errors'=>$this->validator->getErrors()]);
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
            
            $korModel->update($prom->Username,['Password'=>$this->request->getVar('new')]);

     
           return $this->promena_lozinke1('Uspešno ste promenili šifru!');
    }

   
   // Funkcija kojom se moderator izloguje, i vrati na index stranicu 
    //@return void
    public function izlogujse() {
            $this->session->destroy();
           return  redirect()->to(site_url('/')); //podrazumevano
  
    
   
    }
    // Funkcija za prikaz stranice dodajOpis
    //@return void
    //@param $poruka
    public function dodajPutovanje($poruka=null) {
            
    $destModel=new DestinacijeModel();
    $destinacije=$destModel->findAll();
    
  
    $this->prikaz('dodajOpis', ['destinacije'=> $destinacije,'poruka'=>$poruka]);
        
        }
        
    // Funkcija za dodavanje novog putovanja u bazu, prvo se proveri da li su svi podaci ispavno uneseni
    // ako jesu doda se putovanje u bazu
    //@return void
        
        public function novoPutovanje() {
            
            
            
              if(!$this->validate(['saputnik'=>'required', 'destinacija'=>'required','trajanje'=>'required','Uzrast'=>'required', 'opis'=>'required'],
                   ['saputnik'=>[
                     'required'=> 'Ovo polje je obavezno',
                    ],                       
                       'destinacija'=>['required'=>'Ovo polje je obavezno']
                       ],
                       ['trajanje'=>[
                     'required'=> 'Ovo polje je obavezno',
                    ],
                        'Uzrast'=>[
                     'required'=> 'Ovo polje je obavezno',
                    ],
                          'opis'=>[
                     'required'=> 'Ovo polje je obavezno'
                    ]])){
                    return $this->dodajPutovanje("Niste uneli sva polja ispravno!");
        
                    }
                    

            $putModel=new PutovanjeModel();
            $destModel=new DestinacijeModel();

    
            $data = $this->request->getVar('destinacija');;    
            $whatIWant = substr($data, strpos($data, "/") + 1);    

            $dest=$destModel->where('ImeDestinacije', $whatIWant)->find();


  


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

        

              $putModel->save([
                
                'Saputnik'=>$this->request->getVar('saputnik'),
                'Trajanje'=>$this->request->getVar('trajanje'),
                'Opis'=>$this->request->getVar('opis'),
                'IdDestinacije'=>$dest[0]->IdDestinacije,
                'DonjiUzrast'=>$u1,
                'GornjiUzrast'=>$u2
            ]);
             



            return redirect()->to(site_url("Moderator/dodajPutovanje"));
             
                        
          
        }
      
        
        
    
    
}
