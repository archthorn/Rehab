@extends('layouts.app')

@section('content')
<div class="container">
    <div class="d-flex justify-content-end mb-4">
        <a href="{{ route('addCourse') }}" class="btn btn-primary">Додати курс</a>
    </div>
    @if($courses->isEmpty())
    <h3>Курсів немає!</h3>
    @endif
    @foreach($courses as $course)
    <div class="card mb-3">
        <div class="card-body">
            <p class="card-text mb-0"><strong>Призначення курсу: </strong>{{ $course->prescription }}</p>
            <p class="card-text mb-0"><strong>Стандартний строк проходження курсу, днів: </strong>{{ $course->term }}</p>
            <p class="card-text mb-0"><strong>Активних курсів: </strong>{{ $course->activeCourses()->count() }}</p>
            <p class="card-text mb-0"><strong>Пройдених курсів: </strong>{{ $course->passedCourses()->count() }}</p>
            <p class="card-text mb-0"><strong>Перерваних курсів: </strong>{{ $course->interruptedCourses()->count() }}</p>
            <p class="card-text"><strong>Всього курсів: </strong>{{ $course->treatments()->count() }}</p>
        </div>
    </div>
    @endforeach
    {{ $courses->links() }}
</div>
@endsection