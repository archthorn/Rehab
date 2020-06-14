@extends('layouts.app')

@section('content')
<div class="container">
    <form action="{{ Route::is('editUser') ? route('saveEditedUser', $user->id) : route('saveUser') }}" method="POST">
        @csrf
        <div class="form-row">
            <div class="form-group col-md-4">
                <label for="name">Ім'я:</label>
                <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" @isset($user) value="{{ $user->name }}" @endisset value="{{ old('name') }}">
                @error('name')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>
            <div class="form-group col-md-4">
                <label for="surname">Прізвище:</label>
                <input type="text" class="form-control @error('surname') is-invalid @enderror" id="surname" name="surname" @isset($user) value="{{ $user->surname }}" @endisset value="{{ old('surname') }}">
                @error('surname')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>
            <div class="form-group col-md-4">
                <label for="middle_name">По батькові:</label>
                <input type="text" class="form-control @error('middle_name') is-invalid @enderror" id="middle_name" name="middle_name" @isset($user) value="{{ $user->middle_name }}" @endisset value="{{ old('middle_name') }}">
                @error('middle_name')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>
        </div>
        <div class="form-row">
            <div class="form-group col-md-6">
                <label for="appointment">Посада:</label>
                <select class="form-control @error('appointment') is-invalid @enderror" id="appointment" name="appointment">
                <option value="0">...</option>
                    @foreach($appointments as $appointment)
                    <option @isset($user) {{ $user->appointment_id === $appointment->id ? 'selected' : '' }} @endisset value="{{ $appointment->id }}">{{ $appointment->name }}</option>
                    @endforeach
                </select>
                @error('appointment')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>
            <div class="form-group col-md-6">
                <label for="specialty">Спеціальність:</label>
                <select class="form-control @error('specialty') is-invalid @enderror" id="specialty" name="specialty">
                    <option value="0">...</option>
                    @foreach($specialties as $specialty)
                    <option @isset($user) {{ $user->specialty_id === $specialty->id ? 'selected' : '' }} @endisset value="{{ $specialty->id }}">{{ $specialty->name }}</option>
                    @endforeach
                </select>
                @error('specialty')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>
        </div>
        <div class="form-row">
            <div class="form-group col-md-6">
                <label for="phone">Номер телефону:</label>
                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text">+380</span>
                    </div>
                    <input type="tel" class="form-control @error('phone') is-invalid @enderror" id="phone" name="phone" pattern="[0-9]{9}" @isset($user) value="{{ substr($user->phone, 4) }}" @endisset value="{{ old('phone') }}">
                    @error('phone')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
            </div>
            <div class="form-group col-md-6">
                <label for="birth_date">Дата народження:</label>
                <input type="date" class="form-control @error('birth_date') is-invalid @enderror" id="birth_date" name="birth_date" @isset($user) value="{{ $user->birth_date }}" @endisset value="{{ old('birth_date') }}">
                @error('birth_date')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>
        </div>
        <div class="form-row">
            <div class="form-group col-md-6">
                <label for="email">Email:</label>
                <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" @isset($user) value="{{ $user->email }}" @endisset value="{{ old('email') }}">
                @error('email')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>
            <div class="form-group col-md-6">
                <label for="password">Пароль:</label>
                <input type="password" class="form-control @error('password') is-invalid @enderror" id="password" name="password">
                @error('password')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>
        </div>
        <div class="form-group">
            <label for="check-group">Ролі користувача:</label>
            <div id="check-group">
                @foreach($roles as $role)
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="checkbox" id="{{ $role->name }}" name="roles[{{$role->id}}]" value="{{ $role->name }}" @isset($user) {{ $user->hasRole($role->name) ? 'checked' : '' }} @endisset>
                    <label class="form-check-label" for="{{ $role->name }}">
                        {{ $role->name }}
                    </label>
                </div>
                @endforeach
            </div>
            @error('roles')
                <span class="badge text-danger" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
        <button type="submit" class="btn btn-primary">{{ Route::is('editUser') ? 'Зберегти зміни' : 'Додати користувача' }}</button>
    </form>
</div>
@endsection