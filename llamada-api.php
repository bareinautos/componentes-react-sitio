<?php
    $url = 'https://api-scraping-ml.onrender.com/dataml';
    $response = file_get_contents($url);
    
    if ($response !== false) {
        echo "La respuesta de la API es: " . $response . "\n";
        
        $data = json_decode($response, true);
        
        if (json_last_error() === JSON_ERROR_NONE) {
            echo "Decodificación JSON exitosa\n";
            echo json_encode($data, JSON_PRETTY_PRINT);
            
            // Verificar si el array no está vacío
            if (!empty($data)) {
                file_put_contents('./vehiculos.json', json_encode($data, JSON_PRETTY_PRINT));
                echo "Datos guardados en vehiculos.json\n";
            } else {
                echo "El array de datos está vacío. No se sobrescribo el archivo vehiculos.json.\n";
            }
        } else {
            echo "Error al decodificar JSON: " . json_last_error_msg() . "\n";
        }
    } else {
        error_log('Error al realizar la solicitud a la API.');
    }
?>