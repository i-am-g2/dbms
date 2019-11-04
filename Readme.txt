1) sudo apt install php-pgsql
2) php 7.2


TechStack:
PHP,PosgreSql,MongoDB,HTML,CSS,BOOTSTRAP


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























