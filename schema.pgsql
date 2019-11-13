CREATE TABLE credentials(
	username varchar(50) not NULL PRIMARY KEY,
	password varchar(1000)
);
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

-- 
-- Sample Application
-- INSErt into applications (username, start_date, end_date, description , status , curr_holder, d )
