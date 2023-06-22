CREATE TABLE tbluser (
    email varchar(200),
    pass varchar(200),
    isType set("Lecturer","Student"),
    fullName varchar(200),
    schoolID varchar(8),
    PRIMARY KEY (schoolID)
);

CREATE TABLE tbladmin (
    email varchar(200),
    pass varchar(200),
    schoolID varchar(8),
    fullName varchar(200),
    PRIMARY KEY (schoolID)
);

INSERT INTO Admin (Email, password, schoolID , fullName) VALUES
('admin@sis.hust.edu.vn','20231234','20231234','Admin');

CREATE TABLE equipment (
    type varchar(200) NOT NULL,
    id varchar(7) NOT NULL,
    totalUsedTime integer,
    producedYear integer NOT NULL,
    description varchar(200),
    lastUserUsed varchar(8),
    currentRoom varchar(7),
    avaiableTime SET("1", "2", "3","4","5","6","7","8","9","10","11","12","13","14"),
    PRIMARY KEY (ID)
);


CREATE TABLE room (
    id varchar(7) NOT NULL,
    capacity integer NOT NULL,
    usability boolean NOT NULL,
    description varchar(200),
    avaiableTime SET("1", "2", "3","4","5","6","7","8","9","10","11","12","13","14"),
    PRIMARY KEY (id)
);

CREATE TABLE RoomRegisterForm (
    userID varchar(8) NOT NULL,
    phoneNumber varchar(12) NOT NULL,
    purpose varchar(200) NOT NULL,
    numberOfRoom int NOT NULL,
    numberOfPeople int NOT NULL,
    borrowTime SET("1", "2", "3","4","5","6","7","8","9","10","11","12","13","14") NOT NULL,
    borrowDay DATE NOT NULL,
    FOREIGN KEY (userID) REFERENCES User(SchoolID)
);

CREATE TABLE EquipmentRegisterForm (
    userID varchar(8) NOT NULL,
    phoneNumber varchar(12) NOT NULL ,
    purpose varchar(200) NOT NULL ,
    equipType varchar(50) NOT NULL,
    numberOfEach int NOT NULL,
    borrowTime SET("1", "2", "3","4","5","6","7","8","9","10","11","12","13","14") NOT NULL,
    borrowDay DATE NOT NULL,
    FOREIGN KEY (userID) REFERENCES User(SchoolID)
);

CREATE TABLE ReportForm (
    reportDate DATE NOT NULL,
    roomID varchar(7) NOT NULL,
    userReportID varchar(8),
    desribeCondition varchar(200) NOT NULL,
    FOREIGN KEY (userReportID) REFERENCES User(SchoolID),
    FOREIGN KEY (roomID) REFERENCES Room(ID)
);

CREATE TABLE Notification (
    notiContent varchar(200) NOT NULL
);

ALTER TABLE equipment
ADD FOREIGN KEY (currentroom) REFERENCES room(id);

ALTER TABLE equipment
ADD FOREIGN KEY (lastUserUsed) REFERENCES User(schoolID);
