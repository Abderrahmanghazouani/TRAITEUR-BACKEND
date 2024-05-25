<?php

namespace App\Http\Controllers;

use App\Models\Demande;
use App\Http\Requests\DemandeRequest;
use Illuminate\Http\Request;

class DemandeController extends Controller
{
    public function index()
    {
        $demandes = Demande::all();
        return response()->json($demandes);
    }

    public function destroy($id)
    {
        $demande = Demande::findOrFail($id);
        $demande->delete();
        return response()->json(null, 204);
    }

    public function store(DemandeRequest $request)
    {
        try {
            $demande = Demande::create($request->validated());
            return response()->json([
                'message' => "Demande successfully created.",
                'demande' => $demande
            ], 201); // Use 201 for resource creation
        } catch (\Exception $e) {
            return response()->json([
                'message' => "Something went wrong: " . $e->getMessage()
            ], 500);
        }
    }
}
