<?php

namespace App\Http\Controllers;

use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class UserController extends Controller
{

    /**
     * Registration of new users.
     * @param Request $request
     * @return \Illuminate\Http\Response
     *
     * Swagger
     *
     * @OA\Get(
     *      path="/api/user/all",
     *      operationId="userAll",
     *      tags={"Users"},
     *      summary="Lists of users",
     *      description="Lists of users",
     *      @OA\Response(response=200, description="Ok"),
     *      @OA\Response(response=404, description="Resource Not Found"),
     *      security={
     *         {
     *             "bearerAuth": {}
     *         }
     *     },
     * )
     */
    //Función que se encarga de devolver la data del usuario 
    public function user(Request $request)
    {
        $user = User::all();
        if(!sizeOf($user))
            return response()->json(['mensaje'=>'No se encuentran usuarios'], 404);

        return response()->json($user, 200);

        
        
    }

    /**
     * Registration of new users.
     * @param id $id
     * @return \Illuminate\Http\Response
     *
     * Swagger
     *
     * @OA\Delete(
     *      path="/api/user/delete/{id}",
     *      operationId="userDelete",
     *      tags={"Users"},
     *      summary="Delete User",
     *      description="Delete User",
     *      @OA\Parameter(
     *          name="id",
     *          description="Id user",
     *          required=true,
     *          in="path",
     *          @OA\Schema(
     *              type="integer"
     *          )
     *      ),
     *      @OA\Response(response=200, description="Ok"),
     *      @OA\Response(response=409, description="CONFLICT"),
     *      security={
     *         {
     *             "bearerAuth": {}
     *         }
     *     },
     * )
     */
    //Función que se encarga de eliminar un usuario en especifico
    public function userDelete($id)
    {
        if(User::destroy($id))
            return response()->json(['message' => 'Usuario eliminado correctamente'], 200);

        return response()->json(['message' => 'Error al eliminar el usario'], 409);
    }

    /**
     * Registration of new users.
     * @param id $id
     * @return \Illuminate\Http\Response
     *
     * Swagger
     *
     * @OA\Get(
     *      path="/api/user/show/{id}",
     *      operationId="userShow",
     *      tags={"Users"},
     *      summary="Search User",
     *      description="Search User",
     *      @OA\Parameter(
     *          name="id",
     *          description="Id user",
     *          required=true,
     *          in="path",
     *          @OA\Schema(
     *              type="integer"
     *          )
     *      ),
     *      @OA\Response(response=200, description="Ok"),
     *      @OA\Response(response=404, description="Resource Not Found"),
     *      security={
     *         {
     *             "bearerAuth": {}
     *         }
     *     },
     * )
     */
    //Función que se encarga de devolver la data de un usuario en especifico
    public function userShow($id)
    {
        $user = User::find($id);
        if (!$user) {
            return response()->json(['mensaje'=>'No se encuentra el usuario'], 404);
        }
        return response()->json(User::find($id), 200);
    }

    /**
     * Registration of new users.
     * @param Request $request
     * @return \Illuminate\Http\Response
     *
     * Swagger
     *
     * @OA\Put(
     *      path="/api/user/update/{id}",
     *      operationId="userUpdate",
     *      tags={"Users"},
     *      summary="Update of user",
     *      description="Update of user",
     *      @OA\Parameter(
     *          name="id",
     *          description="id",
     *          required=true,
     *          in="path",
     *          @OA\Schema(
     *              type="string"
     *          )
     *      ),
     *      @OA\Parameter(
     *          name="name",
     *          description="Name user",
     *          required=true,
     *          in="query",
     *          @OA\Schema(
     *              type="string"
     *          )
     *      ),
     *      @OA\Parameter(
     *          name="email",
     *          description="Email user",
     *          required=true,
     *          in="query",
     *          @OA\Schema(
     *              type="string"
     *          )
     *      ),
     *      @OA\Parameter(
     *          name="password",
     *          description="Password user",
     *          required=true,
     *          in="query",
     *          @OA\Schema(
     *              type="string"
     *          )
     *      ),
     *      @OA\Response(response=400, description="Bad request"),
     *      @OA\Response(response=404, description="Resource Not Found"),
     *      security={
     *         {
     *             "bearerAuth": {}
     *         }
     *     },
     * )
     */

    //Función que se encarga de actualizar el usuario
    public function userUpdate(Request $request, $id)
    {
        $user = User::find($id);
        if(!$user){
            return response()->json(['menssage'=>'No se encuentra el usuario'], 404);
        }
        
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = $request->password;
        $user->save();
        return response()->json(['message' => 'Usuario Modificado Correctamente!'], 201);
    }
}