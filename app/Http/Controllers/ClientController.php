<?php
namespace App\Http\Controllers;

use App\Http\Requests\ClientRequest;
use App\Models\Client;
use Illuminate\Http\Request;

class ClientController extends Controller
{
    public function index()
    {
        $clients = Client::with('demandes:idDemande,description,lieu,date_creation,nombre_personne,type_de_celebration')
            ->select('idClient', 'nom', 'email', 'numero')
            ->get();

        return response()->json($clients);
    }

    public function show($id)
    {
        $client = Client::find($id);
        if (!$client) {
            return response()->json(['message' => 'Client Not Found.'], 404);
        }

        return response()->json(['client' => $client], 200);
    }

    public function store(ClientRequest $request)
    {
        try {
            $client = Client::where('email', $request->email)->first();
            if (!$client) {
                $client = Client::create($request->validated());
            }
            return response()->json(['message' => 'Client trouvé/créé avec succès', 'client' => $client], 201);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Erreur lors de la création du client'], 500);
        }
    }

    public function destroy($id)
    {
        $client = Client::find($id);
        if (!$client) {
            return response()->json(['message' => 'Client Not Found.'], 404);
        }

        $client->delete();
        return response()->json(['message' => "Client successfully deleted."], 200);
    }
}
