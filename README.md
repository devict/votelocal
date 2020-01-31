# Vote ICT

A service for being an informed voter in the Wichita, KS area.

[voteict.org](https://www.voteict.org)

## Primary Goals

- Receive SMS reminders on important voting dates and information
- Provide access to important information on local elections and voting

## Built With..

- Laravel
- Twilio

## Configuration

In addition to the normal Laravel configuration stuff, this application also
needs to set a few things:

- `TWILIO_ACCOUNT_SID` and `TWILIO_AUTH_TOKEN` should be your Twilio account
  credentials, get them from your Twilio Dashboard.
- `TWILIO_FROM_NUMBER` should be the Twilio number that messages are sent out
  from. This must be a number owned by the configured account.
- `TIMEZONE`, defaults to America/Chicago, but should be local to wherever this
  service is used.

## Developing

The recommended way to get the application running locally is to use [Homestead](https://laravel.com/docs/5.6/homestead).

_Note: if you have a global Homestead setup already, these instructions may not
work correctly._

As a quickstart, you can copy `Homestead.yaml.example` to `Homestead.yaml`, and
update the line pointing to where the voteict code is stored locally. For
example, if you installed Homestead into `~/Homestead` and your cloned repo is
in `~/projects/voteict`, you should have a `~/Homestead/Homestead.yaml` file
with a `folders` entry like...

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

Then, run `vagrant up`, and then the site should be available at
localhost:8000. Most commands will need to be run inside the vagrant box, so
do `vagrant ssh` first and `cd` into `~/code`.

```
$ composer install
$ artisan key:generate
$ artisan migrate
$ artisan db:seed
$ npm i
```

- To run tests, run `phpunit`.
- To connect to the database, `mysql homestead`.
- To follow the logs, use `tail -f storage/logs/laravel.log`.

To get Twilio receiving messages locally, use [ngrok](https://ngrok.com) and
point your Twilio number's SMS receive endpoint to the ngrok tunnel URL,
suffixed with the path `/sms/receive`.

To test scheduled messages, you can manually run `artisan schedule:run` from
within the `code` directory inside the vagrant box.

## Design

Interested in helping boost the design of VoteICT? Local designers interested in contributing their ideas, talents, and time to this effort now can! The homepage design and additional brand assets are managed in [a community Figma file](https://www.figma.com/c/file/804929533491978159) for anyone to duplicate and make changes to.

We're open to any ideas that would improve the current state of the VoteICT service; icons, illustrations, or even new pages and additional resources that could be added to the site!

## Getting Involved

VoteICT is a project maintained by part of [devICT](https://devict.org),
Wichita's developer community. To get involved, join the [devICT
Slack](https://devict.org/slack)!

Also feel free to jump into [the
issues](https://github.com/openwichita/voteict/issues)!
