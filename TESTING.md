# ProTeach Testing Documentation

## Manual Testing Guide

### Test Environment Setup
1. Ensure MySQL is running
2. Create database: `proteach`
3. Import schema from `database.sql`
4. Start PHP server: `php -S localhost:8000`

### Test Cases

#### 1. User Registration
**Test Case:** Register a new user account
- Navigate to register.php
- Fill in all fields:
  - Full Name: "John Teacher"
  - Username: "johnteacher"
  - Email: "john@example.com"
  - Password: "password123"
  - Confirm Password: "password123"
- Submit form
- Expected: Success message and redirect option to login

**Validation Tests:**
- Empty fields → Error message
- Password mismatch → Error message
- Password < 6 chars → Error message
- Duplicate username → Error message
- Invalid email format → Error message

#### 2. User Login
**Test Case:** Login with registered account
- Navigate to login.php
- Enter username: "johnteacher"
- Enter password: "password123"
- Submit form
- Expected: Redirect to dashboard.php

**Validation Tests:**
- Invalid credentials → Error message
- Empty fields → Error message
- Stay logged in across pages

#### 3. Dashboard Display
**Test Case:** View user dashboard
- Login and access dashboard.php
- Expected to see:
  - Welcome message with user's full name
  - Statistics (enrolled courses, completed, progress)
  - List of enrolled courses (initially empty)
  - Link to browse courses

#### 4. Course Browsing
**Test Case:** Browse available courses
- Navigate to courses.php
- Expected to see:
  - 4 sample courses displayed
  - Course title, description, duration, category
  - "View Course" button (when logged in)
  - "Login to Enroll" button (when not logged in)

#### 5. Course Enrollment
**Test Case:** Enroll in a course
- Login and navigate to courses.php
- Click "View Course" on "Effective Classroom Management"
- Click "Enroll Now" button
- Expected: 
  - Page refreshes showing enrolled status
  - Progress bar at 0%
  - List of learning materials
  - List of assessments

#### 6. Material Access
**Test Case:** Access learning material
- From enrolled course page, click on first material
- Expected:
  - Material content displayed
  - "Mark as Complete" button
  - Navigation to next material

**Test Case:** Mark material as complete
- Click "Mark as Complete"
- Expected:
  - Redirect to course page
  - Material marked with checkmark
  - Progress percentage updated

#### 7. Progress Tracking
**Test Case:** Track course progress
- Complete 1 out of 3 materials in a course
- Return to dashboard
- Expected:
  - Progress bar shows 33%
  - Course status shows "active"

**Test Case:** Complete all materials
- Complete all 3 materials in course
- Expected:
  - Progress bar shows 100%
  - All materials have checkmarks

#### 8. Assessment Taking
**Test Case:** Take an assessment
- From course page, click "Take Assessment"
- Expected:
  - Instructions displayed
  - All questions shown with multiple choice options
  - "Submit Assessment" button

**Test Case:** Submit assessment
- Select answers for all questions
- Click "Submit Assessment"
- Confirm submission
- Expected:
  - Results page with score
  - Pass/Fail status
  - Correct answers shown
  - Option to retry (if failed) or return to course

#### 9. Assessment Results
**Test Case:** Pass an assessment
- Answer all questions correctly
- Expected:
  - Score: 100%
  - "Passed" status with green styling
  - All answers marked correct (✓)

**Test Case:** Fail an assessment
- Answer questions incorrectly
- Expected:
  - Score below passing threshold
  - "Failed" status with red styling
  - Incorrect answers marked (✗)
  - Correct answers shown
  - "Try Again" button available

#### 10. Navigation
**Test Case:** Navigation menu
- Test all navigation links:
  - Home → index.php
  - Courses → courses.php
  - Dashboard → dashboard.php (logged in only)
  - Login/Logout → appropriate page

#### 11. Responsive Design
**Test Case:** Mobile responsiveness
- Resize browser to mobile width (< 768px)
- Expected:
  - Navigation adapts to mobile view
  - Course grid changes to single column
  - All content remains readable
  - Buttons remain clickable

#### 12. Security
**Test Case:** Unauthorized access
- Logout
- Try to access dashboard.php directly
- Expected: Redirect to login.php

**Test Case:** SQL injection prevention
- Try SQL injection in login form: `' OR '1'='1`
- Expected: Login fails (prepared statements prevent injection)

**Test Case:** XSS prevention
- Try entering `<script>alert('XSS')</script>` in registration
- Expected: Script rendered as text, not executed

### Expected Sample Data
After importing database.sql:
- 4 courses
- 8 learning materials
- 3 assessments
- 7 assessment questions

### Performance Tests
- Page load time < 2 seconds
- Form submission < 1 second
- Database queries optimized with indexes
- No N+1 query problems

### Browser Compatibility
Test on:
- Chrome (latest)
- Firefox (latest)
- Safari (latest)
- Edge (latest)

### Known Limitations
1. No password reset functionality
2. No email verification
3. No file upload for materials
4. No admin panel
5. No course creation interface (requires direct database access)
6. No user profile editing
7. No certificate generation

### Success Criteria
✓ All test cases pass
✓ No PHP errors or warnings
✓ No JavaScript console errors
✓ Responsive design works on mobile and desktop
✓ Security measures in place
✓ Progress tracking accurate
✓ Assessment scoring correct
✓ User experience smooth and intuitive
