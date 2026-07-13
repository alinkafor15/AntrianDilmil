<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class AuthController extends Controller
{
    public function prosesLogin(Request $request)
    {

        $request->validate([
            'username' => 'required',
            'password' => 'required',
        ]);

        $username = $request->input('username');
        $password = $request->input('password');

        $daftarAkun = [
            'Kepaniteraan' => ['password' => '12345###', 'role' => 'Kepaniteraan', 'name' => 'Operator Kepaniteraan'],
            'Kesekretariatan' => ['password' => '12345$$$', 'role' => 'Kesekretariatan', 'name' => 'Operator Kesekretariatan'],
            'Informasi' => ['password' => '12345@@@', 'role' => 'Informasi', 'name' => 'Operator Meja Informasi'],
            'Konsultasi' => ['password' => '12345***', 'role' => 'Konsultasi', 'name' => 'Operator Konsultasi & Pengaduan'],
        ];

        if (array_key_exists($username, $daftarAkun) && $daftarAkun[$username]['password'] === $password) {

            Session::put('operator_login', true);
            Session::put('operator_username', $username);
            Session::put('operator_role', $daftarAkun[$username]['role']);
            Session::put('operator_name', $daftarAkun[$username]['name']);

            return redirect('/operator/antrian');
        }

        return back()->withErrors([
            'username' => 'Username atau Password yang Anda masukkan salah.',
        ])->withInput($request->only('username'));
    }

    public function prosesLogout()
    {
        Session::forget(['operator_login', 'operator_username', 'operator_role', 'operator_name']);
        return redirect('/');
    }
}