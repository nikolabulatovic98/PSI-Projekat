<?php namespace App\Controllers;

use App\Models\VestModel;
use App\Models\AutorModel;
use App\Models\KorisnikModel;
use App\Models\RegKorisnikModel;
use App\Models\ModeratorModel;
use App\Models\DestinacijeModel;
use App\Models\PutovanjeModel;



class Moderator extends BaseController
{
   public function index(){
        $this->prikaz('promenaLozinkeM', []);
    }
   
    protected function prikaz($page, $data) {
        $data['controller']='Moderator';
        $data['korisnik']=$this->session->get('korisnik');
        echo view('sablon/header_moderator',$data);
        echo view("stranice/$page", $data);
    }
   
    public function promena_lozinke1($poruka=null){
         
        return $this->prikaz('promenaLozinkeM',['poruka'=>$poruka]);
    }
   
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
            if($prom->Password!=$this->request->getVar('password'))
              return $this->promena_lozinke1('Pogresna stara lozinka');
           
          //promena u bazi
            
            $korModel->update($prom->Username,['Password'=>$this->request->getVar('new')]);
            
              //gde da skoci??
     
           return redirect()->to(site_url('Moderator'));
    }

   
   
    public function izlogujse() {
            $this->session->destroy();
           return  redirect()->to(site_url('/')); //podrazumevano
  
    
   
    }
       public function dodajPutovanje($poruka=null) {
            
    $destModel=new DestinacijeModel();
    $destinacije=$destModel->findAll();
    
  
    $this->prikaz('dodajOpis', ['destinacije'=> $destinacije,'poruka'=>$poruka]);
        
        }
        
        
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

  //$dest=$destModel->find($whatIWant);

    $dest=$destModel->where('ImeDestinacije', $whatIWant)->find();


  


if($this->request->getVar('uzrast')==="Mlađi od 18 godina") {
    $u1=0;
    $u2=18;
}
else if($this->request->getVar('uzrast')=="18 - 35 godina") {
    $u1=18;
    $u2=35;
}
else if($this->request->getVar('uzrast')=="35 - 55 godina") {
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
              /*
              $putModel->update([
                
                'Saputnik'=>$this->request->getVar('saputnik'),
                'Trajanje'=>$this->request->getVar('trajanje'),
                'Opis'=>$this->request->getVar('opis'),
                'IdDestinacije'=>$dest[0]->IdDestinacije,
                'DonjiUzrast'=>$u1,
                'GornjiUzrast'=>$u2
            ]);*/




 return redirect()->to(site_url("Moderator/dodajPutovanje"));
             
                    
           
                    
                    
                    
              
               
              
           
            
          
        }
      
        
        
    
    
}
