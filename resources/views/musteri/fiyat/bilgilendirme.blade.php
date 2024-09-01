@extends('layouts.main')

@section('content')
<div class="container-fluid">
    <h1>Bilgilendirme</h1>
    <p>Burada neler yapılacağına dair bilgilendirmeyi yazabilirsiniz.</p>

    <form action="{{ route('confirmRead') }}" method="POST">
        @csrf
        <label>
            <input type="checkbox" name="read_confirm" required> Okudum, anladım
        </label>
        <div>
            <label for="subject">İzin Konusu:</label>
            <input type="text" name="subject" id="subject" required>
        </div>
        <button type="submit">Devam Et</button>
    </form>
</div>
@endsection