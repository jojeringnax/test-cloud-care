## Test task for [Cloud Care](https://www.cloud-care.it/)

I made it using the [breeze](https://laravel.com/docs/9.x/starter-kits#laravel-breeze) and [sail](https://laravel.com/docs/9.x/sail#installation).

On Windows the sail does not work properly, and I used the [Docker](https://www.docker.com/) itself to create and start the container.

It will be something like:
`docker-compose -f ${PATH_TOPROJECT}/docker-compose.yml up -d`

Migrations and seed for User should be applied on deploying.

## Punk API

As I read [here](https://punkapi.com/documentation/v2), Punk API doesn't use authorization anymore, so there are no sense to send a token within the request.

Anyway, ON Login Request there are three different tokens saved in Cookies (I could send them).

****Thanks for your attention!****
