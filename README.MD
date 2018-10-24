# PHP - Training(Crud)

### Table of Contents
 1. [Description](#description)
 2. [Project Conditions](#project-conditions)
 3. [Project Requirements](#project-requirements)
 4. [Installation](#installation)
 5. [Running](#running)
 6. [Project Structure](#project-structure)
	 - [Model](#model)
	 - [Controllers](#controllers)
	 - [View](#view)
 7. [Comments](#comments)
 8. [Author](#author)

## Description

> **Problem:** The owner of a company asked you to solve a problem that was happening in the company, he wanted to be able to manipulate a task list containing some useful information. A task must have the following information:
> 1. **ID:** Unique task identifier.
> 2. **Name:** Task title.
> 3. **Description:** Brief task description.
> 4. **Deadline:** Deadline for completion
> 5. **Priority:** Priorities were separated into Very High, High, Medium and Low.
> 6. **Completion status:** Done or Ongoing.

This project was developed with the intention of presenting a simple way, but respecting design patterns (MVC, PSR's), to solve the above problem. This project also doen't use frameworks, for greater learning.

## Project Conditions

 - [x] It is not allowed to use any PHP framework.
 - [x] All project content(variables, methods, classes, etc) should be written in English.
 - [x] All project steps should be versioned with GIT.
 - [x] All PHP code should be written using the PSR's(1,2 and 4) as a reference.
 - [ ] All project commits should be written in English.
 - [ ] The project interface should be responsive.

## Project Requirements

- PHP 7+
- MySQL 5+
- Composer
- Bootstrap 4

## Installation

First of all you'll need to **clone** this repo:

    git clone https://github.com/vitor-veras/php-training.git
    
And then:

    composer install

Now you ready to run, but remember to **change your database credentials** inside `lib/config.ini`:
```
[database]
host = 'localhost'
dbname = 'phptraining'
username = 'root'
password = ''
tablename = 'tasks'
```

## Running

Running with PHP built in server(inside project root folder):

    php -S localhost:8000

## Project Structure

```
/src/App
	/Controllers
		Controller.php
		RouteController.php
	/Models
		Model.php
	/Views
		index.htm
```	

## Model

This class uses the configuration file you've set up early to connect and execute SQL queries to DB for task storage manipulation.

**Methods:**

- **connectDB()**

> Connect to the DB using config.ini file.

- **initializeTable()**

> Create a new table if not exists for task storage.

- **showAll()**

> Return all rows into task DB table.

- **show($id)**

> Return a row based on id(*Int*).

- **insert($data)**

> Inserts a new row using the data(*Array*) given.

- **delete($id)**

> Delete a task based on id(*Int*).

- **update($id,  $data)**

> Update a row info using the id(*Int*) and data(*Array*) given.

## Controllers

### Controller.php

> This class the bond beetween Model and View. It handles the user input and then calls Model methods.

**Methods:**

- **sendResponse($statusCode,  $message,  $data)**

> Send a server response to the browser.
> *Params:* 
> - statusCode(*String*) - Ex: '200' or '401'.
> - message(*String*) - Ex: 'Failed to create task'.
> - data(*Array*) - data to be returned as JSON.

- **getErrors($data)**

> Handle form input errors.
> *Params:* 
> - data(*Array*) - data contained on the form.

- **createTask($data)**

> Create a new task.
> *Params:* 
> - data(*JSON*) - Task information.

- **showAllTasks()**

> Return all Tasks.

- **showTask($id)**

> Return a task by id.
> *Params:* 
> - id(*Int*) - Task id.

- **deleteTask($id)**

> Delete a task by id.
> *Params:* 
> - id(*Int*) - Task id.

- **editTask($id, $task)**

> Edit a task by id with the given task data.
> *Params:* 
> - id(*Int*) - Task id.
> - task(*JSON*) - New task data.

- **filter($task)**

> Map priority and status fields to the respective meaning.
> *Params:* 
> - task(*Array*) - Task information.

### RouteController.php

> This file handle browser requests, and then, calls Controller.php methods, based on the action given(*via POST*).

|          ACTION            |       METHOD CALLED        |      DESCRIPTION      | 
| ------------------------- | ----------------- | --------------------- | 
| create                     |       createTask($body)         | Create a new task             | 
| get             |       showAllTasks()         | Show all tasks| 
| getById |       showTask($id)         | Show task info by id            | 
| updateById |       editTask($id,  $body)         | Update task by id  |    
| deleteById |       deleteTask($id)      | Delete task by id  |

## View

## Comments


## Author

* **Vitor Veras de Moura** - [GitHub](https://github.com/vitor-veras) - [LinkedIn](linkedinaqui) - Email: vitorverasm@gmail.com


