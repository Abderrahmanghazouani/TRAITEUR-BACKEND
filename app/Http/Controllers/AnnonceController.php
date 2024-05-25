<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Annonce;
use App\Http\Requests\AnnonceRequest;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage; //php artisan storage:link = php artisan storage:link = http://127.0.0.1:8000/storage/1.jpg

class AnnonceController extends Controller
{
    public function index()
    {
        // All Product
        $annonces = Annonce::all();

        // Return Json Response
        return response()->json([
            'annonces' => $annonces
        ], 200);
    }

    public function store(AnnonceRequest $request)
    {
        try {
            $imageName = Str::random(32) . "." . $request->image->getClientOriginalExtension();

            // Create Annonce
            Annonce::create([
                'titre' => $request->titre,
                'date' => $request->date,
                'description' => $request->description,
                'image' => $imageName,
            ]);

            // Save Image in Storage folder
            Storage::disk('public')->put($imageName, file_get_contents($request->image));

            // Return Json Response
            return response()->json([
                'message' => "Annonce successfully created."
            ], 200);
        } catch (\Exception $e) {
            // Return Json Response
            return response()->json([
                'message' => "Something went really wrong!"
            ], 500);
        }
    }

    public function show($id)
    {
        // Product Detail
        $annonce = Annonce::find($id);
        if (!$annonce) {
            return response()->json([
                'message' => 'Annonce Not Found.'
            ], 404);
        }

        // Return Json Response
        return response()->json([
            'annonce' => $annonce
        ], 200);
    }

    public function update(AnnonceRequest $request, $id)
    {
        try {
            // Find annonce
            $annonce = Annonce::find($id);
            if (!$annonce) {
                return response()->json([
                    'message' => 'Annonce Not Found.'
                ], 404);
            }


            $annonce->titre = $request->titre;
            $annonce->date = $request->date;
            $annonce->description = $request->description;

            if ($request->image) {

                // Public storage
                $storage = Storage::disk('public');

                // Old iamge delete
                if ($storage->exists($annonce->image))
                    $storage->delete($annonce->image);

                // Image name
                $imageName = Str::random(32) . "." . $request->image->getClientOriginalExtension();
                $annonce->image = $imageName;

                // Image save in public folder
                $storage->put($imageName, file_get_contents($request->image));
            }

            // Update Product
            $annonce->save();

            // Return Json Response
            return response()->json([
                'message' => "Annonce successfully updated."
            ], 200);
        } catch (\Exception $e) {
            // Return Json Response
            return response()->json([
                'message' => "Something went really wrong!"
            ], 500);
        }
    }

    public function destroy($id)
    {
        // Detail
        $annonce = Annonce::find($id);
        if (!$annonce) {
            return response()->json([
                'message' => 'Annonce Not Found.'
            ], 404);
        }

        // Public storage
        $storage = Storage::disk('public');

        // Iamge delete
        if ($storage->exists($annonce->image))
            $storage->delete($annonce->image);

        // Delete Product
        $annonce->delete();

        // Return Json Response
        return response()->json([
            'message' => "Annonce successfully deleted."
        ], 200);

    }
}
