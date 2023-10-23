# RxAnte Software Engineer Coding Test

This test is to help us get an understanding of how you work, how you write code, and how you think about code. This little sample app is very bare-bones. For simplicity’s sake, it has no authentication or assumption of a user. It’s essentially a one user, unprotected app, and only meant to be run locally.

The goal here is to create a “notes” feature in this app. The UI has already been designed, so your job is to get it into an interactive set of pages in Next/React, and get PHP api endpoints responding to requests that Next/React sends to it.

There are no tricks or gotchas in this project and no loopholes to jump through. You shouldn’t run into anything unexpected. It’s a simple, straight-forward feature add. There are no intentional errors for you to find and fix. If you run into trouble, please do let your contact at RxAnte know.

## Getting Local Env Up and Running

_(Note, while this Docker environment may run on Windows with some slight modifications, and will almost certainly run on various flavors of Linux, this has been put together and tested on a Mac running macOS Ventura 13.6. If you’re using Windows or Linux and run into any trouble, your RxAnte contact will be happy to work with you as much as possible to see if this environment can be run on your system)_

You will need the following on your computer to run the environment:

- [Docker Desktop](https://www.docker.com/products/docker-desktop/)
- [Node 18 or later](https://formulae.brew.sh/formula/node#default) (for running the local CLI)
- [Yarn](https://formulae.brew.sh/formula/yarn#default) (tested with 1.22.19) (for running the local CLI)
- [md5sha1sum](https://formulae.brew.sh/formula/md5sha1sum#default) (for running the local CLI)

1. Clone this repo to your local computer
2. In your favorite terminal app, CD to the cloned repo on your disk and run `./dev docker up`. This should run all the provisioning and the Docker build so the first time will take a minute.
3. After the environment is online, run `./dev docker container api php cli schema:up`
4. You can now go to http://localhost:55782/ and play around with the ToDo feature of the app.
5. Also note if you need to access the PHP API URL directly, the base URL is http://localhost:55781/. So, for instance, if you want to see the JSON of the TODO list the API returns, go to http://localhost:55781/todos

## Working on the feature

### Design

You will find the static front-end design for this feature in `web/app/design/new-feature-notes`. And when the app is running, you can view the design at the following URLs:

- http://localhost:55782/design/new-feature-notes/01-notes-list-empty
- http://localhost:55782/design/new-feature-notes/02-notes-list
- http://localhost:55782/design/new-feature-notes/03-note-view
- http://localhost:55782/design/new-feature-notes/04-add-note-overlay

### Dev

Use the existing ToDo feature as your guide for adding the Notes feature. They are similar in many ways.

Here’s also a couple hints since, if you’re working on a team, you’d have access to someone to tell you where things are in an unfamiliar codebase:

You’ll need to create some schema to persist your notes, so you’ll want to create a class that does that and then include it and run it in `\SoftwareEngineering\Persistence\CreateSchemaCommand`

And you’ll also need to add a tab to the navigation to access the new notes feature. You’ll find the code that generates the navigation in `web/app/Nav.tsx`.

Your RxAnte contact is also available to help show you around a little if you get stuck, or, if, for some reason, getting the environment up and running doesn’t work.

### Process

1. Clone this repo down to your local computer
2. Create your own private repository
3. Change the `origin` URL of the cloned repo on your computer to your new private repository
4. As you work on the feature, push your updates to a new branch so you can open up a PR against main that we can look at
5. Invite your RxAnte contact as a collaborator on the private repo, and assign them to the PR for review when you’re ready
