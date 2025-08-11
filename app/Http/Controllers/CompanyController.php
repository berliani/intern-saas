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
        'name' => 'required|string|max:20',
        'email' => 'nullable|email|max:30',
        'phone' => 'nullable|string|max:15',
        'address' => 'nullable|string|max:20',
        'sector_id' => 'nullable|exists:sectors,id',
        'description' => 'nullable|string',
    ]);

    $company = Company::create($data);

    return response()->json([
        'message' => 'Company created successfully',
        'company' => $company
    ], 201);
}

}
