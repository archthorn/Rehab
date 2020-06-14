<?php

namespace App\Http\Controllers;

use App\Http\Models\Appointment;
use App\Http\Models\Role;
use App\Http\Models\Specialty;
use App\Http\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class AdminController extends Controller
{
    public function __construct()
    {   
        $this->middleware('auth');
        $this->middleware('role:admin');
    }

    public function users(){
        $users = User::all();
        return view('users', ['users' => $users]);
    }

    public function addUser(){
        $specialties = Specialty::all();
        $appointments = Appointment::all();
        $roles = Role::all();
        return view('addUser', ['appointments' => $appointments, 'specialties' => $specialties, 'roles' => $roles]);
    }

    public function saveUser(Request $request){
        $rules = ['name' => 'required', 'surname' => 'required', 'middle_name' => 'required',
                'phone' => 'digits:9', 'email' => 'email', 'birth_date' => 'required|before:today',
                'password' => 'required|min:8', 'roles' => 'required', 'appointment' => Rule::notIn(['0']),
                'specialty' => Rule::notIn(['0']),];
        $messages = ['name.required' => 'Ім\'я обов\'язкове до заповнення!', 'surname.required' => 'Прізвище обов\'язкове до заповнення!',
                    'middle_name.required' => 'По батькові обов\'язкове до заповнення!', 'phone.digits' => 'Номер телефону повинен містити 9 цифр!',
                    'email.email' => 'Не коректний email!', 'birth_date.*' => 'Не коректна дата!',
                    'password.*' => 'Пароль повинен містити мінімум 8 сиволів!', 'roles.required' => 'Повинна бути вказана мінімум ондна роль!',
                    'appointment.*' => 'Посада обов\'язково повинна бути вказана!', 'specialty.*' => 'Спеціальність обов\'язково повинна бути вказана!'];
        
        $request->validate($rules, $messages);

        $user = new User;

        $user->name = $request->name;
        $user->surname = $request->surname;
        $user->middle_name = $request->middle_name;
        $user->appointment_id = $request->appointment;
        $user->specialty_id = $request->specialty;
        $user->phone = '+380'.$request->phone;
        $user->birth_date = $request->birth_date;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->save();

        foreach($request->roles as $key => $value){
            $user->roles()->attach(Role::find($key));
        }
        return redirect()->route('users');
    }

    public function editUser($id){
        $user = User::find($id);
        $specialties = Specialty::all();
        $appointments = Appointment::all();
        $roles = Role::all();
        return view('addUser', ['user' => $user, 'appointments' => $appointments, 'specialties' => $specialties, 'roles' => $roles]);
    }

    public function saveEditedUser(Request $request, $id){
        $user = User::find($id);

        $user->name = $request->name;
        $user->surname = $request->surname;
        $user->middle_name = $request->middle_name;
        $user->appointment_id = $request->appointment;
        $user->specialty_id = $request->specialty;
        $user->phone = '+380'.$request->phone;
        $user->birth_date = $request->birth_date;
        $user->email = $request->email;
        if($request->input('password') !== null)
            $user->password = Hash::make($request->password);
        $user->save();
        
        $user->roles()->detach();
        foreach($request->roles as $key => $value){
            $user->roles()->attach(Role::find($key));
        }
        return redirect()->route('users');
    }
}
