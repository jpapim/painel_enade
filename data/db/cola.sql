#Windows

mysqldump -u root -B bdpainelenade -p > C:\xampp\htdocs\painel_enade\data\db\script_inicial.sql

mysql -u root -p < C:\xampp\htdocs\painel_enade\data\db\script_inicial.sql



#LINUX

mysqldump -u root -B bdpainelenade -p > /var/www/html/painel_enade/data/db/script_inicial.sql

mysql -u root -p < /var/www/html/painel_enade/data/db/script_inicial.sql


