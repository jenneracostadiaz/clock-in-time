<div class="w-full flex flex-col items-center">
    @if($showingCheckOut)
        <button class="open-checkout relative w-[330px] h-[330px] [&>div]:hover:rotate-45 [&>div>div]:hover:rotate-90 [&>div>div>div]:hover:rotate-45 [&>div]:focus:-rotate-45 [&>div>div]:focus:-rotate-90 [&>div>div>div]:focus:-rotate-45"
              wire:click="checkOut"
        >
            <div
                id="bg-bottom"
                class="w-[330px] h-[330px] bg-gradient-to-r from-cyan-800 to-cyan-50 rounded-full text-white text-2xl font-bold shadow-2xl flex justify-center items-center transition-all rotate-0">
                <div
                    id="bg-center"
                    class="w-[320px] h-[320px] bg-gradient-to-r from-white to-cyan-50 rounded-full text-white text-2xl font-bold  flex justify-center items-center rotate-0">
                    <div
                        id="bg-font"
                        class="w-[310px] h-[310px] bg-gradient-to-r from-cyan-900 to-cyan-700 rounded-full text-white flex flex-col justify-center items-center transition-all rotate-0 hover:rotate-12"
                    >
                    </div>
                </div>
            </div>

            <section class="absolute top-0 left-0 right-0 bottom-0 flex flex-col justify-center items-center text-white">
                <input name="counter" id="counter" class="cursor-pointer text-5xl pt-10 bg-transparent text-center border-0 ring-0 focus:ring-0" value="00:00:00" readonly />
                <p>Click for check-out</p>
                <p class="text-xs">Entrance: {{ $initial_counter }}</p>
            </section>
        </button>

        <script>
            const initial_counter = `{{ $initial_counter }}`;
            let counter = document.getElementById('counter');

            function updateCounter() {
                let currentTime = new Date();
                let startTime = new Date();
                let [hours, minutes, seconds] = initial_counter.split(':');
                startTime.setHours(hours, minutes, seconds);

                let timeDiff = currentTime - startTime;
                if (timeDiff > 0) {
                    let hours = Math.floor((timeDiff % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
                    let minutes = Math.floor((timeDiff % (1000 * 60 * 60)) / (1000 * 60));
                    let seconds = Math.floor((timeDiff % (1000 * 60)) / 1000);

                    counter.value = `${String(hours).padStart(2, '0')}:${String(minutes).padStart(2, '0')}:${String(seconds).padStart(2, '0')}`;
                } else {
                    counter.value = "00:00:00";
                }
            }

            setInterval(updateCounter, 1000);
        </script>
    @endif
    <style>
        .open-checkout{
            animation: open-checkout 2s;
        }

        @keyframes open-checkout {
            0% {
                transform: rotate(0deg) scale(0);
            }
            50% {
                transform: rotate(360deg) scale(0);
            }
            100% {
                transform: rotate(0deg) scale(1);
            }
        }
    </style>
</div>

