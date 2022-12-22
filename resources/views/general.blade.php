@extends('layouts.content')

@section('container')
    <ul class="marginlog">
        <a class="btn btn-warning" href="{{ route('logout') }}" role="button">Logout</a>
    </ul>

    <div class="wrapper position">
        <div class="circle"></div>
        <div class="circle"></div>
        <div class="circle"></div>
        <div class="shadow"></div>
        <div class="shadow"></div>
        <div class="shadow"></div>
    </div>

    <h6 class="fm">Halaman bisa diakses oleh semua pengguna</h6>
@endsection
