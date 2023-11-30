<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crud con Ajax</title>
    <!-- Crud con Ajax
        - preparare tabella html ✅
        - creare file config.php ✅
        - creare file select.php ✅
        - creare container ✅
        - fare il fetch per dati ✅
        - creare dinamicamente la tabella ✅
        - aggiungere tasto nuova riga, modifica e elimina riga ✅
        - creare file insert, update, delete ✅
        - creare fetch insert, update, delete ✅
        - aggiornare tabella ✅

        DA FARE DA SOLO
        - form per inserire una persona ✅
            - selezionare il form con queryselector ✅
            - e.preventDefault() ✅
            - nuova istanza formData, in cui passiamo il form selezionato al punto 1) ✅
            - fetch ✅
        - implementare form reset ✅
        - nascondere il form finché non si clicca sul pulsante inserisci persona ✅
        - Se due volte su modificapersona mi inserisce di nuovo i dati della persona da modificare senza eliminare la precedente tabella ✅
        - esportare tutto il codice JS in un altro file ✅
        - $sql = "UPDATE persone SET email='$email' WHERE id = $id"; aggiornare lo statement sequel perché sta settando solo la email ✅
        - fare in modo che la tabella modifica compaia solo dopo aver cliccato su uno dei pulsanti modifica ✅
        - timer per il dialog ✅
        - dargli un minimo di stile con tailwind.css (meglio) o bootstrap ✅
        
        Possibilità di miglioramento
        - implementare un minimo di validazione dei campi del form
        - fare una repo su github
        - implementare full textsearch 
            - https://dev.mysql.com/doc/refman/8.0/en/fulltext-boolean.html
            - https://packagist.org/packages/teamtnt/tntsearch

    -->
    <script src="script.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/purecss@3.0.0/build/pure-min.css" integrity="sha384-X38yfunGUhNzHpBaEBsWLO+A0HDYOQi8ufWDkZ0k9e0eXz/tH3II7uKZ9msv++Ls" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <h1>The Smallest Crud in the World</h1>
    <h2>Made in Javascript, PHP, SQL</h2>
    <button id="nuova-riga" class="pure-button pure-button-primary">Inserisci Persona</button>
    <div id="tabella-container"></div>
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