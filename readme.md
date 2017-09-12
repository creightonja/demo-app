# Initial Setup

Originally configured on [Virtualbox](https://www.virtualbox.org/wiki/Downloads) 5.1.22 and [Vagrant](https://www.vagrantup.com/) 1.9.5.
NOTE:  These versions of Virtualbox and Vagrant are hard requirements. This won't work on older versions.
You'll need [Git](https://git-scm.com/downloads) and [Composer](https://getcomposer.org/download/) installed before beginning configuration. Composer requires a php runtime, so you'll need to have php installed on your system as well and point Composer to it. 

Windows Users: [Laragon 3.1](https://laragon.org/) provides most of the needed runtime.

To set up the app:

 * Clone down the repo to a folder of your choice *NOTE: Make sure there are no spaces in your path*
 * Check your id keyfiles exist (youruser/.ssh/id_rsa.pub and youruser/.ssh/id_rsa)
 * If they don't, run ```ssh-keygen -t rsa -C "youremail@email.com"``` (defaults should be fine)
 * Copy Homestead.yaml.example to Homestead.yaml and configure the file paths to match your system
 * Copy the ```.env.example``` file to ```.env``` and update the configuration to match your environment.
 * Now we have to ```composer install``` to pull in the homestead box and the rest of our backend dependencies
 * Once that's done, ```vagrant up```
 * Add the hosts entry for the server IP and url you set in your Homestead.yaml
 * Run ```php artisan key:generate``` to generate your app key
 * You should now be able to go to the url of the app it see the homepage! (default: clincierge.dev)


To access, your VM, ```vagrant ssh``` from within the project folder.

Once that's done, we need to install our frontend dependencies. Still in the project folder, run ```yarn install```. If you have problems using [Yarn](https://yarnpkg.com/en/docs), you can also use ```npm install``` instead. We're going to try to yarn since it's better (it includes a composer-style lock file, for example), but it's new so if we have too many issues we can just use npm. Note that on windows, both npm and yarn seem to have issues with symlinks. When adding a package via yarn add or when doing yarn install, try adding the  ```--no-bin-links``` parameter to your command if you get a symlink error. Ex. ```yarn add font-awesome --no-bin-links```.

# Development
### Frontend Workflow
#### CSS
We use sass on this app which gets compiled into one app.css file. If you want to include a sass file, include it in ```resources/assets/sass/app.scss```. We have also included [Bulma](http://bulma.io/documentation/grid/columns/), a flexbox css framework. It includes components for most  elements, so always use the Bulma component if one exists. Also make sure to adhere to Bulma's column/row structure (it's very simple).

To compile your sass, use ```npm run dev```. To monitor your sass for changes and automatically re-compile, use ```npm run watch```. If you're running it in the VM and "watch" isn't updating, you may need to use ```npm run watch-poll``` instead. 

NOTE: if your compiliation errors out with some type of file/directory not found error, it may be that your VM and local machine directories are out of sync. Run
```
npm rebuild node-sass --no-bin-links
```
to fix.
#### JS
Like CSS, all JS on the project is compiled down into one ```app.js``` file.

We have included Vue to handle frontend UI behavior. Components are located in the ```resources/assets/js/components``` folder. Refer to the [Vue documentation](https://vuejs.org/v2/guide/) for how to write your components. For the most part, we'll want to use components for any dom behavior. I'd like to avoid using jQuery, but there are cases where Vue is overkill. Let's fallback to vanilla JS, [Axios](https://github.com/mzabriskie/axios), and [lodash](https://lodash.com/docs/) for those cases and see how it goes.

To compile your components, use ```npm run dev```. To monitor your components for changes and automatically re-compile, use ```npm run watch```. If you're running it in the VM and "watch" isn't updating, you may need to use ```npm run watch-poll``` instead. 

Most of the time, you'll just have ```npm run watch``` running while you're working on the project and it will ensure your CSS and JS changes are compiled as needed.

### Mail
The default mail configuration in the .env file is for Mailhog, which is included on your VM. You can go to ```clincierge.dev:1025``` (or whatever URL you have the project on) to see any mail sent with the application.

### Tunneling URL for your homestead machine
Sometimes, it can be handy to be able to send someone a link to view your local copy of the app, which lives on your homestead VM. Homestead offers a way to do this easily through ngrok.

SSH into your Homestead machine via ```vagrant ssh``` and run ```share clincierge.dev```. This will share the clincierge.dev site from your Homestead.yaml configuration file.

After running the command, you will see an Ngrok screen appear which contains the activity log and the publicly accessible URLs for the shared site. You can send this URL to anyone to let them access your local copy of clincierge.

### Connecting to the database
For now, we don't have any database GUI installed on the VM. If you have a GUI program you'd like to use, you can connect it to the VM. Connect to ```127.0.0.1``` and port ```33060```. The username and password for both databases is ```homestead``` / ```secret```.

### Database Seeding
To seed the database with dummy data:
```php artisan dummy-data:all```

There's also a utility command for completing reseting the database and then re-seeding with the dummy data:
```php artisan reset-database```

#### Seeded Accounts
* admin@clincierge.dev / password
* all other seeded accounts use the password `secret` with auto-generated username emails

## Visit Tasks Management System
Each Patient Visit will have an associated list of tasks.  These can include 'book flight', 'send reminder', etc.  Each task has can be done in an automated or manual fashion.  If automated, a job will be dispatched onto the Laravel job queue for processing.  If manual, the user clicks a link to go to the specific task type CRUD.

To implement a new task in the codebase follow the example of Book Flight already in the codebase.  You'll need to create:
  - Task class (app/Jobs/VisitTasks/BookFlight.php) - This is a Laravel job class that has extra information to point to the manual CRUD if needed
  - CRUD for the Task resource (Flight model, Flight controller, Flight routes) 

Once those are done, go to the Tasks view for a particular visit, e.g. clincierge.dev/visits/1/tasks.

Click Add Task to create a new one. The Task Type dropdown menu will read from the app/Jobs/VisitTasks directory and pick up the existing task types.  Select one and fill out the other fields.

From the Task index view, you can start an automated task or click to go to the manual CRUD.  

## Automated Task Jobs

We're using Laravel's [Job Queue](https://laravel.com/docs/5.4/queues) feature to handle our automated tasks.

For ease of development, we're using the database as a queue.  We may eventually switch to a dedicated queue system such as Redis or Amazon SQS. Set your ```.env``` to use the database for a queue
```
QUEUE_DRIVER=database
```

To start a queue worker to process jobs on the queue go to your application root directory and run
```
php artisan queue:work --tries=1
```

Then on the task index page, under 'Automated Job Status', click start on a Book Flight task.  The BookFlight job will be dispatched to the queue and processed.  If successful, a Flight will be created in the 'flights' table and statuses will be updated accordingly.

*NOTE:*  when running dummy-data:all, you may run into class not found issues.  If so, run
```composer dumpauto```
Also, when updating Laravel job code, you must restart the queue worker, (Ctrl-C and the queue:work) to run the updated code.

### Integrations

#### Deltek

If you need to use the Deltek UI, the [Windows 10 Evaluation VM](https://developer.microsoft.com/en-us/windows/downloads/virtual-machines) is a better experience than the [Edge VM](https://developer.microsoft.com/en-us/microsoft-edge/tools/vms/).

A new set of `.env` entries should be made for use w/ Deltek

```
DELTEK_DB=
DELTEK_USER=
DELTEK_PASSWORD=
DELTEK_ENDPOINT=
```

- - - -
#### WARNING: do not run this command until you are sure the credentials are entered, Deltek likes to disable your login after a few failed attempts 
After setting those up you can run `php artisan deltek:verify-credentials` 
- - - -


### Flash Notifications 
We're using the [laracasts/flash](https://github.com/laracasts/flash) package from the venerable Jefferey Way. 

The package injects a 'flash' function into the global name space that you can use in your controllers.  The template has been mofied to use [Bulma notification styling](http://bulma.io/documentation/elements/notification/).  To use, right before you return from a controller call flash with your message and the message type:
```PHP
flash('Patient updated!', 'success');
return redirect()->route('patients.show', $patient->id);
```
or
```PHP
flash('The update failed', 'warning');
```
You can flash as many messages as needed and they will all display on the next view.

The notification HTML is included in the default layout so it will show for all views that use it.  The actual template is in ```Flash message template in resources/views/vendor/flash/message.blade.php``` if it needs to be tweaked.
 
### Error Notifications 
Form validation error display code is included in the default layout with the _errors.blade.php partial.

## Testing

### Functional and Unit
We are using Codeception for Functional and Unit testing.  Some relevant urls:
(http://codeception.com/docs/01-Introduction)
(http://codeception.com/docs/04-FunctionalTests)
(http://codeception.com/docs/modules/Laravel5)

#### Codeception setup
make a .env.testing file for Codeception tests to pick up.
```
cp .env .env.testing
``` 

All functional tests are in tests/functional and unit tests are in tests/unit

Note, Dusk also has unit tests and shares the same tests/unit folder.

#### Running tests
To run all tests
```
vendor/bin/codecept run
```

Append 'unit', 'functional' or 'acceptance' to the above command to only run those.

#### generate new test templates
Unit test
```
vendor/bin/codecept generate:cest unit Example
```

Functional test
```
vendor/bin/codecept generate:cest functional Example 
```

### Browser/Acceptance
We are using Laravel Dusk introduced in 5.4 for browser/acceptance testing. 

#### Adding dependencies to VM
The dependencies necessary for Dusk automated testing have been added to the Vagrantfile.  To provision, run
```
vagrant reload --provision
```
which reboots your vm and runs provisioning.

#### Running tests
Since the vm is headless we'll need to run an in memory headless display server, Xvfb
```
Xvfb -ac :0 -screen 0 1280x1024x16 &
```

All browser tests are in tests/Browser/ 
To run them all: 
```
php artisan dusk
``` 

#### Creating new tests
{ stub: fill out later }

## Form Model binding
To make view creation easier and get goodies like displaying user input upon form validation errors, we're trying out the [LaravelCollective package](https://laravelcollective.com/docs/5.4/html) and applying it to the Studies create and edit pages.

Take a look at ```resources/views/studies/create.blade.php``` and ```edit.blade.php``` for example usage.

These are using Custom components which are intialized in ```app/Providers/HtmlServiceProvidor.php```.  

The general format for a component is 
```
Form::component('component name', 'template location', [ template variables array] )
```

Note:  for some vue components, special data processing is necessary to display old user input.  See StudyController#processValidationErrors() for example.

## Timezone handling in application
To ensure correct times across timezones, we'll save all time data (except Laravel DB timestamps) in UTC.  This involves accepting user time inputs in their local timezone, converting it to UTC to save to the database and when displayig times, take the UTC time in the database and convert it back to local time.  To achieve this we've implemented the `App\Libraries\TimeZone` class and we'll use [Laravel Accessors and Mutators](https://laravel.com/docs/5.4/eloquent-mutators#accessors-and-mutators) on time related model attributes.  All datetime attribues will be converted to Carbon objects.

See the Visit and Flight CRUDS for examples.

# Deployment
For now, sites are spun up using laravel forge. Currently, the version of ubuntu used on them experiences [this issue](https://askubuntu.com/questions/761885/kswapd0-use-100-cpu). Updating didn't seem to help, so for now each is running a cron every 15 minutes (on the root user) which executes ```echo 1 > /proc/sys/vm/drop_caches```. This seems to solve the issue for now, but if the server is acting up you can run the command manually, and eventually we'll want to apply some updates to fix it altogether.
