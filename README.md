# Simple Ad Api

Create a simple Ads management API that shows ads and related tags/categories. It will be a part of a module handling the Advertiser functionalities towards these ads. Since advertiser will be assigned with an ad to start and should include the following:
### Ads Attributes:
- type(free/paid), title, description, category, tags, advertiser, start_date.
- Each Ad is created under one category and has many related tags
- One category can have many ads and each Ad is related to one category.
- Schedule a daily email at 08:00 PM that will be sent to advertisers who have ads the next day as a remainder.
### Endpoints should contain: 
- Tags (CRUD)
- Categories (CRUD)
- Ad filters (by tag, by category) 
- Showing Advertiser Ads


## Installation

1. Clone the repo and `cd` into it.
1. `composer install`.
1. Rename or copy `.env.example` file to `.env`.
1. `php artisan key:generate`.
1. Set database credentials in `.env` file.
1. Don't forget mail setting in `.env` file.
1. `php artisan migrate --step --seed`.
1. `php artisan serve`.
1. Open new terminal tap `php artisan schedule:work`.
1. Use [Postman Collection](https://documenter.getpostman.com/view/6784299/2s8Z6vXteB) for run api services
   
