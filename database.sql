CREATE DATABASE IF NOT EXISTS job_internship_db;
USE job_internship_db;

CREATE TABLE users (
 id INT AUTO_INCREMENT PRIMARY KEY,
 name VARCHAR(100) NOT NULL,
 email VARCHAR(150) UNIQUE NOT NULL,
 password VARCHAR(255) NOT NULL,
 created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE opportunities (
 id INT AUTO_INCREMENT PRIMARY KEY,
 title VARCHAR(150) NOT NULL,
 company VARCHAR(150) NOT NULL,
 type ENUM('Job','Internship') NOT NULL,
 location VARCHAR(100) NOT NULL,
 description TEXT,
 created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE applications (
 id INT AUTO_INCREMENT PRIMARY KEY,
 user_id INT NOT NULL,
 opportunity_id INT NOT NULL,
 status ENUM('Pending','Shortlisted','Rejected','Selected') DEFAULT 'Pending',
 applied_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
 UNIQUE KEY unique_application(user_id,opportunity_id),
 FOREIGN KEY(user_id) REFERENCES users(id) ON DELETE CASCADE,
 FOREIGN KEY(opportunity_id) REFERENCES opportunities(id) ON DELETE CASCADE
);

INSERT INTO opportunities(title,company,type,location,description) VALUES
('PHP Web Developer','Tech Solutions','Job','Pune','Develop and maintain web applications using PHP and MySQL.'),
('Software Intern','Innovate Labs','Internship','Mumbai','Learn software development and work on real projects.'),
('Data Analyst Intern','DataWorks','Internship','Remote','Analyze data and prepare useful reports.');
