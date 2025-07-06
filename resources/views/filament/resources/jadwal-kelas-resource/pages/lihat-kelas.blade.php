<x-filament::page>
    {{ $this->form }}

    @if ($selectedKelasId)
    <a href="{{ route('lihat-kelas.cetak-pdf', ['kelas' => $selectedKelasId]) }}"
       target="_blank"
   style="background-color: #dc2626; color: white; padding: 6px 12px; border-radius: 4px; text-decoration: none; width: 110px">
    Cetak PDF
    </a>
        <div class="overflow-x-auto rounded-xl shadow-md mt-6">
            <table class="w-full text-sm text-left border border-gray-200 bg-white">
                <thead class="bg-gray-100 text-gray-700 uppercase text-xs">
                    <tr>
                        <th class="border px-4 py-3 font-medium w-12 text-center">#</th>
                        <th class="border px-4 py-3 font-medium">Nama Siswa</th>
                        <th class="border px-4 py-3 font-medium">NISN</th>
                        <th class="border px-4 py-3 font-medium text-center">Tahun Ajaran</th>
                    </tr>
                </thead>
                <tbody class="text-gray-700">
                    @php $no = $this->getNoStart(); @endphp
                    @forelse ($this->getSiswaByKelas() as $index => $item)
                        <tr class="hover:bg-gray-50 transition">
                            <td class="border px-4 py-3 text-center">{{ $no++ }}</td>
                            <td class="border px-4 py-3">{{ $item->siswa->nama }}</td>
                            <td class="border px-4 py-3">{{ $item->siswa->nisn }}</td>
                            <td class="border px-4 py-3 text-center">{{ $item->tahun_ajaran }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="3" class="border px-4 py-3 text-center text-gray-500">
                                Tidak ada siswa dalam kelas ini.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    @endif
</x-filament::page>
