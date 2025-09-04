# SQL Playground with PHP, MySQL, and Nginx

This project is a simple **learning environment** to practice working with **MySQL**, **PHP**, and **Nginx** inside **Docker containers**.  
You can experiment with:

- Creating and managing **databases** and **tables**
- Writing **SQL queries** (`SELECT`, `INSERT`, `UPDATE`, `DELETE`, `JOIN`, etc.)
- Displaying database data dynamically in PHP
- Using **DataGrip** or another GUI tool to interact with the database

---

## **Prerequisites**
Make sure you have the following installed:

- [Docker](https://docs.docker.com/get-docker/)
- [Docker Compose](https://docs.docker.com/compose/install/)
- [DataGrip](https://www.jetbrains.com/datagrip/) (optional, for GUI database management)

---

## **Getting Started**

### **1. Clone the repository**
```bash
git clone https://github.com/yourusername/php-mysql-playground.git
cd php-mysql-playground
```

### **2. Start the Docker environment**
Run the following command to build and start the containers in the background:
```bash
docker compose up -d --build
```

### **3. Database Setup**
> **Note:** The project does not include the actual database. When you start the Docker environment, MySQL will be created empty.  
> To make the PHP code in `index.php` work, you need to **create the database and tables** as described below.

After starting the Docker environment, you need to create the `myblog` database and populate the tables so the PHP code works.

#### **3.1. Connect with DataGrip (optional)**
You can also connect to the MySQL container using DataGrip or any SQL client.

**Connection settings:**

| Setting  | Value       |
| -------- |-------------|
| Host     | `localhost` |
| Port     | `3306`      |
| Username | `bloguser`  |
| Password | `blogpass`  |
| Database | `myblog`    |

> **Note:** If you connect with DataGrip, you can populate and manage the database there while following the next 
> steps. Otherwise, continue using the terminal.

#### **3.2. Connect to the MySQL container via terminal**
```bash
docker exec -it mysql mysql -u root -p
# Enter password: root
```

#### **3.3. Create the database**
```bash
CREATE DATABASE myblog;
USE myblog;
```

#### **3.4. Create tables**
```sql
CREATE TABLE users (
id INT AUTO_INCREMENT PRIMARY KEY,
name VARCHAR(255),
email VARCHAR(255),
created_at DATETIME
);

CREATE TABLE posts (
id INT AUTO_INCREMENT PRIMARY KEY,
user_id INT,
title VARCHAR(255),
content TEXT,
created_at DATETIME,
FOREIGN KEY (user_id) REFERENCES users(id)
);

CREATE TABLE comments (
id INT AUTO_INCREMENT PRIMARY KEY,
post_id INT,
user_id INT,
comment TEXT,
created_at DATETIME,
FOREIGN KEY (post_id) REFERENCES posts(id),
FOREIGN KEY (user_id) REFERENCES users(id)
);
```

#### **3.5. Insert example data**
Insert example data

##### **Users**
```sql
INSERT INTO users (name, email) VALUES
('Alice', 'alice@example.com'),
('Bob', 'bob@example.com'),
('Charlie', 'charlie@example.com'),
('Diana', 'diana@example.com'),
('Ethan', 'ethan@example.com'),
('Fiona', 'fiona@example.com'),
('George', 'george@example.com'),
('Hannah', 'hannah@example.com'),
('Ian', 'ian@example.com'),
('Julia', 'julia@example.com');
```

##### **Posts**
```sql
INSERT INTO posts (user_id, title, content) VALUES
(1, 'Post 1 by Alice', 'Content for post 1'),
(2, 'Post 2 by Bob', 'Content for post 2'),
(3, 'Post 3 by Charlie', 'Content for post 3'),
(4, 'Post 4 by Diana', 'Content for post 4'),
(5, 'Post 5 by Ethan', 'Content for post 5'),
(6, 'Post 6 by Fiona', 'Content for post 6'),
(7, 'Post 7 by George', 'Content for post 7'),
(8, 'Post 8 by Hannah', 'Content for post 8'),
(9, 'Post 9 by Ian', 'Content for post 9'),
(10, 'Post 10 by Julia', 'Content for post 10');
```

##### **Comments**
```sql
INSERT INTO comments (post_id, user_id, comment) VALUES
(1, 2, 'Nice post Alice!'),
(1, 3, 'I agree with Bob!'),
(2, 1, 'Thanks Bob for sharing'),
(3, 4, 'Interesting thoughts Charlie'),
(4, 5, 'Good job Diana'),
(5, 6, 'Well written Ethan'),
(6, 7, 'Informative Fiona'),
(7, 8, 'Great insights George'),
(8, 9, 'Thanks Hannah'),
(9, 10, 'Nice work Ian');
```

### **4. Access the application**
Open your browser and go to:
http://localhost:8080

You should see dynamically generated data from the MySQL database rendered in PHP.

### **5.Stopping the environment**
```bash
docker compose down
```

## **Useful Docker Commands**
| Command                          | Description                     |
| -------------------------------- | ------------------------------- |
| `docker compose ps`              | Check running containers        |
| `docker compose logs -f`         | View container logs (live)      |
| `docker exec -it <container> sh` | Open a shell inside a container |

---

## **6. Have Fun! 🎉**

Thank you for using this project! 🎉  
Have fun experimenting with SQL, PHP, and Docker.

If you have any questions, ideas, or suggestions, feel free to **open an issue** or leave a comment — I’d love to start a conversation!