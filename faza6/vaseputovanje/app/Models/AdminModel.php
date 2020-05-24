<?php namespace App\Models;

use CodeIgniter\Model;

class AdminModel extends Model
{
        protected $table      = 'administrator';
        protected $primaryKey = 'Username';
        protected $returnType = 'object';
        protected $allowedFields = ['Username', 'Password'];
        
        
        
        
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