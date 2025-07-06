<x-filament::page>
    {{ $this->form }}

    {{-- Tabel Jadwal --}}
        @if ($selectedKelasId)
            <div class="overflow-x-auto rounded-xl shadow-md">
                <table class="w-full text-sm text-left border border-gray-200 bg-white">
                    <thead class="bg-gray-100 text-gray-700 uppercase text-xs">
                        <tr>
                            <th class="border px-4 py-3 font-medium">Waktu</th>
                            @foreach (['Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu'] as $hari)
                                <th class="border px-4 py-3 font-medium text-center">{{ $hari }}</th>
                            @endforeach
                        </tr>
                    </thead>
                    <tbody class="text-gray-700">
                        @foreach ($this->getGroupedJadwal() as $jam => $mapelPerHari)
                            <tr class="hover:bg-gray-50 transition">
                                <td class="border px-4 py-3 font-semibold text-sm bg-gray-50">{{ $jam }}</td>
                                @foreach (['Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu'] as $hari)
                                    <td class="border px-4 py-3 text-center">
                                        @php $mapel = $mapelPerHari[$hari] ?? null; @endphp
                                        @if ($mapel)
                                            <span class="font-medium text-blue-600">{{ $mapel }}</span>
                                        @else
                                            <span class="text-gray-400">-</span>
                                        @endif
                                    </td>
                                @endforeach
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endif
</x-filament::page>
