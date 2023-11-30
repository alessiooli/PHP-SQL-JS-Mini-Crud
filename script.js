window.addEventListener("DOMContentLoaded", (e) => {
  // inserimento con fetch senza ricaricare la pagina
  const formInsert = document.querySelector("#form-inserisci-persona");

  // possiamo spostare tutto in una funzione (o una classe) e creare un metodo che si occupa dell'inserimento
  formInsert.addEventListener("submit", (e) => {
    e.preventDefault();
    const formData = new FormData(formInsert);
    // loopiamo nell'array per stampare i campi. Item[0] è la chiave e item[1] è il valore, rispettivamente per ogni campo
    for (item of formData) {
      console.log(item[0], item[1]);
    }
    // inviamo i dati del form al server
    fetch("./php/insert.php", {
      method: "POST",
      body: formData,
    })
      .then((response) => response.json())
      .then((response) => {
        console.log(response);
        aggiornaTabella();
      })
      .catch((error) => {
        console.error("Errore: ", error);
      });

    formInsert.reset();
  });

  let persone;
  let tabellaContainer = document.querySelector("#tabella-container");
  let inserisciBtn = document.querySelector("#nuova-riga");

  function toggleTabellaModifica() {
    const containerModificaPersona = document.getElementById(
      "div-modifica-persona"
    );
    if (containerModificaPersona.style.display === "none") {
      containerModificaPersona.style.display = "block";
    } else {
      containerModificaPersona.style.display = "none";
    }
  }

  generaTabella();

  function generaTabella() {
    fetch("./php/select.php", {
      // fetch del file che eseguirà la query con i dati
      method: "POST",
      headers: {
        "Content-Type": "application/json",
      },
    })
      .then((response) => response.json()) // parsiamo il testo della promise, da json a oggetto javascript
      .then((data) => {
        persone = data;
        console.log("Dati ricevuti: ", data);
        let tabella = `
                <table id="tabella-record" class="pure-table pure-table-bordered">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Nome</th>
                            <th>Cognome</th>
                            <th>Email</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        ${generaRighe(data)}
                    </tbody>
                </table>
                `;
        tabellaContainer.insertAdjacentHTML("beforeend", tabella);
        let modificaBottoni = document.querySelectorAll(".modifica-persona");
        let eliminaBottoni = document.querySelectorAll(".elimina-persona");

        for (let i = 0; i < modificaBottoni.length; i++) {
          modificaBottoni[i].addEventListener("click", modificaPersona);

          modificaBottoni.forEach((button) => {
            button.addEventListener("click", toggleTabellaModifica);
          });
        }

        for (let i = 0; i < eliminaBottoni.length; i++) {
          eliminaBottoni[i].addEventListener("click", eliminaPersona);
        }
      })
      .catch((error) => {
        console.error("Errore: ", error);
      });
  }

  function generaRighe(persone) {
    let righe = "";
    persone.forEach((persona) => {
      let riga = `
                <tr>
                    <td>${persona.id}</td>
                    <td>${persona.nome}</td>
                    <td>${persona.cognome}</td>
                    <td>${persona.email}</td>
                    <td>
                        <button class="modifica-persona pure-button" data-val="${persona.id}">Modifica</button>
                        <button class="elimina-persona pure-button" data-val="${persona.id}">Elimina</button>
                    </td>
                </tr>
                `;

      righe += riga;
    });
    return righe;
  }

  /**
   * Nascondi/mostra la tabella quando clicchi sul pulsante inserisci persona
   */

  const containerInserisciPersona = document.querySelector(
    "#div-inserisci-persona"
  );
  inserisciBtn.addEventListener("click", attivaTabella);

  function attivaTabella() {
    if (containerInserisciPersona.style.display === "none") {
      containerInserisciPersona.style.display = "block";
      inserisciBtn.innerHTML = "Chiudi";
    } else {
      containerInserisciPersona.style.display = "none";
      inserisciBtn.innerHTML = "Inserisci Persona";
    }
  }

  // passiamo 'e' perché sono eventi
  function modificaPersona(e) {
    let id = e.target.getAttribute("data-val");
    console.log(id);
    /**
     * ATTENZIONE:
     * siccome persone è un'array di oggetti,
     * per trovare una specifica persona dal suo id devo usare il metodo find sull'array persone
     */
    let persona = persone.find((persona) => persona.id === id);
    console.log("Ecco la persona selezionata", persona);
    console.log("Modifico persona numero: ", persona.id);
    let formDiModifica = document.getElementById("form-modifica-persona");
    let tabElemEsiste = document.querySelector(".tab-elementi-in-modifica");
    if (tabElemEsiste) {
      tabElemEsiste.remove();
    }
    let tabElemMod = `
                <div class="tab-elementi-in-modifica">Dati dell'elemento che stai modificando:
                    <div class="backg-red">ID numero: ${persona.id}</div>
                    <div class="backg-red">Nome: ${persona.nome}</div>
                    <div class="backg-red">Cognome: ${persona.cognome}</div>
                    <div class="backg-red">Email: ${persona.email}</div>
                </div>
            `;
    formDiModifica.insertAdjacentHTML("beforebegin", tabElemMod);
    // Riempio gli input del form con i valori che poi andremo a modificare così da poter essere visualizzati dall'utente sul form
    document.getElementById("nomeMod").value = persona.nome;
    document.getElementById("cognomeMod").value = persona.cognome;
    document.getElementById("emailMod").value = persona.email;
    // ------------------------------------------------------

    /**
     * you're adding a 'submit' event listener to formDiModifica
     *  every time a modification button is clicked.
     * This means that if you click the modification button twice,
     * two 'submit' event listeners will be added, and the code inside will run twice when the form is submitted.
     *
     * To fix this, you should remove any existing 'submit' event listeners
     * from formDiModifica before adding a new one. However,
     * JavaScript doesn't provide a straightforward way to remove all event listeners from an element.
     * One workaround is to replace the element with a clone of itself, which will have the same properties but no event listeners.
     */
    let formDiModificaClone = formDiModifica.cloneNode(true);
    formDiModifica.parentNode.replaceChild(formDiModificaClone, formDiModifica);
    formDiModifica = formDiModificaClone;
    // ------------------------------------------
    formDiModifica.addEventListener("submit", (e) => {
      e.preventDefault();
      /**
       * The FormData object does not provide
       * a built-in method to insert a value at the beginning.
       * The append method always adds the new value at the end.
       * However, you can create a new FormData object and add the id first,
       * then iterate over the original FormData object and add the remaining values to the new object.
       */
      const originalFormData = new FormData(formDiModifica);
      const formData = new FormData();
      formData.append("id", id);
      for (let pair of originalFormData.entries()) {
        formData.append(pair[0], pair[1]);
      }

      fetch("./php/update.php", {
        method: "POST",
        body: formData,
      })
        .then((response) => response.json())
        .then((data) => {
          console.log(data);
          aggiornaTabella();
        })
        .catch((error) => {
          console.error("Errore: ", error);
        });
      formDiModifica.reset();
      dialogAvvenutaModifica();
      toggleTabellaModifica();
      setTimeout(() => {
        dialog.close(); // necessario inserirla in una funzione anonima altrimenti viene invocata immediatamente
      }, 5000);
    });
  }

  function eliminaPersona(e) {
    let id = e.target.getAttribute("data-val");
    console.log("Elimino persona: ", id);
    const formDataDelete = new FormData();
    formDataDelete.append("id", id);

    fetch("./php/delete.php", {
      method: "POST",
      body: formDataDelete,
    })
      .then((response) => response.json())
      .then((data) => {
        console.log(data);
        aggiornaTabella();
      })
      .catch((error) => {
        console.error("Errore: ", error);
      });
  }

  function aggiornaTabella() {
    let tabella = document.querySelector("#tabella-record");
    if (tabella) {
      tabellaContainer.removeChild(tabella);
    }
    generaTabella();
  }

  const dialog = document.querySelector("dialog");
  const closeButton = document.querySelector("#close-dialog");
  const eliminaTabMod = document.querySelector(".tab-elementi-in-modifica");

  function dialogAvvenutaModifica() {
    dialog.show();
    closeButton.addEventListener("click", () => {
      dialog.close();
      eliminaTabMod.remove();
    });
  }
});
