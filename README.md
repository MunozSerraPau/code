# Web - Pau Munoz Serra

## Descripció del Projecte

Aquesta és una aplicació web que permet als usuaris registrar-se, iniciar sessió, i gestionar el seu perfil. Els usuaris poden crear, editar i eliminar campions de League of Legends. L'aplicació està dissenyada per facilitar l'administració d'usuaris i campions, proporcionant una interfície intuïtiva i funcionalitats robustes per a la gestió de dades. També es pot iniciar sessió amb el compte de Reddit.

## Estructura de Carpetes

A continuació es mostra l'estructura de carpetes i arxius dins de la carpeta "code":

``` js
C:\XAMPP\HTDOCS\CODE
│   .htaccess
│   env.php
│   index.php
│   PALETA_COLORS.jpg
│   pt04_pau_munoz.sql
│   README.md
│
├───controlador
│       afegirChamp.controlador.php
│       connexio.php
│       editarChamp.controlador.php
│       editarUsuari.controlador.php
│       eliminarChamp.controlador.php
│       eliminarUsuari.controlador.php
│       HybridAuthReddit.controlador.php
│       logOut.controlador.php
│       paginacioChamps.controlador.php
│       paginacioUsuaris.controlador.php
│       recuperarContrasenya.controlador.php
│       reset_password.controlador.php
│       usuaris.controlador.php
│
├───lib
│   ├───HybridAuth
│   │   │   composer.json
│   │   │   composer.lock
│   │   │   hybridauth_config.php
│   │   │
│   │   └───vendor
│   │       │   autoload.php
│   │       │
│   │       ├───composer
│   │       │      └─── ...
│   │       │
│   │       └───hybridauth
│   │              └─── ...
│   │
│   └───PHPMailer-master
│           └─── ...
│
├───model
│       afegirChamp.model.php
│       buscarChamp.model.php
│       editarChamp.model.php
│       editarUsuaris.model.php
│       eliminarChamp.model.php
│       eliminarUsuari.model.php
│       paginacioChamps.model.php
│       paginacioUsuaris.model.php
│       recuperarContrasenya.model.php
│       usuaris.model.php
│
├───style
│   │   reset.css
│   │   style.css
│   │
│   └───images
│           background.jpg
│           background.webp
│
├───vista
│       afegirChamp.vista.php
│       canviarContrasenya.vista.php
│       editarChamp.vista.php
│       editarPerfil.vista.php
│       login.vista.php
│       modificarAdmin.vista.php
│       recuperarContrasenya.vista.php
│       reset_password.vista.php
│       singup.vista.php
│
└───vistaGlobal
    │   footer.vista.php
    │   mostrarChamps.vista.php
    │   nav.vista.php
    │
    ├───error
    │       403.php
    │       404.php
    │
    └───imgPerfil
            default.png
```

## Funciones

Descripció detallada de les funcions disponibles en el projecte.

- **afegirChamp**: Funció per afegir un nou campionat.
- **eliminarChamp**: Funció per eliminar un campionat existent.
- **paginacioUsuaris**: Funció per gestionar la paginació dels usuaris.
- **recuperarContrasenya**: Funció per recuperar la contrasenya d'un usuari.
- **usuaris**: Funció per gestionar els usuaris del sistema.

## Arquitectura MVC

Explicació de l'arquitectura Model-Vista-Controlador (MVC) utilitzada en el projecte.

- **Model**: Es qui s'ocpa de poder per tota la connexio amb la base de dades ja sigui per afegir eliminar modificar.. qualsevol cosa relaccionada amb la bd.
- **Vista**: Mostra les dades a l'usuari i dona la vista al usuari.
- **Controlador**: Gestiona la comunicació entre el model i la vista, i contrla les sol·licituds de l'usuari.

## Estructura de Carpetes Addicionals

- **lib**: Conté les llibreries del PHPMailer i el HybridAuth.
- **style**: Conté els estils.
- **vistaGlobal**: Conté les parts de la pàgina web comunes per a totes les vistes.

## Licencia

Información sobre la licencia del proyecto.