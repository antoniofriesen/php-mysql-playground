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
git clone https://github.com/yourusername/playground-sql.git
cd playground-sql
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
