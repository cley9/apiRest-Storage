<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\ImageToken;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;


class StorageController extends Controller
{
    public function storage(Request $request)
    {
        $extImg = $request->file('imagen')->extension();
        $aletImg = rand(1, 100000);
        $img = $aletImg . '.' . $extImg;
        $request->file('imagen')->storeAs('public/img/perfil/', $img);
        // Generar un token único para la imagen
        $token = str::random(32);
        // Guardar el token con la referencia a la imagen en la base de datos
        $saveImage = new ImageToken;
        $saveImage->token = $token;
        $saveImage->filename = $img;
        $saveImage->save();
        // Retornar la URL enmascarada
        $endpointImg = route('image.api.enmascarar', ['token' => $token]);
        return response()->json(["status" => 200, "message" => "0k", "image" => $endpointImg], 200);
    }

    public function enmascarar($token)
    {
        // Buscar el nombre de archivo asociado con el token
        $imageToken = ImageToken::where('token', $token)->firstOrFail();
        $filename = $imageToken->filename;
        // Servir la imagen
        $path = 'img/perfil/' . $filename;
        if (!Storage::disk('public')->exists($path)) {
            abort(404);
        }
        $file = Storage::disk('public')->get($path); // obtine el contenido de la imagen
        $type = Storage::disk('public')->mimeType($path); // obtiene el tipo de mime para el formato del content-type
        return response($file, 200)->header('Content-Type', $type);
    }
}
