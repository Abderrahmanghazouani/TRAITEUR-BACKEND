<?php
namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class AuthenticatedSessionController extends Controller
{
public function store(Request $request)
{
$request->validate([
'email' => 'required|email',
'password' => 'required',
]);

if (!Auth::attempt($request->only('email', 'password'))) {
throw ValidationException::withMessages([
'email' => ['Les informations d\'identification fournies sont incorrectes.'],
]);
}

$request->session()->regenerate();

return response()->json(['message' => 'Connexion réussie.']);
}

public function destroy(Request $request)
{
Auth::guard('web')->logout();

$request->session()->invalidate();

$request->session()->regenerateToken();

return response()->json(['message' => 'Déconnexion réussie.']);
}
}
