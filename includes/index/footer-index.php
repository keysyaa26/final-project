<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <style>
        body {
            font-family: 'Poppins', sans-serif;
        }

        footer {
            background: linear-gradient(to right, #2C2C7C, #191970);
            color: white;
        }

        .about-section h4,
        .social-media-section h4 {
            color: #FFFFFF;
        }

        .about-section p,
        .social-media-section a {
            color: #FFFFFF;
        }

        .social-icon {
            transition: transform 0.3s ease, color 0.3s ease;
        }

        .social-icon:hover {
            transform: scale(1.2);
            /* Ganti dengan warna hover yang diinginkan */
        }

        .social-media-section h4 {
            font-size: 1.8rem;
            color: white;
            font-weight: 600;
        }
    </style>
</head>

<body>
    <div class="container-fluid py-5" style="background-color: #2C2C7C;" id="contact">
        <div class="d-flex justify-content-between align-items-center mx-5 footer-container">
            <!-- About Section -->
            <div class="about-section" style="flex: 1; margin-right: 50px;">
                <h4 class="mb-3">About</h4>
                <p style="line-height: 1.8;">
                    Event Center adalah platform penyelenggaraan acara yang menyediakan berbagai informasi terkini
                    mengenai event-event menarik yang dapat diikuti. Kami berdedikasi untuk memberikan pengalaman
                    terbaik dalam menemukan dan mendaftar acara.
                </p>
            </div>

            <!-- Social Media Section -->
            <div class="social-media-section text-center" id="social-media" style="flex: 1;">
                <h4 class="mb-3 text-white">Follow Us on Social Media</h4>
                <div class="d-flex justify-content-center mt-3">
                    <!-- Globe Icon -->
                    <a href="#" class="text-decoration-none mx-3 social-icon"
                        style="color: #FFF000; font-size: 1.5rem;">
                        <i class="bi bi-globe"></i>
                    </a>
                    <!-- Facebook Icon -->
                    <a href="#" class="text-decoration-none mx-3 social-icon"
                        style="color: #FFF000; font-size: 1.5rem;">
                        <i class="bi bi-facebook"></i>
                    </a>
                    <!-- Instagram Icon -->
                    <a href="#" class="text-decoration-none mx-3 social-icon"
                        style="color: #FFF000; font-size: 1.5rem;">
                        <i class="bi bi-instagram"></i>
                    </a>
                    <!-- YouTube Icon -->
                    <a href="#" class="text-decoration-none mx-3 social-icon"
                        style="color: #FFF000; font-size: 1.5rem;">
                        <i class="bi bi-youtube"></i>
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <footer class="text-center py-4">
        <p class="mb-0" style="color: white;">&copy; 2024 Event Center. All Rights Reserved.</p>
    </footer>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>
</body>

</html>