How To run this Application 
------------------------------


1) Unzip folder 

2) In root directory run  

   $ composer install 

3) In root/frontend directory run (optional)

   $ npm install 

4) In root/docker-compose directory run (Before this install docker in your system refer this link for intallation on linux  https://www.digitalocean.com/community/tutorials/how-to-install-and-use-docker-on-ubuntu-18-04
for windows refer this https://docs.docker.com/docker-for-windows/install/ )

   $ docker-compose up --build -d 

5) Import Database in mysql using following command :

   $ docker exec -i dockercompose_mysql_1 mysql -u root -p  admin --database admin < admin.sql

   (admin.sql is at root folder)

   Note : For mysql username and password refer docker-compose.yml file or common/config /database.php file 

6) Now access the backend using following url :

   http://localhost:4003/site/login

   username :admin@test.com
   password :password

 7) Now access the frontend using following url :  

    http://localhost:4204/login


   

