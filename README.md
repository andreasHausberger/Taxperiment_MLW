# Taxperiment_MLW
A tax experiment using the MouselabWEB interface. 

## Getting Started

After initialising a web server and copying/cloning the project to its root folder, the top level index.php file should be visible in browser. 


### PHP Runtime: 

Make sure your PHP runtime is at least 5.3. Later versions should work fine, earlier ones may not. 

### Database Setup: 

The project uses a standard MySQL database connection to write/read/export data. 

#### Initial setup: 
* resources/config.php. Here you can enter your database credentials at the specified line. 
* public/exp_config.php. Make your this file is executed before every experiment. It also calls the syntax to set up all required tables if none exists. To see whether all tables were set up, check the output in the browser console.  


## Structure
The project uses a standard PHP project structure. 

### Top Level

* index.php: Homepage. This is shown when the standard url is entered.
* download.php: Downloads page. It works together with datalyser.php to facilitate data download.
* datalyser.php: Helps download.php. Do not change.


### /public
Includes all files that are visible to the participants. 
* css, img, js: Include all helper files (js is empty as of now).
* include: Includes all content files. 
* templates: Includes all partial website blocks that are reusable (such as header, footer, ...). 

### /resources
Includes all additional resources, external libraries (such as Mouselab WEB) and reusable templates.
