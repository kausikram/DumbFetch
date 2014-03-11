### DumbFetch

cause its absolutely dumb to rewrite a simple dump and fetch system over and over again. 
DumbFetch is a PHP,MySQL app into which you can dump data and then on a later date list it so that you can perform analysis on it.

It is quick as of now and very light. (again as of now).

#### How To Use it

* Clone DumbFetch from github into a folder.
* Create a database in MySQL and configure the database connection from config.php
* Add your favourite securing mechanism on the /secure/ folder.
* Visit secure/build_service.php?service=<service_name> to create a bucket into which data has to be thrown.
* Hit /?service=service_name&api_key=api_key&data1=data1&data2 ...to dump some value into the bucket.
* Visit /secure/view.php?service=service_name&keys=data1 to view data.

#### License
DumbFetch is [MIT]() Licensed. feel free to do whatever you want to do with it.



 
