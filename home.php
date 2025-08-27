<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pharmacy Management System</title>
    <link rel="stylesheet" href="home.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>

<body>
    <!-- Header -->
    <header>
        <div class="logo">
            <i class="fa-solid fa-prescription-bottle-medical"></i>
            <h1>Master Pharmacy</h1>
        </div>

        <nav>
            <ul>
                <li><a href="#home">Home</a></li>
                <li><a href="#about">About</a></li>
                <li><a href="#services">Services</a></li>
                <li><a href="#contact">Contact Us</a></li>
            </ul>
        </nav>

        <div class="auth-buttons">
            <button class="btn btn-login" id="loginBtn"><a href="index.php"
                    style="text-decoration: none; color: blue;">Login</a></button>
        </div>
    </header>

    <!-- Hero Section -->
    <section class="hero" id="home">
        <div class="hero-content">
            <h2>Master Pharmacy Management System</h2>
            <p>Master Pharmacy is a systematic pharmacy management system designed to streamline operations for modern
                pharmacies, integrating inventory control, prescription processing, customer management, and sales
                tracking into one seamless platform. Our solution empowers pharmacists to enhance patient care, reduce
                operational costs, and improve efficiency through intuitive tools for stock management, automated refill
                reminders, and real-time reporting—all while ensuring compliance with healthcare regulations and
                providing a personalized experience for every customer.</p><br>
            <button class="btn btn-register btn-large"><a href="index.php"
                    style="text-decoration: none; color: white;">Get Started</a></button>
        </div>
    </section>

    <!-- About Section -->
    <section class="about" id="about">
        <h2 class="section-title">About Us</h2>
        <div class="about-content">
            <div class="about-image">
                <img src="img\about.jpg" alt="Pharmacy">
            </div>
            <div class="about-text">
                <h4>Your Trusted Pharmacy Management Solution</h4>
                <p>PharmaCare is a comprehensive pharmacy management system designed to streamline operations for modern
                    pharmacies. Our system helps you manage inventory, process sales, track customer history, and
                    generate reports with ease.</p>
                <p>With over years of experience in the healthcare industry, we understand the unique challenges
                    faced by pharmacy businesses and have developed a solution that addresses all your needs.</p>
                <p>Our mission is to empower pharmacists with technology that saves time, reduces errors, and improves
                    the pharmacy system.</p>
            </div>
        </div>
    </section>

    <!-- Services Section -->
    <section class="services" id="services">
        <h2 class="section-title">Our Services</h2>
        <div class="services-grid">
            <div class="service-card">
                <div class="service-icon">
                    <i class="fas fa-pills"></i>
                </div>
                <h3>Inventory Management</h3>
                <p>Efficiently manage your medicine stock and track expiration dates.</p>
            </div>

            <div class="service-card">
                <div class="service-icon">
                    <i class="fas fa-cash-register"></i>
                </div>
                <h3>POS System</h3>
                <p>Process sales quickly and generate receipts with our point-of-sale system.</p>
            </div>

            <div class="service-card">
                <div class="service-icon">
                    <i class="fas fa-user-md"></i>
                </div>
                <h3>Customer Management</h3>
                <p>Maintain customer records, purchase history, and prescription information.</p>
            </div>

            <div class="service-card">
                <div class="service-icon">
                    <i class="fas fa-chart-line"></i>
                </div>
                <h3>Sales Reports</h3>
                <p>Generate detailed sales reports and analytics to track your business performance.</p>
            </div>

            <div class="service-card">
                <div class="service-icon">
                    <i class="fas fa-file-prescription"></i>
                </div>
                <h3>Medicine Management</h3>
                <p>Manage and track prescriptions from receiving to fulfillment.</p>
            </div>

            <div class="service-card">
                <div class="service-icon">
                    <i class="fas fa-truck"></i>
                </div>
                <h3>Supplier Management</h3>
                <p>Keep track of your suppliers and manage orders efficiently.</p>
            </div>
        </div>
    </section>

    <!-- Contact Section -->
    <section class="contact" id="contact">
        <h2 class="section-title">Contact Us</h2>
        <div class="contact-container">
            <div class="contact-info">
                <div class="contact-item">
                    <div class="contact-icon">
                        <i class="fas fa-map-marker-alt"></i>
                    </div>
                    <div>
                        <h3>Our Location</h3>
                        <p>Geta-5, Attriya, Nepal</p>
                        <p>Opposite of Sudur Food Company</p>
                    </div>
                </div>

                <div class="contact-item">
                    <div class="contact-icon">
                        <i class="fas fa-phone"></i>
                    </div>
                    <div>
                        <h3>Phone Number</h3>
                        <p>+977 981-8738232</p>
                        <p>+977 987-6532943</p>
                    </div>
                </div>

                <div class="contact-item">
                    <div class="contact-icon">
                        <i class="fas fa-envelope"></i>
                    </div>
                    <div>
                        <h3>Email Address</h3>
                        <p>mastercare2@gmail.com</p>
                        <p>masterpharma7@gmail.com</p>
                    </div>
                </div>
            </div>

            <div class="contact-form">
                <h3>Send us a Message</h3>
                <form>
                    <div class="form-group">
                        <label for="name">Your Name</label>
                        <input type="text" id="name" placeholder="Enter your name">
                    </div>

                    <div class="form-group">
                        <label for="email">Email Address</label>
                        <input type="email" id="email" placeholder="Enter your email">
                    </div>

                    <div class="form-group">
                        <label for="message">Message</label>
                        <textarea id="message" rows="5" placeholder="Enter your message"></textarea>
                    </div>

                    <button type="submit" class="btn btn-register">Send Message</button>
                </form>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer>
        <div class="footer-content">
            <div class="footer-column">
                <h3>Master Pharmacy</h3>
                <p>Advanced pharmacy management system designed to streamline your pharmacy operations and improve
                    patient care.</p>

                <div class="social-icons">
                    <a href="#"><i class="fab fa-facebook-f"></i></a>
                    <a href="#"><i class="fab fa-twitter"></i></a>
                    <a href="#"><i class="fab fa-instagram"></i></a>
                    <a href="#"><i class="fab fa-linkedin-in"></i></a>
                </div>
            </div>

            <div class="footer-column">
                <h3>Quick Links</h3>
                <ul class="footer-links">
                    <li><a href="#">Home</a></li>
                    <li><a href="#about">About</a></li>
                    <li><a href="#services">Services</a></li>
                    <li><a href="#contact">Contact Us</a></li>
                    <li><a href="#">Privacy Policy</a></li>
                    <li><a href="#">Terms of Service</a></li>
                </ul>
            </div>

            <div class="footer-column">
                <h3>Our Services</h3>
                <ul class="footer-links">
                    <li><a href="#">Inventory Management</a></li>
                    <li><a href="#">POS System</a></li>
                    <li><a href="#">Customer Management</a></li>
                    <li><a href="#">Sales Reports</a></li>
                    <li><a href="#">Medicine Management</a></li>
                    <li><a href="#">Supplier Management</a></li>
                </ul>
            </div>

            <div class="footer-column">
                <h3>Newsletter</h3>
                <p>Subscribe to our newsletter to get updates on our services and pharmacy management tips.</p>
                <form>
                    <div class="form-group">
                        <input type="email" placeholder="Enter your email">
                    </div>
                    <button type="submit" class="btn btn-register">Subscribe</button>
                </form>
            </div>
        </div>

        <div class="copyright">
            <p>&copy; 2025 Master Pharmacy. All rights reserved.</p>
        </div>
    </footer>

</body>

</html>
```