<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Pendaftaran Siswa</title>
    <link rel="stylesheet" href="{{ asset('Assets/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('Assets/boxicons/css/boxicons.css') }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">

    <style>
        a {
            text-decoration: none;
        }
    </style>
</head>
<body>

    <nav class="navbar navbar-expand-lg" style="background: #001f3f">
    <div class="container-fluid">
        <h4 class="mb-0 py-3 text-white">SMA Negeri Situraja</h4>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
        </button>
    </div>
    </nav>

    <div class="container my-4">
    <h3 class="mb-4">Lihat Jadwal Kelas</h3>

    <form method="GET" action="{{ route('jadwal.kelas') }}" class="mb-4">
        <div class="row g-3">
            <div class="col-md-3">
                <label for="kelas">Pilih Kelas:</label>
                <select name="kelas" class="form-select" onchange="this.form.submit()">
                    <option value="">-- Pilih Kelas --</option>
                    @foreach ($kelasList as $kelas)
                        <option value="{{ $kelas->id }}" {{ $selectedKelasId == $kelas->id ? 'selected' : '' }}>
                            {{ $kelas->nama_kelas }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="col-md-3">
                <label for="tahun">Tahun Masuk:</label>
                <select name="tahun" class="form-select" onchange="this.form.submit()">
                    <option value="">-- Semua Tahun --</option>
                    @foreach ($tahunMasukList as $tahun)
                        <option value="{{ $tahun }}" {{ $selectedTahunMasuk == $tahun ? 'selected' : '' }}>
                            {{ $tahun }}
                        </option>
                    @endforeach
                </select>
            </div>
        </div>
    </form>


    @if ($selectedKelasId && count($groupedJadwal))
        <div class="table-responsive">
            <table class="table table-bordered text-center align-middle">
                <thead class="table-secondary">
                    <tr>
                        <th>Jam</th>
                        @foreach (['Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu'] as $hari)
                            <th>{{ $hari }}</th>
                        @endforeach
                    </tr>
                </thead>
                <tbody>
                    @foreach ($groupedJadwal as $jam => $mapels)
                        <tr>
                            <td><strong>{{ $jam }}</strong></td>
                            @foreach (['Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu'] as $hari)
                                <td>
                                    {{ $mapels[$hari] ?? '-' }}
                                </td>
                            @endforeach
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @elseif ($selectedKelasId)
        <div class="alert alert-info">Jadwal belum tersedia untuk kelas ini.</div>
    @endif

    <a href="/" class="btn text-white mt-3 mb-5" style="background: #001f3f">Kembali</a>
    </div>
</div>



<!-- footer  -->
    <footer>
        <section class="footer">
            <div class="container">
                <div class="detail">
                    <h3>SMAN Situraja</h3>
                    <a href="" style="text-align: justify; margin-bottom: 20px;">SMAN SITURAJA adalah salah satu satuan pendidikan dengan jenjang SMA di Situraja, Kec. Situraja, Kab. Sumedang, Jawa Barat. </a>
                    <h5>contact us</h5>
                    <a href="#">smantura@gmail.com</a>
                    <div class="social">
                        <a href="#"><i class="fa-brands fa-facebook"></i></a>
                        <a href="#"><i class="fa-brands fa-instagram"></i></a>
                    </div>
                </div>
                <div class="about-us">
                    <h4>about us</h4>
                    <li><a href="#">about us</a></li>
                    <li><a href="#">our term</a></li>
                    <li><a href="#">careers <span>we're hiring!</span></a></li>
                    <li><a href="#">mission and values</a></li>
                    <li><a href="#">partnerships</a></li>
                </div>
                <div class="about-us">
                    <h4>help</h4>
                    <li><a href="#">FAQ</a></li>
                    <li><a href="#">PPDB guide</a></li>
                    <li><a href="#">cancellation policy</a></li>
                    <li><a href="#">site map</a></li>
                </div>
                <div class="about-us">
                    <h4>Resources</h4>
                    <li><a href="#">newsletter</a></li>
                    <li><a href="#">blog</a></li>
                    <li><a href="#">gallery</li>
                    <li><a href="#">offers</a></li>
                </div>
            </div>

            <div class="copyright">
                <div>
                    &copy;2025 - SMAN Situraja, inc, all rights reserved
                </div>
                <div>
                    <a href="#">term & conditions</a>
                    <a href="#">privacy policy</a>
                </div>
            </div>
        </section>
    </footer>
    <!-- end footer  -->

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4"
        crossorigin="anonymous"></script>
</body>
</html>