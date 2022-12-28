<?php 
  $hotels = [
    [
      'name' => 'Hotel Belvedere',
      'description' => 'Hotel Belvedere Descrizione',
      'parking' => true,
      'vote' => 4,
      'distance_to_center' => 10.4
    ],
    [
      'name' => 'Hotel Futuro',
      'description' => 'Hotel Futuro Descrizione',
      'parking' => true,
      'vote' => 2,
      'distance_to_center' => 2
    ],
    [
      'name' => 'Hotel Rivamare',
      'description' => 'Hotel Rivamare Descrizione',
      'parking' => false,
      'vote' => 1,
      'distance_to_center' => 1
    ],
    [
      'name' => 'Hotel Bellavista',
      'description' => 'Hotel Bellavista Descrizione',
      'parking' => false,
      'vote' => 5,
      'distance_to_center' => 5.5
    ],
    [
      'name' => 'Hotel Milano',
      'description' => 'Hotel Milano Descrizione',
      'parking' => true,
      'vote' => 2,
      'distance_to_center' => 50
    ],
  ];

  //controllo che esista
  $park = $_GET["park"] ?? '';
  $stars = $_GET["stars"] ?? '';
  // echo "Parcheggi".$park."<br>";
  // echo "Stelle".$stars."<br>";

  //se non é stringa vuota o undefined ho dei filtri attivi
  $hasFilter = !empty($stars) || !empty($park);

  //array in cui salvare i dati filtrati
  $filterData = [];

  //filtro i dati se nel GET ho almeno una della chiavi dei dati
  if ($hasFilter){
    //ciclo su hotels e per ogni elemento di questo array
    //devo decidere, in base ai filtri, se pusharlo nell'array
    foreach ($hotels as $hotel) {
      $mustPush = true;

      if ($hotel["vote"] < $stars){
        $mustPush = false;
      }

      if ($park === 'on' && $hotel["parking"] === false) {
        $mustPush = false;
      }

      if($mustPush) {
        $filterData[] = $hotel;
      }
    }
  } else{
    //se non ci sono filtri attivi
    $filterData = $hotels;
  }
?>

<!DOCTYPE html>
<html lang="it">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <title>Php Hotel</title>

  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css">
</head>

<body>
    <main class="container">
        <h1 class="py-3">HOTEL</h1>

        <form method="GET" class="row">
          <div class="col-6">
            <input type="checkbox" name="park">
            <label>Hotel con parcheggio</label>
          </div>
          
          <div class="col-6">
            <input type="number" class="form-control" name="stars" placeholder="Numero di stelle">
          </div>
          
          <div class="col-12 text-center my-3">
            <a class="btn btn-secondary" href="index.php">Annulla Filtri</a>
            <button class="btn btn-primary" type="submit" >Filtra</button>
          </div>
          
        </form>

        <table class="table table-striped">
          <thead>
            <tr>
              <th scope="col">Name</th>
              <th scope="col">Desription</th>
              <th scope="col">Parking</th>
              <th scope="col">Vote</th>
              <th scope="col">Distance to center</th>
            </tr>
          </thead>
          <tbody>
            <?php
              foreach ($filterData as $hotel) {
                echo "<tr>";
                echo "<td>{$hotel['name']}</td>";
                echo "<td>{$hotel['description']}</td>";
                echo "<td>{$hotel['parking']}</td>";
                echo "<td>{$hotel['vote']}</td>";
                echo "<td>{$hotel['distance_to_center']}</td>";
                echo "</tr>";
              }
            ?>
          </tbody>  
        </table>
    </main>
</body>
</html>
