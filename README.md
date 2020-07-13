# Vote Local

A service for being an informed voter in the South Central KS area.

[votelocalks.org](https://www.votelocalks.org)

## Primary Goals

-   Receive SMS reminders on important voting dates and information
-   Provide access to important information on local elections and voting

## Built With..

-   [Laravel](https://laravel.com/docs/5.7)
-   [Twilio](https://twilio.com)
-   [Tailwind CSS](https://tailwindcss.com/)

## Configuration

In addition to the normal Laravel configuration stuff, this application also needs to set a few things:

-   `TIMEZONE`, defaults to America/Chicago, but should be local to wherever this service is used.
-   `TWILIO_ACCOUNT_SID` and `TWILIO_AUTH_TOKEN` should be your Twilio account credentials, get them from your Twilio Dashboard.
-   `TWILIO_FROM_NUMBER` should be the Twilio number that messages are sent out from. This must be a number owned by the configured account.
-   `TWITTER_*` config values should be filled in using details from an app in the [Twitter Developer](https://developer.twitter.com/en/apps) portal.
    -   Twitter integration is optional. If the config values are not set, the application will simply not attempt to send messages out as tweets.
-   `GOOGLE_CIVIC_API_KEY` should be an API key setup through the [Google Developer](https://console.developers.google.com) portal. Your API project should have the [Google Civic Information API](https://console.developers.google.com/apis/library/civicinfo.googleapis.com) enabled.
    -   Google Civic Info integration is optional. If this config value is not set, the application will simply not search for local representatives.

## Developing

There are currently two ways of running Vote Local locally.

-   [Docker](./DOCKER.md)
-   [Homestead](./HOMESTEAD.md)

### Twilio Integration

To get Twilio receiving messages locally, use [ngrok](https://ngrok.com) and point your Twilio number's SMS receive endpoint to the ngrok tunnel URL, suffixed with the path `/sms/receive`.

_Note: if you're using docker for local dev, there is already an `ngrok` service running. Check [the docker docs](./DOCKER.md) for more detail._

To test scheduled messages, you can manually run `artisan schedule:run` from within the `code` directory inside the vagrant box.

### Twitter Integration

Sending messages to a Twitter account from a local setup requires having a Twitter [developer account](https://developer.twitter.com/) and a [Twitter app](https://developer.twitter.com/en/apps) configured on that account.

Twitter messages will automatically be sent out to an account if the necessary Twitter config values are filled in in your `.env` file. Check the "Configuration" section above for more information.

## Design

Interested in helping boost the design of Vote Local? Local designers interested in contributing their ideas, talents, and time to this effort now can! The homepage design and additional brand assets are managed in [a community Figma file](https://www.figma.com/c/file/804929533491978159) for anyone to duplicate and make changes to.

SVG icons are located in `/resources/svg`. Use `<x-icon-filename-of-icon />` within a blade template to render an icon. Most of the icons in this project are provided by the [Eva Icons](https://akveo.github.io/eva-icons) set.

We're open to any ideas that would improve the current state of the Vote Local service; icons, illustrations, or even new pages and additional resources that could be added to the site!

## Getting Involved

Vote Local is a project maintained by part of [devICT](https://devict.org), Wichita's developer community. To get involved, join the [devICT Slack](https://devict.org/slack)!

Also feel free to jump into [the issues](https://github.com/devict/votelocal/issues)!
