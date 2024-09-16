@php
    \Carbon\Carbon::setLocale('es');
    $today = \Carbon\Carbon::now()->isoFormat('dddd D, MMM YYYY');
@endphp

@extends('layouts.app')

@section('content')
    <section class="my-12 flex flex-col items-center">
        <h1 class="text-4xl font-bold text-slate-700">Wecolme, {{ auth()?->user()->name  }} 👋</h1>
        <p class="font-light text-slate-500">don't forget to register your attendance</p>
    </section>
    <section class="mx-auto w-full flex-col justify-center h-[330px]">
        <livewire:dashboard.check-in />
        <livewire:dashboard.check-out />
    </section>

    <section class="my-12 flex flex-col items-center">
        <p class="border-0 w-full text-center mt-8 bg-transparent capitalize text-slate-600 text-lg focus:ring-0">
                {{ $today }}
        </p>
    </section>

@endsection
