

/*Activity ISA HIERARCHY*/
CREATE TABLE Activity (
activity_id varchar(50) UNIQUE,
activity_name varchar(50),
activity_description TEXT,
activity_location varchar(50),
open_to_everyone bool,
activity_date datetime,
starting_time time,
closing_time time,
PRIMARY KEY(activity_id)
);

CREATE TABLE  College_activities(
activity_id varchar(50),
college_name varchar(50),
PRIMARY KEY (activity_id),
FOREIGN KEY (activity_id) REFERENCES Activity (activity_id)
);

CREATE TABLE Club_activities(
activity_id varchar(50),
club_name varchar(50),
PRIMARY KEY (activity_id),
FOREIGN KEY (activity_id) REFERENCES Activity(activity_id)
);

/*College Activity ISA HIERARCHY */

CREATE TABLE Academic_college_activities(
    activity_id varchar(50),
    subject_name varchar(50),
    PRIMARY KEY (activity_id),
    FOREIGN KEY (activity_id) REFERENCES College_activities(activity_id)
);

CREATE TABLE Social_college_activities(
    activity_id varchar(50),
    social_event_type varchar(50),
    PRIMARY KEY (activity_id),
    FOREIGN KEY (activity_id) REFERENCES College_activities(activity_id)
);

CREATE TABLE Sport_college_activities(
    activity_id varchar(50),
    sport_type varchar(50),
    PRIMARY KEY (activity_id),
    FOREIGN KEY (activity_id) REFERENCES College_activities(activity_id)
);

/*Club ISA HIERARCHY*/

CREATE TABLE Recreational_club_activities(
activity_id varchar(50) UNIQUE,
recretional_club_name varchar(50),
PRIMARY KEY (activity_id),
FOREIGN KEY(activity_id) REFERENCES Club_activities(activity_id)
);
CREATE TABLE Intellectual_club_activities(
activity_id varchar(50) UNIQUE,
intellectual_club_name varchar(50),
PRIMARY KEY (activity_id),
FOREIGN KEY(activity_id) REFERENCES Club_activities(activity_id)
);

CREATE TABLE Science_club_activities(
activity_id varchar(50) UNIQUE,
science_club_name varchar(50),
PRIMARY KEY (activity_id),
FOREIGN KEY(activity_id) REFERENCES Club_activities(activity_id)
);

/*College_leader*/

CREATE TABLE College_leader(
    college_leader_id INT,
    is_on_duty bool,
    leader_type ENUM('RSA', 'RLM', 'Peer_mentor') NOT NULL,  -- Include Peer_mentor in the ENUM
    leader_numbers INT,
    leader_name varchar(20),
    leader_surname varchar(20),
    leader_email_address varchar(50),
    leader_timetable_data BLOB,
    PRIMARY KEY (college_leader_id)
);

/*Club_leader*/
CREATE TABLE Club_leader(
    club_leader_id INT,
    is_organiser bool,
    leader_role ENUM('President', 'Vice President', 'Organizer') NOT NULL,
    leader_name varchar(20),
    leader_surname varchar(20),
    leader_email_address varchar(50),
    leader_timetable_data BLOB,
    PRIMARY KEY (club_leader_id)
);

/*relationships*/

CREATE TABLE Manages(
college_leader_id INT,
activity_id varchar(50),
PRIMARY KEY (college_leader_id,activity_id),
FOREIGN KEY (college_leader_id) REFERENCES College_leader(college_leader_id),
FOREIGN KEY(activity_id) REFERENCES College_activities (activity_id)
);


CREATE TABLE Leads (
club_leader_id INT,
activity_id varchar(50),
PRIMARY KEY (club_leader_id, activity_id),
FOREIGN KEY (club_leader_id) REFERENCES Club_leader(club_leader_id),
FOREIGN KEY (activity_id) REFERENCES Club_activities (activity_id)
);

CREATE TABLE Organizes(
    club_leader_id INT,
    activity_id varchar(50),
    PRIMARY KEY (club_leader_id, activity_id),
    FOREIGN KEY (club_leader_id) REFERENCES Club_leader(club_leader_id),
    FOREIGN KEY (activity_id) REFERENCES Club_activities(activity_id)
);












 

