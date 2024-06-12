# Developer Experience

### Account Generation
Cardboard comes equipped with an artisan command `php artisan dev:setup`.
This command will teardown, rebuild and seed your application. Additionally,
it will create a development account along with a API token. The credentials
are: development@cardboard.test & password. The email can be customized in `config/development.php`.

### Data Seeding
Cardboard was built with seeding in mind, and has a handful of database seeders
to make your development life easier. See `database/seeders/DatabaseSeeder.php`
for a list of seeders that will run.

#### Generating Real Magic Cards
You can have real magic cards pulled down into your project quite easily. First,
add the variable `SEED_REAL_DATA=true` to your `.env` file.

From there, run `php artisan import:scryfall` and you should see products in your database `products` table.

**Note:** You'll want to cancel the command after having seeded some products; there's no reason to seed 150,000 products.(lol)
