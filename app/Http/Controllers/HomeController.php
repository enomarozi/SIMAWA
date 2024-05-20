<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Hash;
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

        $data = array(
            'userid' => 'simawa',
            'pin' => 'V6ZTwx',
        );
        $url = "http://api.unand.ac.id/auth/get-token";
        $ch = curl_init($url);
        $jsonData = json_encode($data);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $jsonData);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            'Content-Type: application/json',
            'Content-Length: ' . strlen($jsonData)
        ));

        $response = curl_exec($ch);
        $responseArray = json_decode($response, true);
        $token = $responseArray['token'];
        curl_close($ch);

        $data_user = array(
           'nim' => $nim,
           'password' => $password,
        );

        $url_user = "http://api.unand.ac.id/siakad/login-mhs";
        $ch = curl_init($url_user);
        $jsonData_user = json_encode($data_user);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $jsonData_user);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            'Content-Type: text/plain',
            'Authorization: Bearer ' . $token,
        ));

        $response = curl_exec($ch);
        $responseUser = json_decode($response, true);
        $status = $responseUser['status'];
        if($status === "success"){
            Session::put('nim', $responseUser["data"]["nim"]);
            Session::put('nama', $responseUser["data"]["nama"]);
            Session::put('prodi', $responseUser["data"]["prodiNama"]);
            Session::put('jenjang', $responseUser["data"]["jenjang"]);
            return redirect()->route("index");
        }
    }
    public function registration(){
        return view("auth.registration");
    }
    public function registrationAction(Request $request){
        $validated = $request->validate([
            'nama' => 'required|string|max:30',
            'nim' => 'required|string|max:20',
            'email' => 'required|string|max:35',
            'password' => 'required|string|max:100',
        ]);

        if($request->input('password') === $request->input('confirmPassword')){
            $data = new User();
            $data->nama = $validated['nama'];
            $data->nim = $validated['nim'];
            $data->email = $validated['email'];
            $data->password = Hash::make($validated['password']);
            $data->save();
            return redirect()->route("login");
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
        return redirect()->route("login");
    }

}
