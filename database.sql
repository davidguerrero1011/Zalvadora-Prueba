CREATE DATABASE IF NOT EXISTS
zalvadora_db;
USE zalvadora_db;

CREATE TABLE ci_sessions (
    session_id VARCHAR(50) DEFAULT '0' NOT NULL,
    ip_address VARCHAR(50) DEFAULT '0' NOT NULL,
    user_agent VARCHAR(150) NOT NULL,
    last_activity INT(10) UNSIGNED DEFAULT 0 NOT NULL, 
    user_data TEXT NOT NULL,
    PRIMARY KEY (session_id),
    KEY last_activity_idx (last_activity)
);

CREATE TABLE users (
    id int(11) NOT NULL AUTO_INCREMENT,
    name VARCHAR(255) NOT NULL,
    email VARCHAR(100) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL, 
    role ENUM('admin', 'user') DEFAULT 'user',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP, 
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    PRIMARY KEY (id) 
);

CREATE TABLE categories (
    id int(11) NOT NULL AUTO_INCREMENT,
    name VARCHAR(255) NOT NULL UNIQUE,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP, 
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    PRIMARY KEY (id)
);

CREATE TABLE products (
    id int(11) NOT NULL AUTO_INCREMENT,
    name VARCHAR(255) NOT NULL,
    sku VARCHAR(50) NOT NULL UNIQUE,
    price DECIMAL(10, 2) NOT NULL, 
    stock INT(11) NOT NULL DEFAULT 0,
    category_id INT(11) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP, 
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    PRIMARY KEY (id),
    FOREIGN KEY(category_id) REFERENCES categories(id) ON DELETE RESTRICT
);

INSERT INTO users (name, email, password, role) VALUES
('Admin', 'admin@zalvadora.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'admin');