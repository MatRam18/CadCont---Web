<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Session;
use CloudinaryLabs\CloudinaryLaravel\Facades\Cloudinary;

class ProfileController extends Controller
{
    public function show()
    {
        if (!Session::has('firebase_user')) {
            return redirect('/login');
        }
        $user = Session::get('firebase_user');
        $firestoreUrl = env('FIREBASE_FIRESTORE_URL') . '/users/' . $user['uid'];
        $response = Http::get($firestoreUrl);
        $profile = null;
        if ($response->ok() && isset($response['fields'])) {
            $fields = $response['fields'];
            $profile = [
                'name' => $fields['name']['stringValue'] ?? '',
                'photo' => $fields['photo']['stringValue'] ?? '',
            ];
        }
        return view('profile.index', compact('profile', 'user'));
    }

    public function update(Request $request)
    {
        if (!Session::has('firebase_user')) {
            return redirect('/login');
        }
        $user = Session::get('firebase_user');
        $firestoreUrl = env('FIREBASE_FIRESTORE_URL') . '/users/' . $user['uid'];

        $name = $request->input('name');
        $photoUrl = $request->input('current_photo');

        // Se houver upload de foto, faz upload para Cloudinary e salva a URL
        if ($request->hasFile('photo')) {
            $uploadedFileUrl = Cloudinary::upload(
                $request->file('photo')->getRealPath(),
                [
                    'folder' => 'usuarios/' . $user['uid'],
                ]
            )->getSecurePath();
            $photoUrl = $uploadedFileUrl;
        }

        // Atualiza nome e foto no Firestore
        $fields = [
            'fields' => [
                'name' => ['stringValue' => $name],
                'photo' => ['stringValue' => $photoUrl],
            ]
        ];

        Http::patch($firestoreUrl, $fields);

        return redirect()->back()->with('status', 'Perfil atualizado com sucesso!');
    }
}
