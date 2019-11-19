# Faculty-Portal

The portal can be used in 2 kinds of modes: Admin and User.

## Admin Operations:
1.)Create New Users(Faculties).<br>
2.)Delete Users<br>
3.)View Logs<br>
4.)Modify Leave Routes(explained further later)<br>
5.)Create/Delete secondary Admins with limited power on portal.<br>
6.)Change HODs or other positions like Faculty Advisors or Assistant Faculty Advisors.<br>
7.)View User Activities.<br>
8.)Grant new leaves to users on new year.<br>

## User Operations:
1.)Manage his/her profile.<br>
2.)Take Leave.<br>
3.)comment/approve/reject on any leave applications that are forwarded to him/her.(for HOD/FAs).<br>

## Things Managed by portal:
1.)Manage Leaves for different Faculties.<br>
2.)Send the Leave Application to the proper person in the heirarchy.<br>

## Technologies used:
PHP7.2,PosgreSql,MongoDB,HTML,CSS,BOOTSTRAP,AJAX

### Postgre Cheat seat
 \du - see all user<br>
 \dt see all tables<br>
 \list - see all database<br>

### Run php server
pass in terminal $ php -S localhost:8080<br>   
This creates a local server on port 8080 in the folder where terminal was in.<br>


### Setting up project
Make sure  that in the file in pg_hba file in etc/postgres/main    <br>
local   all             postgres                                md5     <br>
Make sure mongodb is setup and running(use '$ sudo mongod' to run)   <br>

// Create Db and Create new user to access db  <br>
CREATE DATABASE yourdbname;   <br>
ALTER ROLE myprojectuser SET client_encoding TO 'utf8';  <br>
ALTER ROLE myprojectuser SET default_transaction_isolation TO 'read committed';  <br>
ALTER ROLE myprojectuser SET timezone TO 'UTC';  <br>
CREATE USER youruser WITH ENCRYPTED PASSWORD 'yourpass'; <br>
GRANT ALL PRIVILEGES ON DATABASE yourdbname TO youruser;  <br>

Then pass statements in schema.pgsql to create tables (use \i command to load external files) <br>


### TODO : before submitting application check overlap with existing in pending / Approved
ON approval : change app parameters , add data to approved leaves table (No need), deduce leave days, deduce next years leaved days <br>
Form safety : Make sure user does not enter sql command in form <br>
Hande Errors




