# What is this project about?

- This project is for people to share their information as digital business card
- This project also provides templates and design tools for users to freely customize their template

# Why do we develop this project?

- Replace physical business card with digital version to reduce print waste to the environment
- Make networking to the next level
- Give users more convenient way to update their information

> [!IMPORTANT]
> For design tools, this is another project in the future

# Below is how it works

- User registers their own accout
- User logs in to their account
- User is able to put their links to boxes in the admin page
- User hits "save" button to save everything on server
- After this, it will go back to user page to view main bio page

# Backend Development

## API Management

- First, every database has tables and every table has rows (record) and columns (features or attributes)
- REST API routes should follow the following api schema

| Route | API prefix | table   | id1     | id2         | ... |
| ----- | ---------- | ------- | ------- | ----------- | --- |
| User  | /api       | /users  | /id     |
| Style | /api       | /styles | /userid | /templateid |

- If dealing with microservices

| Route | API prefix | service  | table   | id1     | id2         | ... |
| ----- | ---------- | -------- | ------- | ------- | ----------- | --- |
| User  | /api       | /system1 | /users  | /id     |
| Style | /api       | /system2 | /styles | /userid | /templateid |

- For private api, the flow is Auth > Authz > Processing details
- For public api, the flow is ApiSecret > Processing details
- If auth strategy is session, Auth will get username from session storage and pass it Authz
- If auth strategy is token-based, Auth will get token from the request headers
- ApiSecret will get the secret key from the request headers

## Server

- The database stores user personal information such as Email, Phone, Facebook, Template style, ...
- The database does not use any foreign key constraints for scalability and modification reasons. Read this article for more information https://planetscale.com/docs/vitess/operating-without-foreign-key-constraints

- This project uses DOCTRINE ORM to do CRUD operations through Entity Manager

> [!NOTE]
> We also create an abstraction layer for Entity Manager (or a wrapper over Entity Manager) called Database that helps do CRUD operations easier

- This project also uses an abstraction layer over calling api endpoint to other servers to get resources (microservice architecture) called APIClient.php, and have external services implement this abstraction

- When calling api endpoints, each api controller inherits API public, which requires only secret key to get and modify resources and API private, which requires authentication and authorization to get and modify resources

- Model Migration command

```linux
./vendor/bin/doctrine-migrations diff && ./vendor/bin/doctrine-migrations migrate
```
