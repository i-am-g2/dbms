1) sudo apt install php-pgsql
2) php 7.2


TechStack:
PHP,PosgreSql,MongoDB,HTML,CSS,BOOTSTRAP,AJAX


Common Pitfalls - 
Postgre Cheat seat
 \du - see all user
 \dt see all tables
 \list - see all database



Run php server
sudo php -S localhost:8007


// Create Db and Create new user to access db
CREATE DATABASE yourdbname;
ALTER ROLE myprojectuser SET client_encoding TO 'utf8';
ALTER ROLE myprojectuser SET default_transaction_isolation TO 'read committed';
ALTER ROLE myprojectuser SET timezone TO 'UTC';
CREATE USER youruser WITH ENCRYPTED PASSWORD 'yourpass';
GRANT ALL PRIVILEGES ON DATABASE yourdbname TO youruser;

Make sure  
local   all             postgres                                md5
in pg_hba file in etc/postgres/main


==========================================
Personal Profile schema(to be implemented using mongodb):
Info:
{} means object,
[] means array
string means one liner text,
text/string means more than one line, although saved similarly, but to help during gui

Schema:
UserId(Primarykey): string,
Name: string,
Position: string,
Lab: string,
Headline: string,
EmailId: string,
Linkedin_Link: string/url,
Google_Scholar:link,
Latest_News: [{
		Headline:text/string,
		Link: text/string
	}]
Note: text/string,
About_Me: text,
Research_Interests: [string],
Collaboration(note regarding it): text/string,
Teaching_Interest: [text/string],
Projects: [{
		Title: string,
		Link: string,
		Description:text/string,
		Time_Begin: date/time,
		Time_End(if currently doing then null):date/time,		
	}]
Research_Outputs:{
		Conference_Papers:[{
			Paper_Title:string,
			Conference_Title:string,
			Time:date/time,
			Link:string/url,
			Description:text/string,
			Citations:integer,			
		}],
		Articles:[{
			Title:string,
			Conference_Title:string,
			Time:date/time,
			Link:string/url,
			Description:text/string,		
		}],
		Others:[{
			Title:string,
			Time:date/time,
			Link:string/url,
			Description:text/string,	
		}]
},
Prizes: [{
	Title:string,
	time:date/time
}],
Other_Links: [string/url]

Please note the following:
1.)Actually there is no schema in mongoDB but we need to define some schema to be used by the frontend, the frontend will query for a employee, then look for all the values as described by the above schema, it's not necessary all the value are there for an employee, the frontend will display the values it receives.
2.) As mongoDB allows us to store arrays, we can store as many stuff an employee wants to store in a particular category, for e.g. projects, whereas if we were using sql, we would not have been able to do this so easily, we can do it then by creating another table for projects and adding foreign key employee ID, but this would take longer time as when we want to get projects for a particular employee, we would be required to query the whole projects table. 


==========================================================
There is an Admin table, there can be a few admins with one main admin, and other admins, main admin has all the access to everything, he creates/deletes other admins including log tables. Other admins can only add/remove new faculties. This is also logged in an Admin operation DB.
Admin Table Schema:
Username(Primary Key),Password,{Power(int)=2;for main,1 for other}

CREATE TABLE Admins(
Username        VARCHAR(50) NOT NULL PRIMARY KEY
,Password         VARCHAR(1000) NOT NULL
,Power      INTEGER NOT NULL
);
Power=2; Main admin that can create other admins, restore backups and everything
Power=1; can only add users, modify application paths

// Already Created
CREATE TABLE credentials(
username        VARCHAR(50) NOT NULL PRIMARY KEY
,Password         VARCHAR(1000) NOT NULL
);

CREATE TABLE Faculty_Pos(
username        VARCHAR(50) NOT NULL PRIMARY KEY,
dept         VARCHAR(10) NOT NULL,
Position		VARCHAR(10) NOT NULL
);
values for dept: CSE, ME, EE (case sensitive)
//old values for position: Director,Faculty,HOD,DFA,ADFA    (case sensitive)
This makes update route function and its trigger as well as getrouteusername function very inefficient
//new values for position: Director,Faculty,CSE_HOD,ME_HOD,EE_HOD,DFA,ADFA
//now i have to check while updating hod but this updateHOD function is used rarely is a very

CREATE TABLE routes(
from_ 	VARCHAR(50) NOT NULL PRIMARY KEY,
to_ 		VARCHAR(50) NOT NULL
);
values allowed: Approved, CSE_FAC,CSE_HOD, EE_FAC, EE_HOD, ME_HOD, ME_FAC, Director, DFA, ADFA;

CREATE TABLE admin_logs{
	admin_username	VARCHAR(50) NOT NULL,
	log_	VARCHAR(200) NOT NULL,
	time		TIMESTAMPTZ DEFAULT CURRENT_TIMESTAMP
}

-----------------------------------

TODO : before submitting application check overlap with existing in pending / Approved
ON approval : change app parameters , add data to approved leaves table (No need), deduce leave days, deduce next years leaved days 
Form safety : Make sure user does not enter sql command in form 
Hande Errors
-----------------------------------
















