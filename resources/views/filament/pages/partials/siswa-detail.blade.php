<div class="space-y-4">
    <div class="flex items-center gap-4">
        <img src="{{ Storage::url($record->gambar) }}" alt="Foto Siswa" class="w-20 h-20 rounded-full object-cover">
        <div>
            <h2 class="text-lg font-bold">{{ $record->nama }}</h2>
            <p class="text-sm text-gray-600">NISN: {{ $record->nisn }}</p>
        </div>
    </div>

    <div class="grid grid-cols-2 gap-4">
        <div><strong>Email:</strong> {{ $record->email ?? '-' }}</div>
        <div><strong>Jenis Kelamin:</strong> {{ $record->jenis_kelamin === 'L' ? 'Laki-laki' : 'Perempuan' }}</div>
        <div><strong>Tahun Masuk:</strong> {{ $record->tahun_masuk }}</div>
        <div><strong>Tanggal Lahir:</strong> {{ $record->tanggal_lahir ? \Carbon\Carbon::parse($record->tanggal_lahir)->format('d M Y') : '-' }}</div>
    </div>
</div>
