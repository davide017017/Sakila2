[![License: MIT](https://img.shields.io/badge/License-MIT-yellow.svg)](https://opensource.org/licenses/MIT)
[![Made with PHP](https://img.shields.io/badge/Made%20with-PHP-blueviolet.svg)](https://www.php.net/)
[![Powered by MySQL](https://img.shields.io/badge/Powered%20by-MySQL-blue.svg)](https://www.mysql.com/)

# 🎬 Interfaccia di Gestione Database Sakila

**Una semplice interfaccia web sviluppata in PHP per interagire con il database Sakila, permettendo la visualizzazione, l'aggiunta e l'eliminazione di dati dalle tabelle 'actor' e 'film'.**

![Screenshot della Todo List App](public\sakila-2-screenshot.JPG)

## ✨ Panoramica

Questa applicazione web è stata sviluppata utilizzando PHP per fornire un'interfaccia di base per la gestione di un database Sakila. Attualmente supporta la visualizzazione di dati dalle tabelle `actor` e `film`, oltre alla possibilità di aggiungere nuovi record ed eliminare quelli esistenti. La configurazione del database viene gestita tramite variabili d'ambiente per una maggiore flessibilità e sicurezza.

## 🚀 Funzionalità Principali

* **Visualizzazione di Tabelle:** Permette di visualizzare i dati delle tabelle `actor` e `film`, con opzioni per limitare il numero di risultati e ordinare i dati.
* **Aggiunta di Record:** Funzionalità per aggiungere nuovi attori (nome e cognome) e nuovi film (titolo, anno di rilascio, tariffa di noleggio e descrizione) al database.
* **Eliminazione di Record:** Possibilità di eliminare attori e film specificando il loro ID.
* **Gestione della Connessione:** La connessione al database MySQL è gestita tramite PDO e configurata attraverso variabili d'ambiente.
* **Configurazione tramite .env:** Le credenziali del database (host, porta, nome database, utente, password) sono caricate da un file `.env` per una gestione più sicura.

## 🛠️ Tecnologie Utilizzate

* **Backend:**
    * **[PHP](https://www.php.net/)**: Linguaggio di scripting lato server utilizzato per la logica dell'applicazione.
    * **[MySQL](https://www.mysql.com/)**: Sistema di gestione di database relazionale.
    * **[PDO (PHP Data Objects)](https://www.php.net/manual/it/book.pdo.php)**: Estensione per l'accesso al database.
    * **File .env**: Per la gestione delle variabili d'ambiente.

## ⚙️ Installazione e Utilizzo (Sviluppo Locale)

Se desideri eseguire l'applicazione in locale per sviluppo o test:

1.  **Clona il repository:**
    ```bash
    git clone [https://github.com/OpenScienceMOOC/Module-5-Open-Research-Software-and-Open-Source/blob/master/content_development/Task_1.md](https://github.com/OpenScienceMOOC/Module-5-Open-Research-Software-and-Open-Source/blob/master/content_development/Task_1.md)
    cd [nome della cartella del repository]
    ```

2.  **Crea un file `.env`:**
    Nella directory principale del progetto, crea un file chiamato `.env` e aggiungi le tue credenziali del database. Dovrebbe assomigliare a questo:
    ```
    DB_HOST=localhost
    DB_PORT=3306
    DB_DATABASE=nome_del_tuo_database_sakila
    DB_USERNAME=tuo_utente_mysql
    DB_PASSWORD=tua_password_mysql
    ```
    **Ricorda di sostituire i valori di esempio con le tue credenziali reali.**

3.  **Configura il web server:**
    Assicurati di avere un web server (come Apache o Nginx) configurato per servire i file PHP dalla directory del tuo progetto.

4.  **Accedi all'applicazione:**
    Apri il tuo browser web e naviga all'URL dove il tuo web server sta servendo l'applicazione (solitamente `http://localhost/nome_della_cartella_del_progetto/` o simile, a seconda della tua configurazione).

## 📜 Licenza

Questo progetto è distribuito sotto la [Licenza MIT](LICENSE). 
Puoi trovare il testo completo della licenza nel file `LICENSE` presente nel repository.

## 🧑‍💻 Autore

[davide017017 - Davide Martinco] - [[Link al tuo profilo GitHub o Portfolio ](https://github.com/davide017017)]

**Realizzato con ❤️ e PHP**