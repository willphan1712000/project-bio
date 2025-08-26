# What is this project about?

- This project is for people to share their information as digital business card
- This project also provides templates and design tools for users to freely customize their template

> [!IMPORTANT]
> For design tools, this is another project in the future

# Below is how it works

- user registers their own accout
- user logs in to their account
- user is able to put their links to boxes in the admin page
- user hits "save" button to save everything on server
- after this, it will go back to user page to view main bio page

# Our mission

## is to integrate advanced technology to the bio web application to make it more capable of making our customers feel satisfied and safe to use our application

# CODE NOTES

- The database we implement does not use any foreign key constraints for scalability and modification reasons. Read this article for more information https://planetscale.com/docs/vitess/operating-without-foreign-key-constraints

- This project uses DOCTRINE ORM to do CRUD operations through Entity Manager

> [!NOTE]
> We also create an abstraction layer for Entity Manager (or a wrapper over Entity Manager) called Database that helps do CRUD operations easier

- Model Migration

```linux
./vendor/bin/doctrine-migrations diff && ./vendor/bin/doctrine-migrations migrate
```
