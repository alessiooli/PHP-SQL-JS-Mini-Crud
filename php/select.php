<?php

require_once('config.php');

$sql = 'SELECT * FROM persone';

if ($result = $connessione->query($sql)) {
    if ($result->num_rows > 0) {
        $data = [];
        while ($row = $result->fetch_array(MYSQLI_ASSOC)) {
            $tmp;
            $tmp['id'] = $row['id'];
            $tmp['nome'] = $row['nome'];
            $tmp['cognome'] = $row['cognome'];
            $tmp['email'] = $row['email'];
            array_push($data, $tmp);
        }
        echo json_encode($data); // trasformiamo l'array data in un json e lo visualizziamo a schermo
    } else {
        echo 'Non ci sono righe disponibili';
        echo json_encode($data);
    }
} else {
    echo "Errore nell'esecuzione di $sql. " . $connessione->connect_error;
}
