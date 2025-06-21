<x-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Pengaturan Waktu PJU') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="p-6 sm:px-20 bg-white border-b border-gray-200">
                    <div class="mt-8 text-2xl">
                        Kontrol Smart PJU Desa Kepyar
                    </div>
                    <div class="mt-6 text-gray-500">
                        <p>Berikut adalah kontrol untuk mengatur jadwal PJU Desa Kepyar.</p>
                    </div>
                    <!-- Slider Section in One Row -->
                    <div class="mt-6 flex flex-wrap gap-6 items-center justify-center">
                        @foreach ($timers as $timer)
                            <div class="flex flex-col items-center">
                                <span class="mb-2">PJU {{ $timer->pju_id }}</span>
                                <label class="switch">
                                    <input type="checkbox" id="toggle-{{ $timer->pju_id }}" {{ $timer->condition ? 'checked' : '' }} onchange="updateCondition({{ $timer->pju_id }}, this.checked ? 1 : 0)">
                                    <span class="slider round"></span>
                                </label>
                                <span id="condition-{{ $timer->pju_id }}" class="mt-2 text-gray-600">{{ $timer->condition ? 'On' : 'Off' }}</span>
                            </div>
                        @endforeach
                    </div>
                </div>

                <div class="p-6 sm:px-20 bg-white border-b border-gray-200">
                    <div class="grid grid-cols-2 gap-2">
                        <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                            <div class="p-6 sm:px-20 bg-white border-b border-gray-200">
                                <div class="mt-8 text-2xl">
                                    Pengaturan PJU
                                </div>
                                <div class="mt-6 text-gray-500">
                                    <p>Atur jadwal PJU Desa Kepyar.</p>
                                </div>
                                <div class="mt-6">
                                    <form action="{{ route('timers.store') }}" method="POST" id="timer-form">
                                        @csrf
                                        <div class="flex flex-col justify-center">
                                            <label for="pju-select" class="text-lg font-medium mb-2">Pilih PJU</label>
                                            <select id="pju-select" name="pju_id" class="w-48 text-center">
                                                @foreach ($timers as $timer)
                                                    <option value="{{ $timer->pju_id }}">PJU {{ $timer->pju_id }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="flex flex-col justify-center">
                                            <label for="timer-on" class="text-lg font-medium mb-2">Menyala</label>
                                            <input type="time" id="timer-on" name="on_time" class="w-48 text-center" value="{{ old('on_time', '00:00') }}">
                                        </div>
                                        <div class="flex flex-col justify-center">
                                            <label for="timer-off" class="text-lg font-medium mb-2">Mati</label>
                                            <input type="time" id="timer-off" name="off_time" class="w-48 text-center" value="{{ old('off_time', '00:00') }}">
                                        </div>
                                        <div class="mt-6">
                                            <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded" id="save-timer">Simpan</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                            <div class="p-6 sm:px-20 bg-white border-b border-gray-200">
                                <div class="mt-8 text-2xl">
                                    Jadwal PJU
                                </div>
                                <div class="mt-6 text-gray-500">
                                    <p>Jadwal PJU menyala dan mati.</p>
                                </div>
                                <!-- Carousel with Alpine.js -->
                                <div x-data="{ currentPage: 1, perPage: 5 }" class="mt-6">
                                    <!-- PJU List -->
                                    <div class="grid grid-cols-1 gap-6">
                                        @foreach ($timers as $timer)
                                            <template x-if="(currentPage - 1) * perPage <= {{ $loop->index }} && {{ $loop->index }} < currentPage * perPage">
                                                <div class="flex items-center justify-between">
                                                    <div class="flex items-center">
                                                        <label for="pju-{{ $timer->pju_id }}" class="block text-sm font-medium text-gray-700">PJU {{ $timer->pju_id }}</label>
                                                    </div>
                                                    <div class="flex items-center ml-4">
                                                        <span id="timer{{ $timer->pju_id }}-on" class="w-20 text-center">{{ $timer->on_time }}</span>
                                                        <span class="mx-2">sampai</span>
                                                        <span id="timer{{ $timer->pju_id }}-off" class="w-20 text-center">{{ $timer->off_time }}</span>
                                                    </div>
                                                </div>
                                            </template>
                                        @endforeach
                                    </div>
                                    <!-- Pagination Buttons -->
                                    <div class="flex justify-center mt-6">
                                        <button @click="currentPage = Math.max(currentPage - 1, 1)" 
                                                class="px-4 py-2 bg-gray-300 rounded hover:bg-gray-400">
                                            &lt;
                                        </button>
                                        <button @click="currentPage++" 
                                                class="px-4 py-2 ml-4 bg-gray-300 rounded hover:bg-gray-400"
                                                :disabled="currentPage * perPage >= {{ $timers->count() }}">
                                            &gt;
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <script>
        function updateCondition(pju_id, condition) {
            axios.defaults.headers.common['X-CSRF-TOKEN'] = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

            axios.post('/timers/updateCondition', {
                pju_id: pju_id,
                condition: condition
            })
            .then(response => {
                document.getElementById(`condition-${pju_id}`).innerText = condition ? 'On' : 'Off';
            })
            .catch(error => {
                console.error(error);
                alert('Terjadi kesalahan saat memperbarui kondisi.');
            });
        }

        function updateConditionBasedOnTime() {
            axios.post('/timers/updateConditionBasedOnTime')
                .then(response => {
                    console.log(response.data.message);
                    // Handle response jika perlu
                })
                .catch(error => {
                    console.error('Terjadi kesalahan saat memperbarui kondisi berdasarkan waktu.', error);
                });
        }

        // Panggil fungsi setiap menit untuk memperbarui kondisi
        setInterval(updateConditionBasedOnTime, 500); // Setiap 1 menit (60000 milidetik)

        // // Memeriksa dan mengupdate condition sesuai waktu saat ini
        // function updateConditionsAutomatically() {
        //     const currentTime = getCurrentTime();
            
        //     // Loop melalui setiap timer
        //     @foreach ($timers as $timer)
        //         const onTime_{{ $timer->pju_id }}= "{{ $timer->on_time }}";
        //         const offTime_{{ $timer->pju_id }}= "{{ $timer->off_time }}";
        //         const condition_{{ $timer->pju_id }}= document.getElementById(`toggle-{{ $timer->pju_id }}`);
        //         console.log("waktu saat ini", getCurrentTime());
        //         if (currentTime === onTime_{{ $timer->pju_id }}) {
        //             condition_{{ $timer->pju_id }}.checked = true;
        //             updateCondition({{ $timer->pju_id}}, 1);
        //             alert('data berhasil diubah.');
        //         } else if (currentTime === offTime_{{ $timer->pju_id }}) {
        //             condition_{{ $timer->pju_id }}.checked = false;
        //             updateCondition({{ $timer->pju_id }}, 0);
        //             console.log('Terjadi kesalahan saat memperbarui kondisi.');
        //         }
        //         else{
        //             console.log('tidak terjadi perubahan');
        //         }
        //     @endforeach
        // }

        // // Panggil updateConditionsAutomatically setiap menit untuk memperbarui kondisi
        // setInterval(updateConditionsAutomatically, 1000);
    </script>
</x-layout>
<style>
    .switch {
        position: relative;
        display: inline-block;
        width: 60px;
        height: 34px;
    }

    .switch input {
        opacity: 0;
        width: 0;
        height: 0;
    }

    .slider {
        position: absolute;
        cursor: pointer;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background-color: #ccc;
        transition: .4s;
    }

    .slider:before {
        position: absolute;
        content: "";
        height: 26px;
        width: 26px;
        left: 4px;
        bottom: 4px;
        background-color: white;
        transition: .4s;
    }

    input:checked + .slider {
        background-color: #4CAF50;
    }

    input:focus + .slider {
        box-shadow: 0 0 1px #4CAF50;
    }

    input:checked + .slider:before {
        transform: translateX(26px);
    }

    .slider.round {
        border-radius: 34px;
    }

    .slider.round:before {
        border-radius: 50%;
    }
</style>
