<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <title>The Clash - Pjesme</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

  <style>
    body {
      background: linear-gradient(to right, #000000, #1a1a1a);
      color: #f8f9fa;
      font-family: 'Segoe UI', sans-serif;
    }

    .glass-card {
      background: rgba(255, 255, 255, 0.05);
      border: 1px solid rgba(255, 255, 255, 0.15);
      border-radius: 1rem;
      backdrop-filter: blur(10px);
      padding: 1.5rem;
      min-height: 500px;
    }

    h2 {
      font-weight: bold;
      text-shadow: 0 0 10px #f00;
    }

    .page-link {
      background-color: #212529;
      color: #f8f9fa;
      border: 1px solid #444;
    }

    .page-link:hover {
      background-color: #343a40;
    }

    .navbar-dark .navbar-nav .nav-link.active {
      color: #f8f9fa;
      font-weight: bold;
    }

    table th:nth-child(1), table td:nth-child(1) { width: 5%; }
    table th:nth-child(2), table td:nth-child(2) { width: 35%; }
    table th:nth-child(3), table td:nth-child(3) { width: 15%; }
    table th:nth-child(4), table td:nth-child(4) { width: 45%; }

    table {
      table-layout: fixed;
    }

    td {
      white-space: nowrap;
      overflow: hidden;
      text-overflow: ellipsis;
    }

    .about-text {
      margin-top: 2rem;
      font-size: 1.1rem;
      line-height: 1.5;
      color: #ccc;
      text-align: justify;
      text-shadow: 0 0 4px #222;
    }
  </style>
</head>
    <body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark shadow">
    <div class="container-fluid">
        <a class="navbar-brand" href="index.php">The Clash</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
        <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav ms-auto">
            <li class="nav-item">
            <a class="nav-link active" href="index.php">Početna</a>
            </li>
            <li class="nav-item">
            <a class="nav-link" href="provjera.php">Provjera XML</a>
            </li>
        </ul>
        </div>
    </div>
    </nav>
    <div class="container mt-5">
    <div class="glass-card">
        <h2 class="mb-4">The Clash</h2>
        <?php
        $xml = simplexml_load_file('users.xml') or die("Greška kod učitavanja XML-a.");
        $pjesme = $xml->pjesma;
        $pjesme_array = [];
        foreach ($pjesme as $pjesma) {
            $pjesme_array[] = $pjesma;
        }
        $po_stranici = 4;
        $ukupno = count($pjesme_array);
        $ukupno_stranica = ceil($ukupno / $po_stranici);
        $stranica = isset($_GET['page']) ? max(1, intval($_GET['page'])) : 1;
        if ($stranica > $ukupno_stranica) $stranica = $ukupno_stranica;
        $od = ($stranica - 1) * $po_stranici;
        $prikazi = array_slice($pjesme_array, $od, $po_stranici);
        ?>
        <table class="table table-dark table-hover table-bordered text-center">
        <thead>
            <tr>
            <th>#</th>
            <th>Naslov pjesme</th>
            <th>Godina</th>
            <th>Album</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $broj = $od + 1;
            foreach ($prikazi as $pjesma) {
                echo "<tr>";
                echo "<td>{$broj}</td>";
                echo "<td>{$pjesma->naslov}</td>";
                echo "<td>{$pjesma->godina}</td>";
                echo "<td>{$pjesma->album}</td>";
                echo "</tr>";
                $broj++;
            }
            for ($i = count($prikazi); $i < $po_stranici; $i++) {
                echo "<tr><td>&nbsp;</td><td></td><td></td><td></td></tr>";
            }
            ?>
        </tbody>
        </table>
        <nav>
        <ul class="pagination justify-content-center mt-4">
            <li class="page-item <?= $stranica <= 1 ? 'disabled' : '' ?>">
            <a class="page-link" href="?page=<?= $stranica - 1 ?>">Prethodno</a>
            </li>

            <?php for ($i = 1; $i <= $ukupno_stranica; $i++): ?>
            <li class="page-item <?= $i == $stranica ? 'active' : '' ?>">
                <a class="page-link" href="?page=<?= $i ?>"><?= $i ?></a>
            </li>
            <?php endfor; ?>

            <li class="page-item <?= $stranica >= $ukupno_stranica ? 'disabled' : '' ?>">
            <a class="page-link" href="?page=<?= $stranica + 1 ?>">Sljedeće</a>
            </li>
        </ul>
        </nav>
        <div class="about-text">
        <p><strong>The Clash</strong> je bio engleski punk rock sastav koji je bio aktivan od 1976. do 1986. godine i bio je dio početnog vala punka u UK u kasnim 70-ima. Sastav je miješao punk s reggae, rockom, danceom, jazzom, ska i brojnim ostalim stilovima.
        Clashova izuzetna glazba i stravstveni, lijevo orijentirani idealizam frontmena Joea Strummera i Micka Jonesa bio je u oštrom kontrastu s nihilizmom Sex Pistolsa.
        Tako je Clash polučio ogroman uspjeh u Engleskoj još od izdavanja njihovog prvog albuma u 1977., nisu bili popularni u SAD sve do 1979. Njihov treći album, London Calling, pušten u kasnoj 1979. jedan je od najvažnijih albuma u povijesti rock glazbe; bio je objavljen u SAD-u u siječnju 1980. i deset godina 
        kasnije časopis Rolling Stone ga je proglasio najboljim albumom 80-ih. Rolling Stone ga je 2003. stavio na 8. mjesto među 500 najboljih albuma svih vremena.Clashov stav i stil, kao i njihova glazba, utjecali su na mnoge grupe nakon 1980-ih. Epski Record A&R producent nazvao ih je "jedinom važnom grupom". U 2003. uvedeni su u Rock and Roll Hall of Fame. U 2004. Rolling Stone ih je stavio na 30. mjesto na njihovoj listi 100 najvećih umjetnika svih vremena.
        </p>
    </div>
        <div class="row mt-4 g-3 justify-content-center">
            <div class="col-6 col-md-3">
                <div class="card bg-dark text-white shadow-sm">
                <img src="the clash.jpg" class="card-img-top" alt="London Calling">
                <div class="card-body p-2 text-center">
                    <h6 class="card-title mb-0">The Clash</h6>
                </div>
                </div>
            </div>
            <div class="col-6 col-md-3">
                <div class="card bg-dark text-white shadow-sm">
                <img src="The_Clash_-_Sandinista!.jpg" class="card-img-top" alt="White Riot">
                <div class="card-body p-2 text-center">
                    <h6 class="card-title mb-0">Sandinista!(1980)</h6>
                </div>
                </div>
            </div>
            <div class="col-6 col-md-3">
                <div class="card bg-dark text-white shadow-sm">
                <img src="EDAD977E-9DE9-4042-AF05-F59CE751596D.webp" class="card-img-top" alt="Combat Rock">
                <div class="card-body p-2 text-center">
                    <h6 class="card-title mb-0">Combat Rock (1982)</h6>
                </div>
                </div>
            </div>
            <div class="col-6 col-md-3">
                <div class="card bg-dark text-white shadow-sm">
                <img src="TheClashLondonCallingalbumcover.jpg" class="card-img-top" alt="Rock the Casbah">
                <div class="card-body p-2 text-center">
                    <h6 class="card-title mb-0">London Calling (1979)</h6>
                </div>
                </div>
    </div>
</div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    </body>
</html>