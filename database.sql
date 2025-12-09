-- ProTeach Database Schema
-- Online Teacher Training Platform

CREATE DATABASE IF NOT EXISTS proteach;
USE proteach;

-- Users table for educators
CREATE TABLE IF NOT EXISTS users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) UNIQUE NOT NULL,
    email VARCHAR(100) UNIQUE NOT NULL,
    password VARCHAR(255) NOT NULL,
    full_name VARCHAR(100) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    last_login TIMESTAMP NULL
);

-- Courses table
CREATE TABLE IF NOT EXISTS courses (
    id INT AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(200) NOT NULL,
    description TEXT,
    category VARCHAR(50),
    duration_hours INT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

-- Enrollments table (many-to-many relationship)
CREATE TABLE IF NOT EXISTS enrollments (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    course_id INT NOT NULL,
    enrolled_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    completion_percentage DECIMAL(5,2) DEFAULT 0.00,
    status ENUM('active', 'completed', 'dropped') DEFAULT 'active',
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE,
    FOREIGN KEY (course_id) REFERENCES courses(id) ON DELETE CASCADE,
    UNIQUE KEY unique_enrollment (user_id, course_id)
);

-- Learning materials table
CREATE TABLE IF NOT EXISTS materials (
    id INT AUTO_INCREMENT PRIMARY KEY,
    course_id INT NOT NULL,
    title VARCHAR(200) NOT NULL,
    content TEXT,
    material_type ENUM('document', 'video', 'presentation', 'link') DEFAULT 'document',
    file_path VARCHAR(255),
    order_index INT DEFAULT 0,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (course_id) REFERENCES courses(id) ON DELETE CASCADE
);

-- Assessments/Quizzes table
CREATE TABLE IF NOT EXISTS assessments (
    id INT AUTO_INCREMENT PRIMARY KEY,
    course_id INT NOT NULL,
    title VARCHAR(200) NOT NULL,
    description TEXT,
    passing_score DECIMAL(5,2) DEFAULT 70.00,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (course_id) REFERENCES courses(id) ON DELETE CASCADE
);

-- Assessment questions table
CREATE TABLE IF NOT EXISTS questions (
    id INT AUTO_INCREMENT PRIMARY KEY,
    assessment_id INT NOT NULL,
    question_text TEXT NOT NULL,
    option_a VARCHAR(255),
    option_b VARCHAR(255),
    option_c VARCHAR(255),
    option_d VARCHAR(255),
    correct_answer ENUM('a', 'b', 'c', 'd') NOT NULL,
    points INT DEFAULT 1,
    FOREIGN KEY (assessment_id) REFERENCES assessments(id) ON DELETE CASCADE
);

-- User assessment attempts table
CREATE TABLE IF NOT EXISTS assessment_attempts (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    assessment_id INT NOT NULL,
    score DECIMAL(5,2),
    total_points INT,
    passed BOOLEAN DEFAULT FALSE,
    completed_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE,
    FOREIGN KEY (assessment_id) REFERENCES assessments(id) ON DELETE CASCADE
);

-- Progress tracking for materials
CREATE TABLE IF NOT EXISTS material_progress (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    material_id INT NOT NULL,
    completed BOOLEAN DEFAULT FALSE,
    completed_at TIMESTAMP NULL,
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE,
    FOREIGN KEY (material_id) REFERENCES materials(id) ON DELETE CASCADE,
    UNIQUE KEY unique_progress (user_id, material_id)
);

-- Insert sample courses
INSERT INTO courses (title, description, category, duration_hours) VALUES
('Effective Classroom Management', 'Learn strategies for managing diverse classrooms and creating positive learning environments.', 'Teaching Methods', 20),
('Digital Teaching Tools', 'Master modern educational technology and online teaching platforms.', 'Technology', 15),
('Assessment Strategies', 'Develop skills in creating and implementing effective student assessments.', 'Assessment', 12),
('Student Engagement Techniques', 'Explore methods to increase student participation and motivation.', 'Teaching Methods', 18);

-- Insert sample learning materials
INSERT INTO materials (course_id, title, content, material_type, order_index) VALUES
(1, 'Introduction to Classroom Management', 'Classroom management is the foundation of effective teaching. This module covers the basics of establishing rules, procedures, and expectations.', 'document', 1),
(1, 'Behavior Management Strategies', 'Learn practical strategies for addressing challenging behaviors and promoting positive conduct in the classroom.', 'document', 2),
(1, 'Creating a Positive Learning Environment', 'Discover how to create a welcoming, inclusive, and motivating classroom atmosphere that supports all learners.', 'document', 3),
(2, 'Introduction to EdTech', 'An overview of educational technology tools and their role in modern teaching.', 'document', 1),
(2, 'Learning Management Systems', 'Explore popular LMS platforms and how to use them effectively for course delivery.', 'document', 2),
(3, 'Types of Assessment', 'Understanding formative, summative, and diagnostic assessments and when to use each.', 'document', 1),
(3, 'Creating Effective Tests', 'Learn how to design tests that accurately measure student learning and achievement.', 'document', 2),
(4, 'Active Learning Strategies', 'Techniques to transform passive learners into active participants in the learning process.', 'document', 1);

-- Insert sample assessments
INSERT INTO assessments (course_id, title, description, passing_score) VALUES
(1, 'Classroom Management Quiz', 'Test your understanding of classroom management principles and strategies.', 70.00),
(2, 'Digital Tools Assessment', 'Evaluate your knowledge of digital teaching tools and technologies.', 75.00),
(3, 'Assessment Methods Quiz', 'Assess your understanding of different assessment strategies and their applications.', 70.00);

-- Insert sample questions
INSERT INTO questions (assessment_id, question_text, option_a, option_b, option_c, option_d, correct_answer, points) VALUES
(1, 'What is the first step in establishing effective classroom management?', 'Setting clear rules and expectations', 'Punishing misbehavior', 'Giving rewards', 'Ignoring problems', 'a', 1),
(1, 'Which approach is most effective for addressing disruptive behavior?', 'Public criticism', 'Consistent consequences', 'Ignoring the student', 'Calling parents immediately', 'b', 1),
(1, 'What creates a positive learning environment?', 'Strict discipline only', 'Respect and clear communication', 'No rules or structure', 'Competition among students', 'b', 1),
(2, 'What does LMS stand for?', 'Learning Management System', 'Library Media Services', 'Local Media Server', 'Learning Media Support', 'a', 1),
(2, 'Which is a benefit of using educational technology?', 'Eliminates need for teachers', 'Increases student engagement', 'Always costs less', 'Never has technical issues', 'b', 1),
(3, 'What is formative assessment used for?', 'Final grading only', 'Monitoring learning progress', 'College admissions', 'Teacher evaluation', 'b', 1),
(3, 'What makes an effective test question?', 'It is very easy', 'It measures the learning objective', 'It is impossible to answer', 'It has no correct answer', 'b', 1);
