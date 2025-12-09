<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EdusparkOnline - Homepage</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: #f5f7fa;
            overflow-x: hidden;
        }

        /* Hero Slider Section */
        .container {
            max-width: 1400px;
            margin: 40px auto;
            padding: 0 20px;
            position: relative;
        }

        .images {
            position: relative;
            width: 100%;
            height: 550px;
            border-radius: 20px;
            overflow: hidden;
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.15);
        }

        .images input {
            display: none;
        }

        .images img {
            position: absolute;
            width: 100%;
            height: 100%;
            object-fit: cover;
            opacity: 0;
            transition: opacity 0.8s ease-in-out;
        }

        #slide1:checked ~ .s1,
        #slide2:checked ~ .s2,
        #slide3:checked ~ .s3,
        #slide4:checked ~ .s4 {
            opacity: 1;
        }

        .dots {
            position: absolute;
            bottom: 30px;
            left: 50%;
            transform: translateX(-50%);
            display: flex;
            gap: 12px;
            z-index: 10;
        }

        .dots label {
            width: 50px;
            height: 6px;
            background: rgba(255, 255, 255, 0.4);
            border-radius: 3px;
            cursor: pointer;
            transition: all 0.3s ease;
            backdrop-filter: blur(5px);
        }

        .dots label:hover {
            background: rgba(255, 255, 255, 0.7);
        }

        #slide1:checked ~ .dots label:nth-child(1),
        #slide2:checked ~ .dots label:nth-child(2),
        #slide3:checked ~ .dots label:nth-child(3),
        #slide4:checked ~ .dots label:nth-child(4) {
            background: #f18930;
            width: 70px;
        }

        #become-teacher {
            margin-top: 40px;
            padding: 18px 50px;
            background: linear-gradient(135deg, #f18930 0%, #ff6b6b 100%);
            color: white;
            border: none;
            border-radius: 50px;
            font-size: 18px;
            font-weight: 600;
            cursor: pointer;
            box-shadow: 0 8px 25px rgba(241, 137, 48, 0.4);
            transition: all 0.4s ease;
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        #become-teacher:hover {
            transform: translateY(-3px);
            box-shadow: 0 12px 35px rgba(241, 137, 48, 0.6);
            background: linear-gradient(135deg, #ff6b6b 0%, #f18930 100%);
        }

        /* Courses Section */
        .body-content {
            max-width: 1400px;
            margin: 80px auto;
            padding: 0 20px;
        }

        .heading {
            text-align: center;
            font-size: 42px;
            font-weight: 700;
            color: #2d3748;
            margin-bottom: 20px;
            position: relative;
            padding-bottom: 20px;
        }

        .heading::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 50%;
            transform: translateX(-50%);
            width: 120px;
            height: 4px;
            background: linear-gradient(90deg, #f18930, #ff6b6b);
            border-radius: 2px;
        }

        .body {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(380px, 1fr));
            gap: 35px;
            margin-top: 60px;
        }

        .box {
            background: white;
            border-radius: 16px;
            overflow: hidden;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.08);
            transition: all 0.4s ease;
            position: relative;
        }

        .box::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 4px;
            background: linear-gradient(90deg, #667eea, #764ba2);
            transform: scaleX(0);
            transition: transform 0.4s ease;
        }

        .box:hover {
            transform: translateY(-10px);
            box-shadow: 0 20px 50px rgba(0, 0, 0, 0.15);
        }

        .box:hover::before {
            transform: scaleX(1);
        }

        .body-img {
            width: 100%;
            height: 280px;
            overflow: hidden;
            position: relative;
        }

        .body-img img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.5s ease;
        }

        .box:hover .body-img img {
            transform: scale(1.1);
        }

        .body-img::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            right: 0;
            height: 80px;
            background: linear-gradient(to top, rgba(0,0,0,0.3), transparent);
        }

        .img-content {
            padding: 25px;
        }

        .img-content h3 {
            font-size: 22px;
            color: #2d3748;
            margin-bottom: 15px;
            font-weight: 600;
            min-height: 55px;
        }

        .img-content p {
            color: #718096;
            font-size: 14px;
            line-height: 1.8;
            margin-bottom: 15px;
            min-height: 80px;
        }

        .Reg-btn {
            width: 100%;
            padding: 14px;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            border: none;
            border-radius: 10px;
            font-size: 15px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .Reg-btn:hover {
            background: linear-gradient(135deg, #764ba2 0%, #667eea 100%);
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(102, 126, 234, 0.4);
        }

        /* Events Section */
        #events {
            max-width: 1400px;
            margin: 80px auto;
            padding: 0 20px;
            position: relative;
        }

        #events img {
            width: 100%;
            height: auto;
            border-radius: 20px;
            box-shadow: 0 15px 40px rgba(0, 0, 0, 0.1);
            display: block;
        }

        #load-more {
            margin-top: 35px;
            padding: 16px 45px;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            border: none;
            border-radius: 50px;
            font-size: 16px;
            font-weight: 600;
            cursor: pointer;
            box-shadow: 0 8px 25px rgba(102, 126, 234, 0.4);
            transition: all 0.4s ease;
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        #load-more:hover {
            transform: translateY(-3px);
            box-shadow: 0 12px 35px rgba(102, 126, 234, 0.6);
            background: linear-gradient(135deg, #764ba2 0%, #667eea 100%);
        }

        /* Subscription Background */
        #subbg {
            margin: 80px 0 0;
            width: 100%;
            position: relative;
        }

        #subbg img {
            width: 100%;
            height: auto;
            display: block;
            min-height: 400px;
            object-fit: cover;
        }

        /* Star Ratings */
        .img-content p {
            position: relative;
        }

        /* Responsive Design */
        @media (max-width: 1200px) {
            .body {
                grid-template-columns: repeat(auto-fit, minmax(320px, 1fr));
                gap: 30px;
            }
        }

        @media (max-width: 768px) {
            .images {
                height: 400px;
            }

            .heading {
                font-size: 32px;
            }

            .body {
                grid-template-columns: 1fr;
                gap: 25px;
            }

            .box {
                max-width: 500px;
                margin: 0 auto;
            }

            #become-teacher,
            #load-more {
                width: 90%;
                max-width: 400px;
            }
        }

        @media (max-width: 480px) {
            .images {
                height: 300px;
                border-radius: 12px;
            }

            .heading {
                font-size: 26px;
            }

            .img-content h3 {
                font-size: 19px;
                min-height: auto;
            }

            .img-content p {
                font-size: 13px;
                min-height: auto;
            }

            #become-teacher,
            #load-more {
                padding: 14px 30px;
                font-size: 14px;
            }
        }

        /* Auto-play animation for slider */
        @keyframes autoSlide {
            0%, 25% { opacity: 1; }
            30%, 100% { opacity: 0; }
        }
    </style>
</head>
<body>
    <!-- Header would be included here via PHP -->
    <!-- <?php require 'header.php'; ?> -->

    <center>
        <div class="container">
            <div class="images">
                <input type="radio" name="slide" id="slide1" checked>
                <input type="radio" name="slide" id="slide2">
                <input type="radio" name="slide" id="slide3">
                <input type="radio" name="slide" id="slide4">

                <img src="images/slide1.png" alt="slide1" class="s1">
                <img src="images/slide2.png" alt="slide2" class="s2">
                <img src="images/slide3.png" alt="slide3" class="s3">
                <img src="images/slide4.jpg" alt="slide4" class="s4">

                <div class="dots">
                    <label for="slide1"></label>
                    <label for="slide2"></label>
                    <label for="slide3"></label>
                    <label for="slide4"></label>
                </div>
            </div>
        </div>
        
        <button id="become-teacher">Become An Educator</button>
    </center>

    <div class="body-content">
        <h1 class="heading">Our Latest Courses To Explore</h1>
        
        <div class="body">
            <div class="box" id="course1">
                <div class="body-img">
                    <img src="images/courses/ai.png" alt="AI & Machine Learning Course">
                </div>
                <div class="img-content">
                    <h3>Artificial Intelligence & Machine Learning</h3>
                    <p>This course introduces Artificial Intelligence & Machine Learning and how these algorithms could be applied to general applications.<br>★★★★☆</p>
                    <button class="Reg-btn">More Details</button>
                </div>
            </div>

            <div class="box" id="course2">
                <div class="body-img">
                    <img src="images/courses/java.png" alt="Java Development Course">
                </div>
                <div class="img-content">
                    <h3>JAVA Development</h3>
                    <p>This course provides the base for a versatile and popular programming language used in web and mobile apps.<br>★★★★☆</p>
                    <button class="Reg-btn">More Details</button>
                </div>
            </div>

            <div class="box" id="course3">
                <div class="body-img">
                    <img src="images/courses/graphic.png" alt="Graphics Design Course">
                </div>
                <div class="img-content">
                    <h3>Graphics Design</h3>
                    <p>This course focuses on designing professional-grade materials using the required knowledge.<br>★★★★☆</p>
                    <button class="Reg-btn">More Details</button>
                </div>
            </div>

            <div class="box" id="course4">
                <div class="body-img">
                    <img src="images/courses/ui.png" alt="UI/UX Design Course">
                </div>
                <div class="img-content">
                    <h3>UI/UX Design</h3>
                    <p>This course helps educators understand the principles of UI/UX design to build professional applications.<br>★★★★☆</p>
                    <button class="Reg-btn">More Details</button>
                </div>
            </div>

            <div class="box" id="course5">
                <div class="body-img">
                    <img src="images/courses/data.png" alt="Data Science Course">
                </div>
                <div class="img-content">
                    <h3>Data Science</h3>
                    <p>This course focuses on collecting, analyzing, and interpreting data to improve performance.<br>★★★★☆</p>
                    <button class="Reg-btn">More Details</button>
                </div>
            </div>

            <div class="box" id="course6">
                <div class="body-img">
                    <img src="images/courses/ps.png" alt="Adobe Photoshop Course">
                </div>
                <div class="img-content">
                    <h3>Adobe Photoshop</h3>
                    <p>This course covers advanced Photoshop skills to create professional-grade designs.<br>★★★★☆</p>
                    <button class="Reg-btn">More Details</button>
                </div>
            </div>
        </div>
    </div>

    <center>
        <div id="events">
            <img src="images/events.png" alt="Upcoming Events">
            <button id="load-more">See Upcoming Events</button>
        </div>
    </center>

    <div id="subbg">
        <img src="images/subbg.png" alt="Subscribe background">
    </div>

    <!-- Footer would be included here via PHP -->
    <!-- <?php include 'footer.php'; ?> -->

    <script>
        // Auto-play slider
        let currentSlide = 1;
        setInterval(() => {
            currentSlide = currentSlide === 4 ? 1 : currentSlide + 1;
            document.getElementById(`slide${currentSlide}`).checked = true;
        }, 5000);
    </script>
</body>
</html>