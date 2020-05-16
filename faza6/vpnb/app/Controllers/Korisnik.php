<?php namespace App\Controllers;

use App\Models\VestModel;
use App\Models\AutorModel;

class Korisnik extends BaseController
{
    /*
    protected function prikaz($page, $data) {
        $data['controller']='Korisnik';
        $data['autor']=$this->session->get('autor');
        echo view('sablon/header_korisnik',$data);
        echo view("stranice/$page", $data);
        echo view('sablon/footer');
    }
    
    public function mojeVesti(){
        $vestModel=new VestModel();
        $vesti=$vestModel->dohvatiVestiAutora($this->session->get('autor')->korime);
        $this->prikaz('mojevesti', ['vesti'=>$vesti]);
    } 
    
    public function logout(){
        $this->session->destroy();
        return redirect()->to(site_url('/'));
    }
    public function dodajVest() {
        $this->prikaz('dodavanjevesti', []);
    }
       
    public function novaVest() {
        if(!$this->validate(['naslov'=>'required|min_length[5]|max_length[50]',
            'sadrzaj'=>'required|min_length[10]'])){
            return $this->prikaz('dodavanjevesti', 
                ['errors'=>$this->validator->listErrors()]);
        }
        $vestModel=new VestModel();
        $vestModel->save([
            'naslov'=>$this->request->getVar('naslov'),
            'sadrzaj'=>$this->request->getVar('sadrzaj'),
            'autor'=>$this->session->get('autor')->korime
        ]);
        return redirect()->to(site_url("Korisnik/vest/{$vestModel->getInsertId()}"));
    }
     
     */
}
