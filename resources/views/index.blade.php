<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SMAN Situraja</title>
    <link rel="stylesheet" href="{{ asset('Assets/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('Assets/boxicons/css/boxicons.css') }}">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
    <style>
        a {
            text-decoration: none;
        }
    </style>
</head>

<body>
    <button id="backToTopBtn" class="back-to-top">
        <i class="fas fa-arrow-up"></i>
    </button>

    <!-- header  -->
    <section class="home" id="home">
        <div class="home-box">
            <nav>
                <div class="logo bars">
                    <div class="bar">
                        <i class="fa fa-bars"></i>
                    </div>
                    <img src="Assets/image/logosma.png" alt="" style="width: 40px; gap: 0.2rem;" id="logo_hilang">
                    <h5 style="font-weight: 500;" class="mt-2">SMA NEGERI SITURAJA</h5>
                </div>
                <div class="menu">
                    <div class="close">
                        <i class="fa fa-close"></i>
                    </div>
                    <ul class="mt-3">
                        <li><a href="#home"
                                style="color: #001f3f; background-color: white; border-radius: 1rem; padding: 0.2rem 1rem;">Home</a>
                        </li>
                        <li><a href="#destinations">Tentang Kami</a></li>
                        <li><a href="#portofolio">Berita</a></li>
                        <li><a href="#article">Informasi PPDB</a></li>
                        <li class="kebawah">
                        <a href="#">Lainnya</a>
                        <div class="kebawah-content">
                            <a href="/jadwal-kelas">Jadwal Kelas</a>
                            <a href="/daftar-kelas">Daftar Siswa</a>
                        </div>
                        </li>
                    </ul>
                </div>
                <div class="signup-login">
                    @auth
                    <form action="{{ route('logout2') }}" method="POST" class="ms-2">
                    @csrf
                    <button type="submit" class="btn me-3" onclick="return confirmLogout()">
                    Logout
                    </button>
                    </form>
                    @else
                    <a href="/login">Login</a>
                    @endauth
                    <a href="/pendaftaran">Daftar PPDB</a>
                    @auth
                        <div class="user-profile ms-3" style="position: relative;">
                            <i class="fas fa-user fa-lg profile-icon" style="cursor: pointer;"></i>
                            <div class="profile-tooltip">
                                {{ Auth::user()->name }}
                            </div>
                        </div>
                        @endauth
                </div>
                    
            </nav>

            <div class="content">
                <div class="content-header">
                    <h5>Kabupaten Sumedang, Jawa Barat</h5>
                    <h1>SMA NEGERI SITURAJA</h1>
                    <p>SMA Negeri Situraja merupakan salah satu sekolah lanjutan tingkat atas yang berada di Kecamatan Situraja. Sekolah ini bisa dikatakan sudah cukup lama berdiri.</p>

                    <div class="search">
                        <i class="fa-solid fa-panorama"></i>
                        <input type="text" placeholder="Jelajah sekolah dengan VR 360,  selamat explore online">
                        <a href="navmenu/vr.html">Jelajah</a>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- end header  -->

    <!-- vr  -->
    <section class="destinations" id="destinations">
        <h4 class="label ms-3">Smantura</h4>
        <div class="container">
            <div class="container-box">
                <h2 class="heading">SMA NEGERI SITURAJA</h2>
                <div class="content">
                    <p>SMA Negeri Situraja saat ini sudah memiliki fasilitas yang sangat memadai. Berbagai fasilitas dimiliki oleh SMA Negeri Situraja yaitu ruang teori/kelas 27 kelas, Laboratorium Kimia, Laboratorium Fisika, Laboratorium Biologi, Laboratorium Bahasa, Laboratorium Komputer, Ruang Perpustakaan, Ruang Multimedia, Ruang Pusat Sumber Belajar, Ruang Keterampilan, Ruang UKS, Koperasi, Ruang BP/BK, Ruang Kepala Sekolah, Ruang Wakil Kepala Sekolah, ruang Guru, Ruang TU, Ruang OSIS, Ruang Ekstrakulikuler, Ruang PMR, Kamar Mandi, Gudang, Ruang Ibadah, Ruang Olahraga, Dapur, Kantin/Warung Sekolah, Lapangan Olahraga/Upacara, dan Tempat Parkir.</p>
                    <a href="#">Read more <i class="fa fa-arrow-right"></i></a>
                </div>
            </div>
            <div class="gallery">
                <div class="box box1">
                    <img src="Assets/image/sman1.jpg" alt="">
                    <div class="text">
                        <h2>jelajahi Sekolah favoritmu</h2>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- end vr  -->

    <!-- card daya tarik  -->
    <section class="feedback" id="portofolio">
        <div class="container py-5">
            <h1 class="text-center text-light mb-5">Berita Tekini</h1>

            <!-- Card 1 -->
            <div class="swiper portofolio-swiper">
                <div class="swiper-wrapper">
                    @foreach($beritas as $berita)
                <div class="swiper-slide">
                    <div class="card shadow" style="border: none;">
                        <img src="{{ asset('storage/' . $berita->gambar) }}" class="card-img-top" alt="Thumbnail">
                        <div class="position-relative">
                            <a href="{{ route('berita.detail', $berita->id) }}" class="btnn btn-hijau position-absolute top-50 start-50 translate-middle">Read More</a>
                        </div>
                        <div class="card-body">
                            <h2 class="card-title">{{ $berita->judul }}</h2>
                            <p class="d-block batas">{{ \Illuminate\Support\Str::words(strip_tags($berita->konten), 9, '...') }}</p>
                            <p class="card-text" style="font-size: 12px;">{{ \Carbon\Carbon::parse($berita->tanggal_publish)->translatedFormat('d F Y') }}</p>
                        </div>
                    </div>
                </div>
                @endforeach


                    
                </div>

                <div class="d-flex align-item-center justify-content-end gap-3 mt-3">
                    <button class="btn btn-light d-flex align-item-center justify-content-center btn-next">
                        <i class="bx bx-left-arrow-alt fs-5"></i>
                    </button>
                    <button class="btn btn-light d-flex align-item-center justify-content-center btn-prev">
                        <i class="bx bx-right-arrow-alt fs-5"></i>
                    </button>
                </div>

            </div>





        </div>
    </section>
    <!-- end card daya tarik  -->

    <!-- kenapa harus kita  -->
    <section class="article" id="article">
        <h4 class="label ms-3">Informasi</h4>
        <h2 class="heading ms-3">FAQ PPDB 2025</h2>
        <div class="faq-item">
            <div class="faq-question">
            <span>Apa itu layanan SPMB?</span>
            <span class="faq-icon"><i class='bx bx-chevron-down'></i></i></span>
            </div>
            <div class="faq-answer">
            SPMB adalah sistem pendaftaran masuk berbasis online yang dikelola oleh Dinas Pendidikan Provinsi Jawa Barat.
            </div>
        </div>

        <div class="faq-item">
            <div class="faq-question">
            <span>Bagaimana cara mendaftar?</span>
            <span class="faq-icon"><i class='bx bx-chevron-down'></i></i></span>
            </div>
            <div class="faq-answer">
            Anda bisa mendaftar melalui website resmi dengan mengisi formulir dan mengunggah dokumen yang dibutuhkan.
            </div>
        </div>

        <div class="faq-item">
            <div class="faq-question">
            <span>Apakah data saya aman?</span>
            <span class="faq-icon"><i class='bx bx-chevron-down'></i></i></span>
            </div>
            <div class="faq-answer">
            Ya, data Anda kami simpan dengan aman dan hanya digunakan untuk keperluan administrasi pendaftaran.
            </div>
        </div>

    </section>
    <!-- end kenapa harus kita -->

    <!-- footer  -->
    <footer>
        <section class="footer">
            <div class="container">
                <div class="detail">
                    <h3>SMAN Situraja</h3>
                    <a href="https://www.google.com/maps/place/State+High+School+Situraja/@-6.8410072,108.0148701,17z/data=!4m14!1m7!3m6!1s0x2e68d36f5aec2331:0x2eb4e15f74688677!2sState+High+School+Situraja!8m2!3d-6.8410072!4d108.017445!16s%2Fg%2F1hm33hl9x!3m5!1s0x2e68d36f5aec2331:0x2eb4e15f74688677!8m2!3d-6.8410072!4d108.017445!16s%2Fg%2F1hm33hl9x?entry=ttu&g_ep=EgoyMDI1MDYzMC4wIKXMDSoASAFQAw%3D%3D" style="text-align: justify; margin-bottom: 20px;" target="_blank">SMAN SITURAJA adalah salah satu satuan pendidikan dengan jenjang SMA di Situraja, Kec. Situraja, Kab. Sumedang, Jawa Barat. </a>
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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.4/gsap.min.js"
        integrity="sha512-EZI2cBcGPnmR89wTgVnN3602Yyi7muWo8y1B3a8WmIv1J9tYG+udH4LvmYjLiGp37yHB7FfaPBo8ly178m9g4Q=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.4/ScrollTrigger.min.js"
        integrity="sha512-OzC82YiH3UmMMs6Ydd9f2i7mS+UFL5f977iIoJ6oy07AJT+ePds9QOEtqXztSH29Nzua59fYS36knmMcv79GOg=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="{{ asset('Assets/js/script.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
    <script>
        var swiper = new Swiper(".portofolio-swiper", {
            slidesPerView: 3,
            spaceBetween: 30,
            navigation: {
                nextEl: ".btn-prev",
                prevEl: ".btn-next",
            },

            breakpoints: {
                320: {
                    slidesPerView: 2,
                    spaceBetween: 20,
                },

                480: {
                    slidesPerView: 3,
                    spaceBetween: 30,
                },
            },
        });
    </script>
</body>

</html>