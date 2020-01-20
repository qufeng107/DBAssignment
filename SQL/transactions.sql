#insert into transactions (timedate,description,balancechange) Values ()

SET SQL_SAFE_UPDATES = 0;
#delete from transactions where 1=1;

SET @counter = 100000000;

#insert into transactions (balancechange)  select annual_salary/12 from staff;
#update transactions set timedate = "2019/01/24 09:00:00", description="Salary Payment", balanceChange = 0-balanceChange;
update transactions set balance = (@counter = @counter + balanceChange);
SET SQL_SAFE_UPDATES = 1;