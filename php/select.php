<?php

require_once('config.php');

$count = json_decode(file_get_contents('php://input'))->count;
// $sqlCount = "SELECT COUNT(*) as total FROM anagrafica";
// $resultCount = $connessione->query($sqlCount);
// $rowCount = $resultCount->fetch_assoc();
// $totalCount = $rowCount['total'];

$sql = "SELECT * FROM anagrafica LIMIT $count, 200";

if ($result = $connessione->query($sql)) {
    if ($result->num_rows > 0) {
        $data = [];
        while ($row = $result->fetch_array(MYSQLI_ASSOC)) {
            $tmp;
            $tmp['id'] = $row['id'];
            $tmp['codice'] = $row['codice'];
            $tmp['data_consegna'] = $row['data_consegna'];
            $tmp['qualifica'] = $row['qualifica'];
            $tmp['nazionalita'] = $row['nazionalita'];
            $tmp['cognome'] = $row['cognome'];
            $tmp['nome'] = $row['nome'];
            $tmp['sesso'] = $row['sesso'];
            $tmp['telefono'] = $row['telefono'];
            $tmp['citta'] = $row['citta'];
            $tmp['provincia'] = $row['provincia'];
            $tmp['cap'] = $row['cap'];
            $tmp['coordinate'] = $row['coordinate'];
            $tmp['zona'] = $row['zona'];
            $tmp['asl'] = $row['asl'];
            $tmp['municipi_distretti_roma'] = $row['municipi_distretti_roma'];
            $tmp['email'] = $row['email'];
            $tmp['patente'] = $row['patente'];
            $tmp['data_colloquio_contatto'] = $row['data_colloquio_contatto'];
            $tmp['offerta_assistenza'] = $row['offerta_assistenza'];
            $tmp['tipo_collaborazione'] = $row['tipo_collaborazione'];
            $tmp['commenti'] = $row['commenti'];
            array_push($data, $tmp);
        }
        echo json_encode($data); // trasformiamo l'array data in un json e lo visualizziamo a schermo
    } else {
        echo json_encode(array("message" => "Non ci sono più risultati da mostrare."));
        // echo json_encode($data);
    }
} else {
    echo json_encode(array("error" => "Errore nell'esecuzione di $sql. " . $connessione->connect_error));
}
