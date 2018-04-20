#Q/A app made with Laravel and the Artisan Console
The purpose of the exercise is to see how comfortable you are with a Laravel based interactive console app. i
We have done a bit of work for you. If you fork this project, and run `php artisan qanda:interactive`, the command will be started. In this command, create an event loop and implement the following features:

- The initial interaction should allow you to choose between adding questions and answers and viewing previously entered answers.

- Upon choosing the option to add a question, the user will be prompted to give a question and the answer to that question.
- Upon giving a question and answer, this must be stored in the database. Use migrations to create the DB tables.

- Upon choosing to view the questions, the user will be prompted to choose from the previously given questions which one he wants to practice.
- Upon choosing to practice a question, the user must fill in the right answer for the question, which will be checked against the previously given answer.

