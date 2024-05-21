<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
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
        $nim = strtolower($request->input('nim'));
        $password = $request->input('password');
        $timeNow = Carbon::now()->setTimezone('Asia/Jakarta');
        $data_user = array(
           'nim' => $nim,
           'password' => $password,
        );

        if(substr($nim,0,5) === "admin"){
            if(Auth::attempt($data_user)){
                $user = Auth::user();
                $user->recent_login = $timeNow->format('Y-m-d H:i:s');
                $user->save();
                Session::put('nim', Auth::user()->nim);
                Session::put('nama', Auth::user()->nama);
                return redirect()->route('index');
            }else{
                return redirect()->route('login')->with('failed', 'Username atau Password Salah');
            }
        }
        else{
            $data = array(
                'userid' => 'simawa',
                'pin' => 'V6ZTwx',
            );
            $url = array("http://api.unand.ac.id/auth/get-token","http://api.unand.ac.id/siakad/login-mhs");

            for($i = 0;$i<2;$i++){
                $ch = curl_init($url[$i]);
                $jsonData = json_encode($data);
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                curl_setopt($ch, CURLOPT_POST, true);
                if($i === 0){
                    curl_setopt($ch, CURLOPT_POSTFIELDS, $jsonData);
                    curl_setopt($ch, CURLOPT_HTTPHEADER, array(
                        'Content-Type: application/json',
                        'Content-Length: ' . strlen($jsonData)
                    ));
                    $response = curl_exec($ch);
                    $responseArray = json_decode($response, true);
                    $token = $responseArray['token'];
                }else{
                    $jsonData_user = json_encode($data_user);
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
                    }else{
                        return redirect()->route('login')->with('failed', 'NIM atau Password Salah');
                    }
                }                
            }
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
    public function setting(){
        return view("setting"); 
    }
    public function settingAction(Request $request){
        $validated = $request->validate([
            'recentPassword' => 'required|string|max:100',
            'newPassword' => 'required|string|max:100',
            'confirmPassword' => 'required|string|max:100',
        ]);

        $password = $request->input('password');
        $data_user = array(
           'nim' => Auth::user()->nim,
           'password' => $validated['recentPassword'],
        );
        if(Auth::attempt($data_user)){
            if(strlen($validated['newPassword']) >= 8){
                if($validated['newPassword'] === $validated['confirmPassword']){
                    $user = Auth::user();
                    $user->password = Hash::make($validated['confirmPassword']);
                    $user->save();
                    Session::flush();
                    return redirect()->route('login')->with('success', 'Password Berhasil Diperbaharui, Silahkan Login Kembali');
                }else{
                    return redirect()->route('setting')->with('failed', 'Password Tidak Sama Dengan Konfirm Password');
                }
            }else{
                return redirect()->route('setting')->with('failed', 'Password Minimal 8 Character');
            }
        }else{
            return redirect()->route('setting')->with('failed', 'Password Anda Salah');
        }
    }
    public function logout(){
        Session::flush();
        return redirect()->route("login");
    }

}
