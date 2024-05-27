<?php
namespace App\Http\Controllers;

use App\Models\Demande;
use App\Http\Requests\DemandeRequest;
use Illuminate\Http\Request;

class DemandeController extends Controller
{
public function index()
{
$demandes = Demande::with('client:idClient,nom,email,numero')
->select('idDemande', 'client_id', 'description', 'lieu', 'date_creation', 'nombre_personne', 'type_de_celebration')
->get();

return response()->json($demandes);
}

public function show($id)
{
$demande = Demande::find($id);
if (!$demande) {
return response()->json(['message' => 'Demande Not Found.'], 404);
}

return response()->json(['demande' => $demande], 200);
}

public function store(DemandeRequest $request)
{
try {
$demande = Demande::create($request->validated());
return response()->json(['message' => "Demande successfully created.", 'demande' => $demande], 201);
} catch (\Exception $e) {
return response()->json(['message' => "Something went really wrong!"], 500);
}
}

public function destroy($id)
{
$demande = Demande::find($id);
if (!$demande) {
return response()->json(['message' => 'Demande Not Found.'], 404);
}

$demande->delete();
return response()->json(['message' => "Demande successfully deleted."], 200);
}
}
