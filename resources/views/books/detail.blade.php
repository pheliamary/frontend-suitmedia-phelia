<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Perpustakaan Digital</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Merriweather:wght@300;400;700&family=Open+Sans:wght@300;400;600&display=swap">
   
    <style>
        :root {
            --accent-color: #ab8d6b;
            --light-accent: #ebebe9;
            --dark-color: #FF5C00;
            --light-color: #f8f9fa;
        }

        body {
            font-family: 'Open Sans', sans-serif;
            color: #333;
            background-color: #f9f7f4;
        }

        h1, h2, h3, h4, h5, h6 {
            font-family: 'Merriweather', serif;
        }

/* Enhanced Header Styles - Fixed */
.navbar {
    background-color: var(--dark-color) !important;
    box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
    padding: 0.8rem 0;
    position: fixed;
    top: 0;
    left: 0;
    right: 0;
    z-index: 1000;
    transition: all 0.3s ease;
    /* Hapus background-color yang konflik */
}

/* Header states */
.navbar.navbar-hidden {
    transform: translateY(-100%);
}

.navbar.navbar-scrolled {
    /* Jangan set background-color di sini, biarkan JS yang handle */
    backdrop-filter: blur(10px);
    -webkit-backdrop-filter: blur(10px); /* Safari support */
    box-shadow: 0 2px 20px rgba(0, 0, 0, 0.15);
}

/* Pastikan navbar-brand dan nav-link tidak terpengaruh */
.navbar-brand {
    font-family: 'Merriweather', serif;
    font-weight: 700;
    font-size: 1.5rem;
    color: white !important;
}

.nav-link {
    font-weight: 600;
    text-transform: uppercase;
    font-size: 0.85rem;
    letter-spacing: 0.5px;
    margin: 0 5px;
    border-radius: 4px;
    transition: all 0.3s ease;
    position: relative;
    color: white !important;
}

.nav-link:hover {
    background-color: rgba(255, 255, 255, 0.1);
    color: white !important;
}

/* Active menu state */
.nav-link.active {
    background-color: rgba(255, 255, 255, 0.2);
    color: white !important;
}

.nav-link.active::after {
    content: '';
    position: absolute;
    bottom: -2px;
    left: 50%;
    transform: translateX(-50%);
    width: 20px;
    height: 2px;
    background-color: white;
    border-radius: 2px;
}

/* Responsive navbar */
@media (max-width: 991px) {
    .navbar-collapse {
        background-color: rgba(255, 92, 0, 0.98);
        margin-top: 1rem;
        border-radius: 8px;
        padding: 1rem;
        backdrop-filter: blur(10px);
        -webkit-backdrop-filter: blur(10px);
    }
    
    .nav-link {
        margin: 0.25rem 0;
        padding: 0.5rem 1rem;
    }
}

        .nav-link:hover {
            background-color: rgba(255, 255, 255, 0.1);
        }

        /* Active menu state */
        .nav-link.active {
            background-color: rgba(255, 255, 255, 0.2);
            color: white !important;
        }

        .nav-link.active::after {
            content: '';
            position: absolute;
            bottom: -2px;
            left: 50%;
            transform: translateX(-50%);
            width: 20px;
            height: 2px;
            background-color: white;
            border-radius: 2px;
        }

        /* Enhanced Hero Section with Parallax */
        .ideas-hero-wrapper {
            position: relative;
            height: 100vh;
            overflow: hidden;
            background-image: url('{{ asset('background_suitmedia.jpg') }}');
            background-position: center;
            background-repeat: no-repeat;
            background-attachment: fixed;
        }

        /* Parallax background layer */
        .parallax-bg {
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background-image: url('{{ asset('background_suitmedia.jpg') }}');
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            will-change: transform;
            z-index: 1;
        }

        /* Overlay gelap untuk readability text */
        .ideas-hero-wrapper::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: rgba(0, 0, 0, 0.4);
            z-index: 2;
        }

        /* Bentuk miring di bagian bawah */
        .ideas-hero-wrapper::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            right: 0;
            height: 100px;
            background: white;
           clip-path: polygon(0 200%, 200% 200%, 100% 0%, 0 50%);
            z-index: 4;
        }

        .ideas-hero-content {
            position: relative;
            height: 100%;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            text-align: center;
            color: white;
            z-index: 3;
            will-change: transform;
        }

        .ideas-hero-content h1 {
            font-size: 4rem;
            font-weight: 700;
            margin-bottom: 1rem;
            text-shadow: 2px 2px 4px rgba(0,0,0,0.5);
            opacity: 0;
            animation: fadeInUp 1s ease-out 0.5s forwards;
        }

        .ideas-hero-content p {
            font-size: 1.4rem;
            margin-bottom: 0;
            text-shadow: 1px 1px 2px rgba(0,0,0,0.5);
            opacity: 0;
            animation: fadeInUp 1s ease-out 0.8s forwards;
        }

        /* Animations */
        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        /* Main content area */
        .main-content-wrapper {
            background-color: #fff;
            margin-top: -50px;
            position: relative;
            z-index: 5;
            padding-top: 80px;
            box-shadow: 0 -5px 15px rgba(0, 0, 0, 0.05);
        }

        /* Filter section */
        .filter-section {
            margin-bottom: 2rem;
            display: flex;
            flex-wrap: wrap;
            justify-content: space-between;
            align-items: center;
            gap: 1rem;
        }

        .filter-section .form-select {
            width: auto;
            display: inline-block;
            min-width: 120px;
        }
       
        .filter-section div {
            display: flex;
            align-items: center;
            flex-wrap: wrap;
            gap: 1rem;
        }

        /* Card styling */
        .idea-card {
            border: none;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.08);
            transition: all 0.3s ease;
            cursor: pointer;
            height: 100%;
            border-radius: 8px;
            overflow: hidden;
        }

        .idea-card:hover {
            transform: translateY(-8px);
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.15);
        }

        .idea-card img {
            height: 180px;
            object-fit: cover;
            width: 100%;
            transition: transform 0.3s ease;
        }

        .idea-card:hover img {
            transform: scale(1.05);
        }

        .idea-card .card-body {
            padding: 1rem;
        }

        .idea-card .card-title {
            font-size: 1rem;
            font-weight: 600;
            margin-bottom: 0.5rem;
            line-height: 1.3;
        }

        .idea-card .card-text small {
            color: #666;
        }

        /* Pagination */
        .pagination .page-link {
            color: var(--dark-color);
            border-color: #dee2e6;
        }

        .pagination .page-item.active .page-link {
            background-color: var(--dark-color);
            border-color: var(--dark-color);
        }

        .pagination .page-link:hover {
            background-color: rgba(255, 92, 0, 0.1);
            border-color: var(--dark-color);
        }

        /* Footer Styles */
        footer {
            background-color: var(--dark-color);
            color: white;
            padding: 4rem 0 0;
        }

        .footer-heading {
            font-size: 1.2rem;
            margin-bottom: 1.5rem;
            position: relative;
            padding-bottom: 0.75rem;
        }

        .footer-heading::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            width: 30px;
            height: 2px;
            background-color: var(--accent-color);
        }

        .footer-link {
            color: rgba(255, 255, 255, 0.7);
            text-decoration: none;
            display: block;
            margin-bottom: 0.75rem;
            transition: all 0.3s ease;
        }

        .footer-link:hover {
            color: white;
            transform: translateX(5px);
        }

        .footer-bottom {
            background-color: rgba(0, 0, 0, 0.1);
            padding: 1.5rem 0;
            margin-top: 3rem;
        }

        .social-icon {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 38px;
            height: 38px;
            border-radius: 50%;
            background-color: rgba(255, 255, 255, 0.1);
            color: white;
            margin-right: 0.5rem;
            transition: all 0.3s ease;
        }

        .social-icon:hover {
            background-color: var(--accent-color);
            transform: translateY(-3px);
        }

        /* Scroll indicator */
        .scroll-indicator {
            position: absolute;
            bottom: 30px;
            left: 50%;
            transform: translateX(-50%);
            color: white;
            z-index: 3;
            animation: bounce 2s infinite;
        }

        .scroll-indicator i {
            font-size: 1.5rem;
        }

        @keyframes bounce {
            0%, 20%, 50%, 80%, 100% {
                transform: translateX(-50%) translateY(0);
            }
            40% {
                transform: translateX(-50%) translateY(-10px);
            }
            60% {
                transform: translateX(-50%) translateY(-5px);
            }
        }

        /* Additional CSS for enhanced animations */
        .loaded {
            opacity: 1;
        }
        
        .lazy {
            opacity: 0;
            transition: opacity 0.3s;
        }
        
        /* Enhanced mobile responsiveness */
        @media (max-width: 768px) {
            .ideas-hero-content h1 {
                font-size: 2.5rem;
            }
            
            .ideas-hero-content p {
                font-size: 1.1rem;
            }
            
            .filter-section {
                flex-direction: column;
                align-items: flex-start;
            }
            
            .filter-section div {
                flex-direction: column;
                align-items: flex-start;
                width: 100%;
            }
            
            .filter-section .form-select {
                width: 100%;
                margin-left: 0;
            }
            
            .filter-section label {
                margin-left: 0 !important;
            }
        }

        @media (max-width: 576px) {
            .ideas-hero-content h1 {
                font-size: 2rem;
            }
            
            .ideas-hero-content p {
                font-size: 1rem;
            }
            
            .navbar-brand {
                font-size: 1.2rem;
            }
            
            .nav-link {
                font-size: 0.8rem;
                padding: 0.5rem 1rem;
            }
            
            .idea-card {
                margin-bottom: 1rem;
            }
        }
        
        /* Print styles */
        @media print {
            .navbar,
            .scroll-indicator,
            .pagination,
            footer {
                display: none !important;
            }
            
            .ideas-hero-wrapper {
                height: 200px !important;
            }
            
            .main-content-wrapper {
                margin-top: 0 !important;
            }
        }
    </style>
</head>

<body>
    
   <nav class="navbar navbar-expand-lg navbar-dark" id="mainNavbar">
    <div class="container">
        <a class="navbar-brand" href="/">
      <img src="{{ asset('suitmedialogo.png') }}" alt="Suitmedia" style="height: auto; width: 90px;">




        </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link nav-btn text-white" href="/" data-page="work">
                            <i class="fas fa-home me-1"></i> Work
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link nav-btn text-white" href="/books/book" data-page="about">
                            <i class="fas fa-book me-1"></i> About
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link nav-btn text-white" href="/peminjam" data-page="services">
                            <i class="fas fa-user-edit me-1"></i> Ideas
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link nav-btn text-white active" href="/peminjam" data-page="ideas">
                            <i class="fas fa-lightbulb me-1"></i> Services
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link nav-btn text-white" href="/careers" data-page="careers">
                            <i class="fas fa-briefcase me-1"></i> Careers
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link nav-btn text-white" href="/careers" data-page="careers">
                            <i class="fas fa-briefcase me-1"></i> Contact
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <div class="ideas-hero-wrapper">
        <div class="parallax-bg"></div>
        <div class="ideas-hero-content">
            <h1>Ideas</h1>
            <p>Where all our great things begin</p>
        </div>
        <div class="scroll-indicator">
            <i class="fas fa-chevron-down"></i>
        </div>
    </div>

    <!-- Main Content -->
    <div class="main-content-wrapper">
        <div class="container py-4">
            <div class="filter-section">
                <span>Showing 1-10 of 100</span>
                <div>
                    <label for="showPerPage" class="form-label mb-0 me-2">Show per page:</label>
                    <select class="form-select form-select-sm" id="showPerPage">
                        <option selected>10</option>
                        <option value="20">20</option>
                        <option value="50">50</option>
                    </select>

                    <label for="sortBy" class="form-label mb-0 ms-4 me-2">Sort by:</label>
                    <select class="form-select form-select-sm" id="sortBy">
                        <option selected>Newest</option>
                        <option value="oldest">Oldest</option>
                        <option value="popular">Popular</option>
                    </select>
                </div>
            </div>

            <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 row-cols-lg-4 g-4">
                <!-- Card 1 -->
                <div class="col">
                    <div class="card idea-card">
                        <img src="https://images.unsplash.com/photo-1611224923853-80b023f02d71?ixlib=rb-4.0.3&auto=format&fit=crop&w=400&q=80" class="card-img-top" alt="Influencer Marketing">
                        <div class="card-body">
                            <p class="card-text text-muted mb-1"><small>12 July 2025</small></p>
                            <h5 class="card-title">Kenali Tingkatan Influencers berdasarkan Jumlah Followers</h5>
                        </div>
                    </div>
                </div>

                <!-- Card 2 -->
                <div class="col">
                    <div class="card idea-card">
                        <img src="https://images.unsplash.com/photo-1553484771-371a605b060b?ixlib=rb-4.0.3&auto=format&fit=crop&w=400&q=80" class="card-img-top" alt="Strategy">
                        <div class="card-body">
                            <p class="card-text text-muted mb-1"><small>11 July 2025</small></p>
                            <h5 class="card-title">Jangan Asal Pilih Influencer, Berikut Cara Menyusun Strategi Influencer...</h5>
                        </div>
                    </div>
                </div>

                <!-- Card 3 -->
                <div class="col">
                    <div class="card idea-card">
                        <img src="https://images.unsplash.com/photo-1460925895917-afdab827c52f?ixlib=rb-4.0.3&auto=format&fit=crop&w=400&q=80" class="card-img-top" alt="Digital Marketing">
                        <div class="card-body">
                            <p class="card-text text-muted mb-1"><small>10 July 2025</small></p>
                            <h5 class="card-title">Memahami Algoritma Media Sosial untuk Strategi Marketing yang Efektif</h5>
                        </div>
                    </div>
                </div>

                <!-- Card 4 -->
                <div class="col">
                    <div class="card idea-card">
                        <img src="https://images.unsplash.com/photo-1556761175-b413da4baf72?ixlib=rb-4.0.3&auto=format&fit=crop&w=400&q=80" class="card-img-top" alt="Content Creation">
                        <div class="card-body">
                            <p class="card-text text-muted mb-1"><small>9 July 2025</small></p>
                            <h5 class="card-title">Tips Membuat Konten yang Engaging di Era Digital</h5>
                        </div>
                    </div>
                </div>

                <!-- Card 5 -->
                <div class="col">
                    <div class="card idea-card">
                        <img src="https://images.unsplash.com/photo-1432888622747-4eb9a8efeb07?ixlib=rb-4.0.3&auto=format&fit=crop&w=400&q=80" class="card-img-top" alt="Brand Strategy">
                        <div class="card-body">
                            <p class="card-text text-muted mb-1"><small>8 July 2025</small></p>
                            <h5 class="card-title">Membangun Brand Awareness melalui Strategi Konten yang Tepat</h5>
                        </div>
                    </div>
                </div>

                <!-- Card 6 -->
                <div class="col">
                    <div class="card idea-card">
                        <img src="https://images.unsplash.com/photo-1551288049-bebda4e38f71?ixlib=rb-4.0.3&auto=format&fit=crop&w=400&q=80" class="card-img-top" alt="Analytics">
                        <div class="card-body">
                            <p class="card-text text-muted mb-1"><small>7 July 2025</small></p>
                            <h5 class="card-title">Mengoptimalkan ROI Campaign dengan Data Analytics</h5>
                        </div>
                    </div>
                </div>

                <!-- Card 7 -->
                <div class="col">
                    <div class="card idea-card">
                        <img src="https://images.unsplash.com/photo-1596526131083-e8c633c948d2?ixlib=rb-4.0.3&auto=format&fit=crop&w=400&q=80" class="card-img-top" alt="Social Media">
                        <div class="card-body">
                            <p class="card-text text-muted mb-1"><small>6 July 2025</small></p>
                            <h5 class="card-title">Tren Social Media Marketing yang Wajib Diketahui di 2025</h5>
                        </div>
                    </div>
                </div>

                <!-- Card 8 -->
                <div class="col">
                    <div class="card idea-card">
                        <img src="https://images.unsplash.com/photo-1519389950473-47ba0277781c?ixlib=rb-4.0.3&auto=format&fit=crop&w=400&q=80" class="card-img-top" alt="Team Work">
                        <div class="card-body">
                            <p class="card-text text-muted mb-1"><small>5 July 2025</small></p>
                            <h5 class="card-title">Kolaborasi Tim dalam Menciptakan Kampanye yang Sukses</h5>
                        </div>
                    </div>
                </div>
            </div>

            <nav aria-label="Page navigation" class="mt-4">
                <ul class="pagination justify-content-center">
                    <li class="page-item disabled">
                        <a class="page-link" href="#" tabindex="-1" aria-disabled="true">Previous</a>
                    </li>
                    <li class="page-item active" aria-current="page"><a class="page-link" href="#">1</a></li>
                    <li class="page-item"><a class="page-link" href="#">2</a></li>
                    <li class="page-item"><a class="page-link" href="#">3</a></li>
                    <li class="page-item">
                        <a class="page-link" href="#">Next</a>
                    </li>
                </ul>
            </nav>
        </div>
    </div>

    <!-- Footer -->
    <footer>
        <div class="container">
            <div class="row">
                <div class="col-md-4 mb-4 mb-md-0">
                    <h5 class="footer-heading">Tentang Kami</h5>
                    <p class="text-white-50">Suitmedia adalah agensi digital yang berfokus pada menciptakan solusi inovatif untuk kebutuhan digital bisnis modern. Kami membantu klien mencapai tujuan mereka melalui strategi yang tepat dan eksekusi yang berkualitas.</p>
                    <div class="mt-4">
                        <a href="#" class="social-icon"><i class="fab fa-facebook-f"></i></a>
                        <a href="#" class="social-icon"><i class="fab fa-twitter"></i></a>
                        <a href="#" class="social-icon"><i class="fab fa-instagram"></i></a>
                        <a href="#" class="social-icon"><i class="fab fa-linkedin-in"></i></a>
                    </div>
                </div>
                <div class="col-md-2 mb-4 mb-md-0">
                    <h5 class="footer-heading">Layanan</h5>
                    <ul class="list-unstyled">
                        <li><a href="#" class="footer-link"><i class="fas fa-angle-right me-2"></i>Web Development</a></li>
                        <li><a href="#" class="footer-link"><i class="fas fa-angle-right me-2"></i>Mobile App</a></li>
                        <li><a href="#" class="footer-link"><i class="fas fa-angle-right me-2"></i>Digital Marketing</a></li>
                        <li><a href="#" class="footer-link"><i class="fas fa-angle-right me-2"></i>UI/UX Design</a></li>
                        <li><a href="#" class="footer-link"><i class="fas fa-angle-right me-2"></i>Consulting</a></li>
                    </ul>
                </div>
                <div class="col-md-2 mb-4 mb-md-0">
                    <h5 class="footer-heading">Industri</h5>
                    <ul class="list-unstyled">
                        <li><a href="#" class="footer-link"><i class="fas fa-angle-right me-2"></i>E-commerce</a></li>
                        <li><a href="#" class="footer-link"><i class="fas fa-angle-right me-2"></i>Healthcare</a></li>
                        <li><a href="#" class="footer-link"><i class="fas fa-angle-right me-2"></i>Education</a></li>
                        <li><a href="#" class="footer-link"><i class="fas fa-angle-right me-2"></i>Finance</a></li>
                        <li><a href="#" class="footer-link"><i class="fas fa-angle-right me-2"></i>Travel</a></li>
                    </ul>
                </div>
                <div class="col-md-4">
                    <h5 class="footer-heading">Hubungi Kami</h5>
                    <ul class="list-unstyled text-white-50">
                        <li class="mb-3"><i class="fas fa-map-marker-alt me-3"></i>Jl. Kemang Raya No. 1,
                            Jakarta Selatan, Indonesia</li>
                        <li class="mb-3"><i class="fas fa-phone-alt me-3"></i>+62 21 1234 5678</li>
                        <li class="mb-3"><i class="fas fa-envelope me-3"></i>hello@suitmedia.com</li>
                        <li class="mb-3"><i class="fas fa-clock me-3"></i>Senin - Jumat: 09:00 - 18:00</li>
                    </ul>
                </div>
            </div>
        </div>

        <div class="footer-bottom text-center">
            <div class="container">
                <p class="mb-0">© 2025 Suitmedia. All rights reserved.</p>
            </div>
        </div>
    </footer>

    <!-- Bootstrap JavaScript -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" 
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" 
        crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous">

    </script>
<!-- Custom JavaScript -->
<script src="{{ asset('js/script.js') }}"></script>

<style>
    /* Additional CSS for enhanced animations */
    .loaded {
        opacity: 1;
    }
    
    .lazy {
        opacity: 0;
        transition: opacity 0.3s;
    }
    
    /* Enhanced mobile responsiveness */
    @media (max-width: 576px) {
        .ideas-hero-content h1 {
            font-size: 2rem;
        }
        
        .ideas-hero-content p {
            font-size: 1rem;
        }
        
        .navbar-brand {
            font-size: 1.2rem;
        }
        
        .nav-link {
            font-size: 0.8rem;
            padding: 0.5rem 1rem;
        }
        
        .idea-card {
            margin-bottom: 1rem;
        }
    }
    
    /* Print styles */
    @media print {
        .navbar,
        .scroll-indicator,
        .pagination,
        footer {
            display: none !important;
        }
        
        .ideas-hero-wrapper {
            height: 200px !important;
        }
        
        .main-content-wrapper {
            margin-top: 0 !important;
        }
    }
</style>