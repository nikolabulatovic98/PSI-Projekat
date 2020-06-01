<?php namespace App\Models;

use CodeIgniter\Model;

class JePutovaoModel extends Model
{
        protected $table      = 'jeputovao';
        protected $primaryKey = 'idPutovao';
        protected $returnType = 'object';
        protected $allowedFields = ['Ocena','Trajanje','Saputnik','Username','IdDestinacije'];
        
        
        
        
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