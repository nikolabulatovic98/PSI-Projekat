<?php namespace App\Models;

use CodeIgniter\Model;

class PutovanjeModel extends Model
{
        protected $table      = 'putovanje';
        protected $primaryKey = 'idPutovanja';
        protected $returnType = 'object';
        protected $allowedFields = ['IdPutovanja', 'Saputnik', 'Trajanje', 'Opis','IdDestinacije','DonjiUzrast','GornjiUzrast'];
        
        
        
        
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