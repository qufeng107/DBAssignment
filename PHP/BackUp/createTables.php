<?php
	// Include the database connection
	include "db.php";
	try{
		$query = 
		"CREATE TABLE account(
			id integer AUTO_INCREMENT,
			username varchar(35) not null,
			password varchar(35) not null,
			type varchar(255),
			primary key(id)
		);

		CREATE TABLE course(
			id integer primary key,
			title varchar(255),
			license varchar(255)
		);

		CREATE TABLE term(
			id integer primary key,
			course_id integer,
			constraint foreign key (course_id) references course(id)
		);

		CREATE TABLE customer(
			id integer,
			term_id integer not null,
			customer_name varchar(35) not null,
			address varchar(255),
			city varchar(255),
			phone_number varchar(15),
			date_of_birth date,
			primary key(id),
			constraint foreign key (id) references account(id),
			constraint foreign key (term_id) references term(id)
		);

		CREATE TABLE branch(
			branch_name varchar(255) primary key,
			address varchar(255) unique
		);

		CREATE TABLE staff(
			staff_id integer AUTO_INCREMENT,
			branch_name varchar(255) not null,
			staff_name varchar(35),
			surname varchar(35),
			phone_number varchar(15) unique,
			job_title varchar(255),
			annual_salary float(20),
			primary key (staff_id),
			constraint foreign key (branch_name) references branch(branch_name)
		);

		CREATE TABLE teaches(
			term_id integer,
			staff_id integer,
			constraint foreign key (term_id) references term(id),
			constraint foreign key (staff_id) references staff(staff_id)
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

		CREATE TABLE aircraft_parts(
			id integer AUTO_INCREMENT,
			wings varchar(255),
			a_engine varchar(255),
			landing_gears varchar(255),
			cockpit varchar(255),
			fuselage varchar(255),
			wings_operational bit,
			engine_operational bit,
			landing_gears_operational bit,
			cockpit_operational bit,
			fuselage_operational bit,
			primary key (id)
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
			aircraft_parts_id integer not null,
			supplier_id integer not null,
			hangar_id integer not null,
			type varchar(255),
			fuel_per_hour integer,
			is_renTABLE bit,
			primary key (id),
			constraint foreign key (staff_id) references staff(staff_id),
			constraint foreign key (aircraft_parts_id) references aircraft_parts(id),
			constraint foreign key (supplier_id) references supplier(id),
			constraint foreign key (hangar_id) references hangar(id)
		);

		CREATE TABLE lecture(
			aircraft_id integer not null,
			term_id integer not null,
			date timestamp,
			start time,
			end time,
			constraint foreign key (aircraft_id) references aircraft(id),
			constraint foreign key (term_id) references term(id)
		);

		CREATE TABLE rent_management(
			id integer AUTO_INCREMENT,
			aircraft_id integer,
			customer_id integer,
			date timestamp,
			days smallint,
			constraint foreign key (aircraft_id) references aircraft(id), 
			constraint foreign key (customer_id) references customer(id),
			primary key (id)
		)";
	
		$mysql->exec($query);
		echo "REACHED END";
	} catch ( PDOException $e ) {
	// Any errors from the query are caught in this block
	echo $e->getMessage();
	}
?>
