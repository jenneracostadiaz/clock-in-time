<div class="w-full flex flex-col items-center">
    <div
        class="w-[330px] h-[330px] bg-gradient-to-r from-cyan-800 rounded-full text-white text-2xl font-bold shadow-2xl flex justify-center items-center transition-all hover:bg-gradient-to-tl">
        <div
            class="w-[320px] h-[320px] bg-white rounded-full text-white text-2xl font-bold shadow-2xl flex justify-center items-center">
            <button
                class="w-[310px] h-[310px] bg-cyan-900 bg-gradient-to-r from-cyan-600 rounded-full text-white flex flex-col justify-center items-center relative transition-all hover:bg-gradient-to-bl"
                wire:click="checkIn"
            >
                <span class="text-5xl">00:00:00</span>
            </button>
        </div>
    </div>

    <input wire:model="today" name="today" id="today"
           class="border-0 w-full text-center mt-8 bg-transparent capitalize text-slate-600 text-lg focus:ring-0"
           readonly>
</div>
