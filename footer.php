<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EdusparkOnline Footer</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }

        footer {
            margin-top: auto;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: #ffffff;
            padding: 60px 0 0;
            position: relative;
            overflow: hidden;
        }

        footer::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 4px;
            background: linear-gradient(90deg, #f18930, #ff6b6b, #4ecdc4, #45b7d1);
            background-size: 300% 100%;
            animation: gradient 3s ease infinite;
        }

        @keyframes gradient {
            0%, 100% { background-position: 0% 50%; }
            50% { background-position: 100% 50%; }
        }

        #containerr {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 20px;
            display: grid;
            grid-template-columns: 1.2fr 1fr 1fr 0.8fr;
            gap: 40px;
            align-items: start;
        }

        #logo2 {
            width: 100%;
            max-width: 280px;
            height: auto;
            filter: drop-shadow(0 4px 12px rgba(0, 0, 0, 0.2));
            transition: transform 0.3s ease;
        }

        #logo2:hover {
            transform: scale(1.05);
        }

        .footer-items {
            padding: 10px 0;
        }

        h3 {
            font-size: 22px;
            font-weight: 600;
            margin-bottom: 20px;
            position: relative;
            padding-bottom: 12px;
            letter-spacing: 0.5px;
        }

        h3::after {
            content: '';
            position: absolute;
            left: 0;
            bottom: 0;
            width: 50px;
            height: 3px;
            background: #f18930;
            border-radius: 2px;
        }

        .footer-items p {
            font-size: 14px;
            line-height: 1.8;
            margin-bottom: 12px;
            opacity: 0.95;
            transition: all 0.3s ease;
        }

        .footer-items p:hover {
            opacity: 1;
            transform: translateX(5px);
        }

        .footer-items p i {
            margin-right: 8px;
            color: #f18930;
            width: 18px;
        }

        #list {
            list-style: none;
        }

        #list li {
            margin-bottom: 10px;
            transition: all 0.3s ease;
        }

        #list li a {
            color: #ffffff;
            text-decoration: none;
            font-size: 14px;
            display: inline-block;
            position: relative;
            transition: all 0.3s ease;
            opacity: 0.9;
        }

        #list li a::before {
            content: '→';
            margin-right: 8px;
            opacity: 0;
            transform: translateX(-10px);
            transition: all 0.3s ease;
        }

        #list li:hover a::before {
            opacity: 1;
            transform: translateX(0);
        }

        #list li a:hover {
            color: #f18930;
            opacity: 1;
            padding-left: 5px;
        }

        .social-links {
            display: flex;
            gap: 15px;
            margin-top: 15px;
        }

        .social-links a {
            display: flex;
            align-items: center;
            justify-content: center;
            width: 45px;
            height: 45px;
            background: rgba(255, 255, 255, 0.1);
            border-radius: 50%;
            color: #ffffff;
            font-size: 20px;
            transition: all 0.3s ease;
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.2);
        }

        .social-links a:hover {
            background: #f18930;
            transform: translateY(-5px);
            box-shadow: 0 8px 20px rgba(241, 137, 48, 0.4);
            border-color: #f18930;
        }

        .bottom-bar {
            background: rgba(0, 0, 0, 0.2);
            text-align: center;
            padding: 25px 20px;
            margin-top: 50px;
            backdrop-filter: blur(10px);
        }

        .bottom-bar p {
            font-size: 14px;
            opacity: 0.9;
            line-height: 1.6;
        }

        .bottom-bar p span {
            color: #f18930;
            font-weight: 600;
        }

        @media (max-width: 968px) {
            #containerr {
                grid-template-columns: 1fr 1fr;
                gap: 30px;
            }

            #logo2 {
                max-width: 200px;
            }
        }

        @media (max-width: 640px) {
            #containerr {
                grid-template-columns: 1fr;
                text-align: center;
            }

            h3::after {
                left: 50%;
                transform: translateX(-50%);
            }

            .footer-items p {
                margin: 0 auto 12px;
            }

            #list li a::before {
                display: none;
            }

            .social-links {
                justify-content: center;
            }

            #logo2 {
                margin: 0 auto;
            }
        }
    </style>
</head>
<body>
    <footer>
        <div id="containerr">
            <div>
                <img src="images/logo2.png" alt="EdusparkOnline Logo" id="logo2">
            </div>
            
            <div class="footer-items">
                <h3>Contact Us</h3>
                <p><i class="fas fa-envelope"></i>info@EdusparkOnline.com</p>
                <p><i class="fas fa-phone"></i>+94 117827682</p>
                <p><i class="fas fa-map-marker-alt"></i>Eduspark Building, 9th Lane, High Level Road, Maharagama</p>
            </div>
            
            <div class="footer-items">
                <h3>Quick Links</h3>
                <ul id="list">
                    <li><a href="#">Home</a></li>
                    <li><a href="#">Courses</a></li>
                    <li><a href="#">Events</a></li>
                    <li><a href="#">About Us</a></li>
                    <li><a href="#">Contact Us</a></li>
                    <li><a href="#">FAQ</a></li>
                    <li><a href="#">Terms & Conditions</a></li>
                    <li><a href="#">Privacy & Cookies</a></li>
                </ul>
            </div>

            <div class="footer-items">
                <h3>Follow Us</h3>
                <div class="social-links">
                    <a href="#" aria-label="Facebook"><i class="fab fa-facebook-f"></i></a>
                    <a href="#" aria-label="Twitter"><i class="fab fa-twitter"></i></a>
                    <a href="#" aria-label="Instagram"><i class="fab fa-instagram"></i></a>
                    <a href="#" aria-label="LinkedIn"><i class="fab fa-linkedin-in"></i></a>
                </div>
            </div>
        </div>
        
        <div class="bottom-bar">
            <p>
                © 2024 <span>EdusparkOnline</span>. All rights reserved.<br>
                Created By: MLB_01.02_01
            </p>
        </div>
    </footer>
</body>
</html>