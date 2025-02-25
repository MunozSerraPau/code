<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="./style/style.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    <title>Crear Equip</title>
</head>

<body>
    <?php require_once '../env.php'; ?>
    <?php require BASE_PATH . '/controlador/obtenirChampAPI.controlador.php'; ?>
    <?php require BASE_PATH . '/controlador/crearEquip.controlador.php'; ?>
    <?php if (session_status() === PHP_SESSION_NONE) {
        session_start();
    } ?>

    <div class="position-absolute top-0 start-0" style="z-index: 9999;">
        <a href="#main-content" class="btn btn-primary btn-Tabular fw-bold">Ir al contenido principal</a>
    </div>

    <div class="containerr mt-5">
        <?php include BASE_PATH . "/vistaGlobal/nav.vista.php" ?>


        <div class="container d-flex justify-content-center min-vh-100 py-10p" id="main-content">
        
            <div class="shadow p-4 container" style="backdrop-filter: blur(15px); border-radius: 25px; border: 3px solid #454962;">
            
                <h1 class="text-center mb-4 text-light">Crear Equip</h1>

                <div id="infoGenerarQr" class="d-none py-4">
                    <div id="divQrMostrar" class="d-flex justify-content-center"></div>

                    <a id="downloadLink" href="#" download="qr_code.png" class="btn btn-primary my-5" aria-label="Descargar QR">
                        <i class="bi bi-download fs-4 p-0"></i>
                    </a>

                    <h2 class="text-light text-center text-uppercase fw-bold">Nom del Equip</h2>
                </div>

                <div class="row">
                    <div class="col px-0" id="champEscollit_1"><img src="" alt="" style="border: 2px solid black ;min-width: 100%; height: 460px;" class="placeholder bg-dark"></div>
                    <div class="col px-0" id="champEscollit_2"><img src="" alt="" style="border: 2px solid black ;min-width: 100%; height: 460px;" class="placeholder bg-dark"></div>
                    <div class="col px-0" id="champEscollit_3"><img src="" alt="" style="border: 2px solid black ;min-width: 100%; height: 460px;" class="placeholder bg-dark"></div>
                    <div class="col px-0" id="champEscollit_4"><img src="" alt="" style="border: 2px solid black ;min-width: 100%; height: 460px;" class="placeholder bg-dark"></div>
                    <div class="col px-0" id="champEscollit_5"><img src="" alt="" style="border: 2px solid black ;min-width: 100%; height: 460px;" class="placeholder bg-dark"></div>
                </div>

                <form id="championForm" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST" class="d-flex flex-column align-items-center">
                    <div class="py-5 w-50">
                        <label for="nomEquip" class="form-label text-center w-100">
                            <h2 class="text-light text-center">Nom de l'Equip</h2>
                            <input type="text" id="nomEquip" name="nomEquip" class="form-control" placeholder="Escriu el nom del teu equip..." required>
                        </label>
                    </div>

                    <div class="row row-cols-2 row-cols-sm-3 row-cols-md-4 row-cols-lg-5 row-cols-xl-6">
                        <?php foreach ($llistatChampions as $champion) : ?>
                            <div class="col py-3">
                                <div class="card d-flex justify-content-center align-items-center champion-card" data-id="<?php echo htmlspecialchars($champion['id']); ?>">
                                    <img src="https://ddragon.leagueoflegends.com/cdn/15.1.1/img/champion/<?php echo $champion['img']; ?>"
                                    style="height: 150px; width: 150px;" class="rounded-circle p-2" alt="Img miniatura <?php echo $champion['name'] ?>">
                                    <div class="card-body d-flex flex-column align-items-center w-100">
                                        <h3 class="h5 card-title"><strong><?php echo htmlspecialchars($champion['name']); ?></strong></h3>
                                        <hr style="height: 3px;" class="w-100 bg-dark opacity-100 my-0" />
                                        <p class="card-text"><?php echo $champion['tags']; ?></p>

                                        <input 
                                            type="checkbox" 
                                            id="<?php echo htmlspecialchars($champion['id']); ?>" 
                                            name="champions" 
                                            value='<?php echo json_encode($champion); ?>'
                                            class="championCheckbox"
                                            data-id="<?php echo htmlspecialchars($champion['id']); ?>"
                                            aria-label="<?= $champion['name'] ?> (<?= $champion['tags'] ?>)"
                                            
                                        />
                                        
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>

                    <button class="btn btn-primary text-dark" type="submit" name="crearEquip">
                        Crear Equip
                    </button>
                </form>

            </div>
        </div>


        <?php include BASE_PATH . "/vistaGlobal/footer.vista.php" ?>
    </div>

    <script>
        $(document).ready(function() {
            $('#championForm').submit(function(e) {
                e.preventDefault();
                var formData = $(this).serializeArray(); // Obté l'array amb les dades serialitzades
                console.log(formData);
                var result = {}; // Objecte que emmagatzemarà les dades
                result.champions = []; // Array per emmagatzemar els campions

                formData.forEach(field => {
                    if (field.name === "champions") {
                        console.log(field.value);
                        // Decodifica i converteix cada campió en un objecte
                        const champion = JSON.parse(decodeURIComponent(field.value));
                        result.champions.push(champion); // Afegeix l'objecte a l'array de campions
                    } else {
                        // Afegeix altres camps a l'objecte principal
                        result[field.name] = field.value;
                    }
                });
                console.log(result);

                if (result.champions.length === 5 && result.nomEquip) {
                    console.log('Tot correcte, enviant dades...');
                    $.ajax({
                        type: 'POST',
                        url: '<?php echo BASE_URL; ?>/controlador/crearEquip.controlador.php',
                        data: JSON.stringify(result),
                        contentType: 'application/json',
                        success: function (resposta) {

                            if (resposta.startsWith('<img src=')) {
                                const teamName = document.getElementById('nomEquip').value;
                                console.log('Equip creat amb nom: ' + teamName);
                                document.getElementById('infoGenerarQr').classList.remove('d-none');
                                document.getElementById('infoGenerarQr').classList.add('d-flex', 'flex-column', 'align-items-center');
                                document.getElementById('infoGenerarQr').querySelector('h2').innerText = teamName;
                                document.getElementById('championForm').remove();
    
                                const divQrImage = document.getElementById('infoGenerarQr').querySelector('#divQrMostrar');
                                divQrImage.innerHTML = resposta;
                                
                            } else {
                                alert(resposta);
                            }
                            
                        },
                        error: function () {
                            alert('Error en la sol·licitud.');
                        }
                    });
                } else {
                    alert('Selecciona 5 campions i proporciona un nom d\'equip.');
                }
            });
        });
        
    </script>
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const downloadButton = document.getElementById('downloadLink');
            downloadButton.addEventListener('click', function() {
                const qrImage = document.querySelector('#divQrMostrar img');
                if (qrImage) {
                    downloadButton.href = qrImage.src;
                } else {
                    alert('No hi ha cap imatge QR per descarregar.');
                }
            });
        });
    </script>
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const maxSelections = 5; // Maxim de Campions a seleccionar
            const checkboxes = document.querySelectorAll('.championCheckbox');
            const selectedDivs = [
                document.getElementById('champEscollit_1'),
                document.getElementById('champEscollit_2'),
                document.getElementById('champEscollit_3'),
                document.getElementById('champEscollit_4'),
                document.getElementById('champEscollit_5'),
            ];           

            function handleCardClick(card) {
                const checkbox = card.querySelector('.championCheckbox');
                const selected = Array.from(checkboxes).filter(cb => cb.checked);

                // Limitar el número de selecciones
                if (!checkbox.checked && selected.length >= maxSelections) {
                    alert('Només pots seleccionar fins a 5 campions.');
                    return;
                }

                checkbox.checked = !checkbox.checked;
                if (checkbox.checked) {
                    card.classList.remove('bg-light');
                    card.classList.add('bg-success');
                } else {
                    card.classList.remove('bg-success');
                    card.classList.add('bg-light');
                }

                // Actualizar los divs dinámicamente
                const updatedSelected = Array.from(checkboxes).filter(cb => cb.checked);
                selectedDivs.forEach((div, index) => {
                    div.innerHTML = updatedSelected[index] ?
                        `<img src="https://ddragon.leagueoflegends.com/cdn/img/champion/loading/${updatedSelected[index].dataset.id}_0.jpg" style="max-width: 100%;" class="px-0" alt="...">` :
                        '<img src="" style="border: 2px solid black; min-width: 100%; height: 460px" class=" placeholder bg-dark">'; // Limpiar si no hay más selecciones
                });
            }

            document.querySelectorAll('.champion-card').forEach(card => {
                card.addEventListener('click', function(event) {
                    if (event.target.tagName === 'INPUT') {
                        return;
                    }
                    handleCardClick(this);
                });
            });

            // Agregar evento de clic al checkbox para que ejecute lo mismo que la tarjeta
            checkboxes.forEach(checkbox => {
                checkbox.addEventListener('click', function(event) {
                    event.stopPropagation();
                    handleCardClick(this.closest('.champion-card'));
                });

                // Permitir la selección con el teclado
                checkbox.addEventListener('keydown', function(event) {
                    if (event.key === ' ') {
                        event.preventDefault();
                        handleCardClick(this.closest('.champion-card'));
                    }
                });
            });
        });
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>