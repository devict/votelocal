# Developing with Docker

These are instructions for running this application locally using docker and docker-compose.

## Configuration

Copy the two configuration files into place (note: `.db.env` is not required for non-docker setup).
- `.env.docker.example` -> `.env`
- `.db.env.docker.example` -> `.db.env`.

If you're looking to test out the **Twilio** and/or **Twitter** integrations locally, you will need to configure the appropriate sections in your new `.env` file.

## Quick Start

```
$ make dev-setup
```

This command will..
- Build containers and install dependencies in them.
- Set the app key in the .env file
- Migrate and seed the database with the initial user.

To run the system..

```
$ make dev
```

This will boot up all containers, and expose the system at http://localhost:8002.

## Ngrok for Twilio Integration

When configuring a number in Twilio, it needs a publicly accessible URL. This is provided locally by the `ngrok` container.

To get the URL for Twilio configurationn, run `./twilio-url.sh`.

For more detail on Twilio configuration check the "Twilio Integration" section of the [README](./README.md).