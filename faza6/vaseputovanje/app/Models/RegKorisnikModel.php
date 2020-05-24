<?php namespace App\Models;

use CodeIgniter\Model;

class RegKorisnikModel extends Model
{
        protected $table      = 'registrovanikorisnik';
        protected $primaryKey = 'Username';
        protected $returnType = 'object';
        protected $allowedFields = ['Username', 'Email', 'Godiste','Zahtev'];
        
        
        
        
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