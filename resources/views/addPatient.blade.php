@extends('layouts.app')

@section('content')
<div class="container">
    <form action="{{ Route::is('editPatient') ? route('saveEditedPatient', $patient->id) : route('savePatient') }}" method="POST">
        @csrf
        <div class="form-row">
            <div class="form-group col-md-4">
                <label for="name">Ім'я:</label>
                <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" @isset($patient) value="{{ $patient->name }}" @endisset value="{{ old('name') }}">
                @error('name')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>
            <div class="form-group col-md-4">
                <label for="surname">Прізвище:</label>
                <input type="text" class="form-control @error('surname') is-invalid @enderror" id="surname" name="surname"  @isset($patient) value="{{ $patient->surname }}" @endisset value="{{ old('surname') }}">
                @error('surname')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>
            <div class="form-group col-md-4">
                <label for="middle_name">По батькові:</label>
                <input type="text" class="form-control @error('middle_name') is-invalid @enderror" id="middle_name" name="middle_name" @isset($patient) value="{{ $patient->middle_name }}" @endisset  value="{{ old('middle_name') }}">
                @error('middle_name')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>
        </div>
        <div class="form-row">
            <div class="form-group col-md-4">
                <label for="phone">Номер телефону:</label>
                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text">+380</span>
                    </div>
                    <input type="tel" class="form-control @error('phone') is-invalid @enderror" id="phone" name="phone" pattern="[0-9]{9}"  @isset($patient) value="{{ substr($patient->phone, 4) }}" @endisset  value="{{ old('phone') }}">
                    @error('phone')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
            </div>
            <div class="form-group col-md-4">
                <label for="email">Email:</label>
                <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" @isset($patient) value="{{ $patient->email }}" @endisset  value="{{ old('email') }}">
                @error('email')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>
            <div class="form-group col-md-4">
                <label for="birth_date">Дата народження:</label>
                <input type="date" class="form-control @error('birth_date') is-invalid @enderror" id="birth_date" name="birth_date" @isset($patient) value="{{ $patient->birth_date }}" @endisset  value="{{ old('birth_date') }}">
                @error('birth_date')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>
        </div>
        <div class="form-group">
            <label for="address">Адреса:</label>
            <input type="text" class="form-control @error('address') is-invalid @enderror" id="address" name="address" placeholder="Полтавська обл., м. Кременчук, вул. Шевченка, 5, кв. 17" @isset($patient) value="{{ $patient->address }}" @endisset  value="{{ old('address') }}">
            @error('address')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>
        <div class="form-group">
            <label for="diagnosis">Діагноз:</label>
            <input type="text" class="form-control @error('diagnosis') is-invalid @enderror" id="diagnosis" name="diagnosis" list="diagnoses" autocomplete="off" @isset($patient) value="{{ $patient->diagnosis->name }}" @endisset  value="{{ old('diagnosis') }}">
            <datalist id="diagnoses">
                @foreach($diagnoses as $diagnosis)
                <option value="{{ $diagnosis->name }}"></option>
                @endforeach
            </datalist>
            @error('diagnosis')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>
        <button type="submit" class="btn btn-primary">{{ Route::is('editPatient') ? 'Зберегти зміни' : 'Додати пацієнта' }}</button>
    </form>
</div>
@endsection