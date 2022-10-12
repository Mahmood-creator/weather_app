# About project

This is a todo project.

# Feature of project

In this project User can register and login with email,password.<br>
User can create/edit/view/list/remove (CRUDL) to-do list on his account<br>
User able to create/edit/view/list/remove (CRUDLS) task(task is created to inside of to-do.Each to-do has multiple task)<br>
User cannot access to-do/task list of other users<br>
Project include some feature tests<br>
Added ability to upload files/images for task<br>
Added ability to download pdf todos files<br>


## Setup
- `git clone git@github.com:Mahmood-creator/todo-app.git`
- `cd todo-app`
- `docker-compose up -d`
- `docker exec todo-app-todo-app-1 composer install`
- `cp .env.example .env`
- `docker exec todo-app-todo-app-1 php artisan key:generate`

Now that all containers are up
