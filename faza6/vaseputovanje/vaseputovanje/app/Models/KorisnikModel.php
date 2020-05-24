<?php namespace App\Models;

use CodeIgniter\Model;

class KorisnikModel extends Model
{
        protected $table      = 'korisnik';
        protected $primaryKey = 'Username';
        protected $returnType = 'object';
        protected $allowedFields = ['Username', 'Pol', 'Password', 'Ime','Prezime'];
       
        
        
        
        
        /*
        public function pretraga($tekst) {
            return $this->like('naslov', $tekst)
                    ->orLike('sadrzaj', $tekst)->findAll();      
        }
        
        public function dohvatiVestiAutora($autor) {
            return $this->where('autor', $autor)->findAll();      
        }
         
         */
        
        
}