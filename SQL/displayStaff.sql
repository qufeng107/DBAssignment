
SELECT branch_name, forename, surname, job_title, phone_number, annual_salary FROM staff		
		WHERE forename LIKE '%' and branch_name like '%' and annual_salary >= 0  AND  annual_salary <= 9999999