@extends('layouts.content')

@section('container')
    <ul class="marginlog">
        <a class="btn btn-warning" href="{{ route('logout') }}" role="button">Logout</a>
    </ul>

    <div class="planet position">
    </div>

    <h6 class="fmd">Halaman hanya bisa diakses oleh admin</h6>
@endsection
