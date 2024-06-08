******* XAMPP/MAMP *******
Install XAMPP or MAMP
Place htdocs folder in XAMPP/MAMP folder
Start the services (Apache and MySQL) in XAMPP/MAMP
Hit 127.0.0.1

******* SEED DATABASE *******
To seed database go to localhost/seeders/seed_database.php

Otherwise import sql file included

Once database is seeded, you can login with:
u: admin@company.com    p: password
u: partner@company.com  p: password
u: employee@company.com p: password
u: customer@company.com p: password

******* RUN TAILWINDCSS *******
Remember to install and run tailwindcss:
cd into the tailwindcss folder and run:
> npm install tailwindcss 
then run:
> npx tailwindcss -i ./input.css -o ../app.css --watch