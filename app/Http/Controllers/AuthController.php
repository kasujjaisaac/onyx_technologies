<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Validation\Rules\Password;
use App\Models\User;

class AuthController extends Controller
{
    public function showLogin()
    {
        return view('pages.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        $credentials['email'] = Str::lower($credentials['email']);
        $credentials['is_active'] = true;

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            $this->hydrateLegacySession($request, Auth::user());

            return redirect()->intended('/dashboard');
        }

        return back()->withErrors(['email' => 'Invalid credentials.'])->onlyInput('email');
    }

    public function showRegister()
    {
        return view('pages.register');
    }

    public function register(Request $request)
    {
        $data = $request->validate([
            'company_name' => ['required', 'string', 'min:2', 'max:255'],
            'name' => ['required', 'string', 'min:2', 'max:255'],
            'email' => ['required', 'email:rfc', 'max:255', 'unique:users,email'],
            'password' => [
                'required',
                'confirmed',
                Password::min(10)->mixedCase()->numbers()->symbols(),
            ],
        ]);

        $data['email'] = Str::lower($data['email']);

        $user = DB::transaction(function () use ($data): User {
            $tenantId = DB::table('tenants')->insertGetId([
                'company_name' => $data['company_name'],
                'slug' => $this->uniqueTenantSlug($data['company_name']),
                'currency' => 'UGX',
                'fiscal_year_start' => now()->startOfYear()->toDateString(),
                'status' => 'trial',
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            return User::create([
                'tenant_id' => $tenantId,
                'name' => $data['name'],
                'email' => $data['email'],
                'password' => Hash::make($data['password']),
                'role' => 'super_admin',
                'is_active' => true,
            ]);
        });

        Auth::login($user);
        $request->session()->regenerate();
        $this->hydrateLegacySession($request, $user);

        return redirect('/dashboard');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }

    private function hydrateLegacySession(Request $request, User $user): void
    {
        $tenant = DB::table('tenants')->where('id', $user->tenant_id)->first();

        $request->session()->put([
            'tenant_id' => $user->tenant_id ?: ($tenant->id ?? 1),
            'user_id' => $user->id,
            'user_name' => $user->name,
            'company_name' => $tenant->company_name ?? config('app.name', 'Onyx Hub'),
            'currency' => $tenant->currency ?? 'UGX',
            'role' => $user->role ?: 'super_admin',
        ]);
    }

    private function uniqueTenantSlug(string $companyName): string
    {
        $base = Str::slug($companyName) ?: 'workspace';
        $slug = $base;
        $counter = 2;

        while (DB::table('tenants')->where('slug', $slug)->exists()) {
            $slug = $base . '-' . $counter;
            $counter++;
        }

        return $slug;
    }
}
