<?php require BASE_PATH . '/controlador/paginacio.controlador.php'; ?>



<script>
    // Funcio per guardar el valor de la cookie
    function setItemsPerPageCookie() {
        const items = document.getElementById('itemsPerPage').value;
        document.cookie = `champsPerPagina=${items}; path=/;`;
        location.reload();
    }

    // Selecciona el valor desat de la cookie al carregar la pàgina
    document.addEventListener("DOMContentLoaded", () => {
        const cookieValue = document.cookie.split('; ')
            .find(row => row.startsWith('champsPerPagina='))
            ?.split('=')[1];

        if (cookieValue) {
            document.getElementById('itemsPerPage').value = cookieValue;
        }
    });
</script>



<?php if(!empty($nomUsuari)): ?>
    <div class="row my-4 justify-content-center">
        <div class="col-xs-12 col-md-6 col-lg-3 mb-4">
            <form class="d-flex justify-content-center" action="/buscar" method="GET">
                <div class="input-group" style="max-width: 500px;">
                    <input type="text" class="form-control" name="query" placeholder="Busca..." aria-label="Buscar">
                    <button class="btn btn-primary" type="submit"><i class="bi bi-search"></i></button>
                </div>
            </form>
        </div>
        
    </div>
    <div class="row">
        <?php for ($i = 0; $i < 8; $i++): ?>
            <div class="col-xs-12 col-md-6 col-lg-3 mb-4">
                <div class="card">
                    <img src="https://cmsassets.rgpub.io/sanity/images/dsfx7636/game_data/db39563458aa28c3f3aa8990f2c964a0f7645097-496x560.jpg?auto=format&fit=fill&q=80&w=457" class="card-img-top" alt="...">
                    <div class="card-body">
                        <h5 class="card-title">Card title</h5>
                        <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                        <a href="#" class="btn btn-primary">Go somewhere</a>
                    </div>
                </div>
            </div>
        <?php endfor; ?>
    </div>
    <div class="row">
        <div class="col-md-4">
            <select class="form-control">
                <option>4</option>
                <option>8</option>
                <option>12</option>
                <option>16</option>
            </select>
        </div>
        <div class="col-md-4 text-center">
            <nav aria-label="Page navigation example">
                <ul class="pagination justify-content-center">
                    <li class="page-item"><a class="page-link" href="#">Previous</a></li>
                    <li class="page-item"><a class="page-link" href="#">1</a></li>
                    <li class="page-item"><a class="page-link" href="#">2</a></li>
                    <li class="page-item"><a class="page-link" href="#">3</a></li>
                    <li class="page-item"><a class="page-link" href="#">Next</a></li>
                </ul>
            </nav>
        </div>
        <div class="col-md-4">
            <select class="form-control">
                <option>Ascending</option>
                <option>Descending</option>
            </select>
        </div>
    </div>
<?php else: ?>
    <div class="row my-4 justify-content-center">
        <div class="col-xs-12 col-md-6 col-lg-3 mb-4">
            <form class="d-flex justify-content-center" action="/buscar" method="GET">
                <div class="input-group" style="max-width: 500px;">
                    <input type="text" class="form-control" name="query" placeholder="Busca..." aria-label="Buscar">
                    <button class="btn btn-primary" type="submit"><i class="bi bi-search"></i></button>
                </div>
            </form>
        </div>
        
    </div>
    <div class="row">
        <?php foreach ($campeons as $champion): ?>
            <div class="col-xs-12 col-md-6 col-lg-3 mb-4">
                <div class="card">
                    <img src="" class="card-img-top" alt="...">
                    <div class="card-body">
                        <h5 class="card-title"><?php echo $champion['name']; ?></h5>
                        <p class="card-text"><?php echo $champion['description']; ?></p>
                        <div class="d-flex jus justify-content-between aling-items-center">
                            <p><?php echo $champion['resource']; ?></p>
                            <p><?php echo $champion['role']; ?></p>
                        </div>
                        <div class="d-flex jus justify-content-between aling-items-center">
                            <p class="card-text"><i> <?php echo $champion['creator']; ?> </i></p>
                        </div>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
    <div class="row">
        <div class="col-md-4">
            <select class="form-control" id="itemsPerPage" onchange="setItemsPerPageCookie()">
                <option value="8">8</option>
                <option value="12">12</option>
                <option value="16">16</option>
                <option value="20">20</option>
            </select>
        </div>
        <div class="col-md-4 text-center">
            <nav aria-label="Page navigation example">
                <ul class="pagination justify-content-center">
                    <?php if($pagina == 0): ?>
                        <li class="page-item"><a class="page-link disabled">Enrere</a></li>
                    <?php elseif($pagina == 1): ?>
                        <li class="page-item"><a class="page-link disabled">Enrere</a></li>
                    <?php else: ?>
                        <li class="page-item"><a class="page-link" href="?pagina=<?php echo $pagina - 1 ?>">Enrere</a></li>
                    <?php endif; ?>


                    <?php for($i = 1; $i <= $numeroPagines; $i++): ?>
                        <?php if ($pagina === $i): ?>
                            <li class='page-item disabled'><a class='page-link' href='?pagina=<?php echo $i ?>'><?php echo $i ?></a></li>
                        <?php else: ?>
                            <li class='page-item'><a class='page-link' href='?pagina=<?php echo $i ?>'><?php echo $i ?></a></li>
                        <?php endif ?>
                    <?php endfor ?>

                    <?php if($pagina == 0): ?>
                        <li class="page-item"><a class="page-link disabled">Següent</a></li>
                    <?php elseif($pagina == $numeroPagines): ?>
                        <li class="page-item"><a class="page-link disabled">Següent</a></li>
                    <?php else: ?>
                        <li class="page-item"><a class="page-link" href="?pagina=<?php echo $pagina + 1 ?>">Següent</a></li>
                    <?php endif; ?>
                </ul>
            </nav>
        </div>
        <div class="col-md-4">
            <select class="form-control">
                <option>Ascending</option>
                <option>Descending</option>
            </select>
        </div>
    </div>
<?php endif; ?>


<?php /* 
perfecto ara necessito unaltre codi php per guardar en una cooki el nom d'usuari i la contrasenya qeu es fica en aqeust codi "<form <?php echo htmlspecialchars($_SERVER["PHP_SELF"]) ?>, method="POST">
                    <h1 class="text-center text-primary mb-4">Iniciar sessió</h1>
                    
                    <div class="mb-3">
                        <label for="username" class="form-label">Usuari</label>
                        <input 
                            type="text" 
                            id="username" 
                            name="username" 
                            class="form-control" 
                            value="<?php if (isset($_POST['username'])) { echo $_POST['username']; } ?>">
                    </div>

                    <div class="mb-3">
                        <label for="password" class="form-label">Contrasenya</label>
                        <input type="password" id="password" name="password" class="form-control">
                    </div>

                    <div class="form-check mb-3">
                        <input type="checkbox" name="recordam" class="form-check-input" id="recordam">
                        <label class="form-check-label" for="recordam">Recorda'm</label>
                    </div>

                    <div class="mb-3">
                        <p class="form-text">Has oblidat la contrasenya? <a href="#" class="link-primary">Recuperar  </a></p>
                    </div>

                    <?php if (isset($error)): ?>
                        <?php if (!empty($error) && $error != "UsuariConnectat"): ?>
                            <div class="alert alert-danger d-flex align-items-center" role="alert">
                                <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Danger:"><use xlink:href="#exclamation-triangle-fill"/></svg>
                                <div><?php echo $error; ?></div>
                            </div>
                        <?php elseif ($error == "UsuariConnectat"): ?>
                            <?php header('Location: ../index.php'); ?>
                        <?php endif; ?>
                    <?php endif; ?>

                    <div class="d-grid mb-3">
                        <button type="submit" class="btn btn-primary" name="login">Iniciar sesión</button>
                    </div>

                    <p class="text-center">No tens un compte? <a href="./signUp.php" class="link-primary">Registra't</a></p>
                </form>" nomes si seleccionem l'opció de "Recordem" i ja qeu estas afegeix un camp per insertar una img

*/ ?>