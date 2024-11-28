![](https://github.com/ereztdev/sia/blob/master/public/imgs/sia_splash.png?raw=true)
# SIA
### Straightforward Integer API

---

## Instalation For Local Environment
- Assuming you will run in a webserver either on windows (XAMPP/WAMPP/etc) or on Linux where you already have a 
webserver installed there (Apache2/NGINX/etc). 
#### pre-requisites
- **PHP** - via your webserver
- **Mysql** - via your webserver 
- **Node.JS** -  if you don't have it, you can [download it right here](https://nodejs.org/dist/v12.16.2/node-v12.16.2-x64.msi).
- **Composer** - PHP Dependency Manager, if you don't have it, you can [download it right here](https://getcomposer.org/download/).

#### Installation Procedure
- clone this repo (`git clone https://github.com/ereztdev/sia.git`) into your webserver
- switch into the repo directory where you pulled the repo: (`cd sia`)
- Install PHP dependencies (`composer install`)
- environment:
  - In the project root, you will have to create an `.env` environment file: `cp .env.example .env`
  - in MySQL create a database and fill out that DB name here (`DB_DATABASE`), do the same for the DB username and 
  password 
  - Fill in your client-id/secret's for google and github OAuth2 apps, if you don't have the ability to 
    create one feel free to contact me, and I'll send you mine. 
- Now our environment is set. Let's go ahead and seed our database, run `php artisan migrate`.
- Also, let's seed into our DB our first integer (default 1), run `php artisan db:seed --class=IntegerInitSeeder` 
- Since we are using AES-256 encryption to generate keys for users to access our API, I chose passport as my keymaker. 
Run `php artisan passport:install` to create the keymakers.
- Install Node dependencies, run `npm install`.
- To finish up, build the Vue.js instance, run `npm run dev` for dev environment, or `npm run prod` for production.
- run `php artisan serve` and now you can access the webapp at `http://localhost:8000`.

# Endpoints
## USER MODEL RELATED
#### **POST** `api/register`
> Registers the user via the API

- name <*string*>
- email <*string|email*>
- password <*string*>
- password_confirmation <*string*>

#### Returns JSON Object
```
{
    "user": {
        "name": string,
        "email": string,
        "updated_at": string,
        "created_at": string,
        "id": int
    },
    "access_token": string
}
```
#### **POST** `api/login`
> Login the user via the API

- email <*string|email*>
- password <*string*>
#### Returns JSON Object
```
{
    "user": {
        "name": string,
        "email": string,
        "email_verified_at": string,
        "google_id": string,
        "github_id": string,
        "updated_at": string,
        "created_at": string,
    },
    "access_token": string
}
```
## INTEGER MODEL RELATED
#### **POST** `api/current`
>Returns the current integer
>
- Authorization token <*string|"Bearer "*>
#### Returns JSON Object
```
{
    "success": bool,
    "data": {
        "id": int,
        "integer": int,
        "created_at": string,
        "updated_at": string
    },
    "message": "success"
}
```
#### **POST** `api/next`
>Returns the next integer
>
- Authorization token <*string|"Bearer "*>
#### Returns JSON Object
```
{
    "success": bool,
    "data": {
        "id": int,
        "integer": int,
        "created_at": string,
        "updated_at": string
    },
    "message": "success"
}
```
#### **POST** `api/update`
>Returns the updated integer
>
- Authorization token <*string|"Bearer "*>
- updated_integer <*int*>
#### Returns JSON Object
```
{
    "success": bool,
    "data": {
        "id": int,
        "integer": int,
        "created_at": string,
        "updated_at": string
    },
    "message": "success"
}
```
