<?php namespace App\Models;

use CodeIgniter\Model;

class SeOdnosiNaModel extends Model
{
        protected $table      = 'seodnosina';
        protected $primaryKey = 'IdOdnosi';
        protected $returnType = 'object';
        protected $allowedFields = ['IdDestinacije', 'IdKom','IdOdnosi'];
        
        
        
        
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