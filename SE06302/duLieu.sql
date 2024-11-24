CREATE DATABASE se06302_asm_sdlc;

USE se06302_asm_sdlc;

CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) NOT NULL,
    gender ENUM('Male', 'Female') NOT NULL,
    birth_day INT NOT NULL,
    birth_month INT NOT NULL,
    birth_year INT NOT NULL,
    phone VARCHAR(15) NOT NULL,
    profession ENUM('Student', 'Manage', 'Teacher', 'Another') NOT NULL,
    email VARCHAR(100) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

INSERT INTO users (id,username, gender, birth_day, birth_month, birth_year, phone, profession, email, password) 
VALUES
    ('1','Do Ngoc Trung', 'Male', 26, 12, 2000, '0326358335', 'Student', 'Trungcvbh00735@gmail.com', '$2y$10$xWsCYYTZhMFYLRU19nW8JOaCp/LJdeyyPHYvyo7TUoaS.hKENYN5m'),
    ('2','Nguyen Van Anh', 'Male', 15, 7, 1995, '0373635424', 'Student', 'Anhcjhs00363@gmail.com', '$2y$10$6spDmXyetmUNR5fc4ZSg5.LFw3X8L88lnuISQplbhdEqkZgzQxNj6'),
    ('3','Tran Thi Ninh', 'Female', 22, 3, 1998, '0373635422', 'Teacher', 'Ninhndjs00936@gmail.com', '$2y$10$awG0HPsfZJk8ixuRcHxiw.LkkWSIrSh1DdCQSjy6/e2/IzKkZBhFa'),
    ('4','Le Van Anh', 'Male', 5, 11, 2000, '0326254646', 'Student', 'Anhhgsg00373@gmail.com', '$2y$10$llC6Dw0gUECYvgSRzWjnSOTubSU4E2bMR284gUbQc35x./ngHCv22'),
    ('5','Pham Thi Minh', 'Female', 9, 9, 2000, '0362524282', 'Student', 'Minhdjdg00836@gmail.com', '$2y$10$j.U7YT9Nfm7GewCAdVTV4.jcOJB.mS8BoVbfh4INrBDqXt9u4XNGC'),
    ('6','Hoang Van Trung', 'Male', 1, 1, 2000, '0373524234', 'Student', 'Trungjdhs00245@gmail.com', '$2y$10$.4EklecDs1SIJFRtklQZjeaOixMf.LXCzlCfaRHX2FS1sR22qHQbK'),
    ('7','Hong Thi Le', 'Female', 14, 2, 1987, '0337262424', 'Manage', 'Lejdhs00927@gmail.com', '$2y$10$FM.3EwKeXbMtnc9/gx/lZeLYaWJSOQOQGqw4xmvRf5er8rG6tB/x6'),
    ('8','Doan Van Ung', 'Male', 30, 6, 1992, '0336353465', 'Student', 'Ungdjdh00937@gmail.com', '$2y$10$q7TLPQ1hEFkvZym7sv6vvO8CVRIl96f1XBCftdlEH3LY7t6JFiPZa'),
    ('9','Vo Thi Hong', 'Female', 18, 12, 2000, '0353424244', 'Student', 'Hongxjhj00936@gmail.com', '$2y$10$BfyFHrYw6VtvdC2NeJcL.uVzwvD3.k8WdJ9nWktC7CGnNc74UPBsm'),
    ('10','Dang Van Thanh', 'Male', 25, 4, 1997, '0327262524', 'Student', 'Thanhksjg00827@gmail.com', '$2y$10$Zg8UKda6VxmE58T5dSSsZebTK1gegr7./6KqR3wQnLBuXah2oQWtO'),
    ('11','Bui Thi Thinh', 'Female', 7, 8, 1988, '0322524272', 'Teacher', 'Thinhjdgs00972@gmail.com', '$2y$10$EJXjRdVFDlWVzaoePLTNO.ECrwh6lHfhbm6gUYbv.HSMWuog1x/fS');



CREATE TABLE courses (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    description TEXT NOT NULL,
    time TEXT NOT NULL ,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

INSERT INTO courses (id, name, description, time) 
VALUES
    ('1','HTML Basics', 'Learn the fundamentals of HTML and how to structure web pages.','5 months'),
    ('2','CSS Advanced', 'Master advanced CSS techniques, including animations and grid layouts.','4 months'),
    ('3','PHP for Beginners', 'Introduction to server-side scripting with PHP.','5 months'),
    ('4','JavaScript Essentials', 'Learn the basics of JavaScript and DOM manipulation.','7 months'),
    ('5','Responsive Web Design', 'Design websites that work seamlessly on all devices.','4 months'),
    ('6','SQL and Databases', 'Understand relational databases and learn SQL syntax.','5 months'),
    ('7','Full-Stack Development', 'Combine front-end and back-end skills to build dynamic websites.','5 months'),
    ('8','Python for Web', 'Learn how to use Python in web development with frameworks like Flask.','4 months'),
    ('9','Web Security Basics', 'Understand security principles to protect websites from threats.','7 months'),
    ('10','Project Management', 'Learn how to plan and manage web development projects effectively.','5 months');



CREATE TABLE Grades (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(255) NOT NULL,
    gender ENUM('Male', 'Female') NOT NULL,
    Courses VARCHAR(255) NOT NULL,
    score FLOAT NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

INSERT INTO Grades (id, username, gender, Courses, score) 
VALUES
    ('1','Do Ngoc Trung', 'Male','HTML Basics','9.5'),
    ('2','Nguyen Van Anh', 'Male','Python for Web','8.7'),
    ('3','Le Van Anh', 'Male','Python for Web','7.8'),
    ('4','Pham Thi Minh', 'Female','HTML Basics','6.5'),
    ('5','Hoang Van Trung', 'Male','HTML Basics','9.2'),
    ('6','Doan Van Ung', 'Male','Project Management','8.0'),
    ('7','Vo Thi Hong', 'Female','Project Management','7.5'),
    ('8','Dang Van Thanh', 'Male','Project Management','6.8');



CREATE TABLE schedule (
    id INT AUTO_INCREMENT PRIMARY KEY,
    birth_date DATE NOT NULL,          
    class VARCHAR(255) NOT NULL,       
    start_time TIME NOT NULL,          
    end_time TIME NOT NULL,            
    Courses VARCHAR(255) NOT NULL,     
    activity VARCHAR(255) NOT NULL     
);


INSERT INTO schedule (id, birth_date, class, start_time, end_time, Courses, activity) 
VALUES
(1, '2024-11-12', 'BH0101', '07:15:00', '09:00:00', 'HTML Basics', 'Learn HTML tags and structure for web pages'),
(2, '2024-11-12', 'BH0101', '09:30:00', '12:30:00', 'CSS Advanced', 'Explore advanced CSS concepts like Flexbox and Grid'),
(3, '2024-11-12', 'BK0101', '07:15:00', '09:00:00', 'PHP for Beginners', 'Set up a PHP environment and learn basic syntax'),
(4, '2024-11-12', 'BK0101', '09:30:00', '12:30:00', 'JavaScript Essentials', 'Understand variables, functions, and DOM manipulation'),
(5, '2024-11-12', 'BK0101', '13:30:00', '16:30:00', 'Responsive Web Design', 'Implement media queries for mobile-friendly design'),
(6, '2024-11-12', 'BH0201', '07:15:00', '11:15:00', 'SQL and Databases', 'Learn SQL commands and database normalization'),
(7, '2024-11-12', 'BO0201', '09:30:00', '12:30:00', 'Full-Stack Development', 'Combine front-end and back-end skills'),
(8, '2024-11-12', 'BO0201', '14:00:00', '17:15:00', 'Python for Web', 'Use Python with Flask to create web applications'),
(9, '2024-11-12', 'BG0201', '11:00:00', '15:00:00', 'Web Security Basics', 'Understand common vulnerabilities like XSS and SQL injection'),
(10, '2024-11-12', 'BJ0201', '14:00:00', '16:30:00', 'Project Management', 'Explore Agile methodologies and team collaboration tools');




CREATE TABLE attendance (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL, 
    course_id INT NOT NULL, 
    schedule_id INT NOT NULL, 
    attendance_date DATE NOT NULL, 
    status ENUM('Present', 'On time') NOT NULL, 
    note VARCHAR(255),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(id),
    FOREIGN KEY (course_id) REFERENCES courses(id),
    FOREIGN KEY (schedule_id) REFERENCES schedule(id)
);


INSERT INTO attendance (id, user_id, course_id, schedule_id, attendance_date, status, note)
VALUES
    (1, 1, 1, 2, '2024-11-13', 'Present', 'NO'),
    (2, 2, 1, 2, '2024-11-14', 'Present', ''),
    (3, 3, 1, 2, '2024-11-15', 'On time', ''),
    (4, 4, 1, 2, '2024-11-16', 'Present', ''),
    (5, 5, 1, 2, '2024-11-17', 'Present', ''),
    (6, 6, 1, 2, '2024-11-18', 'On time',''),
    (7, 7, 1, 2, '2024-11-19', 'Present', ''),
    (8, 8, 1, 2, '2024-11-21', 'Present', ''),
    (9, 9, 1, 2, '2024-11-22', 'Present', '');



CREATE TABLE requests (
    id INT AUTO_INCREMENT PRIMARY KEY, 
    username VARCHAR(255) NOT NULL, 
    Courses VARCHAR(255) NOT NULL,
    request_text TEXT NOT NULL, 
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP 
);


INSERT INTO requests (id, username, Courses, request_text) 
VALUES 
    ('1','Do Ngoc trung', 'HTML Basics', 'Recover attendance that was missed due to absence.'),
    ('2','Hoang Van Trung', 'Responsive Web Design', 'Automatically record attendance in online classes.'),
    ('3','Vo Thi Hong', 'Project Management', 'Check and adjust attendance for past classes.'),
    ('4','Nguyen Van Anh', 'Project Management', 'Notify students about missing attendance and how to restore it.'),
    ('5','Pham Thi Minh', 'SQL and Databases', ' Instructor to verify attendance if the student has a valid excuse.');




CREATE TABLE listAttendance (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL, 
    course_id INT NOT NULL, 
    schedule_id INT NOT NULL,  
    attendance_date DATE NOT NULL, 
    status ENUM('Present', 'On time') NOT NULL, 
    note VARCHAR(255),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Sample data insertion
INSERT INTO listAttendance (user_id, course_id, schedule_id, attendance_date, status, note)
VALUES
    (1, 1, 1, 2, '2024-11-13', 'Present', ''),
    (2, 2, 1, 2, '2024-11-13', 'Present', ''),
    (3, 3, 1, 2, '2024-11-13', 'On time', ''),
    (4, 4, 1, 2, '2024-11-13', 'Present', ''),
    (5, 5, 1, 2, '2024-11-13', 'Present', ''),
    (6, 6, 1, 2, '2024-11-13', 'On time',''),
    (7, 7, 1, 2, '2024-11-13', 'Present', ''),
    (8, 8, 1, 2, '2024-11-13', 'Present', ''),
    (9, 9, 1, 2, '2024-11-13', 'Present', '');
