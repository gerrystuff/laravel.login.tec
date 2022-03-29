SET SQL_SAFE_UPDATES = 0;


UPDATE usuarios
set estatus = 0 where tipo > 0;