<!-- Footer Component in Blade -->
<div class="footer-container bg-light pt-5">
    <div class="container">
        <div class="row">
            <!-- Logo and Address -->
            <div class="col-md-4">
                <div class="footer-logo mb-3">
                    <img src="{{ asset('images/logo.png') }}" alt="Logo" height="50">
                </div>
                <div class="footer-address">
                    <p><strong>Адреса</strong><br>
                        Бул. ВМРО бр. 7-З<br>
                        1000 Скопје, Македонија</p>
                </div>
                <div class="footer-email">
                    <p><strong>Е-маил</strong><br>
                        <a href="mailto:contact@mhrpa.mk">contact@mhrpa.mk</a>
                    </p>
                </div>
            </div>
            <!-- Newsletter Subscription -->
            <div class="col-md-4">
                <h5>Претплати се на билтен</h5>
                <!-- <form wire:submit.prevent="subscribe"> -->
                    <div class="input-group">
                        <input type="email" class="form-control" placeholder="Е-маил" wire:model="email">
                        <button class="btn btn-primary" type="submit">Претплати</button>
                    </div>
                </form>
            </div>
            <!-- Social Media Links -->
            <div class="col-md-4 d-flex align-items-center justify-content-md-end mt-4 mt-md-0">
                <div class="footer-social-icons">
                    <a href="https://linkedin.com" target="_blank" class="me-3"><i class="fab fa-linkedin"></i></a>
                    <a href="https://instagram.com" target="_blank" class="me-3"><i class="fab fa-instagram"></i></a>
                    <a href="https://facebook.com" target="_blank" class="me-3"><i class="fab fa-facebook"></i></a>
                    <a href="https://youtube.com" target="_blank"><i class="fab fa-youtube"></i></a>
                </div>
            </div>
        </div>
    </div>
    <style>
        .footer-container {
            background-color: #f8f9fa;
            padding-top: 3rem;
            padding-bottom: 3rem;
            border-top: 1px solid #e0e0e0;
        }

        .footer-logo img {
            height: 50px;
        }

        .footer-address,
        .footer-email {
            font-size: 14px;
            color: #333;
        }

        .footer-social-icons a {
            font-size: 24px;
            margin-right: 15px;
            color: #333;
            transition: color 0.3s;
        }

        .footer-social-icons a:hover {
            color: #007bff;
        }
    </style>
</div>