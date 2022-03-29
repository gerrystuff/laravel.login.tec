
delimiter $$

drop procedure if exists pa_logIn;
create procedure pa_logIn (in p_email varchar(255), out result boolean)
begin
 select sleep(3);
	start transaction;
   
		set @estatus = (select estatus from usuarios where usuarios.correo COLLATE utf8mb4_general_ci = p_email for update);
        -- 1 en sesión, 0 no sesion
        if @estatus = 1 then
            set result = true;
        else
			update usuarios set usuarios.estatus = 1 where usuarios.correo COLLATE utf8mb4_general_ci = p_email;
			set result = false;
        end if;
    commit ;
end;
delimiter $$






















