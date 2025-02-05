<?php require_once BASE_PATH . '/controlador/paginacioChamps.controlador.php'; ?>



<?php if(!empty($nomUsuari)): ?>
    <script>
        function confirmarEliminacion() {
            return confirm('Estas segur que vols eliminar aquest campió?');
        }
    </script>
    <div class="row my-4 justify-content-center">
        <div class="col-xs-12 col-md-6 col-lg-3 mb-4">
            <form class="d-flex justify-content-center" method="POST">
                <div class="input-group" style="max-width: 500px;">
                    <input type="text" class="form-control" name="paraulaBuscador" placeholder="Busca..." aria-label="Buscar" value="<?php echo $paraulaBuscar; ?>">
                    <button class="btn btn-primary" type="submit" name="buscador"><i class="bi bi-search"></i></button>
                </div>
            </form>
        </div>
    </div>
    <div class="row my-4 justify-content-center">
        <div class="col-xs-12 col-md-6 col-lg-3 mb-4 justify-content-center d-flex">
            <a style="height: 50px;" class="btn btn-primary w-25 align-content-center" href="<?php echo BASE_URL; ?>/vista/afegirChamp.vista.php" class="btn btn-primary"><i class="bi bi-plus-circle-fill"></i></a>
        </div>
    </div>

    <div class="row">
        <?php foreach ($campeons as $champion): ?>
            <div class="col-xs-12 col-md-6 col-lg-3 mb-4">
                <div class="card bg-card">
                    <img src="" class="card-img-top m-2 w-auto h-auto" alt="...">
                    <div class="card-body">
                        <h5 class="card-title"><?php echo $champion['name']; ?></h5>
                        <hr>
                        <p class="card-text"><?php echo $champion['description']; ?></p>
                        <div class="d-flex jus justify-content-between aling-items-center">
                            <p><?php echo $champion['resource']; ?></p>
                            <p><?php echo $champion['role']; ?></p>
                        </div>
                        <div class="d-flex jus justify-content-between aling-items-center">
                            <p class="card-text"><i> <?php echo $champion['creator']; ?> </i></p>
                            <!-- en aqeust cas com estem logeats tenim dos buttons per poder editar i modificar els campions ja que nomes es mostren els qeu hem creat nosltres -->
                            
                            <div class="d-flex">
                                <a href="<?php echo BASE_URL; ?>/controlador/eliminarChamp.controlador.php?id=<?php echo $champion['id'] ?>&action=delete" class="me-2 btn btn-outline-danger" onclick="return confirmarEliminacion()">
                                    <i class="bi bi-trash3-fill"></i>
                                </a>

                                <a href="<?php echo BASE_URL; ?>/vista/editarChamp.vista.php?idChampEditar=<?php echo $champion['id'] ?>" class="me-2 btn btn-outline-warning">
                                    <i class="bi bi-pen"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>

    <div class="row">
        <div class="col-md-4">
            <form method="GET" >
                <select class="form-control" name="champsPerPagina" onchange="this.form.submit()">
                    <option value="8"  <?php if(isset($_COOKIE['champsPerPaginaLogin']) && $_COOKIE['champsPerPaginaLogin'] == 8) echo 'selected'; ?>>8</option>
                    <option value="12" <?php if(isset($_COOKIE['champsPerPaginaLogin']) && $_COOKIE['champsPerPaginaLogin'] == 12) echo 'selected'; ?>>12</option>
                    <option value="16" <?php if(isset($_COOKIE['champsPerPaginaLogin']) && $_COOKIE['champsPerPaginaLogin'] == 16) echo 'selected'; ?>>16</option>
                    <option value="20" <?php if(isset($_COOKIE['champsPerPaginaLogin']) && $_COOKIE['champsPerPaginaLogin'] == 20) echo 'selected'; ?>>20</option>
                </select>
            </form>
        </div>
        <div class="col-md-4 text-center">
            <nav aria-label="Page navigation example">
                <ul class="pagination justify-content-center">
                    <?php if($pagina == 1): ?>
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
            <form  method="POST">
                <select class="form-control" name="ordreLogin" onchange="this.form.submit()">
                    <option value="Ascending" <?php if ($ordre == 'Ascending') echo 'selected'; ?>>Ascending</option>
                    <option value="Descending" <?php if ($ordre == 'Descending') echo 'selected'; ?>>Descending</option>
                </select>
            </form>
        </div>
    </div>
<?php else: ?>
    <div class="row my-4 justify-content-center">
        <div class="col-xs-12 col-md-6 col-lg-3 mb-4">
            <form class="d-flex justify-content-center" method="POST">
                <div class="input-group" style="max-width: 500px;">
                    <input type="text" class="form-control" name="paraulaBuscador" placeholder="Busca..." aria-label="Buscar" value="<?php echo $paraulaBuscar; ?>">
                    <button class="btn btn-primary" type="submit" name="buscador"><i class="bi bi-search"></i></button>
                </div>
            </form>
        </div>
    </div>
    <div class="row">
        <?php foreach ($campeons as $champion): ?>
            <div class="col-xs-12 col-md-6 col-lg-3 mb-4">
                <div class="card bg-card">
                    <img src="" class="card-img-top" alt="...">
                    <div class="card-body">
                        <h5 class="card-title"><?php echo $champion['name']; ?></h5>
                        <hr>
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
            <form method="GET" >
                <select class="form-control" name="champsPerPagina" onchange="this.form.submit()">
                    <option value="8"  <?php if(isset($_COOKIE['champsPerPagina']) && $_COOKIE['champsPerPagina'] == 8) echo 'selected'; ?>>8</option>
                    <option value="12" <?php if(isset($_COOKIE['champsPerPagina']) && $_COOKIE['champsPerPagina'] == 12) echo 'selected'; ?>>12</option>
                    <option value="16" <?php if(isset($_COOKIE['champsPerPagina']) && $_COOKIE['champsPerPagina'] == 16) echo 'selected'; ?>>16</option>
                    <option value="20" <?php if(isset($_COOKIE['champsPerPagina']) && $_COOKIE['champsPerPagina'] == 20) echo 'selected'; ?>>20</option>
                </select>
            </form>
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
            <form  method="POST">
                <select class="form-control" name="ordre" onchange="this.form.submit()">
                    <option value="Ascending" <?php if ($ordre == 'Ascending') echo 'selected'; ?>>Ascending</option>
                    <option value="Descending" <?php if ($ordre == 'Descending') echo 'selected'; ?>>Descending</option>
                </select>
            </form>
        </div>
    </div>
<?php endif; ?>