# Task APP API Development with PHP and MySQL

[এই প্রজেক্টটি করার জন্য এবং জমা দেওয়ার আগে অবশ্যই প্রজেক্টের লাইভ ক্লাসটি দেখুন।]


Database Structure:

Database Name: task_api

Table Name: tasks

# tasks Table Structure:

id: INT, AUTO_INCREMENT, PRIMARY KEY

title: VARCHAR(255), NOT NULL

description: TEXT, NULL

priority: ENUM('low', 'medium', 'high'), DEFAULT 'low'

is_completed: TINYINT(1), DEFAULT 0

created_at: TIMESTAMP, DEFAULT CURRENT_TIMESTAMP

updated_at: TIMESTAMP, DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP

API Features:

GET /tasks

Retrieve all tasks.

Respond with a message if no tasks are available.

GET /tasks/{id}

Retrieve a specific task by its id.

Return 404 if the task does not exist.

POST /tasks

Create a new task.

Required fields: title.

Optional fields: description, priority.

Validate that priority matches one of the following: low, medium, high. If not, return an error.

PUT /tasks/{id}

Update a task by its id.

Fields: title, description, priority, is_completed.

Return 404 if the task does not exist.

DELETE /tasks/{id}

Delete a task by its id.

Return 404 if the task does not exist.
