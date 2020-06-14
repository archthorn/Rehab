@extends('layouts.app')

@section('content')
<div class="container">
    <form action="{{ route('saveCourse') }}" method="post">
        @csrf
        <div class="form-row">
            <div class="form-group col-md-11">
                <label for="prescription">Призначення курсу:</label>
                <input type="text" class="form-control @error('prescription') is-invalid @enderror" id="prescription" name="prescription"  value="{{ old('prescription') }}">
                @error('prescription')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>
            <div class="form-group col-md-1">
                <label for="term">Термін:</label>
                <input type="number" class="form-control @error('prescription') is-invalid @enderror" id="term" name="term" min="1" max="30" placeholder="Днів" value="{{ old('term') }}">
                @error('term')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>
        </div>
        <button type="submit" class="btn btn-primary">Додати курс</button>
    </form>
</div>
@endsection