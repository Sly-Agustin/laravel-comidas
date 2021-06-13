## Idea a Implementar

La idea es implementar una aplicación que contenga contenga comidas, recetas, métodos de preparación, ingredientes junto con otros datos interesantes sobre las mismas.

La aplicación ofrecerá una amplia variedad de filtros para poder acceder a la comida que querammos cocinar u obtener información, ya sea por región, ingredientes disponibles o sencillamente buscando el nombre de la misma. Además de comidas la aplicación puede expandirse a bebidas, cocteles, infusiones, etc.

## Tema y conexión

El proyecto está relacionado directamente con el tema comida.

## Diagrama ER

![diagramaiaw2021](https://user-images.githubusercontent.com/21326227/121816575-d18d1200-cc52-11eb-8226-efa57e0f026f.png)

(El diagrama se encuentra sujeto a cambios en el futuro debido a mejoras, optimizaciones o ideas)

## Actualizaciones a los datos

Tendremos 2 tipos de usuarios: Los administradores y los usuarios normales.

Los usuarios normales podrán:
- Agregar comidas.
- Agregar recetas.
- Agregar ingredientes.
- Agregar contenido faltante a las comidas e ingredientes, por ejemplo ante el caso de que una comida no tenga una foto se permite que los usuarios agreguen una, lo mismo con otros atributos como ubicación o descripción.
- Calificar recetas. Esto hace que los usuarios influyan indirectamente sobre la receta.

Los administradores podrán:
- Crear, modificar o borrar recetas.
- Crear, modificar o borrar comidas.
- Crear, modificar o borrar ingredientes.

## Usuarios por default
La aplicación cuenta con 1 usuario administrador por default cuyas credenciales son:
- mail: agustin_sly@hotmail.como
- contraseña: contrasenia
También se cuenta con 10 cuentas usuario, reemplazar la X por un número del 1-9:
- mail: usarioX@gmail.como
- contraseña: contrasenia

En caso de querer usar un usuario propio se puede crear con el botón "registrarse" en la parte superior derecha de la página.

## Alcances de los roles
Como invitado se puede navegar libremente por la página y acceder a toda la información sobre comidas, recetas e ingredientes. Sin embargo cosas que impliquen agregar o modificar algo de las mismas como agregar una comida o puntuar una receta requieren estar logueado. Si bien los usuarios pueden agregar una descripción/foto/etc faltante a algo que no lo tenga, para modificar algo que ya tenga estas propiedades seteadas se requiere permiso de administrador, por ejemplo modificar la descripción ya seteada de una comida.

## Información del Servicio Web

El servicio web permitirá acceder a información sobre las diferentes comidas, recetas e ingredientes. Podremos acceder a las mismas mediante filtros por ingredientes o directamente el nombre de la comida.

## Visualización y Acceso a la Información

Proyecto Javascript - React/Vue permitira al usuario visualizar informacion de las comidas disponibles en la aplicación de manera interactiva y amigable, permitiendo agregar
filtros de busqueda acerca de comidas o ingredientes. Por ejemplo mostrar unicamente comidas con cierto ingrediente.
