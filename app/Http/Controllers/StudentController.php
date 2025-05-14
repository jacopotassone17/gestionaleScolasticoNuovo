<?php

namespace App\Http\Controllers;

use App\Models\Student;
use App\Models\User;
use App\Models\Classe;
use App\Models\Notifiche;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Recuperiamo tutti gli studenti con le informazioni dell'utente e della classe associata
        $students = Student::with(['user', 'classe', 'notification'])->get();

        // Passiamo i dati alla vista per visualizzarli
        return view('studenti.index', compact('students'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Recuperiamo tutti gli utenti e le classi per il modulo di creazione
        $users = User::all();
        $classes = Classe::all();
        $notifications = Notifiche::all(); // Correzione: usa $notifications invece di $notification

        // Mostriamo il modulo per aggiungere un nuovo studente
        return view('studenti.create', compact('users', 'classes', 'notifications')); // Correzione qui
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
{
    // Validazione dei dati
    $validated = $request->validate([
        'nome' => 'required|max:45',
        'cognome' => 'required|max:45',
        'classe' => 'required|max:45',  // Solo max, non exist
        'id_notifica' => 'nullable|exists:notifiche,id_notifica',  // Verifica che id_notifica esista
    ]);

    // Crea lo studente se la validazione ha successo
    $student = new Student();
    $student->nome = $request->nome;
    $student->cognome = $request->cognome;
    $student->classe = $request->classe;
    $student->id_notifica = $request->id_notifica;

    // Puoi assegnare automaticamente un id_user (ad esempio il primo utente creato con il ruolo studente)
    $user = User::where('professore', 0)->first();  // Assumendo che "professore" = 0 per gli studenti

    // Associa l'utente trovato
    if ($user) {
        $student->id_user = $user->id_user;
    }

    // Salva lo studente
    if ($student->save()) {
        return redirect()->route('studenti.index');
    } else {
        return back()->withErrors(['msg' => 'Errore nel salvataggio dello studente']);
    }
}


    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        // Recuperiamo lo studente specifico con le informazioni dell'utente, della classe e della notifica associata
        $student = Student::with(['user', 'classe', 'notification'])->findOrFail($id);

        // Passiamo i dati alla vista per visualizzarli
        return view('studenti.show', compact('student'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        // Recuperiamo lo studente da modificare
        $student = Student::findOrFail($id);

        // Recuperiamo tutti gli utenti, le classi e le notifiche per il modulo di modifica
        $users = User::all();
        $classes = Classe::all();
        $notifications = Notifiche::all(); // Correzione: usa $notifications qui

        // Mostriamo il modulo di modifica dello studente
        return view('studenti.edit', compact('student', 'users', 'classes', 'notifications')); // Correzione qui
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
{
    // Recupera lo studente da modificare
    $student = Student::findOrFail($id);

    // Valida i dati in ingresso
    $validated = $request->validate([
        'nome' => 'required|string|max:255',
        'cognome' => 'required|string|max:255',
        'classe' => 'required|string|max:45',
        'id_notifica' => 'nullable|integer',
    ]);

    // Assegna i nuovi valori ai campi
    $student->nome = $validated['nome'];
    $student->cognome = $validated['cognome'];
    $student->classe = $validated['classe'];
    $student->id_notifica = $validated['id_notifica'];

    // Salva le modifiche
    $student->save();

    // Ritorna una risposta (ad esempio, con un messaggio di successo)
    return redirect()->route('studenti.index');
}


    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        // Recuperiamo lo studente da eliminare
        $student = Student::findOrFail($id);

        // Eliminiamo lo studente dal database
        $student->delete();

        // Reindirizziamo alla lista degli studenti con un messaggio di successo
        return redirect()->route('studenti.index')->with('success', 'Studente eliminato con successo!');
    }
}
