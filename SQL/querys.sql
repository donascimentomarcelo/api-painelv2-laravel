use juniorm1_programmer

select * from usersuploadspromotions

desc uploadspromotions promotions 

insert into promotions(id, name, title, description) value(null,'TESTE NAME','TESTE TITLE', 'TESTE DESCRIPTION')

select * from uploadspromotions inner join
 promotions on promotions.id = uploadspromotions.promotions_id

insert into uploadspromotions(id, filename, promotions_id) value(null, 'TESTE FK', 1)