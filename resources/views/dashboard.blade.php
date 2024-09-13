@extends('layouts.app')

@section('content')
    <section class="my-12 flex flex-col items-center">
        <h1 class="text-4xl font-bold text-slate-700">Wecolme, {{ auth()->user()->name  }} 👋</h1>
        <p class="font-light text-slate-500">don't forget to register your attendance</p>
    </section>
    <section class="mx-auto w-full flex justify-center">
        @livewire('dashboard.check-in')
    </section>
@endsection
