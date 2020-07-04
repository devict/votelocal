# Developing with Homestead

There are instructions for running VoteICT locally using [Homestead](https://laravel.com/docs/5.6/homestead).

_Note: if you have a global Homestead setup already, these instructions may not work correctly._

As a quickstart, you can copy `Homestead.yaml.example` to `Homestead.yaml`, and update the line pointing to where the voteict code is stored locally. For example, if you installed Homestead into `~/Homestead` and your cloned repo is in `~/projects/voteict`, you should have a `~/Homestead/Homestead.yaml` file with a `folders` entry like...

```
folders:
    - map: ~/projects/voteict
      to: /home/vagrant/code
```

Add an `/etc/hosts` entry for...

```
192.168.10.10 homestead.local
```

Within your repo, `cp .env.example .env`.

Then, run `vagrant up`, and then the site should be available at localhost:8000. Most commands will need to be run inside the vagrant box, so do `vagrant ssh` first and `cd` into `~/code`.

```
$ composer install
$ artisan key:generate
$ artisan migrate
$ artisan db:seed
$ npm i
```

- To run tests, run `php artisan test`.
- To connect to the database, `mysql homestead`.
- To follow the logs, use `tail -f storage/logs/laravel.log`.