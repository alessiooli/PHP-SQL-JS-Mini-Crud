<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crud con Ajax</title>
    <script src="script.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/purecss@3.0.0/build/pure-min.css" integrity="sha384-X38yfunGUhNzHpBaEBsWLO+A0HDYOQi8ufWDkZ0k9e0eXz/tH3II7uKZ9msv++Ls" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <h1>The Smallest Crud in the World</h1>
    <h2>Made in Javascript, PHP, SQL</h2>
    <button id="nuova-riga" class="pure-button pure-button-primary">Inserisci Persona</button>
    <div id="div-inserisci-persona" style="display: none;">
        <h2>Inserisci una nuova persona nel Database</h2>
        <form id="form-inserisci-persona" class="pure-form"> <!-- Poiché gestisco la richiesta tramite JS non servono form action e method  -->
            <label for="nome">Nome</label><br>
            <input type="text" id="nome" name="nome" required><br>
            <label for="cognome">Cognome</label><br>
            <input type="text" id="cognome" name="cognome" required><br>
            <label for="email">Email</label><br>
            <input type="email" id="email" name="email" required><br>
            <input type="submit" value="Submit">
        </form>
    </div>
    <div id="tabella-container"></div>
    <button id="carica-altri" class="pure-button pure-button-primary">Carica altri risultati</button>
    <div id="div-modifica-persona" style="display: none;">
        <h2>Modifica una persona nel Database</h2>
        <form id="form-modifica-persona" class="pure-form">
            <label for="nome">Nome</label><br>
            <input type="text" id="nomeMod" name="nomeMod" required><br>
            <label for="cognome">Cognome</label><br>
            <input type="text" id="cognomeMod" name="cognomeMod" required><br>
            <label for="email">Email</label><br>
            <input type="email" id="emailMod" name="emailMod" required><br>
            <input type="submit" value="Submit">
        </form>
    </div>
    <div id="dialog-container">
        <dialog>
            <p>Campo correttamente modificato.</p>
            <button autofocus id="close-dialog">Chiudi</button>
        </dialog>
    </div>
</body>

</html>