<nav class="bg-cyan-900 text-white w-full p-4 flex justify-between items-center gap-4">
    <h1 class="font-black text-2xl">{{ config('app.name', 'Laravel') }}</h1>
    <ul class="flex-1 flex gap-4 text-sm font-thin border-l border-white pl-4">
        <li><a href="{{ route('dashboard') }}">Attendance</a></li>
        <li><a href="{{ route('records:index') }}">Records</a></li>
    </ul>
    <ul class="flex gap-4 text-sm font-thin">
        <li>Hello, <a href="#">{{$user->name}} ({{$user->email}})</a></li>
        <li><a href="{{ route('logout')  }}">Logout</a></li>
    </ul>
</nav>

