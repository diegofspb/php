<!DOCTYPE html>
<html>
<head>
    <title>Leitura de Arquivo CSV</title>
</head>
<body>
    <h1>Geolocalização - .CSV</h1>
    <?php
    // Verifica se o arquivo existe na pasta
    $arquivo_csv = 'Records_simplified.csv';
    if (file_exists($arquivo_csv)) {
        // Lê o arquivo CSV
        $linhas = file($arquivo_csv);
        // Processar o arquivo .csv aqui
        // Exemplo: exibir o conteúdo do arquivo
        // Variável de controle para pular a primeira linha
        $primeira_linha = true;
        foreach ($linhas as $key => $linha) {
            // Pula a primeira linha
            if ($primeira_linha) {
                $primeira_linha = false;
                continue;
            }                
            $campos = str_getcsv($linha);
            $data = new DateTime($campos[0]);
            $data_formatada = $data->format('d/m/Y');
            $hora_formatada = $data->format('H:i:s');
            if($data_formatada == "08/11/2022"){    //data do Homicídio   
                if(isset($campos[2])){
                    // Convertendo a $hora_formatada em um objeto DateTime
                    $UTC = DateTime::createFromFormat('H:i:s', $hora_formatada);        
                    // Subtraia 3 horas usando DateInterval
                    $intervalo = new DateInterval('PT3H'); // PT significa "Período de Tempo" e 3H significa 3 horas 
                    $UTC->sub($intervalo); //sub é a diminuição das horas do $intervalor = 3 horas em relação ao $UTC        
                    // Agora, $data contém a hora com 3 horas a menos
                    $hora_formatada_menos_3_horas = $UTC->format('H:i:s');
                    if ($hora_formatada_menos_3_horas >= "00:00:00" and $hora_formatada_menos_3_horas <= "09:30:00") { //exibe apenas o limite de tempo especifico
                        echo "Data = " . $data_formatada . " <br>";  
                        echo "Hora = " . $hora_formatada_menos_3_horas ." <br>"; 
                        // Construir a URL do Google Maps com as coordenadas de latitude e longitude
                        $url_google_maps = "https://www.google.com/maps/search/?api=1&query={$campos[2]},{$campos[3]}";    
                        // Exibir o link                
                        echo "  Latitude = " . $campos[2] . "<br>";
                        echo "  Longitude = " . $campos[3] . "<br>";    
                        echo "  Conexão = " . $campos[5] . "<br>"; 
                        echo "<a href='{$url_google_maps}' target='_blank'>Ver Localização no Google Maps</a><br><br>";              
                    }
                }            
            }
        }
    } else {
        echo "O arquivo não foi encontrado.";
    }
    ?>
</body>
</html>
