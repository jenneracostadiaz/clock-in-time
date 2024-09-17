<nav class="bg-cyan-900 text-white w-full p-6 flex justify-between items-center gap-6">
    <h1 class="font-black text-2xl">
        <a href="{{ route('dashboard') }}">{{ config('app.name', 'Laravel') }}</a>
    </h1>
    <ul class="flex-1 flex gap-4 font-thin border-l border-white pl-4">
        <li><a href="{{ route('dashboard') }}">Attendance</a></li>
        <li><a href="{{ route('records:index') }}">Records</a></li>
    </ul>
    <ul class="flex gap-4 font-thin">
        <li>Hello, <a href="#">{{$user->name}} ({{$user->email}})</a></li>
        <li><a href="{{ route('logout')  }}">Logout</a></li>
    </ul>
</nav>

