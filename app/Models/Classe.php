<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Classe extends Model
{
    use HasFactory;

    // Nome della tabella
    protected $table = 'classe'; 
    protected $primaryKey = 'id_classe';
    public $incrementing = false;
    protected $keyType = 'string';
    public $timestamps = false;

    
    
    
    protected $fillable = ['id_classe'];  // Solo 'id_classe' può essere aggiornato

    // Relazione con il modello Student
    public function students()
    {
        return $this->hasMany(Student::class, 'id_classe');
    }

    // Relazione con il modello Teacher
    public function teacher()
    {
        return $this->belongsTo(Teacher::class, 'id_professore');
    }
}

