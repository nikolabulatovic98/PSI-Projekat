<?php namespace App\Models;

use CodeIgniter\Model;

class ModeratorModel extends Model
{
        protected $table      = 'moderator';
        protected $primaryKey = 'Username';
        protected $returnType = 'object';
        protected $allowedFields = ['Username'];
        
        
        
        
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