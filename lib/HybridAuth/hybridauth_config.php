<?php
    return [
        // 'callback' => 'https://www.paumunoz.cat/controlador/HybridAuth/reddit.controlador.php', // WEB
        'callback' => 'http://localhost/code/controlador/HybridAuthReddit.controlador.php', // LOCHOST
        'providers' => [
            'Reddit' => [
                'enabled' => true,
                'keys' => [
                    // 'id' => 'XzzxjCAMFsZUV1n5Xda3PQ', // WEB
                    // 'secret' => 'zPhJXtfZVHy-p0oc5Uuv0hsMroowoA', // WEB
                    
                    'id' => 'vHKmEA2_BijvFngBPlg0Rg', // LOCALHOST
                    'secret' => 'ZbpyVrfEXBM3QrXXXeimyIzvCs6FJg', // LOCALHOST
                ],
                'scope' => 'identity',    // Necessari per pillar el correu
            ],
        ],
    ];
?>