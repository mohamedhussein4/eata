<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Beneficiary;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        $rules = [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'phone' => ['required', 'string', 'max:255'],
            'age' => ['required', 'integer'],
            'type' => ['required', 'string', 'max:255'],
            'gender' => ['required', 'string', 'max:255'],
        ];

        // Add beneficiary-specific validation rules
        if (isset($data['type']) && $data['type'] === 'beneficiary') {
            $rules = array_merge($rules, [
                'address' => ['required', 'string', 'max:500'],
                'marital_status' => ['required', 'string', 'in:single,married,divorced,widow'],
                'family_members_count' => ['required', 'integer', 'min:1'],
                'children_under_10_count' => ['nullable', 'integer', 'min:0'],
                'average_monthly_income' => ['required', 'numeric', 'min:0'],
                'has_diseases' => ['nullable', 'boolean'],
                'is_supporting_others' => ['nullable', 'boolean'],
                'critical_surgery_diseases' => ['nullable', 'string', 'max:1000'],
            ]);
        }

        return Validator::make($data, $rules);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */
    protected function create(array $data)
    {
        // Create the user first
        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'phone' => $data['phone'],
            'type' => $data['type'],
            'age' => $data['age'],
            'gender' => $data['gender'],
        ]);

        // If user is a beneficiary, create beneficiary record
        if ($data['type'] === 'beneficiary') {
            Beneficiary::create([
                'name' => $data['name'],
                'email' => $data['email'],
                'age' => $data['age'],
                'phone' => $data['phone'],
                'address' => $data['address'],
                'marital_status' => $data['marital_status'],
                'family_members_count' => $data['family_members_count'],
                'children_under_10_count' => $data['children_under_10_count'] ?? 0,
                'average_monthly_income' => $data['average_monthly_income'],
                'has_diseases' => isset($data['has_diseases']) ? (bool)$data['has_diseases'] : false,
                'is_supporting_others' => isset($data['is_supporting_others']) ? (bool)$data['is_supporting_others'] : false,
                'critical_surgery_diseases' => $data['critical_surgery_diseases'] ?? null,
            ]);
        }

        return $user;
    }
}
