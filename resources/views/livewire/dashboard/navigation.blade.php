<nav class="bg-cyan-900 text-white w-full p-4 flex justify-between items-center gap-4">
    <h1 class="font-black text-2xl">Dashboard Control</h1>
    <ul class="flex-1 flex gap-4 text-sm font-thin border-l border-white pl-4">
        <li><a href="#">Attendance</a></li>
        <li><a href="#">Records</a></li>
    </ul>
    <ul class="flex gap-4 text-sm font-thin">
        <li>Hello, <a href="#">{{$user->name}} ({{$user->email}})</a></li>
        <li><a href="#">Logout</a></li>
    </ul>
</nav>

