<?php

namespace App\Http\Controllers;

use App\Http\Models\Course;
use App\Http\Models\Diagnosis;
use App\Http\Models\Patient;
use App\Http\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\Console\Input\Input;

class PatientsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function patients(Request $request){
        $patients = Auth::user()->patients()->orderBy($request->input('sort'), 'asc')->paginate(15);
        $courses = Course::all();
        return view('patients', ['patients' => $patients, 'courses' => $courses]);
    }

    public function addPatient(){
        $diagnoses = Diagnosis::all();
        return view('addPatient', ['diagnoses' => $diagnoses]);
    }

    public function savePatient(Request $request){
        $rules = ['name' => 'required', 'surname' => 'required', 'middle_name' => 'required',
                'phone' => 'digits:9', 'email' => 'email', 'birth_date' => 'required|before:today',
                'address' => 'required', 'diagnosis' => 'required',];
        $messages = ['name.required' => 'Ім\'я обов\'язкове до заповнення!', 'surname.required' => 'Прізвище обов\'язкове до заповнення!',
                    'middle_name.required' => 'По батькові обов\'язкове до заповнення!', 'phone.digits' => 'Номер телефону повинен містити 9 цифр!',
                    'email.email' => 'Не коректний email!', 'birth_date.*' => 'Не коректна дата!',
                    'address.required' => 'Адреса обов\'язкова до заповнення!', 'diagnosis.required' => 'Діагноз обов\'язковий до заповнення!',];

        $request->validate($rules, $messages);

        $doctor = User::find(Auth::user()->id);
        $patient = new Patient;

        $patient->name = $request->name;
        $patient->surname = $request->surname;
        $patient->middle_name = $request->middle_name;
        $patient->phone = '+380'.$request->phone;
        $patient->birth_date = $request->birth_date;
        $patient->email = $request->email;
        $patient->address = $request->address;

        $diagnosis = Diagnosis::firstOrCreate(['name' => $request->diagnosis]);

        $patient->diagnosis_id = $diagnosis->id;
        $doctor->patients()->save($patient);

        return redirect()->route('patients', ['sort' => 'created_at']);
    }

    public function editPatient($id){
        $patient = Patient::find($id);
        $diagnoses = Diagnosis::all();
        return view('addPatient', ['patient' => $patient, 'diagnoses' => $diagnoses]);
    }

    public function saveEditedPatient(Request $request, $id){
        $rules = ['name' => 'required', 'surname' => 'required', 'middle_name' => 'required',
                'phone' => 'digits:9', 'email' => 'email', 'birth_date' => 'required|before:today',
                'address' => 'required', 'diagnosis' => 'required',];
        $messages = ['name.required' => 'Ім\'я обов\'язкове до заповнення!', 'surname.required' => 'Прізвище обов\'язкове до заповнення!',
                    'middle_name.required' => 'По батькові обов\'язкове до заповнення!', 'phone.digits' => 'Номер телефону повинен містити 9 цифр!',
                    'email.email' => 'Не коректний email!', 'birth_date.*' => 'Не коректна дата!',
                    'address.required' => 'Адреса обов\'язкова до заповнення!', 'diagnosis.required' => 'Діагноз обов\'язковий до заповнення!',];

        $request->validate($rules, $messages);

        $patient = Patient::find($id);

        $patient->name = $request->name;
        $patient->surname = $request->surname;
        $patient->middle_name = $request->middle_name;
        $patient->phone = '+380'.$request->phone;
        $patient->birth_date = $request->birth_date;
        $patient->email = $request->email;
        $patient->address = $request->address;

        $diagnosis = Diagnosis::firstOrCreate(['name' => $request->diagnosis]);

        $patient->diagnosis_id = $diagnosis->id;
        $patient->save();

        return redirect()->route('patients', ['sort' => 'created_at']);
    }
}
