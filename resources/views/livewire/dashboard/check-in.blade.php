<div class="w-full flex flex-col items-center">
    <button class="relative w-[330px] h-[330px] [&>div]:hover:rotate-45 [&>div>div]:hover:rotate-90 [&>div>div>div]:hover:rotate-45 [&>div]:focus:-rotate-45 [&>div>div]:focus:-rotate-90 [&>div>div>div]:focus:-rotate-45
    " wire:click="checkIn">
        <div
            id="bg-bottom"
            class="w-[330px] h-[330px] bg-gradient-to-r from-cyan-800 to-cyan-50 rounded-full text-white text-2xl font-bold shadow-2xl flex justify-center items-center transition-all rotate-0">
            <div
                id="bg-center"
                class="w-[320px] h-[320px] bg-gradient-to-r from-white to-cyan-50 rounded-full text-white text-2xl font-bold shadow-2xl flex justify-center items-center rotate-0">
                <div
                    id="bg-font"
                    class="w-[310px] h-[310px] bg-gradient-to-r from-cyan-900 to-cyan-700 rounded-full text-white flex flex-col justify-center items-center transition-all rotate-0 hover:rotate-12"
                >
                </div>
            </div>
        </div>
        <span class="absolute top-0 left-0 right-0 bottom-0 flex justify-center items-center text-white text-5xl">00:00:00</span>
    </button>

    <input wire:model="today" name="today" id="today"
           class="border-0 w-full text-center mt-8 bg-transparent capitalize text-slate-600 text-lg focus:ring-0"
           readonly>
</div>
