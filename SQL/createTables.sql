CREATE TABLE account(
			id integer AUTO_INCREMENT,
			username varchar(35) not null,
			password varchar(35) not null,
			email varchar(255) not null,
			type varchar(255),
			primary key(id)
		);

		CREATE TABLE course(
			id integer primary key,
			title varchar(255),
			license varchar(255),
			description varchar(255)
		);

		CREATE TABLE term(
			id integer primary key,
			course_id integer,
			start varchar(255),
			end varchar(255),
			constraint foreign key (course_id) references course(id)
		);

		CREATE TABLE customer(
			id integer,
			term_id integer not null,
            forename varchar(35) not null,
			surname varchar(35) not null,
			date_of_birth date,
			email varchar(255),
			phone_number varchar(15),
			address varchar(255),
			primary key(id),
			constraint foreign key (id) references account(id),
			constraint foreign key (term_id) references term(id)
		);

		CREATE TABLE branch(
			branch_name varchar(255) primary key,
			address varchar(255) unique
		);

		CREATE TABLE staff(
			id integer AUTO_INCREMENT,
			branch_name varchar(255) not null,
			forename varchar(35),
			surname varchar(35),
			date_of_birth date,
			phone_number varchar(15) unique,
			job_title varchar(255),
			annual_salary float(20),
			primary key (id),
			constraint foreign key (branch_name) references branch(branch_name)
		);

		CREATE TABLE teaches(
			term_id integer,
			staff_id integer,
			constraint foreign key (term_id) references term(id),
			constraint foreign key (staff_id) references staff(id)
		);

		CREATE TABLE airfield(
			airfield_name varchar(255) primary key,
			branch_name varchar(255) not null,
			capacity smallint,
			constraint foreign key (branch_name) references branch(branch_name)
		);

		CREATE TABLE hangar(
			id integer AUTO_INCREMENT,
			airfield_name varchar(255) not null,
			primary key (id),
			constraint foreign key (airfield_name) references airfield(airfield_name)
		);

		CREATE TABLE supplier(
			id integer AUTO_INCREMENT,
			company_name varchar(35),
			phone_number varchar(15),
			primary key (id)
		);

		CREATE TABLE aircraft(
			id integer AUTO_INCREMENT,
			staff_id integer not null,
			supplier_id integer not null,
			hangar_id integer not null,
			name varchat(255),
			type varchar(255),
			fuel_per_hour integer,
			primary key (id),
			constraint foreign key (staff_id) references staff(id),
			constraint foreign key (supplier_id) references supplier(id),
			constraint foreign key (hangar_id) references hangar(id)
		);

		CREATE TABLE lecture(
			aircraft_id integer not null,
			term_id integer not null,
			date date,
			start time,
			end time,
			constraint foreign key (aircraft_id) references aircraft(id),
			constraint foreign key (term_id) references term(id)
		);
