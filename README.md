# Comserva v@0.0.1 Application Starter

## ¿Que es Comserva?
Aplicación de control, para la captura de los registros de los RHPS que se registran tras las visitas de los clientes.

Procesamiento de la información:        
---

* Clientes:  
    - Listar los clientes   
    - Definir las rutas para el conductor  
    - Ingresar los municipios   

* Los Vehiculos:  
    - Ingresar el funcionario y conductor  

* RHPS:  
    - Vehiculos en ruta  
    - Rutas  
    - Recolecciones Residuos  


Requerimientos Del Usuario:
---

* Aplicativo apk para la captura de los RHPS.  

* Desarrollo de aplicativo central de escritorio para el procesamiento de los datos básicos y generación de reportes y procesos relacionados.  

* A la Hora de sincronizar los datos se debe tener encuenta la fecha de creación de los recursos. Para evitar el reprocesar la información.


```sh
php spark serve --host 0.0.0.0 --port 8001

php spark migrate

php spark db:seed ForeingKeys
php spark db:seed SysSidebar
php spark db:seed Roles
php spark db:seed Paises
php spark db:seed Departamentos
php spark db:seed Municipios
php spark db:seed Cargos
php spark db:seed TiposIdentificacion
php spark db:seed Usuarios
php spark db:seed RolesUsuarios
php spark db:seed Zonas
php spark db:seed ZonasMunicipios
php spark db:seed Empleados
php spark db:seed CargosEmpleados
php spark db:seed Vehiculos
php spark db:seed Clientes
php spark db:seed TipoResiduos
php spark db:seed Recoleccion
php spark db:seed Rhps
```

## Docker Compose With Mysql and php74  
```yml
version: "3.3"
services:
  mysql57:
    image: mysql:5.7
    container_name: mysql57
    restart: always
    ports:
      - 3306:3306
    environment:
      MYSQL_ROOT_PASSWORD: "8912"
      MYSQL_DATABASE: "db_test"
      MYSQL_USER: "admin"
      MYSQL_PASSWORD: "8912Elegro"
    volumes:
      - ../../mysql/schemas:/var/lib/mysql:+rw
    networks:
      comserva_net:
        aliases:
          - mysql57
  comserva:
    build:
      context: ./
      dockerfile: php.dockerfile
    container_name: Comserva
    restart: always
    ports:
      - 9002:8001
    volumes:
      - ./app:/var/www/html:+rw
      - ./config:/usr/local/etc/php
    networks:
      - comserva_net
    depends_on:
      - mysql57
    command: [ "php", "spark", "serve", "--host", "0.0.0.0", "--port", "8001"]
volumes:
  app: {}
  config: {}
  schemas: {}
networks:
  comserva_net:
    driver: bridge
    ipam:
      driver: default
```