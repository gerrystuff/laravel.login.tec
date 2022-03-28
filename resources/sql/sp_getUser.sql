
delimiter //
create procedure pa_getUser ( p_email varchar(50))
begin
	start transaction;
		select * 
			from usuarios 
			where usuarios.correo COLLATE utf8mb4_general_ci = p_email for update;
    commit ;
end;
//
delimiter ;
