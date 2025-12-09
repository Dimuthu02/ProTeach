# ProTeach - Online Teacher Training Platform

ProTeach is an online teacher training platform built with PHP, HTML, CSS, and JavaScript. It allows educators to enroll in courses, access learning materials, complete interactive assessments, and track their progress efficiently. Designed for teachers and trainers, ProTeach helps enhance professional skills anytime, anywhere.

## Features

### 🎓 Core Functionality
- **User Authentication**: Secure registration and login system for educators
- **Course Catalog**: Browse comprehensive teacher training courses
- **Course Enrollment**: Easy one-click enrollment in courses
- **Learning Materials**: Access structured learning content for each course
- **Interactive Assessments**: Complete quizzes to test understanding
- **Progress Tracking**: Monitor completion status and view detailed statistics
- **Dashboard**: Personalized dashboard showing enrolled courses and progress

### 📚 Course Categories
- Classroom Management
- Educational Technology
- Assessment Strategies
- Student Engagement Techniques

### 🎯 Key Features
- Responsive design that works on desktop and mobile devices
- Real-time progress calculation
- Material completion tracking
- Assessment scoring with immediate feedback
- Certificate-ready completion tracking

## Installation

### Prerequisites
- PHP 7.4 or higher
- MySQL 5.7 or higher
- Web server (Apache, Nginx, or PHP built-in server)

### Setup Steps

1. **Clone the repository**
   ```bash
   git clone https://github.com/Dimuthu02/ProTeach.git
   cd ProTeach
   ```

2. **Create the database**
   - Create a MySQL database named `proteach`
   - Import the database schema:
   ```bash
   mysql -u root -p proteach < database.sql
   ```

3. **Configure database connection**
   - Open `config.php`
   - Update the database credentials if needed:
   ```php
   define('DB_HOST', 'localhost');
   define('DB_USER', 'root');
   define('DB_PASS', '');
   define('DB_NAME', 'proteach');
   ```

4. **Start the web server**
   
   Using PHP built-in server:
   ```bash
   php -S localhost:8000
   ```
   
   Or configure Apache/Nginx to point to the project directory.

5. **Access the application**
   - Open your browser and navigate to `http://localhost:8000`
   - Register a new account to get started

## Usage

### For Educators

1. **Register an Account**
   - Click "Sign Up" in the navigation
   - Fill in your details (full name, username, email, password)
   - Submit the registration form

2. **Login**
   - Use your username and password to login
   - You'll be redirected to your personalized dashboard

3. **Browse and Enroll in Courses**
   - Click "Courses" in the navigation
   - Browse available courses
   - Click "View Course" to see course details
   - Click "Enroll Now" to enroll in a course

4. **Access Learning Materials**
   - From your dashboard or course page, click on any material
   - Read through the content
   - Click "Mark as Complete" when finished
   - Progress to the next material

5. **Complete Assessments**
   - Navigate to a course's assessment section
   - Click "Take Assessment"
   - Answer all questions
   - Submit to receive your score immediately
   - Review correct answers if you don't pass

6. **Track Your Progress**
   - View your dashboard to see overall progress
   - Check completion percentages for each enrolled course
   - Review your assessment scores and history

## File Structure

```
ProTeach/
├── index.php           # Landing/home page
├── register.php        # User registration
├── login.php           # User login
├── logout.php          # Logout functionality
├── dashboard.php       # User dashboard
├── courses.php         # Course catalog
├── course.php          # Individual course page
├── material.php        # Material viewing page
├── assessment.php      # Assessment/quiz page
├── config.php          # Database configuration
├── database.sql        # Database schema and sample data
├── style.css           # Main stylesheet
├── script.js           # JavaScript for interactivity
├── .gitignore         # Git ignore file
└── README.md          # This file
```

## Database Schema

### Tables
- **users**: Store educator accounts
- **courses**: Course information
- **enrollments**: User-course relationships
- **materials**: Learning content for courses
- **assessments**: Quizzes/tests for courses
- **questions**: Assessment questions
- **assessment_attempts**: User assessment results
- **material_progress**: Track material completion

## Technologies Used

- **Backend**: PHP (procedural)
- **Database**: MySQL
- **Frontend**: HTML5, CSS3, JavaScript
- **Design**: Responsive CSS with mobile-first approach

## Security Features

- Password hashing using PHP's `password_hash()`
- SQL injection prevention using prepared statements
- Session-based authentication
- Input validation and sanitization
- XSS prevention with `htmlspecialchars()`

## Sample Data

The database comes pre-populated with:
- 4 sample courses
- 8 learning materials
- 3 assessments
- 7 sample questions

You can add more courses, materials, and assessments directly through the database.

## Contributing

Contributions are welcome! Please feel free to submit pull requests or open issues.

## License

This project is open-source and available under the MIT License.

## Support

For questions or support, please open an issue on the GitHub repository.

---

**ProTeach** - Empowering educators through accessible, high-quality professional development.
