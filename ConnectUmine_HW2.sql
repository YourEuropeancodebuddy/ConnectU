/*Activity ISA HIERARCHY*/
CREATE TABLE Activity (
activity_id varchar(5) UNIQUE,
activity_name varchar(5000),
activity_description TEXT,
activity_location varchar(50),
open_to_everyone bool,
activity_date datetime,
starting_time time,
closing_time time,
PRIMARY KEY(activity_id)
);

CREATE TABLE  College_activities(
activity_id varchar(5) UNIQUE,
college_name varchar(5000),
PRIMARY KEY (activity_id),
FOREIGN KEY (activity_id) REFERENCES Activity (activity_id)
);

CREATE TABLE Club_activities(
activity_id varchar(5) UNIQUE,
PRIMARY KEY (activity_id),
FOREIGN KEY (activity_id) REFERENCES Activity(activity_id)
);

/*Club ISA HIERARCHY*/

CREATE TABLE Recreational_club_activities(
activity_id varchar(5) UNIQUE,
recretional_club_name varchar(100),
PRIMARY KEY (activity_id),
FOREIGN KEY(activity_id) REFERENCES Club_activities(activity_id)
);
CREATE TABLE Intellectual_club_activities(
activity_id varchar(5) UNIQUE,
intellectual_lub_name varchar(100),
PRIMARY KEY (activity_id),
FOREIGN KEY(activity_id) REFERENCES Club_activities(activity_id)
);

CREATE TABLE Science_club_activities(
activity_id varchar(5) UNIQUE,
science_club_name varchar(100),
PRIMARY KEY (activity_id),
FOREIGN KEY(activity_id) REFERENCES Club_activities(activity_id)
);

/*College_leader ISA HIERARCHY*/

CREATE TABLE College_leader(
college_leader_id INT,
is_on_duty bool,
PRIMARY KEY (college_leader_id)
);

CREATE TABLE RSA(
rsa_id INT,
rsa_numbers INT,
rsa_name varchar(20),
rsa_surname varchar(20),
rsa_email_address varchar(50),
rsa_timetable_data BLOB,
PRIMARY KEY (rsa_id),
FOREIGN KEY (rsa_id) REFERENCES College_leader(college_leader_id)
);

CREATE TABLE RLM(
rlm_id INT,
rlm_numbers INT,
rlm_name varchar(20),
rlm_surname varchar(20),
rlm_email_address varchar(50),
rlm_timetable_data BLOB,
PRIMARY KEY (rlm_id),
FOREIGN KEY (rlm_id) REFERENCES
College_leader(college_leader_id)
);


CREATE TABLE Peer_mentor(
peer_mentor_id INT,
peer_mentor_numbers INT,
peer_mentor_name varchar(20),
peer_mentor_surname varchar(20),
peer_mentor_email_address varchar(50),
peer_mentor_timetable_data BLOB,
PRIMARY KEY (Peer_mentor_id),
FOREIGN KEY (Peer_mentor_id) REFERENCES College_leader(college_leader_id)
);
/*Club_leader ISA HIERARCHY*/
CREATE TABLE Club_leader(
club_leader_id INT,
is_organiser bool,
PRIMARY KEY (club_leader_id)
);

CREATE TABLE Club_president(
club_president_id INT,
club_president_name varchar(20),
club_president_surname varchar(20),
club_president_email_address varchar(50),
club_president_timetable_data BLOB,
PRIMARY KEY(club_president_id),
FOREIGN KEY (club_president_id) REFERENCES Club_leader(club_leader_id)
);

CREATE TABLE Club_vice_president(
club_vice_president_id INT,
club_vice_president_name varchar(20),
club_vice_president_surname varchar(20),
club_vice_president_email_address varchar(50),
club_vice_president_timetable_data BLOB,
PRIMARY KEY(club_vice_president_id),
FOREIGN KEY (club_vice_president_id) REFERENCES Club_leader(club_leader_id)
);
CREATE TABLE Club_organizers(
club_organizers_id INT,
club_organizers_number INT,
club_organizers_name varchar(20),
club_organizers_surname varchar(20),
club_organizers_email_address varchar(50),
club_organizers_timetable_data BLOB,
PRIMARY KEY(club_organizers_id),
FOREIGN KEY (club_organizers_id) REFERENCES Club_leader(club_leader_id)
);

/*relationships*/

CREATE TABLE Manages(
college_leader_id INT,
activity_id varchar(5) UNIQUE,
PRIMARY KEY (college_leader_id,activity_id),
FOREIGN KEY (college_leader_id) REFERENCES College_leader(college_leader_id),
FOREIGN KEY(activity_id) REFERENCES College_activities (activity_id)
);


CREATE TABLE Leads (
club_leader_id INT,
activity_id varchar(5) UNIQUE,
PRIMARY KEY (club_leader_id, activity_id),
FOREIGN KEY (club_leader_id) REFERENCES Club_leader(club_leader_id),
FOREIGN KEY (activity_id) REFERENCES Club_activities (activity_id)
);
