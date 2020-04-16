# startng-php-task2
The objective of this task was to follow the instructor's steps to build an online PHP based website and add some extra features to the site.

## Description

Following the tutorial series PHP Intro - Building Authentication System on youtube, implement the following components:

Register

Login

Logout

Dashboard

On your registration, in addition to the validations shown in the video, you must validate for:

Correct Name 

Name should not have numbers

Name should not be less than 2

Name should not be blank

Email

Email must be valid email

Email must not be empty

Email must not be less than 5

Email must have @ and . in it

On Login, your login should:


Be validated as done on the tutorial series

Must redirect users to different pages based on their Access level

User login time, and date must be recorded

On Dashboard, in addition to all that was implemented on the tutorial:


User Access Level, Department, date of registration, and date of last login should be shown

Super Admin should be able to add other users

## Additional Functionalities
User should be able to reset their password 
Your code should be refactored to use functions as shown in the tutorial series
Add CSS styling to your code using bootstrap as shown in the video
In addition to the above, implement the following:
A patient should be able to book appointment with a Medical Team. 
After patient sign in, patient should see 2 options on their dashboard (in addition to all the information displayed on the dashboard from task 1), the 2 options are: 
Pay Bill
Book Appointment
Pay Bill should lead to a blank page for now
Book Appointment should allow the patient fill a form to book appointment with the medical team the following form fields are required (you can add more)
Date of appointment
Time of appointment
Nature of appointment
Initial complaint
Department they want to book the appointment for
A medical Team member should be able to:
View all appointments in their own department (if no appointment, they should see : "you have no pending appointments")
See patient details including the following (you can add more)
Patient Name
Date of appointment
Nature of appointment
initial complaint
The medical director (super admin) should be able to do the following:
View all staff
View all patients


### How to run
Folow these steps to run and test the code locally
1. Clone the repo to your local machine by pasting and running `git clone https://github.com/dejiabiola/startng-php-task2.git` on the command prompt.
2. Put the folder inside the htdocs directory of your web server (WAMP, XAMPP, etc).
3. Start up your web server.
4. Open your browser and visit localhost.


## Test Mail Service
This project uses phpmailer for sending emails.
There are two files where sending emails is part of the algorithm process. These are: 
- processreset.php
- processforgot.php

To receive the email, you can open an account on an smtp service like (mailtrap)[https://mailtrap.io/], then enter into each of the two files and tweak the following configurations to the one provided to you from mailtrap:
- $mail->Username   = '38a70c6d5e5842';
- $mail->Password   = '9ce9389295adda'; 


