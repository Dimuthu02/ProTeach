# ProTeach Application Architecture

## System Architecture

```
┌─────────────────────────────────────────────────────────────┐
│                         ProTeach                              │
│              Online Teacher Training Platform                 │
└─────────────────────────────────────────────────────────────┘

┌─────────────────────────────────────────────────────────────┐
│                      Presentation Layer                       │
├─────────────────────────────────────────────────────────────┤
│  HTML/CSS (style.css)  │  JavaScript (script.js)             │
│  - Responsive Design    │  - Form Validation                 │
│  - Mobile-First        │  - Progress Animation              │
│  - Consistent Styling  │  - Interactive Features            │
└─────────────────────────────────────────────────────────────┘

┌─────────────────────────────────────────────────────────────┐
│                     Application Layer                         │
├─────────────────────────────────────────────────────────────┤
│  Authentication        │  Course Management                  │
│  - register.php        │  - courses.php (listing)            │
│  - login.php          │  - course.php (detail)              │
│  - logout.php         │  - material.php (content)           │
│  - config.php         │  - assessment.php (quiz)            │
│                       │  - dashboard.php (progress)         │
└─────────────────────────────────────────────────────────────┘

┌─────────────────────────────────────────────────────────────┐
│                        Data Layer                             │
├─────────────────────────────────────────────────────────────┤
│                    MySQL Database (proteach)                  │
│  - users              │  - enrollments                       │
│  - courses            │  - material_progress                 │
│  - materials          │  - assessment_attempts               │
│  - assessments        │  - questions                         │
└─────────────────────────────────────────────────────────────┘
```

## User Flow Diagram

```
┌─────────────┐
│   Visitor   │
└──────┬──────┘
       │
       ├──────> Browse Courses (courses.php)
       │        └─> View Course Details
       │
       ├──────> Register (register.php)
       │        └─> Create Account
       │
       └──────> Login (login.php)
                └─────┬─────────────────────────────┐
                      │                             │
                ┌─────▼─────────┐          ┌────────▼────────┐
                │   Dashboard   │          │  Browse Courses  │
                │(dashboard.php)│          │  (courses.php)   │
                └─────┬─────────┘          └────────┬─────────┘
                      │                             │
                      ├─> View Enrolled Courses     │
                      ├─> Check Progress            │
                      └─> View Assessment Results   │
                                                     │
                                              ┌──────▼─────────┐
                                              │  Course Detail  │
                                              │  (course.php)   │
                                              └──────┬──────────┘
                                                     │
                        ┌────────────────────────────┼────────────────────┐
                        │                            │                    │
                  ┌─────▼────────┐        ┌─────────▼────────┐   ┌──────▼──────┐
                  │   Materials   │        │   Assessments    │   │   Enroll    │
                  │(material.php) │        │(assessment.php)  │   │   Course    │
                  └─────┬─────────┘        └─────────┬────────┘   └─────────────┘
                        │                            │
                        ├─> Read Content            ├─> Take Quiz
                        ├─> Mark Complete           ├─> Submit Answers
                        └─> Next Material           └─> View Results
```

## Database Schema Overview

```
┌──────────────┐         ┌──────────────┐         ┌──────────────┐
│    users     │         │   courses    │         │  materials   │
├──────────────┤         ├──────────────┤         ├──────────────┤
│ id (PK)      │         │ id (PK)      │         │ id (PK)      │
│ username     │         │ title        │    ┌────│ course_id FK │
│ email        │         │ description  │    │    │ title        │
│ password     │         │ category     │    │    │ content      │
│ full_name    │         │ duration_hrs │    │    │ type         │
│ created_at   │         └──────┬───────┘    │    │ order_index  │
└──────┬───────┘                │            │    └──────────────┘
       │                        │            │
       │        ┌───────────────┘            │
       │        │                            │
       │  ┌─────▼──────────┐                 │
       │  │  enrollments   │                 │
       │  ├────────────────┤                 │
       ├──│ user_id (FK)   │                 │
       │  │ course_id (FK) │─────────────────┘
       │  │ completion_%   │
       │  │ status         │
       │  └────────────────┘
       │
       │  ┌──────────────────┐         ┌──────────────┐
       │  │material_progress │         │ assessments  │
       │  ├──────────────────┤         ├──────────────┤
       └──│ user_id (FK)     │         │ id (PK)      │
          │ material_id (FK) │         │ course_id FK │
          │ completed        │         │ title        │
          └──────────────────┘         │ description  │
                                      │ passing_score│
       ┌──────────────────┐           └──────┬───────┘
       │assessment_attempts│                 │
       ├──────────────────┤                 │
       │ user_id (FK)     │           ┌─────▼────────┐
       │ assessment_id FK │           │  questions   │
       │ score            │           ├──────────────┤
       │ passed           │           │ id (PK)      │
       │ completed_at     │           │ assessment_id│
       └──────────────────┘           │ question_text│
                                      │ option_a/b/c/d
                                      │ correct_answer
                                      └──────────────┘
```

## Feature Implementation Status

### ✅ Completed Features
- User registration and authentication
- Session management
- Course browsing and listing
- Course enrollment
- Learning materials viewing
- Material progress tracking
- Interactive assessments/quizzes
- Assessment scoring and feedback
- Progress calculation and display
- Responsive design
- Form validation
- Security measures (password hashing, SQL injection prevention, XSS protection)

### 🎯 Core Functionality
1. **Authentication System**
   - Secure password hashing
   - Session-based login
   - Access control

2. **Course Management**
   - Course catalog
   - Course details
   - Enrollment system

3. **Learning System**
   - Sequential materials
   - Progress tracking
   - Completion status

4. **Assessment System**
   - Multiple choice quizzes
   - Immediate scoring
   - Result history
   - Pass/fail determination

5. **Progress Tracking**
   - Material completion %
   - Course completion %
   - Assessment results
   - Dashboard statistics

## File Structure & Responsibilities

```
ProTeach/
│
├── Authentication
│   ├── register.php    - User registration form & processing
│   ├── login.php       - User login form & authentication
│   ├── logout.php      - Session destruction
│   └── config.php      - Database config & auth helpers
│
├── Course System
│   ├── courses.php     - Browse all courses (catalog)
│   ├── course.php      - View single course & enroll
│   ├── material.php    - View/complete learning material
│   └── assessment.php  - Take quiz & view results
│
├── User Interface
│   ├── index.php       - Landing page/homepage
│   ├── dashboard.php   - User's personal dashboard
│   └── setup.php       - Setup instructions page
│
├── Assets
│   ├── style.css       - All CSS styles (responsive)
│   └── script.js       - JavaScript interactivity
│
└── Database
    ├── database.sql    - Schema & sample data
    ├── TESTING.md      - Testing documentation
    └── README.md       - Project documentation
```

## Security Measures

1. **Password Security**
   - Hashed with `password_hash()` using bcrypt
   - Minimum 6 characters requirement

2. **SQL Injection Prevention**
   - All queries use prepared statements
   - Parameter binding for all user inputs

3. **XSS Prevention**
   - All output escaped with `htmlspecialchars()`
   - No direct HTML rendering of user input

4. **Authentication**
   - Session-based authentication
   - Login required for sensitive pages
   - Automatic redirect for unauthenticated access

5. **Data Validation**
   - Server-side validation for all forms
   - Email format validation
   - Password confirmation check
   - Required field checks

## Technology Stack

- **Backend**: PHP 7.4+ (procedural)
- **Database**: MySQL 5.7+
- **Frontend**: HTML5, CSS3, JavaScript (ES6)
- **Authentication**: Session-based
- **Security**: Prepared statements, password hashing, XSS protection
