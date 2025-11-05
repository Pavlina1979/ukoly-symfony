# Jednoduchý plánovač úkolý napsaný v Symfony

## Postup instalace:

1. naklonovat repozirář
2. composer install
3. editace .env souboru a změna údajů pro připojení se k databázi na řádku 34 (v případě, že používáte MaruškuDB, což Jste myslím říkal, že používáte)
4. tvorba databaze - php bin/console doctrine:database:create
5. tvorba tabulky úkol v databázi - php bin/console doctrine:schema:create
6. můžete vložit dva předpřipravené úkoly do databáze - php bin/console doctrine:fixtures:load
7. spuštění lokálního serveru s adresářem public jakožto rootem: php -S localhost:8000 -t public/