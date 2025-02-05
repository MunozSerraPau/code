<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    <link rel="stylesheet" href="./style/style.css">
    <title>EDITAR EQUIP</title>
</head>

<body>
    <?php require_once '../env.php'; ?>
    <?php if (session_status() === PHP_SESSION_NONE) {
        session_start();
    } ?>

    <?php require BASE_PATH . "/controlador/editarEquip.controlador.php"; ?>
    <?php require BASE_PATH . "/controlador/obtenirChampAPI.controlador.php"; ?>

    <div class="containerr pt-0">

        <?php include BASE_PATH . "/vistaGlobal/nav.vista.php" ?>

        <div class="container d-flex justify-content-center align-items-center min-vh-100">
            <div class="card shadow p-4 h-100 w-auto bg-transparent" style="backdrop-filter: blur(10px); border-radius: 25px; border: 3px solid #454962;">

                <h1 class="text-center text-white">EDITAR EQUIP</h1>

                <div id="infoGenerarQr" class="d-none py-4">
                    <div id="divQrMostrar" class="d-flex justify-content-center"></div>

                    <a id="downloadLink" href="#" download="qr_code.png" class="btn btn-primary my-5">
                        <i class="bi bi-download fs-4 p-0"></i>
                    </a>

                    <h3 class="text-light text-center text-uppercase fw-bold"></h3>
                </div>

                <?php if ($error !== "<br>") : ?>
                    <div class="alert alert-danger" role="alert">
                        <?= $error ?>
                    </div>
                <?php else : ?>
                    <form id="championForm" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST" class="d-flex flex-column justify-content-center align-items-center">

                        <div class="mb-3">
                            <label for="nomEquip" class="form-label text-white">Nom Equip</label>
                            <input type="text" style="width: 300px;" class="form-control" id="nomEquip" name="nomEquip" placeholder="Nom del equip" required>
                        </div>
                        <div class="row d-flex justify-content-center align-items-center">
                            <?php foreach ($equip as $campio) { ?>
                                <div class="col col-6 col-md-4 col-lg-3 col-xxl-2 py-3">
                                    <div class="card d-flex justify-content-center align-items-center champion-card bg-ligth" data-id="<?php echo htmlspecialchars($champion['id']); ?>">

                                        <img src="https://ddragon.leagueoflegends.com/cdn/img/champion/loading/<?= substr($campio['imgCampio'], 0, strpos($campio['imgCampio'], '.')) ?>_0.jpg" style="max-width: 100%;" class="px-0 rounded" alt="...">

                                        <div class="card-body d-flex flex-column align-items-center w-100">
                                            <h5 class="card-title"><strong><?php echo htmlspecialchars($campio['nameCampio']); ?></strong></h5>
                                            <hr style="height: 3px;" class="w-100 bg-dark opacity-100 my-0" />
                                            <p class="card-text"><?php echo $campio['tagsCampio']; ?></p>
                                        </div>

                                        <select class="form-select" aria-label="Llistat de tots els camps" name="newChampSelect">
                                            <?php foreach ($llistatChampions as $champion) { ?>
                                                <option value='<?php echo json_encode($champion); ?>' <?php if ($champion['img'] == $campio['imgCampio']) echo 'selected'; ?>><?php echo htmlspecialchars($champion['name']); ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>
                            <?php } ?>
                        </div>
                        <button type="submit" class="btn btn-primary" name="">
                            Editar Equip
                        </button>
                    </form>
                <?php endif ?>
            </div>
        </div>

        <?php include BASE_PATH . "/vistaGlobal/footer.vista.php" ?>

    </div>
    
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
        // Canvia la imatge del campió quan es selecciona un altre campió
        document.querySelectorAll('.form-select').forEach(select => {
            select.addEventListener('change', function() {
                const selectedOption = JSON.parse(this.value);
                let isDuplicate = false;
                let previousValue = this.getAttribute('data-previous-value');

                document.querySelectorAll('.form-select').forEach(otherSelect => {
                    if (otherSelect !== this && JSON.parse(otherSelect.value).img === selectedOption.img) {
                    isDuplicate = true;
                    }
                });

                if (!isDuplicate) {
                    const card = this.closest('.champion-card');
                    const imgElement = card.querySelector('img');
                    const nomChamp = card.querySelector('h5');
                    const tagsChamp = card.querySelector('p');
                    imgElement.src = `https://ddragon.leagueoflegends.com/cdn/img/champion/loading/${selectedOption.img.split('.')[0]}_0.jpg`;
                    nomChamp.textContent = selectedOption.name;
                    tagsChamp.textContent = selectedOption.tags;
                    this.setAttribute('data-previous-value', this.value);
                } else {
                    alert('Aquest campió ja està seleccionat en un altre equip.');
                    this.value = previousValue;
                }
            });

            // Set initial data-previous-value attribute
            select.setAttribute('data-previous-value', select.value);
        });
    </script>
    <script>
        $(document).ready(function() {
            $('#championForm').submit(function(e) { // Al enviar el formulario
                e.preventDefault(); // Evita el envío del formulario por defecto
                var formData = $(this).serializeArray(); // Serializa los datos del formulario
                console.log(formData);
                var result = {};
                result.champions = [];

                // Procesa cada campo del formulario
                formData.forEach(field => {
                    if (field.name === "newChampSelect") {
                        const champion = JSON.parse(decodeURIComponent(field.value)); // Decodifica y parsea el valor del campo
                        result.champions.push(champion); // Añade el campeón al array de campeones
                    } else {
                        result[field.name] = field.value; // Añade otros campos al objeto result
                    }
                });
                console.log(result);

                // Verifica que se hayan seleccionado 5 campeones y se haya proporcionado un nombre de equipo
                if (result.champions.length === 5 && result.nomEquip) {
                    console.log('Tot correcte, enviant dades...');
                    $.ajax({
                        type: 'POST',
                        url: '<?= BASE_URL ?>/controlador/crearEquip.controlador.php', // URL del controlador
                        data: JSON.stringify(result), // Convierte el objeto result a JSON
                        contentType: 'application/json', // Tipo de contenido de la solicitud
                        success: function(response) {
                            if (response.startsWith('<img src=')) {
                                const teamName = document.getElementById('nomEquip').value; // Obtiene el nombre del equipo
                                document.getElementById('infoGenerarQr').classList.remove('d-none'); // Muestra la sección de QR
                                document.getElementById('infoGenerarQr').classList.add('d-flex', 'flex-column', 'align-items-center'); // Añade clases para el diseño
                                document.getElementById('infoGenerarQr').querySelector('h3').innerText = teamName; // Muestra el nombre del equipo
                                document.getElementById('championForm').remove(); // Elimina el formulario

                                const divQrImage = document.getElementById('infoGenerarQr').querySelector('#divQrMostrar');
                                divQrImage.innerHTML = response; // Muestra la imagen del QR
                            } else {
                                alert(response); // Muestra una alerta con la respuesta
                            }
                        },
                            error: function() {
                            alert('Error en la solicitud.'); // Muestra una alerta en caso de error
                        }
                    });
                } else {
                    alert('Selecciona 5 campeones y proporciona un nombre de equipo.'); // Muestra una alerta si no se cumplen las condiciones
                }
            });
        });
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>