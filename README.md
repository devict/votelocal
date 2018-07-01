# Vote ICT

A service for being an informed voter in the Wichita, KS area.

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

The recommended way is to use [Homestead](https://laravel.com/docs/5.6/homestead).

To get Twilio receiving messages locally, use [ngrok](https://ngrok.com) and
point your Twilio number's SMS receive endpoint to the ngrok tunnel URL,
suffixed with the path `/sms/receive`.

To test scheduled messages, you can manually run `php artisan schedule:run`.

## Contributing

Jump into [the issues](https://github.com/openwichita/voteict/issues)!
