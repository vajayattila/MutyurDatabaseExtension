# MutyurDatabaseExtension
Database extension for Mütyür PHP Framework

# How to setup
- Download Mütyür PHP Framework from this link: https://github.com/vajayattila/MutyurPHPMVC/archive/master.zip
- Extract files from MutyurPHPMVC-master archive folder to your folder
- Download Database extension for Mütyür PHP Framework from this link: https://github.com/vajayattila/MutyurDatabaseExtension/archive/master.zip
- Extract files from MutyurDatabaseExtension-master archive folder to your folder. Overwrite readme.md file.
# Setup config.php
In the application folder you can see these files:
- config.php
- config_database_sample.php

Find the block below in the config_database_sample.php and copy it:
```php
/** @brief database*/
$config['database']=array(
	'database_name' => 'demodatabase.db' //for sqlite database
);		
```
Open the config.php and insert this block into end of the file.

Add dbtest method to routes:
/** @brief routes*/
```php
$config['routes']=array(
	'default' => 'defaultcontroller/index',	
	'test' => 'defaultcontroller/test',
	'dbtest' => 'defaultcontroller/dbtest'	// for database demonstration	
);
```
# Add m_databasedemo member to derfaultcontroller.php.
In the application/controllers you can see these files:
- defaultcontroller.php
- defaultcontroller_database_sample.php

```php
	protected $m_databasedemo; // for database demo	
```
# Load databasedemo extension 
Open the defaultcontroller_database_sample.php. Find and copy this line:
```php
		$this->m_databasedemo=$this->load_extension('databasedemo');	// <- for databasedemo
```
Open the defaultcontroller.php and insert it here:
```php
	public function __construct(){
		.
		.
		.		
		$this->m_databasedemo=$this->load_extension('databasedemo');	// <- for databasedemo
	}
```
# And dbtest method to defaultcontroller.php:
```php
	public function dbtest(){ // <-- for database demonstration
		$dbname=$this->m_databasedemo->get_dbname();
		$result=$this->m_databasedemo->getversion(1);
		echo "Database name is: $dbname<br>";
		echo "DatabaseDemo's version: ".$result['version'][0]['version']."<br>"; // $result['table'][row]['field']
		echo "DatabaseDemo's description: ".$result['version'][0]['partname']."<br>"; 
	}
```
# Modify language files

Add to english.php:
```php
	'STATUS_VERSION_NOTFOUND' => 'Version is not found'	
```
Add to hungarian.php:
```php
	'STATUS_VERSION_NOTFOUND' => 'A keresett verzió nem található'	
```

# Test it
- Start php embed web server in your folder:
```
php -S 127.0.0.1:8001
```
then write to your browser the following url:
```
http://127.0.0.1:8001/dbtest
```
if everyting is good then you can see this:
Database name is: demodatabase.db
DatabaseDemo's version: 1.0.0.0
DatabaseDemo's description: Sqlite Demo Database

Have a look the **application/extensions/databasedemo.php** for learning more!
