
## CRON JOB scheduler to backup Mysql DB on google Drive

Below is the key which is need to upload any file on google drive

- GOOGLE_CLIENT_ID=371200431869-xxxxx.apps.googleusercontent.com
- GOOGLE_CLIENT_SECRET=GOCSPX-xxxxx-Mj4TNpx1LV
- GOOGLE_DRIVE_REFERSH_TOKEN=1//04peC791YMYO7CgYIARAAGAQSNwF-L9Irn5Dj5jNC5cZyxwyUEbf74a2xfS-xxxxx-xxxY
- GOOGLE_DRIVE_FOLDER_ID=1lbxxxoG09cAF-xxxxxxx

Below file need to created to stored the mysql password in our system
- DEFAULT_FILE_MYSQL_PASSWORD="/home/rishi/Desktop/.my.cnf" Please used your user name instead of "rishi" and avoid to create this config file with sudo permission

.my.cnf                                                            
[mysqldump]
password=root@1234

CrontTab -e file
Download at 1 am (IST) and upload at 3 am (IST)
* * * * * php /var/www/html/project-name/artisan schedule:run (Please have a look in kernel.php)
30 21 * * * php /var/www/html/project-name/artisan queue:listen

## REST API of https://docs.spacexdata.com

End Point: api/v1/launches?number_of_record=2&page_number=2

Query params is optional 
1. number_of_record
2. page_number

You can host any of your hosting server AWS/Heroku
Steps are 
1. Upload your file to server with githubs or filezilla
2. Upload you .env file with correct permission and keys
3. Point to correct domain name 
4. Server can we used Apache/Nginx
5. Database can we used RDS


## Organization Employee System database schema

All Employee schema and migration are in this project 

<p align="center"><img src="https://drive.google.com/file/d/19aC22eVU5MRHVDChbzvJ8EyjWwVRHqy0/view?usp=sharing"> </p>

## Challenging modules

All the task is completed are somewhat challening and intersted

To take Backup of mysql and upload to drive was somewhat challenging and get to learn many new thing into it.
