<?php namespace App\Models;

use CodeIgniter\Model;

class VestModel extends Model
{
        protected $table      = 'vest';
        protected $primaryKey = 'id';
        protected $returnType = 'object';
        protected $allowedFields = ['naslov', 'sadrzaj', 'autor', 'datum'];
        
        public function pretraga($tekst) {
            return $this->like('naslov', $tekst)
                    ->orLike('sadrzaj', $tekst)->findAll();      
        }
        
        public function dohvatiVestiAutora($autor) {
            return $this->where('autor', $autor)->findAll();      
        }
}