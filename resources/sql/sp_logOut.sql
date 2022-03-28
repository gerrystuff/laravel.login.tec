drop procedure if exists pa_logOut;
create procedure pa_logOut (in p_email varchar(255), out result boolean)
begin
	start transaction;
		set @estatus = (select estatus from usuarios where usuarios.correo COLLATE utf8mb4_general_ci = p_email for update);
        -- 1 en sesión, 0 no sesion
        if @estatus = 0 then
            set result = true;
        else
			update usuarios set usuarios.estatus = 0 where usuarios.correo COLLATE utf8mb4_general_ci = p_email;
			set result = false;
        end if;
    commit ;
end;
$$