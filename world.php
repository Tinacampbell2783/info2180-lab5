<?php
$host = 'localhost';
$username = 'lab5_user';
$password = 'password123';
$dbname = 'world';

$conn = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8mb4", $username, $password);

$country = $_GET['country'] ?? "";
$lookup  = $_GET['lookup'] ?? "";

// If lookup=cities, return cities instead of country info
if ($lookup === "cities") {

    $stmt = $conn->prepare(
        "SELECT cities.name AS city, cities.district, cities.population
         FROM cities
         JOIN countries ON cities.country_code = countries.code
         WHERE countries.name LIKE :country"
    );

    $stmt->execute(['country' => "%$country%"]);
    $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

    echo "<table>
            <thead>
                <tr>
                    <th>Name</th>
                    <th>District</th>
                    <th>Population</th>
                </tr>
            </thead>
            <tbody>";

    foreach ($results as $row) {
        echo "<tr>
                <td>{$row['city']}</td>
                <td>{$row['district']}</td>
                <td>{$row['population']}</td>
              </tr>";
    }

    echo "</tbody></table>";
    exit;
}

if (!empty($country)) {
    $stmt = $conn->query("SELECT * FROM countries WHERE name LIKE '%$country%'");
} else {
    $stmt = $conn->query("SELECT * FROM countries");
}

$results = $stmt->fetchAll(PDO::FETCH_ASSOC);

echo "<table>
        <thead>
            <tr>
                <th>Country Name</th>
                <th>Continent</th>
                <th>Independence Year</th>
                <th>Head of State</th>
            </tr>
        </thead>
        <tbody>";

foreach ($results as $row) {
    echo "<tr>
            <td>{$row['name']}</td>
            <td>{$row['continent']}</td>
            <td>" . ($row['independence_year'] ?: 'N/A') . "</td>
            <td>" . ($row['head_of_state'] ?: 'N/A') . "</td>
          </tr>";
}

echo "</tbody></table>";
?>
