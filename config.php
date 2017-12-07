<?php
//estaba debajo de la definicion URL
define('LIBS','libs/'); 

//variables cuando uso localhost
define('URL','http://localhost/sipce/');
define('DB_TYPE','mysql');
define('DB_HOST','localhost');
define('DB_NAME','db_sipce');
define('DB_USER','root');
define('DB_PASS','');

//variables cuando uso hostinger.com
//define('URL', 'http://www.pruebasesteban.bl.ee/');
//define('DB_TYPE', 'mysql');
//define('DB_HOST', 'mysql.hostinger.es');
//define('DB_NAME', 'u276605033_mvc');
//define('DB_USER', 'u276605033_eqs');
//define('DB_PASS', '63246884565');


//Usuario FTP FileZilla
//Servidor: 31.170.164.163
//Usuario: u276605033
//Contraseña: 63246884565
//Puerto: 21

/*No cambiar la hash_key porque es la clave del password*/
define('HASH_GENERAL_KEY','ctpcarrizalalajuela2');

/*ESTE ES PARA LA BASE DE DATOS SOLAMENTE*/
define('HASH_PASSWORD_KEY','ctpcarrizalalajuela2');

//Forma de Encriptacion del Password
//echo Hash::create('sha256', 'admin', HASH_PASSWORD_KEY);
?>
