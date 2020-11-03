Testovaci ukol pro Porta - 11/2020

Na uvodnej stranke je jednoduchy formular na zadanie emailu pre 
ulozenie do database, pricom je tam pridana jednoducha ochrana proti spambotom,
vo forme jednoduchej otazky, ktora verifikuje ci sa jedna o osobu.
V pripade ze sa email uspesne ulozi, je na to uzivatel upozorneny.
Ak sa vsak uz dany email v databaze nachadza, email sa neulozi a taktiez
je na to uzivatel upozorneny. 

Stlacenim "Take me to the admin page" prejdeme na "administratitvnu stranku",
kde mozme vidiet vypis vsetkych emailov v databazi, pricom mozme vidiet
ID zaznamu, cas a datum kedy bol email pridany do databazi a IP z ktorej bol poslany request.
Kazdy zaznam je mozne zmazat, pricom uzivatel zase dostane upoznornenie ze 
zaznam bol zmazany. Ak sa vsak zavola zmazanie na neexistujuci zaznam, respektive,
neexistujuce ID, je na to uzivatel taktiez upozorneny.
Taktiez je moznost exportovat emaily ako CSV tlacidlom "Export".

Postup na deploy pre Windows:
1. mat nainstalovane PHP, MySQL a Symfony a spravne ich nakonfigurovat
2. beziaci mySQL server
3. naklonovat si repozitor
4. v projektovom subore .env zmenit DATABASE_URL premennu na 
DATABASE_URL=mysql://loginNaVasServerMySQL:hesloNaVasLoginMySQL@ipVashoMysqlServeru:portNaPripojenie/menoDatabazy
Pre meno databazy odporucam nieco ako porta_test
5. v adresari s projektom pouzit cez prikazovy riadok "composer install"
6. az to skonci, prikaz "php bin/console doctrine:database:create" vytvorite databazu na serveri
7. nasledne prikaz "php bin/console doctrine:migrations:migrate" vytvori relevantnu tabulku
8. symfony check:requirements spusti aplikaciu
