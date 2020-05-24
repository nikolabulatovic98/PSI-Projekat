<?php namespace App\Models;

use CodeIgniter\Model;

class DestinacijeModel extends Model
{
        protected $table      = 'destinacija';
        protected $primaryKey = 'IdDestinacije';
        protected $returnType = 'object';
        protected $allowedFields = ['IdDestinacije', 'ImeDrzave', 'ImeDestinacije', 'Tip'];
        
        
        
        
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