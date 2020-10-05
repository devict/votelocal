# Developing with Docker

These are instructions for running this application locally using docker and docker-compose.

## Configuration

Copy the two configuration files into place (note: `.db.env` is not required for non-docker setup).
- `.env.docker.example` -> `.env`
- `.db.env.docker.example` -> `.db.env`.

If you're looking to test out the **Twilio** and/or **Twitter** integrations locally, you will need to configure the appropriate sections in your new `.env` file.

Laravel requires `storage` and `bootstrap/cache` directories to be writeable by `www-data`. Depending on your environment there may be several ways to accomplish this. One method is:
```
$ sudo chgrp -R www-data storage bootstrap/cache
$ chmod -R g+w storage bootstrap/cache
```

## Quick Start

First start your containers.

```
$ make dev
```

In a separate terminal, run the setup command.

```
$ make dev-setup
```

This command will..
- Build containers and install dependencies in them.
- Set the app key in the .env file
- Migrate and seed the database with the initial user.

The system should now be accessible at http://localhost:8002

## Ngrok for Twilio Integration

When configuring a number in Twilio, it needs a publicly accessible URL. This is provided locally by the `ngrok` container.

To get the URL for Twilio configurationn, run `./twilio-url.sh`.

For more detail on Twilio configuration check the "Twilio Integration" section of the [README](./README.md).
