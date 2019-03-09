# Description

This is a simple project to explain how api and front work together

# Configuration

Launch a shell and get into /api folder. Launch the following command : `make install`

This command will install all composer dependencies + create database + make doctrine migrations + launch server

Your server is now running on `http://127.0.0.1:8000`

If you want to reset the database, you must stop the server with CTRL+C on server tab and use `make reinstall` command

In order to drop database, simply launch `make clean`

# How does it work ?

All routes are defined into `config/routes.yaml`

Services are autowired, which means that you won't have to define them into `config/services.yaml`

Controllers are into `src/Controller` folder

Every services class are into `src/Service`.

# Database

The chosen database is SqlLite.

Entities will be created into `src/Entity` and have their own repository in `src/Repository`

# Services

Services are splitted into multiple states such as Service, Provider, Persister

Service : Contains every actions that is specific to the action and can also use provider and persister

Provider : Only retrieve data from database (SELECT)

Persister : Will make any `write` actions on database such as (INSERT / UPDATE / DELETE), nothing else

# Run the web page

Let's get into `front` folder and open index.html using your web browser

This page will display a form that allows you to register and log in

`Register` button will make an ajax call to api and save it into database

`Login` button will also make an ajax call to api in order to retrieve the user

If anything goes wrong, an error will be displayed.

That's it !
