<?php namespace App\Models;

use CodeIgniter\Model;

class KomentarModel extends Model
{
        protected $table      = 'Komentar';
        protected $primaryKey = 'IdKom';
        protected $returnType = 'object';
        protected $allowedFields = ['IdKom','Tekst','Username'];
        
        
        
  
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