# Faculty-Portal

The portal can be used in 2 kinds of modes: Admin and User.

| Collaborators |
| :--- |
|Jeetu Kumar|
| [Yogesh Chhabra](https://github.com/yogeshchhabra99) |


## Admin Operations:
1. Create New Users(Faculties).
2. Delete Users
3. View Logs
4. Modify Leave Routes(explained further later)
5. Create/Delete secondary Admins with limited power on portal.
6. Change HODs or other positions like Faculty Advisors or Assistant Faculty Advisors.
7. View User Activities.
8. Grant new leaves to users on new year.

## User Operations:
1. Manage his/her profile.
2. Take Leave.
3. comment/approve/reject on any leave applications that are forwarded to him/her.(for HOD/FAs).

## Things Managed by portal:
1. Manage Leaves for different Faculties.
2. Send the Leave Application to the proper person in the heirarchy.

## Technologies used:
* PHP7.2
* PosgreSql
* MongoDB
* HTML 
* CSS
* BOOTSTRAP
* AJAX

### Postgre Cheat seat
```)
 \du - see all user
 \dt see all tables
 \list - see all database 
```
### Run php server
>`$ php -S localhost:8080`

This creates a local server on port 8080 in the folder where terminal was in.


### Setting up project

* Make sure  that in the file in pg_hba file in etc/postgres/main 
  local   all             postgres                                md5    
* Make sure mongodb is setup and running(use `$ sudo mongod` to run)


```
// Create Db and Create new user to access db

CREATE DATABASE yourdbname;   
ALTER ROLE myprojectuser SET client_encoding TO 'utf8';  
ALTER ROLE myprojectuser SET default_transaction_isolation TO 'read committed';  
ALTER ROLE myprojectuser SET timezone TO 'UTC';  
CREATE USER youruser WITH ENCRYPTED PASSWORD 'yourpass'; 
GRANT ALL PRIVILEGES ON DATABASE yourdbname TO youruser;  
```
Then pass statements in `schema.pgsql` to create tables (use `\i` command to load external files) 


### TODO : 
* Before submitting application check overlap with existing in pending / Approved
* On approval : change app parameters , add data to approved leaves table (No need), deduce leave days, deduce next years leaved days 
* Form safety : Make sure user does not enter sql command in form 
Hande Errors




