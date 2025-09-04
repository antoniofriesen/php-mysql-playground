<?php
$servername = "db";
$username = "bloguser";
$password = "blogpass";
$dbname = "myblog";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
echo "Connected successfully to MySQL!" . "<br>";

function displayTable($result) {
    if ($result->num_rows > 0) {
        echo "<table border='1' cellpadding='6' cellspacing='0' style='border-collapse:collapse; margin:10px 0; width:80%;'>";
        echo "<tr style='background:#f2f2f2;'>";
        foreach (array_keys($result->fetch_assoc()) as $col) {
            echo "<th>" . htmlspecialchars($col) . "</th>";
        }

        $result->data_seek(0);
        while ($row = $result->fetch_assoc()) {
            echo "<tr>";
            foreach ($row as $value) {
                echo "<td>" . htmlspecialchars($value) . "</td>";
            }
            echo "</tr>";
        }
        echo "</table>";
    } else {
        echo "<p style='color:gray;'>No results found.</p>";
    }
}

echo "
<style>
    body { font-family: Arial, sans-serif; margin: 20px; background: #fafafa; }
    h2 { background: #333; color: white; padding: 10px; border-radius: 5px; }
    h3 { color: #444; margin-top: 30px; }
    hr { margin: 20px 0; }
</style>
";

echo "<h3>1. Fetch all users</h3>";
$sql = "SELECT id, name, email, created_at FROM users";
displayTable($conn->query($sql));

echo "<h3>2. Users created in the last 7 days</h3>";
$sql = "SELECT name, email, created_at FROM users WHERE created_at > NOW() - INTERVAL 7 DAY";
displayTable($conn->query($sql));

echo "<h3>3. Posts with authors</h3>";
$sql = "
    SELECT p.title, p.created_at, u.name AS author
    FROM posts p
    JOIN users u ON p.user_id = u.id
";
displayTable($conn->query($sql));

echo "<h3>4. Count posts per user</h3>";
$sql = "
    SELECT u.name, COUNT(p.id) AS total_posts
    FROM users u
    LEFT JOIN posts p ON u.id = p.user_id
    GROUP BY u.name
    ORDER BY total_posts DESC
";
displayTable($conn->query($sql));

echo "<h3>5. Latest 5 comments</h3>";
$sql = "SELECT comment, created_at FROM comments ORDER BY created_at DESC LIMIT 5";
displayTable($conn->query($sql));

echo "<h3>6. Posts with no comments</h3>";
$sql = "
    SELECT p.title
    FROM posts p
    LEFT JOIN comments c ON p.id = c.post_id
    WHERE c.id IS NULL
";
displayTable($conn->query($sql));

echo "<h3>7. Search for users with 'ia' in their name</h3>";
$sql = "SELECT name, email FROM users WHERE name LIKE '%ia%'";
displayTable($conn->query($sql));

echo "<h3>8. Most active commenter</h3>";
$sql = "
    SELECT u.name, COUNT(c.id) AS total_comments
    FROM comments c
    JOIN users u ON c.user_id = u.id
    GROUP BY u.name
    ORDER BY total_comments DESC
    LIMIT 1
";
displayTable($conn->query($sql));

echo "<h3>9. Posts and their comment count</h3>";
$sql = "
    SELECT p.title, COUNT(c.id) AS comment_count
    FROM posts p
    LEFT JOIN comments c ON p.id = c.post_id
    GROUP BY p.title
    ORDER BY comment_count DESC
";
displayTable($conn->query($sql));

echo "<h3>10. Users, Posts, and Comments</h3>";
$sql = "
    SELECT u.name AS user_name, p.title AS post_title, c.comment
    FROM users u
    JOIN posts p ON u.id = p.user_id
    JOIN comments c ON p.id = c.post_id
    ORDER BY u.name, p.title
    LIMIT 10
";
displayTable($conn->query($sql));

$conn->close();
?>
