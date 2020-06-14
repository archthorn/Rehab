@extends('layouts.app')

@section('content')
    <div class="container">
        <table class="table table-sm table-striped table-responsive-md">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">ПІБ</th>
                    <th scope="col">Посада</th>
                    <th scope="col">Спеціальність</th>
                    <th scope="col">Дата народження</th>
                    <th scope="col">Телефон</th>
                    <th scope="col">Email</th>
                    <th scope="col">Ролі</th>
                    <th scope="col"><a href="{{ route('addUser') }}"><i class="fas fa-plus"></i></a></th>
                </tr>
            </thead>
            <tbody>
                @foreach($users as $user)
                <tr>
                    <th scope="row">{{ $user->id }}</th>
                    <td>{{ $user->getFullName() }}</td>
                    <td>{{ $user->appointment->name }}</td>
                    <td>{{ $user->specialty->name }}</td>
                    <td>{{ $user->birth_date }}</td>
                    <td>{{ $user->phone }}</td>
                    <td>{{ $user->email }}</td>
                    <td>{{ implode(', ', $user->roles()->pluck('name')->toArray()) }}</td>
                    <td><a href="{{ route('editUser', $user->id) }}" class="text-secondary"><i class="fas fa-edit"></i></a></i></td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection