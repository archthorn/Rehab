@extends('layouts.app')

@section('content')
    <div class="container">
        <form id="sort-form" class="form-inline mb-4" method="GET">
            <div class="form-group mr-2">
                <label class="col-form-label col-sm-4" for="sort">Сортувати: </label>
                <select class="form-control col-sm-8" name="sort" id="sort" onchange="$('#sort-form').submit()">
                    <option @if(request()->input('sort') === 'patients.name') selected @endif value="patients.name">Ім'я</option>
                    <option @if(request()->input('sort') === 'patients.surname') selected @endif value="patients.surname">Прізвище</option>
                    <option @if(request()->input('sort') === 'passed_days') selected @endif value="passed_days">Пройдені дні</option>
                    <option @if(request()->input('sort') === 'created_at') selected @endif value="created_at">Дата додавання</option>
                </select>
            </div>
            <div class="form-group mr-2">
                <label class="col-form-label col-sm-4" for="filter_status">Статус: </label>
                <select class="form-control col-sm-8" name="filter_status" id="filter_status" onchange="$('#sort-form').submit()">
                    <option value="">Усі</option>
                    @foreach(App\Http\Models\Treatment::STATUS as $status)
                    <option @if(request()->input('filter_status') === $status) selected @endif>{{ $status }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label class="col-form-label col-sm-6" for="filter_re_taking">Перепроходження: </label>
                <select class="form-control col-sm-6" name="filter_re_taking" id="filter_re_taking" onchange="$('#sort-form').submit()">
                    <option @if(request()->input('filter_re_taking') === '') selected @endif value="">Усі</option>
                    <option @if(request()->input('filter_re_taking') === 'true') selected @endif value="true">Потрібно</option>
                    <option @if(request()->input('filter_re_taking') === 'false') selected @endif value="false">Не потрібно</option>
                </select>
            </div>
        </form>
        
        @if($treatments->isEmpty())
        <h3>Курсів немає!</h3>
        @endif
        @foreach($treatments as $treatment)
        <div class="card mb-3">
            <div class="card-body">
                <p class="card-text mb-0"><strong>Пацієнт: </strong>{{ $treatment->patient->getFullName() }}</p>
                <p class="card-text mb-0"><strong>Відповідальний лікар: </strong>{{ $treatment->patient->doctor->getFullName() }}</p>
                <p class="card-text"><strong>Призначення курсу: </strong>{{ $treatment->course->prescription }}</p>
                <form action="{{ route('updateTreatment', $treatment->id) }}" method="POST">
                    @csrf
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label" for="status"><strong>Статус: </strong></label>
                        <select class="form-control col-sm-2" name="status" id="status">
                            @foreach(App\Http\Models\Treatment::STATUS as $status)
                            <option @if($status === $treatment->status) selected @endif>{{ $status }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label" for="passed_days"><strong>Пройдено днів: </strong></label>
                        <input class="form-control col-sm-1" name="passed_days" id="passed_days" type="number" min="0" max="{{ $treatment->course->term }}" value="{{ $treatment->passed_days }}">
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label" for="results"><strong>Рузультати: </strong></label>
                        <textarea class="form-control col-sm-8" name="results" id="results">{{ $treatment->results }}</textarea>
                    </div>
                    <div class="form-group form-check form-check-inline">
                        <label class="form-check-label mr-2" for="re_taking"><strong>Потреба в повторному проходженні: </strong></label>
                        <input class="form-check-input" id="re_taking" name="re_taking" type="checkbox" @if($treatment->re_taking) checked @endif>
                    </div><br>
                    <button class="btn btn-primary" type="reset">Скинути</button>
                    <button class="btn btn-primary" type="submit">Зберегти</button>
                    <a href="{{ route('exportTreatment', $treatment->id) }}" class="btn btn-primary">Завантажити документ</a>
                </form>
            </div>
        </div>
        @endforeach
        {{ $treatments->appends(request()->input())->links() }}
    </div>
@endsection