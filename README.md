# Web - Pau Munoz Serra

User: PauMunozSerra
Password: P@ssw0rd

## Descripció del Projecte

Aquesta és una aplicació web que permet als usuaris registrar-se, iniciar sessió, i gestionar el seu perfil. Els usuaris poden crear, editar i eliminar campions de League of Legends. L'aplicació està dissenyada per facilitar l'administració d'usuaris i campions, proporcionant una interfície intuïtiva i funcionalitats robustes per a la gestió de dades. També es pot iniciar sessió amb el compte de Reddit.

## Estructura de Carpetes

A continuació es mostra l'estructura de carpetes i arxius del meu projecte:

``` terminal (tree)
CODE
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

## Funcions

Descripció detallada de les funcions disponibles en el projecte.

### Funcions del model usuaris.model.php

**modelNickNameExisteixLogin**: Comprova si l'usuari existeix i retorna la seva contrasenya encriptada.
**modelContrasenyaIgualLogin**: Mira si la contrasenya és igual a la de la base de dades.
**modelObtenirUrlImgPerfil**: Retorna la ruta de la imatge de perfil.
**modelCorreuExisteix**: Mira si el correu existeix.
**modelNickNameExisteix**: Mira si el nickname existeix.
**modelAfegeixUsuari**: Afegeix un nou usuari amb totes les dades que li passem.
**modelCanviContrasenya**: Actualitza una nova contrasenya segons el nickname que li passem (la contrasenya està encriptada quan la guardem).
**modelComprovarUsuariAdministrador**: Comprova si l'usuari és administrador o no.
**afegirUsuariHybridAuth**: Afegeix un usuari segons el HybridAuth.
**modelNickNameExisteixReddit**: Comprova si l'usuari existeix registrat amb Reddit.
**modelNickNameExisteixLogin**: Comprova si l'usuari existeix i retorna la seva contrasenya encriptada.

### Funcions del model afegirChamps.model.php

- **modelAfegirCampio** : Afegeix un nou campió a la base de dades amb els paràmetres proporcionats: nom, descripció, recurs, rol i creador.
- **modelComprovarNom** : Comprova si el nom del campió ja existeix a la base de dades. Retorna "ChampDuplicat" si el nom ja existeix, i "ChampNoDuplicat" si no existeix.

### Funcions del model buscarChamp.model.php

- **contarChampionsBuscarLoguejatModel** : Obtenim el número total de champs que hi ha a la base de dades d'un usuari concret amb un nom del champ concret.
- **contarChampionsBuscarSenseLoguejarModel** : Obtenim el número total de champs que hi ha a la base de dades.
- **selectChampsBuscadorAmbLogin** : Seleccionem els champs de la base de dades d'un usuari concret amb un nom del champ concret, amb paginació i ordre.
- **selectChampsBuscadorSenseLogin** : Seleccionem els champs de la base de dades amb un nom del champ concret, amb paginació i ordre.

### Funcions del model editarChamp.model.php

- **modelObtenirChamp** : Obté un campió de la base de dades segons la seva ID.
- **modelComprovarChampNickname** : Comprova si un campió ha estat creat per un usuari específic.
- **modelModificarCampion** : Actualitza un campió a la base de dades segons la seva ID amb nous paràmetres.

### Llistat del model

- **modelObtenirInfoUsuari** : Obté la informació d'un usuari a partir del seu nom d'usuari.
- **modelUpdateDadesUsuari** : Actualitza les dades d'un usuari, incloent la imatge de perfil.
- **modelUpdateDadesUsuariNoImg** : Actualitza les dades d'un usuari sense modificar la imatge de perfil.
- **modelNomUsuariRepetit** : Comprova si un nom d'usuari ja està en ús.
- **modelCorreuRepetit** : Comprova si un correu electrònic ja està en ús.
- **modelObtenirUrlImgPerfilv2** : Retorna la ruta de la imatge de perfil d'un usuari.

### Funcions del model eliminarChamp.model.php

- **modelComprovarUsuariId** : Comprova si un campió amb un nom concret ha estat afegit per l'usuari que es passa com a paràmetre.
- **modelEliminarCampion** : Elimina un campió de la base de dades segons el seu ID.

### Funcions del model eliminarUsuari.model.php

- **modelEliminarUsuari** : Elimina un usuari de la base de dades segons el seu nom d'usuari.

### Funcions del model paginacioChamps.model.php

- **selectModel** : Obtenim tots els champs de la base de dades i els guardem a una array.
- **contarChampionsModel** : Obtenim el numero total els champs que hi ha a la base de dades.
- **selectUsuariLogiModel** : Obtenim tots els champs de la base de dades que entren en aquella paguina que siguin del usuari que li passem i els guardem a una array.
- **contarChampionsUsuariLoginModel** : Obtenim el numero total els champs que hi ha a la base de dades d'un Usari concret.

### Funcions del model paginacioUsuaris.model.php

- **selectObtenirTotsUsuaris** : Aquesta funció obté tots els usuaris de la base de dades que no són administradors.
- **mirarUsuariAdmin** : Aquesta funció comprova si un usuari específic és administrador o no, basant-se en el seu nom d'usuari.

### Funcions del model recuperarContrasenya.model.php

- **modelCorreuExisteixEnviar** : Comprova si un correu existeix a la base de dades i retorna "CorreuExisteix" o "NoHiHaCorreu".
- **afegirTokenContraRecuperacio** : Afegeix un token de recuperació de contrasenya i la seva data d'expiració a un usuari especificat per correu electrònic.
- **actualitzarContrasenya** : Actualitza la contrasenya d'un usuari utilitzant un token de recuperació vàlid i no expirat.

## Arquitectura MVC

Explicació de l'arquitectura Model-Vista-Controlador (MVC) utilitzada en el projecte.

### Estructura de Carpetes Bàsica

- **Model**: Es qui s'ocupa de poder per tota la connexió amb la base de dades ja sigui per afegir eliminar modificar.. qualsevol cosa relacionada amb la bd.
- **Vista**: Mostra les dades a l'usuari i dona la vista a l'usuari.
- **Controlador**: Gestiona la comunicació entre el model i la vista, i controla les sol·licituds de l'usuari.

### Estructura de Carpetes Addicionals

- **lib**: Conté les llibreries del PHPMailer i el HybridAuth.
- **style**: Conté els estils extra per la web (el 99% està fet amb Bootstrap).
- **vistaGlobal**: Conté les parts de la pàgina web comunes per a totes les vistes.

## Cookies

He utilitzat les cookies per diverses funcionalitats en el projecte:

- **Ordenar**: Les cookies s'utilitzen per recordar les preferències d'ordenació dels usuaris, de manera que quan tornin a la pàgina, els elements es mostrin segons les seves preferències.
- **Recordar**: Les cookies permeten recordar els usuaris que han seleccionat l'opció "remember-me" en iniciar sessió, de manera que no hagin de tornar a introduir les seves credencials del nom d'usuari cada vegada que visiten la pàgina.
- **Buscar els campions**: Les cookies emmagatzemen les preferències de cerca dels usuaris, facilitant la recuperació ràpida dels resultats de cerca anteriors.
- **Paginació**: Les cookies s'utilitzen per recordar la pàgina actual en la paginació, de manera que els usuaris puguin reprendre la navegació des del mateix punt on la van deixar.
- **reCAPTCHA**: Les cookies ajuden a gestionar les verificacions de reCAPTCHA per assegurar-se que els usuaris no hagin de passar per la verificació repetidament durant la seva sessió.

## Sessions

Les sessions les he utilitzat per gestionar la informació de l'usuari durant la seva estada a la nostra aplicació.

- **Foto de perfil i nom d'usuari**: A través de les sessions, podem obtenir i mostrar la foto de perfil de l'usuari, així com el seu nom d'usuari (nickname).
- **Privilegis d'administrador**: Les sessions ens permeten determinar si un usuari és administrador, cosa que li atorga accés a llocs amb més privilegis dins de l'aplicació.

## HybridAuth

En el cas del HybridAuth, he fet servir el Reddit ja que era un dels mes facils a l'hora de implementar-ho en el meu programa, a més de que si faltaba algun dels parametres obligatori, li creaca un unic perque no hi hages de repetit, a més de que si ja estava loguejat iniccies seccion sense problemes.

## Resum de QR, API i AJAX

Aquí mostrem els campeons i seleccionem 5, mentres tant es va canviant la img dels 5 personatges, quan li donem a mostrar es desabilitan per canviar els campions i canviar el nom del equip, a més de apreixe el button de descarregar el qr i el qr en gran, a més de un button per tornar a l'inici

### OPCIOANL

Mirar si fer que en canvi de guardar l'equip a una base de dades es guardi a una API com aqeusta:

``` json
{
    "data": {
        "Full Tank": {
            "Zac": {
                "title": "la Espada de los Oscuros",
                "blurb": "Aatrox y sus hermanos, otrora respetados defensores de Shurima contra el Vacío, acabarían convirtiéndose en una amenaza aún mayor para Runaterra y solo conocieron la derrota ante el uso astuto de hechizos mortales. No obstante, tras siglos de reclusión...",
                "info": {
                    "attack": 8,
                    "defense": 4,
                    "magic": 3,
                    "difficulty": 4
                },
                "tags": [
                    "Fighter"
                ],
                "partype": "Pozo sangriento"
            },
            "Ornn": {
                "title": "Las Llamas de la Forja",
                "blurb": "Ornn es el espíritu de Freljord de la forja y la artesanía. Trabaja en la soledad de una enorme forja esculpida en las cavernas de lava bajo el volcán de Dulcehogar. En ella modela objetos de calidad sin igual y depura menas en burbujeantes calderos de...",
                "info": {
                    "attack": 5,
                    "defense": 9,
                    "magic": 3,
                    "difficulty": 5
                },
                "tags": [
                    "Tank"
                ],
                "partype": "Maná"
            },
            "Nautilus": {
                "title": "El Titán Abisal",
                "blurb": "El gigante acorazado Nautilus, una leyenda solitaria tan antigua como los pecios de Aguas Estancadas, recorre las turbias aguas que rodean las costas de las Islas de la Llama Azul. Impulsado por una traición olvidada, ataca con su enorme ancla sin...",
                "info": {
                    "attack": 4,
                    "defense": 6,
                    "magic": 6,
                    "difficulty": 6
                },
                "tags": [
                    "Tank",
                    "Support"
                ],
                "partype": "Maná"
            },
            "Sion": {
                "title": "El Coloso no Muerto",
                "blurb": "Sion fue un héroe de guerra en el pasado y los noxianos lo veneraban porque había arrebatado la vida de un rey demaciano con sus simples manos. No obstante, se le denegó su viaje al más allá, pues fue revivido para servir a su imperio incluso después de...",
                "info": {
                    "attack": 5,
                    "defense": 9,
                    "magic": 3,
                    "difficulty": 5
                },
                 "tags": [
                    "Tank",
                    "Fighter"
                ],
                "partype": "Maná"
            }
        }
    }
}

```

### **QR**

En aquest cas es generara un QR el qual guardara un equip amb 5 campeons que agafarem d'un llistat d'una API de campeons del LOL a més del nom del equip.

Al escanejar-ho es mostraran en una pagina amb els 5 campeons en gran (gracies a la url i el nom del campeon) i un camp per 

### **AJA**

Es pot fer AJAX que quan tinguis els 5 campeons seleccioants es generi un QR i que cada com que canvis un champ es canvi el QR

### **API**

Aquí podem veure la API amb informació de tots els Campeons del Lol hi ha més de url per obtenir la img dels campeons

**API Campeones:** <https://ddragon.leagueoflegends.com/cdn/15.1.1/data/es_ES/champion.json>

**INFO API** <https://developer.riotgames.com/docs/lol>

**URL FOTO GRAN:** <https://ddragon.leagueoflegends.com/cdn/img/champion/loading/nomChamp_0.jpg>

**URL FOTO MINIATURA:** <https://ddragon.leagueoflegends.com/cdn/15.1.1/img/champion/nomChamp.png>
