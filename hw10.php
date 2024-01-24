create table students
(
student_id         integer,
first_name TEXT,
last_name  TEXT,
age        integer not null,
faculty_id  TEXT
);

INSERT INTO students (student_id, first_name, last_name, age, faculty_id)
VALUES
(1, 'John', 'Doe', '1995-03-15', 1),
(2, 'Jane', 'Smith', '1998-07-21', 2),
(3, 'Alex', 'Johnson', '1997-11-30', 1);



create table faculties
(
faculty_id_id           integer,
faculty_name TEXT
);

INSERT INTO faculties (faculty_id, faculty_name)
VALUES
(1, 'Computer Science'),
(2, 'Business Administration'),
(3, 'Engineering');



create table subjects
(
subject_id  integer,
subject_name TEXT
);

INSERT INTO subjects (subject_id, subject_name)
VALUES
(1, 'Database Management'),
(2, 'Financial Accounting'),
(3, 'Mechanical Engineering');


create table grades
(
grade_id  integer,
student_id integer,
subject_id integer,
grade integer
);


INSERT INTO grades (grade_id, student_id, subject_id, grade)
VALUES
(1, 1, 1, 90),
(2, 1, 2, 85),
(3, 2, 1, 78),
(4, 3, 3, 92);
