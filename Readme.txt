1) sudo apt install php-pgsql
2) php 7.2





Common Pitfalls - 
Postgre Cheat seat
 \du - see all user
 \dt see all tables
 \list - see all database



Run php server
sudo php -S localhost:8007


// Create Db and Create new user to access db
CREATE DATABASE yourdbname;
CREATE USER youruser WITH ENCRYPTED PASSWORD 'yourpass';
GRANT ALL PRIVILEGES ON DATABASE yourdbname TO youruser;

Make sure  
local   all             postgres                                md5
in pg_hba file in etc/postgres/main