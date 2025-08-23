        <div class="bg-white flex-grow md:w-[20rem] lg:w-[18rem] h-[250px] shadow-md flex flex-col items-center justify-center p-2 rounded-md relative overflow-hidden">
            <!-- Nama Indikator Dinamis dengan Pembatasan Lebar dan Pembungkusan -->
            <p class="text-gray-500 text-sm text-center font-bold w-full max-w-[30rem] overflow-hidden" style="display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical; white-space: normal;">
                {{ $ind->indikator }}
            </p>
            <div class="flex justify-center items-center gap-2 flex-col w-full h-4/5">
                <div class="flex items-center gap-4">
                    <p class="font-medium text-6xl">{{ $ind->jumlah }}</p>
                </div>
                <div class="flex items-center gap-2 {{ $ind->persentase >= 0 ? 'text-green-400' : 'text-red-400' }}">
                    <i class="fa-solid {{ $ind->persentase >= 0 ? 'fa-angle-up' : 'fa-angle-down' }} text-2xl"></i>
                    <!-- Tampilkan Persentase Kinerja -->
                    <p class="font-medium text-3xl">{{ round(abs($ind->persentase), 2) }}%</p>
                </div>
                <p class="text-sm text-gray-500 mt-5">Dalam 30 hari terakhir</p>
            </div>
            <div class="absolute h-[3px] w-full {{ $ind->persentase >= 0 ? 'bg-green-500' : 'bg-red-500' }} bottom-0"></div>
        </div>
