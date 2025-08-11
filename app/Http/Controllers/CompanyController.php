<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use App\Models\Company;
use App\Models\User;


class CompanyController extends Controller
{
    public function store(Request $request)
{
    $data = $request->validate([
        'company_name' => 'required|string|max:255',
        'company_email' => 'nullable|email|max:255',
        'admin_name' => 'required|string|max:255',
        'admin_email' => 'required|email|unique:users,email',
        'password' => 'required|min:6|confirmed',
        'phone' => 'nullable|string',
        'address' => 'nullable|string',
        'sector_id' => 'nullable|exists:sectors,id',
    ]);

    DB::beginTransaction();
    try {
        $company = Company::create([
            'name' => $data['company_name'],
            'email' => $data['company_email'] ?? $data['admin_email'],
            'phone' => $data['phone'] ?? null,
            'address' => $data['address'] ?? null,
            'sector_id' => $data['sector_id'] ?? null,
        ]);

        $user = User::create([
            'name' => $data['admin_name'],
            'email' => $data['admin_email'],
            'password' => Hash::make($data['password']),
            'role' => 'admin',
            'company_id' => $company->id,
        ]);

        DB::commit();
        return redirect()->route('login')->with('success', 'Registrasi berhasil. Silakan login.');
    } catch (\Exception $e) {
        DB::rollBack();
        return back()->withErrors(['error' => 'Gagal registrasi: '.$e->getMessage()]);
    }
}
}
