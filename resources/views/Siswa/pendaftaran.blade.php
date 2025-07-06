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

    <div class="container mt-5 mb-5">
    <h2 class="mb-0" style="color: #001f3f">Formulir Pendaftaran Siswa</h2>
        <div class="card-body">

            @if (session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif

            <form action="{{ route('siswa.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="mb-3">
                    <label for="nama" class="form-label">Nama Lengkap</label>
                    <input type="text" class="form-control" name="nama" value="{{ old('nama') }}" required>
                    @error('nama') <div class="text-danger small">{{ $message }}</div> @enderror
                </div>

                <div class="mb-3">
                    <label for="nisn" class="form-label">NISN</label>
                    <input type="text" class="form-control" name="nisn" value="{{ old('nisn') }}" required>
                    @error('nisn') <div class="text-danger small">{{ $message }}</div> @enderror
                </div>

                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" class="form-control" name="email" value="{{ old('email') }}" required>
                    @error('email') <div class="text-danger small">{{ $message }}</div> @enderror
                </div>

                <div class="mb-3">
                    <label for="tanggal_lahir" class="form-label">Tanggal Lahir</label>
                    <input type="date" class="form-control" name="tanggal_lahir" value="{{ old('tanggal_lahir') }}" required>
                    @error('tanggal_lahir') <div class="text-danger small">{{ $message }}</div> @enderror
                </div>

                <div class="mb-3">
                    <label for="jenis_kelamin" class="form-label">Jenis Kelamin</label>
                    <select class="form-select" name="jenis_kelamin" required>
                        <option value="">-- Pilih --</option>
                        <option value="L" {{ old('jenis_kelamin') == 'L' ? 'selected' : '' }}>Laki-laki</option>
                        <option value="P" {{ old('jenis_kelamin') == 'P' ? 'selected' : '' }}>Perempuan</option>
                    </select>
                    @error('jenis_kelamin') <div class="text-danger small">{{ $message }}</div> @enderror
                </div>

                <div class="mb-3">
                    <label for="tahun_masuk" class="form-label">Tahun Masuk</label>
                    <input type="number" class="form-control" name="tahun_masuk" value="{{ old('tahun_masuk') }}" required>
                    @error('tahun_masuk') <div class="text-danger small">{{ $message }}</div> @enderror
                </div>

                <div class="mb-3">
                    <label for="gambar" class="form-label">Foto (Opsional)</label>
                    <input type="file" class="form-control" name="gambar">
                    @error('gambar') <div class="text-danger small">{{ $message }}</div> @enderror
                </div>

                <button type="submit" class="btn btn-success">Daftar Sekarang</button>
            </form>
        </div>
    <a href="/" class="btn text-white mt-3 mb-5" style="background: #001f3f">Kembali</a>
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