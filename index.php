<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
  <title>Hotel Finder</title>
</head>
<body>

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

?>

<div class="row bg-dark">
    <div class="col-12 p-5 justify-content-center ">

        <h1 class="text-white">Hotel Finder</h1>


        <form class="p-2" action="index.php" method="GET">
            <label for="parking" class="text-white">Parcheggio</label>
            <input type="checkbox" name="parking" id="parking" value="true">

            <label for="vote" class="text-white">Voto</label>
            <input placeholder="Scegli un voto da 1 a 5" type="number" name="vote" id="vote" min="1" max="5">

          
            <button type="submit" class="btn btn-primary mb-2">Filtra</button>
        </form>

        <?php

        /*
        Filtri definiti dalle variabili $filterParking e $filterVote
        isset($_GET['vote']): Controlla se il parametro 'vote' è presente nella query string. Restituisce true se presente, altrimenti false.
        intval($_GET['vote']): Se il parametro 'vote' è presente, converte il suo valore in un intero utilizzando la funzione intval(). Questa funzione restituirà l'intero corrispondente al valore del parametro. Se il parametro 'vote' non è presente, restituirà 0.
        : 0: Questa parte rappresenta l'operatore ternario e viene utilizzata per fornire un valore di fallback nel caso in cui il parametro 'vote' non sia presente. Se il parametro 'vote' è presente, viene restituito l'intero convertito. Se il parametro 'vote' non è presente, viene restituito 0.
        */
            $filterParking = isset($_GET['parking']) && $_GET['parking'] === 'true';
            $filterVote = isset($_GET['vote']) ? intval($_GET['vote']) : 0;

            // Utilizzo di array_filter per filtrare gli hotel in base ai criteri definiti
            $filteredHotels = array_filter($hotels, function ($hotel) use ($filterParking, $filterVote) {
                // Verifica se l'hotel soddisfa il criterio di parcheggio
                $matchesParking = !$filterParking || $hotel['parking'];

                // Verifica se l'hotel soddisfa il criterio di voto
                $matchesVote = $filterVote == 0 || $hotel['vote'] >= $filterVote;

                // L'hotel viene incluso nel risultato finale solo se soddisfa entrambe le condizioni di parcheggio e voto
                return $matchesParking && $matchesVote;
            });
        ?>

      
        <table class="table table-hover mx-auto">
            <thead>
                <tr>
                    <th>Nome</th>
                    <th>Descrizione</th>
                    <th>Parcheggio</th>
                    <th>Voto</th>
                    <th>Distanza dal centro</th>
                </tr>
            </thead>

            <tbody>
                <?php
                // Itera sugli hotel filtrati e mostra le informazioni
                foreach ($filteredHotels as $hotel) {
                    echo '<tr>';
                    echo '<td>' . $hotel['name'] . '</td>';
                    echo '<td>' . $hotel['description'] . '</td>';
                    echo '<td>' . $hotel['parking'] . '</td>';
                    echo '<td>' . $hotel['vote'] . '</td>';
                    echo '<td>' . $hotel['distance_to_center'] . '</td>';
                    echo '</tr>';
                }
                ?>
            </tbody>
        </table>
    </div>
</div>

</body>
</html>
