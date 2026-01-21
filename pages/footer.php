<footer class="footer">
    <div class="footer-container">
        <div class="footer-content">
            <!-- CONTACT -->
            <div class="footer-section">
                <h3>Contact</h3>
                <div class="contact-info">
                    <a href="tel:+48354247529">+48 354 247 529</a>
                    <a href="mailto:contact@dotfit.com">contact@dotfit.com</a>
                    <address>
                        26-600 Radom<br>
                        Poland
                    </address>
                </div>
            </div>

            <!-- DESCRIPTION -->
            <div class="footer-section">
                <h3>.Fit</h3>
                <p>
                    We deliver reliable fitness and technology solutions for an active lifestyle.
                    Your progress is powered by our platform.
                </p>
            </div>
        </div>

        <!-- LEGAL -->
        <div class="footer-bottom">
            <p>© 2025 .Fit. All rights reserved.</p>
            <p>This website is the property of .Fit Company.</p>
        </div>
    </div>
</footer>

<style>
    @import url('https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600&display=swap');

    .footer {
        background: linear-gradient(180deg, #ffffff 0%, #fafafa 100%);
        border-top: 1px solid rgba(0, 0, 0, 0.08);
        padding: 80px 40px 30px;
        margin-top: 100px;
        font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', Helvetica, Arial, sans-serif;
        color: #1a1a1a;
    }

    .footer-container {
        max-width: 1200px;
        margin: 0 auto;
    }

    .footer-content {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
        gap: 60px;
        margin-bottom: 60px;
    }

    .footer-section h3 {
        font-size: 14px;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 1.5px;
        color: #000;
        margin-bottom: 24px;
        position: relative;
    }

    .footer-section h3::after {
        content: '';
        position: absolute;
        bottom: -8px;
        left: 0;
        width: 24px;
        height: 2px;
        background: #000;
    }

    .footer-section p {
        font-size: 15px;
        font-weight: 400;
        line-height: 1.8;
        color: #666;
        margin: 0;
        max-width: 380px;
    }

    .contact-info {
        display: flex;
        flex-direction: column;
        gap: 12px;
    }

    .contact-info a {
        color: #1a1a1a;
        text-decoration: none;
        font-size: 15px;
        font-weight: 400;
        transition: all 0.2s ease;
        display: inline-block;
    }

    .contact-info a:hover {
        color: #000;
        transform: translateX(4px);
    }

    .contact-info address {
        font-style: normal;
        font-size: 15px;
        font-weight: 400;
        line-height: 1.6;
        color: #666;
        margin-top: 8px;
    }

    .footer-bottom {
        border-top: 1px solid rgba(0, 0, 0, 0.08);
        padding-top: 30px;
        display: flex;
        justify-content: space-between;
        align-items: center;
        flex-wrap: wrap;
        gap: 20px;
    }

    .footer-bottom p {
        font-size: 13px;
        font-weight: 400;
        color: #999;
        margin: 0;
        letter-spacing: 0.3px;
    }

    /* Responsive */
    @media (max-width: 768px) {
        .footer {
            padding: 60px 30px 25px;
        }

        .footer-content {
            grid-template-columns: 1fr;
            gap: 40px;
        }

        .footer-bottom {
            flex-direction: column;
            align-items: flex-start;
            gap: 8px;
        }
    }

    /* Dark mode support */
    @media (prefers-color-scheme: dark) {
        .footer {
            background: linear-gradient(180deg, #0a0a0a 0%, #000000 100%);
            border-top-color: rgba(255, 255, 255, 0.1);
            color: #f0f0f0;
        }

        .footer-section h3 {
            color: #fff;
        }

        .footer-section h3::after {
            background: #fff;
        }

        .footer-section p,
        .contact-info address {
            color: #a0a0a0;
        }

        .contact-info a {
            color: #f0f0f0;
        }

        .contact-info a:hover {
            color: #fff;
        }

        .footer-bottom {
            border-top-color: rgba(255, 255, 255, 0.1);
        }

        .footer-bottom p {
            color: #666;
        }
    }

    /* FOR COMMENTS STYLE */
    .comment-popup {
        display: none;
        position: fixed;
        inset: 0;
        background: rgba(0, 0, 0, 0.6);
        backdrop-filter: blur(6px);
        z-index: 999;
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
    }

    .comment-popup h3 {
        color: #fff;
        margin-bottom: 10px;
    }

    .comment-content {
        width: 350px;
        max-height: 300px;
        overflow-y: auto;
        /* ✅ scroll */
        background: #1f1f1f;
        border-radius: 12px;
        padding: 15px;
    }

    .comment-item {
        margin-bottom: 12px;
        color: #ddd;
    }

    .comment-item strong {
        display: block;
        color: #fff;
    }

    .close-comment {
        margin-top: 12px;
        padding: 8px 20px;
        border-radius: 20px;
        border: none;
        cursor: pointer;
    }
</style>


</body>

</html>