# SQL Playground with PHP, MySQL, and Nginx

This project is a simple **learning environment** to practice working with **MySQL**, **PHP**, and **Nginx** inside **Docker containers**.  
You can experiment with:

- Creating and managing **databases** and **tables**
- Writing **SQL queries** (`SELECT`, `INSERT`, `UPDATE`, `DELETE`, `JOIN`, etc.)
- Displaying database data dynamically in PHP
- Using **DataGrip** or another GUI tool to interact with the database

---

## **Prerequisites**

### **1. Software Setup**
Make sure you have the following installed:

- [Docker](https://docs.docker.com/get-docker/)
- [Docker Compose](https://docs.docker.com/compose/install/)
- [DataGrip](https://www.jetbrains.com/datagrip/) (optional, for GUI database management)


### **2. Database Setup**
> **Note:** The project does not include the actual database. When you start the Docker environment, MySQL will be created empty.  
> To make the PHP code in `index.php` work, you need to **create the database and tables** as described below.

After starting the Docker environment, you need to create the `myblog` database and populate the tables so the PHP code works.

#### **1. Connect to the MySQL container**
```bash
docker exec -it mysql mysql -u root -p
# Enter password: rootpw
```

#### **2. Create the database**
```bash
CREATE DATABASE myblog;
USE myblog;
```

#### **3. Create tables**
Run the SQL scripts for your tables (users, posts, comments) — you can copy/paste them from index.php or a separate SQL file if you add one. Example:

```bash
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

#### **4. Create tables**
Insert example data

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

### **3. Access the application**
Open your browser and go to:
http://localhost:8080

You should see dynamically generated data from the MySQL database rendered in PHP.

### **4. Access the application**
Connect with DataGrip (optional)
You can also connect to the MySQL container using DataGrip or any SQL client.
Connection settings:

| Setting  | Value       |
| -------- | ----------- |
| Host     | `localhost` |
| Port     | `3306`      |
| Username | `root`      |
| Password | `root`      |
| Database | `myblog`    |

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

## **Have Fun! 🎉**

Thank you for using this project! 🎉  
Have fun experimenting with SQL, PHP, and Docker.

If you have any questions, ideas, or suggestions, feel free to **open an issue** or leave a comment — I’d love to start a conversation!