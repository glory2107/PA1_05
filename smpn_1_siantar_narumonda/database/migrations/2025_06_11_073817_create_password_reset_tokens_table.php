<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Auth; // Tambahkan ini

class ResetPasswordController extends Controller
{
    /**
     * Display the password reset view for the given token.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  string|null  $token
     * @return \Illuminate\View\View
     */
    public function showResetForm(Request $request, $token = null)
    {
        return view('admin.passwords.reset')->with(
            ['token' => $token, 'email' => $request->email]
        ); // Ini akan mengarah ke view yang akan kita buat nanti
    }

    /**
     * Reset the given user's password.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function reset(Request $request)
    {
        $request->validate($this->rules());

        // Menggunakan broker 'admin' untuk mereset password
        $response = Password::broker('admin')->reset(
            $request->only('email', 'password', 'password_confirmation', 'token'),
            function ($user, $password) {
                $user->password = Hash::make($password);
                $user->save();

                // Login admin setelah reset password berhasil
                Auth::guard('admin')->login($user);
            }
        );

        if ($response == Password::PASSWORD_RESET) {
            return redirect()->intended('/admin/dashboard') // Ganti dengan route dashboard admin Anda
                             ->with('status', trans($response));
        }

        // Jika gagal
        return back()->withInput($request->only('email'))
            ->withErrors(['email' => trans($response)]);
    }

    /**
     * Get the password reset validation rules.
     *
     * @return array
     */
    protected function rules()
    {
        return [
            'token' => 'required',
            'email' => 'required|email',
            'password' => 'required|confirmed|min:8', // min:8 atau lebih kuat
        ];
    }
}