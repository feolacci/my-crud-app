# My CRUD application

### :newspaper: Latest news
 - [30/07/2020] Aggiunti nuovi task da completare.

### :rainbow: Getting started
 1. Crea un nuovo database con nome "**my-crud-app**".
 2. Scarica e importa il file [my-crud-app.sql](http://federicopaolacci.com/temp/my-crud-app/my-crud-app.sql) nel database appena creato.
 3. Accedi da terminale alla directory @*DocumentRoot* (es. c:/xampp/htdocs).
 4. Esegui il comando: `$ git clone https://github.com/feolacci/my-crud-app.git`.
 5. Imposta la @*DocumentRoot* sul path della cartella "**my-crud-app**" appena clonata. ([?](http://blog.mdsohelrana.com/2011/11/01/how-to-change-the-document-root-in-xampp-on-windows/))

> :bulb: Accedendo all'indirizzo "http://localhost/" tramite browser sarà possibile visualizzare l'ultima release disponibile dell'applicativo, se invece si desidera accedere alla versione in sviluppo, eseguire da terminale i comandi: `$ git fetch` e `$ git checkout -t origin/development`.

### :two_men_holding_hands: Contributing
> :loudspeaker: Per contribuire al progetto è ovviamente necessario seguire i 5 passaggi sopra elencati e solo successivamente procedere come segue:

 1. Accedi da terminale alla directory "**my-crud-app**" clonata in precedenza.
 2. Esegui il comando: `$ git branch`, se il branch "*master*" è il solo ad essere restituito, lancia: `$ git fetch` e `$ git checkout -t origin/development`; se invece il branch "*development*" è già disponibile, esegui in successione: `$ git checkout development`, `$ git fetch` e `$ git pull` per aggiornarlo.
 3. Crea e spostati su un nuovo branch, per farlo, esegui: `$ git checkout -b TuoUsername-dev` dove "*TuoUsername*" è il tuo username di GitHub.
 4. A questo punto apporta al codice le modifiche desiderate ed esegui: `$ git add .` e `$ git commit -m "Descrizione del commit"`.
 5. Utilizza: `$ git push -u origin TuoUsername-dev` per aggiornare il repository remoto.
 6. Esegui i comandi: `$ git fetch` e `$ git rebase origin/development`.
 7. Con cautela, facendo molta attenzione ai passaggi che seguono, cambia branch utilizzando: `$ git checkout development` e unisci le tue modifiche al branch "*development*", tramite: `$ git merge TuoUsername-dev`.
 8. Se sei assolutamente sicuro di aver fatto tutto nel modo corretto, esegui: `$ git push origin development`.
 9. Per terminare, lancia: `$ git push origin :TuoUsername-dev` (:warning: i due punti sono importanti) e `$ git branch -d TuoUsername-dev` per eliminare il branch.

> :blue_book: Per ulteriori informazioni sul workflow adottato, consultare: [Using Git in a team](https://jameschambers.co/git-team-workflow-cheatsheet/).

### :dart: Tasks to do
 - [x] Aggiungere la pagina "*Index*".
 - [x] Aggiungere la funzionalità "*Crea regione*".
 - [x] Aggiungere la funzionalità "*Modifica regione*".
 - [x] Aggiungere la funzionalità "*Elimina regione*".
 - [x] Aggiungere la funzionalità "*Ricerca regione*".
 - [ ] Rendere le funzionalità "*Crea regione*" e "*Modifica regione*" asincrone.
 - [x] Personalizzare le finestre di dialogo Javascript.
 - [x] Rendere le "*Breadcrumb*" dinamiche.
 - [ ] Migliorare le misure di sicurezza dell'applicativo.
 - [ ] Implementare un sistema di autenticazione.