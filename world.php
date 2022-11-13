<?php
$host = 'localhost';
$username = 'lab5_user';
$password = 'password123';
$dbname = 'world';

$conn = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8mb4", $username, $password);
$country = $_GET['query'];

if (empty($country)) {
  $stmt = $conn->query("SELECT * FROM countries");
  $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
  show($results);
} elseif (!empty($country) /*&& smn about country here */) {
  $stmt = $conn->query("SELECT * FROM countries WHERE name LIKE '%$country%'");
  $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
  show($results);
} else /*&& smn about city here */ {
  $stmt = $conn->query("SELECT * FROM countries WHERE name LIKE '%$country%'");
  $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
  showCity($results);
}

?>


<?php 
  function show($country) {
    echo "<table>"; 
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

  function showCity($city) {
    echo "<table>"; 
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