<?php
/**
 * Description of config
 *
 * @author Gabriel Lopes
 */
define("HOST", "192.xxxxx");
define("BANCO", "fabricateste");
define("PORTA", "3306");
define("USER", "xxxx");
define("SENHA", "123456");

define("LHOST", "192.xxxxx");
define("LUSER","cn=Manager,dc=xxxxx,dc=com");
define("LSENHA","123456");
define("LARVORE","dc=xxxxxx,dc=com");
define("LARVORE1","ou=Groups,dc=xxxxxx,dc=com");
define("LARVORE2",",ou=Users,dc=xxxxxx,dc=com");
define("LPORTA","389");
define("LGRUPO","Infraestrutura");

    function __autoload($Class){    
    $dir = ['php'];
    $idir = null;
   
    foreach($dir as $dirnome){
        if(!$idir && file_exists(__DIR__ . "//{$dirnome}//{$Class}.class.php")){
          include_once __DIR__ . "//{$dirnome}//{$Class}.class.php";
        }
        if(!$idir && file_exists(__DIR__ . "//{$dirnome}//{$Class}.php")){
            include_once __DIR__ . "//{$dirnome}//{$Class}.php";
        }
        $idir = TRUE;
    }
}
