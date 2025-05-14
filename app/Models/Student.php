<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Student extends Model
{
    use HasFactory;

    // Nome della tabella
    protected $table = 'studente';
    protected $primaryKey = 'id_studente'; // La chiave primaria si chiama 'id_user' invece di 'id'
    public $timestamps = false;
    
    // Colonne che possono essere assegnate in massa
    protected $fillable = [
        'id_studente',
        'nome',
        'cognome',
        'classe',
        'id_notifica',
        'id_user',
    ];

    // Relazione con il modello Notifiche
    public function notification()
    {
        return $this->belongsTo(Notifiche::class, 'id_notifica');
    }

    // Relazione con il modello User
    public function user()
    {
        return $this->belongsTo(User::class, 'id_user');
    }

    // Relazione con il modello Classe
    public function classe()
    {
        return $this->belongsTo(Classe::class, 'classe', 'id_classe');
    }

    // Relazione con il modello Grade
    public function grades()
    {
        return $this->hasMany(Grade::class, 'id_studente');
    }

    /**
     * Salvataggio dello studente con debug
     */
    public static function saveStudent($request)
    {
        // Visualizza i dati inviati tramite la request
        dd('Dati request:', $request->all()); // Mostra tutti i dati della request

        // Crea una nuova istanza di Student con i dati della request
        $student = new Student();
        $student->nome = $request->nome;
        $student->cognome = $request->cognome;
        $student->classe = $request->classe;
        $student->id_notifica = $request->id_notifica;
        $student->id_user = $request->id_user;

        // Controlla se la classe esiste
        $classeExists = Classe::where('id_classe', $request->classe)->exists();
        dd('Classe esiste?', $classeExists); // Verifica se la classe esiste nel database

        if (!$classeExists) {
            dd('Classe non trovata nel database');
        }

        // Salva lo studente nel database
        if ($student->save()) {
            // Aggiungi un messaggio di successo
            dd('Studente salvato correttamente');
        } else {
            // Aggiungi un messaggio di errore
            dd('Errore nel salvataggio dello studente');
        }
    }

    /**
     * Salvataggio e logging delle query
     */
    public static function logQueryAndSave($request)
    {
        DB::listen(function($query) {
            \Log::info('Query SQL: ' . $query->sql);
            \Log::info('Bindings: ' . implode(', ', $query->bindings));
        });

        // Procedi con il salvataggio
        return self::saveStudent($request);
    }
}
