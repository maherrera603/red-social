# Todo List App

El sistema es una red social en cual el usuario podra realizar publicaciones, dar like a las publicaciones de los usuarios que se encuentra en la lista de amigos.

## Instalacion de programas
para correr el sistema se necesita un servidor local como xampp o wampp:

xampp
```bash
https://www.apachefriends.org/es/index.html
```

wampp

```bash
https://www.wampserver.com/en/
```

## Iniciar en local

Si realizo la instalacion el servidor local xampp, dirijase al disco local "c:\xampp\htdocs\", pero si realizo la instalacion de wampp dirijase a "c:\wamp64\www\" .

Clone el proyecto

```bash
  git clone https://github.com/maherrera603/red-social.git
```

Inicialize el servidor local, si es xampp active las opciones de apache y mysql en el panel de xampp, si es wampp ejecute el archivo Wampserver64, en la parte inferior derecha aparecera un icono verde, dirijase a la siguiente url para crear la base de datos, ingrese y dar click en la pestaña sql, copie y pegue el codigo sql y de click en continuar.

```bash
http://localhost/phpmyadmin/index.php?route=/
```

despues de crear la base de datos dirijase a la siguiente url para correr el sistema

```bash
http://localhost/redSocial/
```