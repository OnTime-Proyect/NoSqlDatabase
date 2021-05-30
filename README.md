<p>
<a href="mailto:marioc@mundogenesys.com" rel="nofollow">
<img border="0" alt="Send Mail" src="https://mundogenesys.com/share/email.png" height="30">	
</a>
<a href="http://ontime.link/" rel="nofollow">
<img border="0" alt="On Time" src="https://mundogenesys.com/share/ontime.png" height="30">	
</a>
<a href="https://www.phpclasses.org/browse/author/1085910.html">
<img border="0" alt="Mundo Genesys" src="https://mundogenesys.com/share/mglogo30.png" height="30">	
</a>
<a href="https://www.phpclasses.org/browse/author/1085910.html">
<img border="0" alt="Php Classes" src="https://mundogenesys.com/share/logo-premium-phpclasses.png" height="30">	
</a>
<a href="https://github.com/OnTime-Proyect" rel="nofollow">
<img border="0" alt="On Time on Github" src="https://mundogenesys.com/share/GitHub_Logo.png" height="30">	
</a>
<a rel="license nofollow" href="http://creativecommons.org/licenses/by-nc-sa/4.0/"><img alt="Creative Commons License" style="border-width: 0;" src="https://i.creativecommons.org/l/by-nc-sa/4.0/88x31.png"></a>
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

<h1 id="otenglish" style="text-align: center;">NoSql Database</h1>

<p> Once you have downloaded the package, the best practice is to protect the code and information of the database, this is achieved by moving the ontime directory from being inside the location of your web page to being parallel to it , with this it cannot be accessed directly from the internet, however, it is easily called from the front simply by changing the line </p>
<p> $ base = <i> 'ontime / </i>'; </p>
<p> include_once ($ base. "OnTime.php"); </p>
<p> $ demo = new OnTime ('ontime'); </p>
for
<p> $ base = '<b> ../ontime/ </b>'; </p>
<p> include_once ($ base. "OnTime.php"); </p>
<p> $ demo = new OnTime (); </p>
<p>With that, the structure of your project will be similar to the one shown in the following image</p>
<div><img style="display: block;
margin-left: auto;
margin-right: auto;" src="http://mundogenesys.com/share/Production%20Best%20practice%202.jpg" alt="Mejor practica FileSystem"></div>
<p> Regardless of whether the database is accessed from the local server, from apis or through web service, the source is the same therefore fully aligned with each other </p>
<p> The files generated should never be modified manually since there is at least double access, the configurations can be made directly from code or using the frontend modules, nor once installed should the security of the files be modified manually. that security is breached </p>
<p> The NOSQL database contains all the necessary elements to be able to generate a useful and complete frontend, and at the same time flexible and customizable </p>
<p> Once the files are copied to their destinations using the browser run the Setup.php file, save the environment and delete itself leaving your database ready to operate </p>
<h2><b> Definition</b> </h2>
<p> Without trying to implement a standard in the industry, as creators of ontime we have our own language to define elements of our framework </p>
<p><b><i>Feature</i> </b> .- It is defined as a specific operation that includes several procedures in the class that support its operation. </p>
<p><b><i>Container</i> </b> .- It is defined as a specific space in the database, which groups information of different types but logically related to each other, physically it is a directory. </p>
<p><b> <i> Basic content </i> </b> .- It is defined as a specific space in the database, which groups records of the same type of information, physically it is a file. &lt; / p&gt;
</p><p><b><i>Contents</i> </b> .- It is defined as a specific space in the database, which groups records of the same type of information as well as supporting information for its correct operaion, it is physically a group of files with the same base name. </p>
<h2><b> Security</b> </h2>
<p> When configuring the database, the admin user is pre-installed, which cannot be eliminated or required to be assigned, has access to the entire database without the need to make any declaration, security assigns for each generic element that they integrate the framewok, each of them with its own levels, which is data associated with assigning accesses </p>
<p> For reading content there are two similar to a user, "anonymous" which is when no user is active in the frontend and "public" available when any user is active in the frontend, this is specifically designed for the information that is present on a page </p>
<h3> <b> Groups and Users </b> </h3>
<p> The database has an advanced security control which allows you to define an unlimited number of user accounts, as well as the functions of each one, the length of the user's password is not limited, nor is the password access, which is encrypted. </p>
<p> The best practice is to create groups according to their responsibilities, which allows you to guarantee the operation of the system, facilitating its maintenance in case of movements in the staff, in case a user level is defined access and is in a group that intends to modify the assignment at user level always remains ignoring what is specified at group level </p>
<p> The database can only be used with a single user or good global access to all, it is the simplest but it is definitely a bad practice </p>
<h3><b> Levels</b> </h3>
<p> When a user or group is assigned to any of the elements of the database, the level that is in it must be indicated, the levels are stratified, each level inherits the characteristics of the immediately preceding one by adding new ones, the levels are static and cannot be modified or translated as the system crashes </p>
<p> They are numbered below: </p>
<p><b><i>vmine</i> </b> .- You can only view information that is directly related to an information that you own </p>
<p><b><i>view</i> </b> .- You can only view owner information indistinctly </p>
<p><b><i>umine</i> </b> .- You can edit the information you own </p>
<p><b><i>update</i> </b> .- You can modify the information Indistinctly from the owner </p>
<p><b><i>insert</i> </b> .- You can add information, if the content type applies it owns the record </p>
<p><b><i>delete</i> </b> .- It allows deleting records in the information </p>
<p><b><i>admin</i> </b> .- You can perform operations such as compaction, encryption and others specially with the information </p>
<p><b><i>access</i> </b> .- Allows to view container specifications in a characteristics </p>
<p><b><i>change</i> </b> .- Allows to modify the container's deny to specifications in a feature </p>
<p><b><i>create</i> </b> .- Allows you to create containers in a feature </p>
<p><b><i>remove</i> </b> .- Allows removing containers in a feature </p>
<p><b><i>owner</i> </b> .- It allows to modify specifications in a characteristics </p>
<h2> <b> Basic Content </b> </h2>
<p> The basic content is the simplest way to store information, where a key is associated with a description, creating basic lists, these lists tend to be static so they do not need to be blocked when updating, and constitute what They are called possible values, the description is displayed on the screen and the key is stored in the information </p>
<h2><b> Tables</b> </h2>
<p> The tables have defined field structures and are validated when adding or removing. </p>
<h3> <b> Data Dictionary </b> </h3>
<p> Before using a field it is necessary to define its characteristics in type and validation, for example, if an Image field is defined, its content is character type, but it must exist in the location that we have to indicate </p>
<h3><b> Records</b> </h3>
<p> There are two models, the records and the sub-records, the first one is a grouping of related data, it is mandatory that one and only one is defined as an access key, the sub-registries are groups without a key, which simplify the definition of the records, for example defines an address sub-record which includes the fields street, exterior number, interior number, neighborhood, municipality, state and country, when it is used in tables of customers, suppliers, etc, just call the address subregister. </p>
<p> If a new field is added to a sub-record, in the previous example, if we add the postal code, just do it once, it is not necessary to fix all the related tables </p>
<p> A Record can be used in an unlimited number of tables </p>
<h2><b> Multilanguage</b> </h2>
<p> Using google's automatic translation is the simplest solution, however, it is not always the most professional since each region, even being the same language, has different nuances, so the database has the ability to have layers of languages ​​to give the desired meaning </p>

<h1 id="otespaniol" style="text-align: center;">Base de Datos NoSql</h1>

<p>Una vez que has descargado el paquete, la mejor practica consiste en proteger el codigo e informacion de la base de datos, esto lo consigue moviendo el directorio ontime de estar dentro de la localización de tu pagina web a quedar paralelo a la misma, con esto no puede ser accesado directamente desde internet, sin embargo, se llama fácilmente desde el front simplemente cambiado la linea </p>
<p>$base=<i>'ontime/</i>';</p>
<p>include_once($base."OnTime.php");</p>
<p>$demo=new OnTime('ontime');</p>
por
<p>$base='<b>../ontime/</b>';</p>
<p>include_once($base."OnTime.php");</p>
<p>$demo=new OnTime();</p>
Con eso, la estructura de tu proyecto sera similar al que se muestra en la siguiente imagen
<div><img style="display: block;
margin-left: auto;
margin-right: auto;" src="http://mundogenesys.com/share/Production%20Best%20practice%202.jpg" alt="Mejor practica FileSystem"></div>
<p>Sin importar si la base de datos se accede desde el servidor local, desde apis o mediante web service la fuente es la misma por lo tanto totalmente alineados entre ellos</p>
<p>Los archivos generados nunca deben de ser modificados manualmente ya que se cuenta con al menos doble acceso, las configuraciones pueden hacerse directamente desde codigo o utilizando los módulos de frontend, tampoco una vez instalado debe de modificarse manualmente la seguridad de los archivos ya que se vulnera la seguridad</p>
<p>La base de datos NOSQL contiene todos los elementos necesarios para poder generar un frontend util y completo, y al mismo tiempo flexible y personalizable</p>
<p>Una vez que los archivos se copian en sus destinos usando el navegador ejecute el archivo Setup.php, grabara el medio ambiente y se autoeliminara dejando su base de datos lista pra operar</p>
<h2><b>Nomenclatura</b></h2>
<p>Sin pretender instrumentar un estándar en la industria, como creadores de ontime tenemos nuestro propio lenguaje para definir elementos de nuestro framework</p>
<p><b><i>Característica</i></b>.-	Se define como una operatividad especifica que incluye varios procedimientos en la clase que soportan su funcionamiento.</p>
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
<h2><b>Tablas</b></h2>
<p>Las tablas cuentan con estructuras de campos definidos y son validados al momento de agregar o eliminar.</p>
<h3><b>Diccionario de datos</b></h3>
<p>Antes de emplear un campo es necesario definir sus caracteristicas en tipo y validacion, por ejemplo, si se define un campo Imagen, su contenido es tipo caracter, pero debe de existir en la localizacion que tenemos que indicar</p>

<h3><b>Registros</b></h3>
<p>Existen dos modelos el registro y el subregistro, el primero son una agrupación de datos relacionados es obligatorio que uno y solo uno este definido como llave de acceso, los subregistros son agrupaciones sin llave las cuales simplifican la definición del registro por ejemplo se define un subregistro dirección el cual incluye los campos calle, numero exterior, numero interior, colonia, municipio, estado y país, cuando se emplea en tablas de clientes, proveedores, etc basta llamar al subregistro dirección.</p>
<p>Si a un subregistro se le agrega un nuevo campo, en el ejemplo anterior, si agregamos el código postal, basta hacer una sola vez, no es necesitar todas las tablas relacionadas</p>
<p>Un Registro puede ser empleado en una cantidad ilimitada de tablas</p>
<h2><b>Multilenguaje</b></h2>
<p>Emplear la traducción automática de google es la solución mas sencilla, sin embargo, no siempre es la mas profesional ya que cada region aun siendo el mismo lenguaje tiene diferentes matices, por lo que la base de datos tiene la habilidad de tener capas de lenguajes para dar el significado deseado</p>


<div><img style="display: block;
margin-left: auto;
margin-right: auto;" src="https://mundogenesys.com/share/ontimer.png" alt="OnTime" height="200"></div>
