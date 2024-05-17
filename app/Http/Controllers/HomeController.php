<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Session;

class HomeController extends Controller
{
    public function index()
    {
        if(session()->has('nim') && session()->has('nama')){
            return view("index");
        }
        return redirect()->route("login");
    }
    public function login(){
        if(session()->has('nim') && session()->has('nama')){
            return redirect()->route("index");
        }
        return view("auth.login");
    }
    public function loginAction(Request $request){
        $nim = $request->input('nim');
        $password = $request->input('password');
        $url = array("http://portal.unand.ac.id/api.php?op=login","http://portal.unand.ac.id/api.php?op=tusrProdiKode","http://portal.unand.ac.id/api.php?op=getnama");
        $value = array();

        $data = array(
           'username' => $nim,
           'password' => $password
        );
        for($i=0;$i<count($url);$i++){
            $ch = curl_init($url[$i]);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_POST, true);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
            $response = curl_exec($ch);
            if (curl_errno($ch)) {
                echo 'Error: ' . curl_error($ch);
            }
            array_push($value,$response);
            curl_close($ch);
        }
        if(count($value) === 3){
            Session::put('nim', $nim);
            Session::put('nama', $value[2]);
            return redirect()->route("index");
        }
    }
    public function talenta(){
        return view("talenta");
    }
    public function profile(){
        return view("profile");
    }
    public function logout(){
        Session::flush();
        echo "hallo";
        return redirect()->route("login");
    }

}
