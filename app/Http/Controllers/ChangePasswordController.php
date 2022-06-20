<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\UpdatePasswordRequest;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\DB;
use App\Models\User;

class ChangePasswordController extends Controller
{
    public function passwordResetProcess(UpdatePasswordRequest $request){
        return $this->updatePasswordRow($request)->count() > 0 ? $this->resetPassword($request) : $this->tokenNotFoundError();
      }
  
      // Verifica si el token es válido
      private function updatePasswordRow($request){
         return DB::table('password_resets')->where([
             'email' => $request->email,
             'token' => $request->resetToken
         ]);
      }
  
      // Respuesta si no encuentra el token 
      private function tokenNotFoundError() {
          return response()->json([
            'error' => 'La información enviada es errónea'
          ],Response::HTTP_UNPROCESSABLE_ENTITY);
      }
  
      // Resetea el password
      private function resetPassword($request) {
          // Busca el email
          $userData = User::whereEmail($request->email)->first();
          // Actualiza el password
          $userData->update([
            'password'=>bcrypt($request->password)
          ]);
          // Remueve la data de verificacion de la base de datos
          $this->updatePasswordRow($request)->delete();
  
          // reset password response
          return response()->json([
            'data'=>'El Password ha sido actualizado con éxito.'
          ],Response::HTTP_CREATED);
      }    
}