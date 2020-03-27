<?php
$servername = getenv("DB_SERVER_NAME");
$username = getenv("DB_USER_NAME");
$password = getenv("DB_PASSWORD");
$database = getenv("DB_NAME");

// Create connection
$conn = new mysqli($servername, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
	die("Connection failed: " . $conn->connect_error);
}

$search = $_GET["search"];
$sql = "SELECT c.Name, c.Code2, c.Continent, c.Region, c.SurfaceArea, c.IndepYear,
	       c.Population, c.LifeExpectancy, c.GNP, c.LocalName, c.GovernmentForm,
	       c.HeadOfState, city.Name as Capitol
	FROM country as c
	JOIN city ON c.Capital = city.ID";

if ($search != NULL) {	
	$sql = $sql." WHERE c.Name LIKE '%".$search."%'";
} 

$result = $conn->query($sql);
$conn->close();
?>


<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

    <title>World DB</title>
  </head>
  <body>
    <div class="container">
      <div class="row">
        <div class="col text-center">
          <h1>World DB</h1>
        </div>
      </div>
      <div class="row">
	<form action="world.php" method="get">
	<div class="input-group mb-3">
          <input type="text" class="form-control" name="search" placeholder="Country" aria-label="Search" aria-describedby="basic-addon2">
          <div class="input-group-append">
            <button type="submit" class="btn btn-outline-secondary">Search</button>
          </div>
        </div>
      </div>
      </form>
      <div class="row">
	<div class="table-responsive">
        <table class="table table-sm table-striped">
          <thead>
            <tr>
              <th scope="col">#</th>
              <th scope="col">Country</th>
              <th scope="col">Code</th>
              <th scope="col">Continent</th>
              <th scope="col">Region</th>
              <th scope="col">Capitol</th>
              <th scope="col">Surface Area</th>
              <th scope="col">Independance</th>
              <th scope="col">Population</th>
              <th scope="col">Life Expectancy</th>
              <th scope="col">GNP</th>
              <th scope="col">Local Name</th>
              <th scope="col">Government Form</th>
              <th scope="col">Head Of State</th>
            </tr>
          </thead>
          <tbody>
            <?php
		$count = 1;
		if ($result->num_rows > 0) {
			while($row = $result->fetch_assoc()) {
				echo "<tr>";
				echo "<th scope='row'>".$count."</th>";
				echo "<td>".utf8_encode($row["Name"])."</td>";
				echo "<td>".utf8_encode($row["Code2"])."</td>";
				echo "<td>".utf8_encode($row["Continent"])."</td>";
				echo "<td>".utf8_encode($row["Region"])."</td>";
				echo "<td>".utf8_encode($row["Capitol"])."</td>";
				echo "<td>".utf8_encode($row["SurfaceArea"])."</td>";
				echo "<td>".utf8_encode($row["IndepYear"])."</td>";
				echo "<td>".utf8_encode($row["Population"])."</td>";
				echo "<td>".utf8_encode($row["LifeExpectancy"])."</td>";
				echo "<td>".utf8_encode($row["GNP"])."</td>";
				echo "<td>".utf8_encode($row["LocalName"])."</td>";
				echo "<td>".utf8_encode($row["GovernmentForm"])."</td>";
				echo "<td>".utf8_encode($row["HeadOfState"])."</td>";
				echo "</tr>";

				$count++;
            		}
		}
            ?>    		
          </tbody>
        </table>
        </div>
      </div>
    </div>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
  </body>
</html>
