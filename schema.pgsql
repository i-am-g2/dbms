CREATE TABLE credentials(
	username varchar(50) not NULL PRIMARY KEY,
	password varchar(1000)
);
CREATE SEQUENCE application_id_seq;
CREATE TABLE applications(
	id INTEGER PRIMARY KEY DEFAULT nextval('application_id_seq'),
	username VARCHAR(50) not null,  
	start_date date not null,
	end_date date not null,
	description text,
	status varchar(5) not null,
	curr_holder varchar(50),
	days_borrowed int not null ,
	FOREIGN key (username) REFERENCES credentials(username)
);

-- Make sure to fill this table on User Creation
-- and Delete too
CREATE Table remaining_leaves (
	username varchar(50) not null,
	yearId INTEGER not null,
	daysleft integer not null,
	FOREIGN KEY (username) REFERENCES credentials(username) 
);

INSERT into remaining_leaves(username, yearId, daysleft) VALUES('jeetu',0,20);
-- Default values
Insert into credentials (username, password) values('jeetu','$2y$10$U9JqjksX6fvAcyrRGb3DI.U7Evical8rOB8OSWHc1fMUx5KVALDGK');

CREATE Table comments (
	app_id INT not null,
	username varchar(50) not null,
	created_at timestamp  not null Default NOW(),
	text_ text not null,
	FOREIGN KEY (username) REFERENCES credentials(username),
	FOREIGN KEY (app_id) REFERENCES applications(id) 
);


CREATE TABLE Admins(
Username        VARCHAR(50) NOT NULL PRIMARY KEY
,Password         VARCHAR(1000) NOT NULL
,Power      INTEGER NOT NULL
);
-- Power=2; Main admin that can create other admins, restore backups and everything
-- Power=1; can only add users, modify application paths

CREATE TABLE Faculty_Pos(
username        VARCHAR(50) NOT NULL PRIMARY KEY,
dept         VARCHAR(10) NOT NULL,
Position		VARCHAR(10) NOT NULL
);

-- values for dept: CSE, ME, EE (case sensitive)
-- //old values for position: Director,Faculty,HOD,DFA,ADFA    (case sensitive)
-- This makes update route function and its trigger as well as getrouteusername function very inefficient
-- //new values for position: Director,Faculty,CSE_HOD,ME_HOD,EE_HOD,DFA,ADFA
-- //now i have to check while updating hod but this updateHOD function is used rarely is a very

CREATE TABLE routes(
from_ 	VARCHAR(50) NOT NULL PRIMARY KEY,
to_ 		VARCHAR(50) NOT NULL
);

-- values allowed: Approved, CSE_FAC,CSE_HOD, EE_FAC, EE_HOD, ME_HOD, ME_FAC, Director, DFA, ADFA;

CREATE TABLE admin_logs{
	admin_username	VARCHAR(50) NOT NULL,
	log_	VARCHAR(200) NOT NULL,
	time		TIMESTAMPTZ DEFAULT CURRENT_TIMESTAMP
}

-- 

-- Sample Application
-- INSErt into applications (username, start_date, end_date, description , status , curr_holder, d )

-- 
Insert into comments VALUES('3', 'jeetu' , NOW() , 'HI there');


CREATE TABLE logs (
	created_at timestamp  not null Default NOW(),
	log_ VARCHAR(200) NOT NULL
);
