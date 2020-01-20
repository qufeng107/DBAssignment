
#select *,course.id from customer,course where 
#select customer.forename,customer.surname,customer.date_of_birth,customer.phone_number,customer.address,customer.term_id, course.title,account.email from customer,course,account where course.id = (select left (customer.id,1)) and customer.id = account.id

#REATE VIEW clientInfo AS select customer.forename,customer.surname,customer.date_of_birth,customer.phone_number,customer.address,customer.term_id, course.title,account.email from customer,course,account where course.id = (select left (customer.id,1)) and customer.id = account.id
