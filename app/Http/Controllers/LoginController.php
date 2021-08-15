<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Usuario;
use App\Models\Cliente;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function dashboard(){

        if(Auth::check() === true){
        return view('dashboard.dashboard');
        }
            return redirect()->route('admin.login');
    }

    public function cliente(){

        if(Auth::check() === true){
        return view('welcome');
        }
            return redirect()->route('admin.login');
    }

    public function showLoginForm(){
        return view('auth.login');
    }

    public function login(Request $request)
    {
        if($request->msgErro == null){
            if(empty($credentials)){
            $credentials = [
                'usuario' => $request-> usuario,
                'password' => $request->password
            ];
        }

        $get_usuario = Usuario::where('usu_usuario', $request->usuario)->first();
        $get_cliente = Cliente::where('cli_usuario', $request->usuario)->first();


            if(filter_var($request->usuario, FILTER_VALIDATE_EMAIL)){

               if (!empty($get_usuario)){
                    if(Hash::check($request->password, $get_usuario->usu_senha)){
                        Auth::loginUsingId($get_usuario->usu_id);
                        $get_usuario = null;
                        return redirect()->route('admin');
                    }
                    return redirect()->back()->withInput()->withErrors(['Os dados informados não conferem!']);
                }

                if (!empty($get_cliente)){
                    if(Hash::check($request->password, $get_cliente->cli_senha)){
                        Auth::loginUsingId($get_cliente->cli_id);
                        $get_cliente = null;
                        return redirect()->route('home');
                    }
                    return redirect()->back()->withInput()->withErrors(['Os dados informados não conferem!']);
                }
                return redirect()->back()->withInput()->withErrors(['O email informado não é válido!']);
            }
            else{
                return redirect()->back()->withInput()->withErrors(['O email digitado não está na base de dados!']);
            }
        }

        else{
            return redirect()->back()->Blade::component('alert-erro')->withInput($request->msgErro);
            $request->msgErro = null;
        }
    }


    public function logout(){
        Auth::logout();
        return redirect()->route('admin');
    }
}




