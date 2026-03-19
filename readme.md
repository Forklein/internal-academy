# Internal Academy – Code Challenge

Progetto realizzato con Laravel ed Inertia.js

---

## Funzionalità

### Autenticazione e Ruoli

-Sistema di login
-Due ruoli distinti:

  -Admin
  -Employee

---

### Gestione Workshop (Admin)

-Creazione workshop
-Modifica workshop
-Eliminazione workshop

Ogni workshop include:

-Titolo
-Descrizione
-Data e ora
-Capacità massima

---

### Iscrizione Workshop (Employee)

-Visualizzazione lista workshop
-Iscrizione a un workshop (se ci sono posti disponibili)
-Disiscrizione

---

### Logica applicativa

-Non è possibile iscriversi due volte allo stesso workshop
-Non è possibile superare la capacità massima
-La UI cambia in base al ruolo dell’utente
-Le rotte sensibili sono protette tramite middleware

---

## Credenziali di accesso

### Admin

-Email: [admin@forklein.com](mailto:admin@forklein.com)
-Password: password

### Employee

-Email: [employee@forklein.com](mailto:employee@forklein.com)
-Password: password

---

## Installazione

-Intallare le dipendenze con composer install e npm install
-Configurare il database nel file `.env`:
-Generare chiave applicativa con php artisan key:generate
-Eseguire le migrazioni con php artisan migrate
-Eseguire seeder: prima --class=RoleSeeder e poi --class=DatabaseSeeder con gli appositi comandi
-Eseguire l'applicazione con php artisan serve ed npm run dev

## Note

-La capacità del workshop non viene modificata: i posti disponibili vengono calcolati dinamicamente
-L’interfaccia si adatta in base al ruolo dell’utente
-È stata seguita una struttura RESTful