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

First, you'll need to run `composer install` to install our dependencies.

The recommended way to get the application running locally is to use [Homestead](https://laravel.com/docs/5.6/homestead).

Mainly, run `vagrant up`, and then the site should be available at
localhost:8000. Most commands that you will need run will need to be run inside
the vagrant box, so do `vagrant ssh` first and `cd` into `~/code`.

```
$ artisan migrate
$ artisan db:seed
```

- To run tests, run `phpunit`.
- To connect to the database, `mysql homestead`.
- To follow the logs, use `tail -f storage/logs/laravel.log`.

To get Twilio receiving messages locally, use [ngrok](https://ngrok.com) and
point your Twilio number's SMS receive endpoint to the ngrok tunnel URL,
suffixed with the path `/sms/receive`.

To test scheduled messages, you can manually run `artisan schedule:run` from
within the `code` directory inside the vagrant box.


## Getting Involved

VoteICT is a project maintained by [Open Wichita](http://openwichita.org), a
part of [devICT](https://devict.org), Wichita's developer community. To
get involved, join the [devICT Slack](https://devict.org/slack) and join the
[#openwichita channel](https://devict.slack.com/messages/C4KJ8FL4A/).

Also feel free to jump into [the issues](https://github.com/openwichita/voteict/issues)!
