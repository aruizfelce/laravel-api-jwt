<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Models\User;
use App\Mail\SendMailreset;
use Illuminate\Support\Facades\Mail;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class PasswordResetRequestController extends Controller
{
    public function sendEmail(Request $request)  // Función principal
    {
        if (!$this->validateEmail($request->email)) {  // Valida el email
            return $this->failedResponse();
        }
        $this->send($request->email);  //Envia el Email
        return $this->successResponse();
    }

    public function send($email)  //Función que envia el email
    {
        $token = $this->createToken($email);
        Mail::to($email)->send(new SendMailreset($token, $email));  // Envia el email con el token
    }

    public function createToken($email)  // Verifica si se hizo la solicitud de reinicio de clave
    {
        $oldToken = DB::table('password_resets')->where('email', $email)->first();

        if ($oldToken) {
            return $oldToken->token;
        }

        $token = Str::random(40);
        $this->saveToken($token, $email);
        return $token;
    }

    public function saveToken($token, $email)  // Función para crear el nuevo token
    {
        DB::table('password_resets')->insert([
            'email' => $email,
            'token' => $token,
            'created_at' => Carbon::now()
        ]);
    }

    public function validateEmail($email)  //Función para obtener el email de la base de datos
    {
        return !!User::where('email', $email)->first();
    }

    public function failedResponse()
    {
        return response()->json([
            'error' => 'Email o se encuentra en nuestra base de datos'
        ], Response::HTTP_NOT_FOUND);
    }

    public function successResponse()
    {
        return response()->json([
            'data' => 'El Email de reinicio de contraseña se envió satisfactoriamente, por favor revise su bandeja de entrada.'
        ], Response::HTTP_OK);
    }
}