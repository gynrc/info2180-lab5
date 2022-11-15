<?php

//header('Access-Control-Allow-Origin: *'); 

$host = 'localhost';
$username = 'lab5_user';
$password = 'password123';
$dbname = 'world';

$conn = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8mb4", $username, $password);
$country = htmlspecialchars($_GET['country']);
$url_segments = parse_url($_SERVER['REQUEST_URI'], PHP_URL_QUERY);
parse_str($url_segments, $params);
$cities = $params['lookup']; // spare me pls ;( I keep getting an error for this line but it works!!

if (empty($country)) {
  $stmt = $conn->query("SELECT * FROM countries");
  $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
  show($results);
} elseif (!empty($country) && count($_GET) == 1 ) {
  $stmt = $conn->query("SELECT * FROM countries WHERE name LIKE '%$country%'");
  $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
  show($results);
} elseif (isset($_GET['country']) && count($_GET) > 1 && $cities == "cities") {
  $stmt = $conn->query("SELECT cities.name, cities.district, cities.population FROM countries join cities on cities.country_code = countries.code WHERE countries.name LIKE '%$country%'");
  $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
  showCity($results);
}

?>


<?php 
 
  function show($results) {
    echo "<table class='center'>";
    echo "<thead>";
      echo "<tr>";
        echo "<th>Name</th>";
        echo "<th>Continent</th>";
        echo "<th>Independence</th>";
        echo "<th>Head of State</th>";
      echo "</tr>";
    echo "</thead>";
    echo"<tbody>";
    foreach ($results as $row) {
      echo "<tr>";
        echo "<td> {$row['name']} </td>";
        echo "<td> {$row['continent']} </td>";
        echo "<td> {$row['independence_year']} </td>";
        echo "<td> {$row['head_of_state']} </td>";
      echo "</tr>";
    }
    echo "</tbody>";
    echo "</table>";
  }

  function showCity($results) {
    echo "<table class='center'>";
    echo "<thead>";
      echo "<tr>";
        echo "<th>Name</th>";
        echo "<th>District</th>";
        echo "<th>Population</th>";
      echo "</tr>";
    echo "</thead>";
    echo"<tbody>";
    foreach ($results as $row) {
      echo "<tr>";
        echo "<td> {$row['name']} </td>";
        echo "<td> {$row['district']} </td>";
        echo "<td> {$row['population']} </td>";
      echo "</tr>";
    }
    echo "</tbody>";
    echo "</table>";
  }
?>