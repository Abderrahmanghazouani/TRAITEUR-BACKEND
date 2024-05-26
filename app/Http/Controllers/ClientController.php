<?php

namespace App\Http\Controllers;

use App\Http\Requests\ClientRequest;
use App\Models\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class ClientController extends Controller
{
    
    public function index()
    {
        // Eager load the 'demandes' relationship and select only the required fields from clients
        $clients = Client::with('demandes:idDemande,description,lieu,date_creation,nombre_personne,type_de_celebration')
            ->select('idClient', 'nom', 'email', 'numero')
            ->get();
    
        return response()->json($clients);
    }
    
    
    

    public function destroy($id)
    {
        $client = Client::findOrFail($id);
        $client->delete();
        return response()->json(null, 204);
    }

    public function store(ClientRequest $request)
    {
        try {
            // Validate the incoming request data
            Log::info('Validating request data...');
            $validatedData = $request->validated();
            Log::info('Validation successful', $validatedData);

            // Create a new client using the validated data
            Log::info('Creating client...');
            $client = Client::create($validatedData);
            Log::info('Client created successfully', ['client' => $client]);

            // Return a JSON response with the newly created client and a 201 status code
            return response()->json($client, 201);
        } catch (\Exception $e) {
            // Log the exception message for debugging
            Log::error('Client creation failed: '.$e->getMessage(), ['exception' => $e]);

            // Return a JSON response with an error message and a 500 status code
            return response()->json(['message' => 'Failed to create client.'], 500);
        }
    }
}
