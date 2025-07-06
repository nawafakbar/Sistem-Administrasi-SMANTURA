<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Detail Berita</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">

</head>
<body>
    <div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-lg-10">

            {{-- Judul & Tanggal --}}
            <div class="text-center mb-4">
                <h1 class="display-6 fw-bold">{{ $berita->judul }}</h1>
                <p class="text-muted mt-2">
                    <i class="bi bi-calendar-event me-1"></i>
                    {{ \Carbon\Carbon::parse($berita->tanggal_publish)->translatedFormat('d F Y') }}
                </p>
            </div>

            {{-- Gambar --}}
            @if($berita->gambar)
                <div class="mb-4 text-center">
                    <img src="{{ asset('storage/' . $berita->gambar) }}"
                         class="img-fluid rounded-3 shadow"
                         style="max-height: 450px; object-fit: cover;"
                         alt="{{ $berita->judul }}">
                </div>
            @endif

            {{-- Konten --}}
            <div class="konten-berita px-1 px-md-4 fs-5 lh-lg mb-5">
                {!! nl2br(e($berita->konten)) !!}
            </div>

            {{-- Tombol Kembali --}}
            <div class="text-center">
                <a href="/" class="btn btn-outline-primary btn-lg">
                    <i class="bi bi-arrow-left-circle me-1"></i> Kembali
                </a>
            </div>

        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4"
        crossorigin="anonymous"></script>
</body>
</html>