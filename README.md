## _IT - Progetto php, mySQL_

Si realizzi una versione semplificata di un sito web per gestire un sistema di partecipazione ad attività a numero chiuso (per es. calcio, pallavolo, nuoto, ecc.) proposte da un circolo ricreativo. Per partecipare alle attività è necessaria una prenotazione, la quale può includere un posto per un adulto più eventualmente uno o più posti per i suoi figli (fino ad un massimo di 3). Il sistema deve consentire di gestire le prenotazioni secondo le specifiche di seguito descritte, assumendo le attività già caricate nella base di dati dagli amministratori del sito:
- Tutti coloro che accedono al sito possono vedere, senza alcuna autenticazione o registrazione, la lista delle attività, il numero di posti prenotati fino a quel momento per ciascuna attività e qual è il numero massimo di posti per quell’attività. Le attività sono visualizzate in ordine di maggior disponibilità, che decresce scorrendo la lista.
- Per semplicità, si assuma che le attività non abbiano una data/ora di svolgimento: in altre parole, sarà sempre possibile prenotare per ognuna delle attività, salvo disponibilità. Inoltre, i posti disponibili possono essere utilizzati indifferentemente per prenotare adulti o figli, posto che questi ultimi siano accompagnati.
- Ogni utente può registrarsi liberamente sul sito (fornendo solamente uno username univoco ed una password).
- Un utente autenticato può prenotare un’attività. Nel caso in cui un adulto desideri prenotare un’attività per se stesso e per i suoi figli, la prenotazione del posto per i figli e per l’adulto deve essere contestuale per garantire che essa sia soddisfatta oppure rifiutata nella sua interezza, secondo la disponibilità. Le prenotazioni con un numero maggiore di 3 figli non devono essere accettate. Non è richiesto di inserire il nome o altro identificativo dei figli durante la prenotazione.
- Un utente autenticato deve poter visualizzare, anche in momenti successivi, i dati relativi alla propria prenotazione ed eventualmente disdire la propria prenotazione. La prenotazione, quando disdetta, è annullata nella sua interezza.
- L’autenticazione attraverso username e password deve essere fatta quando richiesta, e rimanere valida se l’utente non ha periodi di inattività superiori a 2 minuti. Se un utente tenta di eseguire un’operazione qualsiasi di quelle che richiedono l’autenticazione dopo che l’inattività è stata superiore a 2 minuti l’operazione non ha effetto e l’utente è costretto a ri-autenticarsi.
- L’aspetto generale delle pagine web è libero, ma deve essere quanto più possibile gradevole alla vista e prevedere link o voci di menu per poter effettuare le varie operazioni. La visualizzazione, anche semplice, deve essere quanto più possibile uniforme al variare del browser utilizzato.

## _Modello Logico_

attivita (<ins>CodA</ins>, NomeA, MaxPosti, PostiPren)<br />
utente (<ins>Username</ins>, Passwd, Cognome, Nome)<br />
prenota (<ins>CodA</ins>, <ins>Username</ins>, Persone)<br />

## _Vincoli d'integritá_

prenota(CodA) REFERENCES attivita(CodA)<br />
prenota(Username) REFERENCES utente(Username)
