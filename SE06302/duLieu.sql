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
    profession ENUM('Student', 'Manager', 'Teacher', 'Another') NOT NULL,
    email VARCHAR(100) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

INSERT INTO users (username, gender, birth_day, birth_month, birth_year, phone, profession, email, password) 
VALUES
    ('Nguyen Van A', 'Male', 15, 7, 1995, '0912345678', 'Student', 'nguyenvana@gmail.com', '123456'),
    ('Tran Thi B', 'Female', 22, 3, 1998, '0987654321', 'Teacher', 'tranthib@gmail.com', '123456'),
    ('Le Van C', 'Male', 5, 11, 1985, '0934567890', 'Manager', 'levanc@gmail.com', '123456'),
    ('Pham Thi D', 'Female', 9, 9, 2000, '0945678901', 'Another', 'phamthid@gmail.com', '123456'),
    ('Hoang Van E', 'Male', 1, 1, 1990, '0923456789', 'Teacher', 'hoangvane@gmail.com', '123456'),
    ('Nguyen Thi F', 'Female', 14, 2, 1987, '0976543210', 'Manager', 'nguyenthif@gmail.com', '123456'),
    ('Doan Van G', 'Male', 30, 6, 1992, '0911122233', 'Student', 'doanvang@gmail.com', '123456'),
    ('Vo Thi H', 'Female', 18, 12, 1993, '0903344556', 'Another', 'vothih@gmail.com', '123456'),
    ('Dang Van I', 'Male', 25, 4, 1997, '0945566778', 'Student', 'dangvani@gmail.com', '123456'),
    ('Bui Thi J', 'Female', 7, 8, 1988, '0932233445', 'Teacher', 'buithij@gmail.com', '123456');
