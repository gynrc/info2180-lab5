<?php
$host = 'localhost';
$username = 'lab5_user';
$password = 'password123';
$dbname = 'world';

$conn = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8mb4", $username, $password);
$country = htmlspecialchars($_GET['country']);
$url_segments = parse_url($_SERVER['HTTP_REFERER']);
parse_str($url_segments['query'], $params);

if (empty($country)) {
  $stmt = $conn->query("SELECT * FROM countries");
  $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
  show($results);
} elseif (!empty($country)) {
  $stmt = $conn->query("SELECT * FROM countries WHERE name LIKE '%$country%'");
  $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
  show($results);
  //checks if query param has more than one parameter; (in this case) cities would be the next param
} elseif (isset($_GET['country']) && count($_GET) > 1 && $params == ['lookup']) {
  $stmt = $conn->query("SELECT * FROM countries WHERE name LIKE '%$country%'");
  $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
  showCity($results);
}

?>


<?php 
  function show($results) {
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

  function showCity($results) {
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