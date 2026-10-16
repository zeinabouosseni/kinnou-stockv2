<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Boutiques;
use App\Models\Boutiquiers;
use App\Models\Employers;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
    //
    public function rules(): array
    {
        return [
            'nom'          => ['required', 'string', 'max:255'],
            'prenom'       => ['required', 'string', 'max:255'],
            'email'        => ['nullable', 'email', 'max:255', 'unique:boutiquiers,email'],
            'telephone'    => ['required', 'string', 'max:20', 'unique:boutiquiers,telephone'],
            'ville'        => ['required', 'string', 'max:100'],
            'code_pin'     => ['required', 'digits:4'],

            'boutique_nom' => ['required', 'string', 'max:255'],
            'quartier'     => ['required', 'string', 'max:255'],
            'logo'         => ['nullable', 'image', 'max:2048'],
        ];
    }

    public function messages(): array
    {
        return [
            'email.unique'   => 'Cette adresse email est déjà utilisée.',
            'code_pin.digits' => 'Le code PIN doit contenir exactement 4 chiffres.',
        ];
    }
    public function register(Request $request)
    {

        DB::beginTransaction(); // Démarrer une transaction
        try {
            //code...
            $data = $request->validate($this->rules(), $this->messages()); //Valiation des données entrantes selon les règles définies
            $boutiquier = Boutiquiers::create([
                'nom'       => $data['nom'],
                'prenom'    => $data['prenom'],
                'email'     => $data['email'],
                'telephone' => $data['telephone'],
                'ville'     => $data['ville'],
                'code_pin'  => bcrypt($data['code_pin']), // ne jamais stocker en clair
                'status'    => 'actif',
            ]);

            $logoPath = null;
            if (!empty($data['logo'])) {
                $logoPath = $data['logo']->store('logos', 'public');
            }

            $boutique = Boutiques::create([
                'nom'           => $data['boutique_nom'],
                'quartier'      => $data['quartier'],
                'logo'          => $logoPath,
                'status'        => 'actif',
                'boutiquier_id' => $boutiquier->id,
            ]);

            $token = $boutiquier->createToken('mobile')->plainTextToken;
            DB::commit(); // Valider la transaction
            return response()->json([
                'status'  => 'success',
                'message' => 'Compte créé avec succès.',
                'data' => [
                    'boutiquier' => $boutiquier,
                    'boutique'   => $boutique,
                    'token'      => $token,
                ],
            ], 201);
        } catch (\Throwable $th) {
            //throw $th;
            DB::rollBack(); // Annuler la transaction en cas d'erreur
            Log::error('Validation error: ' . $th->getMessage());
            return response()->json([
                'status' => 'warning',
                'message' => 'Une erreur est survenue!Veuillez réessayer.',
            ], 401);
        }
        //
        /* return response()->json([
            'status' => 'warning',
            'message' => 'Registration endpoint is under construction.',
        ], 401); */
    }

    public function login(Request $request)
    {
        try {
            $request->validate([
                'telephone' => ['required', 'string', 'max:20'],
                'code_pin'  => ['required', 'digits:4'],
            ]);

            $boutiquier = Boutiquiers::where('telephone', $request->telephone)->first();
            if (!$boutiquier) {
                return response()->json([
                    'status' => 'warning',
                    'message' => 'Aucun compte trouvé avec ce numéro de téléphone.',
                ], 401);
            }
            if (!$boutiquier || !Hash::check($request->code_pin, $boutiquier->code_pin)) {
                return response()->json([
                    'status' => 'warning',
                    'message' => 'Code PIN incorrect.',
                ], 401);
            }

            $token = $boutiquier->createToken('mobile')->plainTextToken;

            return response()->json([
                'status'  => 'success',
                'message' => 'Compte créé avec succès.',
                'data' => [
                    'boutiquier' => $boutiquier,
                    'boutique'   => $boutiquier->boutiques,
                    'token'      => $token,
                ],
            ], 201);
        } catch (\Throwable $th) {
            Log::error('Login error: ' . $th->getMessage());
            return response()->json([
                'status' => 'warning',
                'message' => 'Une erreur est survenue!Veuillez réessayer.',
            ], 500);
        }
    }

    public function loginEmploye(Request $request)
    {
        try {
            $request->validate([
                'code' => 'required|string',
                'pin' => 'required|string',
            ]);

            // Récupération de l'employé actif avec ses permissions
            $employe = Employers::with('permission')
                ->where('code', $request->code)
                ->where('actif', true)
                ->first();

            if (!$employe || !Hash::check($request->pin, $employe->pin)) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Code employé ou PIN invalide.',
                ], 401);
            }

            $token = $employe->createToken('employe_token')->plainTextToken;
            Log::info("connexion", [
                'status'  => 'success',
                'message' => 'Connexion employé réussie',
                'data'    => [
                    'token'   => $token,
                    'employe' => $employe->toArray(),
                ]
            ]);
            return response()->json([
                'status'  => 'success',
                'message' => 'Connexion employé réussie',
                'data'    => [
                    'token'   => $token,
                    'employe' => $employe->toArray(),
                ],
            ], 200);
        } catch (Exception $e) {
            Log::error('Erreur loginEmploye:', ['error' => $e->getMessage()]);
            return response()->json([
                'status' => 'error',
                'message' => 'Une erreur est survenue lors de la connexion employé.',
            ], 500);
        }
    }

    public function changePin(Request $request)
    {
        try {
            $request->validate([
                'current_pin' => 'required|digits:4',
                'new_pin'     => 'required|digits:4|different:current_pin|confirmed',
            ], [
                'current_pin.digits' => 'Le code PIN actuel doit contenir 4 chiffres.',
                'new_pin.digits'     => 'Le nouveau code PIN doit contenir 4 chiffres.',
                'new_pin.different'  => "Le nouveau code doit être différent de l'ancien.",
                'new_pin.confirmed'  => 'Les codes PIN ne correspondent pas.',
            ]);

            $user = $request->user();

            if (!$user) {
                return response()->json([
                    'status'  => 'error',
                    'message' => 'Non authentifié.',
                ], 401);
            }

            if (!Hash::check($request->current_pin, $user->code_pin)) {
                return response()->json([
                    'status'  => 'error',
                    'message' => 'Le code PIN actuel est incorrect.',
                ], 422);
            }

            $user->code_pin = Hash::make($request->new_pin);
            $user->save();

            return response()->json([
                'status'  => 'success',
                'message' => 'Code PIN modifié avec succès.',
            ]);
        } catch (ValidationException $e) {
            return response()->json([
                'status'  => 'error',
                'message' => 'Données invalides.',
                'errors'  => $e->errors(),
            ], 422);
        } catch (\Throwable $th) {
            Log::error('Erreur changePin: ' . $th->getMessage());

            return response()->json([
                'status'  => 'error',
                'message' => 'Erreur serveur.',
            ], 500);
        }
    }
}
