<p>
<a href="mailto:marioc@mundogenesys.com">
<img border="0" alt="Send Mail" src="https://mundogenesys.com/share/email.png" height="30">	
</a>
<a href="http://ontime.link/">
<img border="0" alt="On Time" src="https://mundogenesys.com/share/ontime.png" height="30">	
</a>
<a href="https://www.phpclasses.org/browse/author/1085910.html">
<img border="0" alt="Mundo Genesys" src="https://mundogenesys.com/share/mglogo30.png" height="30">	
</a>
<a href="https://www.phpclasses.org/browse/author/1085910.html">
<img border="0" alt="Php Classes" src="https://mundogenesys.com/share/logo-premium-phpclasses.png" height="30">	
</a>
<a href="https://github.com/OnTime-Proyect">
<img border="0" alt="On Time on Github" src="https://mundogenesys.com/share/GitHub_Logo.png" height="30">	
</a>
<a rel="license" href="http://creativecommons.org/licenses/by-nc-sa/4.0/"><img alt="Creative Commons License" style="border-width:0" src="https://i.creativecommons.org/l/by-nc-sa/4.0/88x31.png" /></a>
<a href="#otespaniol">
<img border="0" alt="Español" src="https://mundogenesys.com/share/Espa%C3%B1a.png" height="30">	
</a>
<a href="#otenglish">
<img border="0" alt="English" src="https://mundogenesys.com/share/EEUU.png" height="30">	
</a>
</p>
<div><img style="display: block;
margin-left: auto;
margin-right: auto;" src="https://mundogenesys.com/share/mglogo30.png" alt="Mundo Genesys" height="200"></div>

<h1 id ="otenglish" style="text-align: center;">NoSql Database</h1>

<p>Una vez que has descargado el paquete, la mejor practica consite en proteger el codigo e informacion de la base de datos, esto lo consigue moviendo el directorio ontime de estar dentro de la localizacion de tu pagina web a quedar paralelo a la misma, con esto no puede ser accesado directamente desde internet, sin embargo, se llama facilmente desde el front simplemente cambiado la linea </p>
<p>$base=<i>'ontime/</i>';</p>
<p>include_once($base."OnTime.php");</p>
<p>$demo=new OnTime('ontime');</p>
por
<p>$base='<b>../ontime/</b>';</p>
<p>include_once($base."OnTime.php");</p>
<p>$demo=new OnTime();</p>
Con eso, la estructura de tu proyecto sera similar al que se muestra en la siguiente imagen
<div"><img style="display: block;
margin-left: auto;
margin-right: auto;" src="http://mundogenesys.com/share/Production%20Best%20practice%202.jpg" alt="Mejor practica FileSystem"></div>
<p>Sin importar si la base de datos se accesa desde el servidor local, desde apis o mediante web service la fuente es la misma por lo tanto totalmente alineadoas entre ellos</p>
<p>Los archivos generados nunca deben de ser modificados manualmente ya que se cuenta con al menos doble acceso, las configuraciones pueden hacerse directamente desde codigo o utilizando los modulos de frontend, tampoco una vez instalado debe de modificarse manualmente la seguridad de los archivos ya que se vulnera la seguridad</p>
<p>La base de datos NOSQL contiene todos los elementos necesarios para poder generar un frontend util y completo, y al mismo tiempo flexible y personalizable</p>
<h2><b>Nomenglatura</b></h2>
<p>Sin pretender instrumentar un standar en la industria, como creadores de ontime tenemos nuestro propio lenguaje para definir elementos de nuestro framework</p>
<p><b><i>Caracteristica</i></b>.-	Se define como una operatividad especifica que incluye varios procedimientos en la clase que soportan su funcionamiento.</p>
<p><b><i>Contenedor</i></b>.-	Se define como un espacio especifico en el la base de datos, que agrupa informacion de diferentes tipos pero relacionada logicamente entre si, fisicamente es un directorio.</p>
<p><b><i>Contenido basico</i></b>.-	Se define como un espacio especifico en el la base de datos, que agrupa registros de el mismo tipo de informacion, fisicamente es un archivo.</p>
<p><b><i>Contenido</i></b>.-	Se define como un espacio especifico en el la base de datos, que agrupa registros de el mismo tipo de informacion asi como informacion de apoyo para su correcta operaion, fisicamente es un grupo de archivos con el mismo nombre base.</p>
<h2><b>Seguridad</b></h2>
<p>Al configurar la base de datos se preinstala el usuario admin, el cual no puede ser eliminado ni requiere se asignado, tiene acceso a toda la base de datos sin necesidad de realizar ninguna declaracion, la seguridad asigna para cada elemento generico que integran el framewok, cada uno de ellos con sus propios niveles que es un dato asociado al momento de asignar accesos</p>
<p>Para lectura de contenido hay dos similes a un usuario, "anonimo" que es cuando ningun usuario esta activo en el frontend y "publico" disponible cuando cualquier usuario esta activo en el frontend, esto esta especificamente diseñado para la informacion que se presenta en una pagina</p>
<h3><b>Grupos y Usuarios</b></h3>
<p>La base de datos cuenta con un avanzado control de seguridad la cual te permite definir un numero ilimitado de cuentas de usuario, asi como las funciones de cada uno,la longitud de la clave del usuario no se encuentra limitada, tampoco la clave de acceso, la cual se encuentra encriptada.</p>
<p>La mejor practica consiste en crear grupos en fincion a sus responsabilidades lo que te permite garantizar la operacion del sistema, facilitando el mantenimiento del mismo en caso de movimientos en la plantilla de personal, en caso que a nivel usuario se defina un nivel de acceso y se encuentre en un grupo que lo pretende modificar la asignacion a nivel usuario siempre se mantiene ignorando lo especificado a nivel grupo</p>
<p>Tenicamente puede usarse la base de datos con un solo usuario o buen dar acceso global a todos, es lo mas simple pero definitivamente es es una mala practica</p>
<h3><b>Niveles</b></h3>
<p>Cuando se asigna un usuario o grupo a cualquiera de los elementos de la base de datos se tiene que que indicar el nivel que se tiene en el mismo, los niveles son estratificados cada nivel hereda las caracteristicas del inmediato anterior  agregando nuevas, los niveles son estaticos no pueden ser modificados o traducidos ya que el sistemas se bloquea</p>
<p>A continuacion de senumeran:</p>
<p><b><i>vmine</i></b>.- Unicamente se pueden visualizar informacion que se encuentre relacionada directamente con unformacion de la que eres propietario</p>	
<p><b><i>view</i></b>.- Unicamente puedes visualizar informacion indistintamente de propietario</p>	
<p><b><i>umine</i></b>.- Puedes nodificar la informacion de la que eres propietario</p>	
<p><b><i>update</i></b>.- Puedes nodificar la informacion Indistintamente del propietario</p>	
<p><b><i>insert</i></b>.- Puedes agregar informacion, si el tipo de contenido aplica es propietario del registro</p>	
<p><b><i>delete</i></b>.- Permite eliminar regisytos en la informacion</p>	
<p><b><i>admin</i></b>.- Puede realizar operaciones como compactacion, encriptacion y otras dentro espeiales con la informacion</p>	
<p><b><i>access</i></b>.- Permite visualizar especificaciones del contenedor en un caracteristicas</p>	
<p><b><i>change</i></b>.- Permite modificar especificaciones denyto del contenedor en un caracteristicas</p>	
<p><b><i>create</i></b>.- Permite crear contenedores en un caracteristicas</p>	
<p><b><i>remove</i></b>.- Permite eliminar contenedores en un caracteristicas</p>	
<p><b><i>owner</i></b>.- Permite modificar especificaciones en una caracteristicas</p>	
<h2><b>Contenido Basico</b></h2>
<p>El contenido basico es la forma mas simple de almacenar informacion, donde una clave es asociada a una descripción, creando listas basicas, estas listas tienden a ser estaticas por lo que no requieren ser bloqueadas al momento de actualizarse, y constituyen lo que se llaman valores posibles, la descripcion se muestra en la pantalla y la clave se almacena en la informacion</p>
<p>Los errores que se producen por la operacion de la base de datos son datos basicos</p>
<h2><b>Tablas</b></h2>
<h3><b>Diccionario de datos</b></h3>
<p></p>
<h3><b>Registros</b></h3>
<p></p>
<h3><b>Validacion</b></h3>
<p></p>
<h2><b>Multilenguaje</b></h2>


<h1 id ="otespaniol" style="text-align: center;">NoSql Database</h1>

<p>Una vez que has descargado el paquete, la mejor practica consite en proteger el codigo e informacion de la base de datos, esto lo consigue moviendo el directorio ontime de estar dentro de la localizacion de tu pagina web a quedar paralelo a la misma, con esto no puede ser accesado directamente desde internet, sin embargo, se llama facilmente desde el front simplemente cambiado la linea </p>
<p>$base=<i>'ontime/</i>';</p>
<p>include_once($base."OnTime.php");</p>
<p>$demo=new OnTime('ontime');</p>
por
<p>$base='<b>../ontime/</b>';</p>
<p>include_once($base."OnTime.php");</p>
<p>$demo=new OnTime();</p>
Con eso, la estructura de tu proyecto sera similar al que se muestra en la siguiente imagen
<div"><img style="display: block;
margin-left: auto;
margin-right: auto;" src="http://mundogenesys.com/share/Production%20Best%20practice%202.jpg" alt="Mejor practica FileSystem"></div>
<p>Sin importar si la base de datos se accesa desde el servidor local, desde apis o mediante web service la fuente es la misma por lo tanto totalmente alineadoas entre ellos</p>
<p>Los archivos generados nunca deben de ser modificados manualmente ya que se cuenta con al menos doble acceso, las configuraciones pueden hacerse directamente desde codigo o utilizando los modulos de frontend, tampoco una vez instalado debe de modificarse manualmente la seguridad de los archivos ya que se vulnera la seguridad</p>
<p>La base de datos NOSQL contiene todos los elementos necesarios para poder generar un frontend util y completo, y al mismo tiempo flexible y personalizable</p>
<h2><b>Nomenglatura</b></h2>
<p>Sin pretender instrumentar un standar en la industria, como creadores de ontime tenemos nuestro propio lenguaje para definir elementos de nuestro framework</p>
<p><b><i>Caracteristica</i></b>.-	Se define como una operatividad especifica que incluye varios procedimientos en la clase que soportan su funcionamiento.</p>
<p><b><i>Contenedor</i></b>.-	Se define como un espacio especifico en el la base de datos, que agrupa informacion de diferentes tipos pero relacionada logicamente entre si, fisicamente es un directorio.</p>
<p><b><i>Contenido basico</i></b>.-	Se define como un espacio especifico en el la base de datos, que agrupa registros de el mismo tipo de informacion, fisicamente es un archivo.</p>
<p><b><i>Contenido</i></b>.-	Se define como un espacio especifico en el la base de datos, que agrupa registros de el mismo tipo de informacion asi como informacion de apoyo para su correcta operaion, fisicamente es un grupo de archivos con el mismo nombre base.</p>
<h2><b>Seguridad</b></h2>
<p>Al configurar la base de datos se preinstala el usuario admin, el cual no puede ser eliminado ni requiere se asignado, tiene acceso a toda la base de datos sin necesidad de realizar ninguna declaracion, la seguridad asigna para cada elemento generico que integran el framewok, cada uno de ellos con sus propios niveles que es un dato asociado al momento de asignar accesos</p>
<p>Para lectura de contenido hay dos similes a un usuario, "anonimo" que es cuando ningun usuario esta activo en el frontend y "publico" disponible cuando cualquier usuario esta activo en el frontend, esto esta especificamente diseñado para la informacion que se presenta en una pagina</p>
<h3><b>Grupos y Usuarios</b></h3>
<p>La base de datos cuenta con un avanzado control de seguridad la cual te permite definir un numero ilimitado de cuentas de usuario, asi como las funciones de cada uno,la longitud de la clave del usuario no se encuentra limitada, tampoco la clave de acceso, la cual se encuentra encriptada.</p>
<p>La mejor practica consiste en crear grupos en fincion a sus responsabilidades lo que te permite garantizar la operacion del sistema, facilitando el mantenimiento del mismo en caso de movimientos en la plantilla de personal, en caso que a nivel usuario se defina un nivel de acceso y se encuentre en un grupo que lo pretende modificar la asignacion a nivel usuario siempre se mantiene ignorando lo especificado a nivel grupo</p>
<p>Tenicamente puede usarse la base de datos con un solo usuario o buen dar acceso global a todos, es lo mas simple pero definitivamente es es una mala practica</p>
<h3><b>Niveles</b></h3>
<p>Cuando se asigna un usuario o grupo a cualquiera de los elementos de la base de datos se tiene que que indicar el nivel que se tiene en el mismo, los niveles son estratificados cada nivel hereda las caracteristicas del inmediato anterior  agregando nuevas, los niveles son estaticos no pueden ser modificados o traducidos ya que el sistemas se bloquea</p>
<p>A continuacion de senumeran:</p>
<p><b><i>vmine</i></b>.- Unicamente se pueden visualizar informacion que se encuentre relacionada directamente con unformacion de la que eres propietario</p>	
<p><b><i>view</i></b>.- Unicamente puedes visualizar informacion indistintamente de propietario</p>	
<p><b><i>umine</i></b>.- Puedes nodificar la informacion de la que eres propietario</p>	
<p><b><i>update</i></b>.- Puedes nodificar la informacion Indistintamente del propietario</p>	
<p><b><i>insert</i></b>.- Puedes agregar informacion, si el tipo de contenido aplica es propietario del registro</p>	
<p><b><i>delete</i></b>.- Permite eliminar regisytos en la informacion</p>	
<p><b><i>admin</i></b>.- Puede realizar operaciones como compactacion, encriptacion y otras dentro espeiales con la informacion</p>	
<p><b><i>access</i></b>.- Permite visualizar especificaciones del contenedor en un caracteristicas</p>	
<p><b><i>change</i></b>.- Permite modificar especificaciones denyto del contenedor en un caracteristicas</p>	
<p><b><i>create</i></b>.- Permite crear contenedores en un caracteristicas</p>	
<p><b><i>remove</i></b>.- Permite eliminar contenedores en un caracteristicas</p>	
<p><b><i>owner</i></b>.- Permite modificar especificaciones en una caracteristicas</p>	
<h2><b>Contenido Basico</b></h2>
<p>El contenido basico es la forma mas simple de almacenar informacion, donde una clave es asociada a una descripción, creando listas basicas, estas listas tienden a ser estaticas por lo que no requieren ser bloqueadas al momento de actualizarse, y constituyen lo que se llaman valores posibles, la descripcion se muestra en la pantalla y la clave se almacena en la informacion</p>
<p>Los errores que se producen por la operacion de la base de datos son datos basicos</p>
<h2><b>Tablas</b></h2>
<h3><b>Diccionario de datos</b></h3>
<p></p>
<h3><b>Registros</b></h3>
<p></p>
<h3><b>Validacion</b></h3>
<p></p>
<h2><b>Multilenguaje</b></h2>



<div><img style="display: block;
margin-left: auto;
margin-right: auto;" src="https://mundogenesys.com/share/ontimer.png" alt="OnTime" height="200"></div>
