# NoAuthChat

## Installation

To get started, follow these steps:

1. Clone the repository to your local machine:
```bash
git clone https://github.com/sidiqaldi/no-auth-chat
```

2. Navigate to the project directory:
```bash
cd no-auth-chat
```
3. Install composer dependencies:
```bash
composer install --no-dev
```
4. Copy the `.env.example` file and rename it to `.env`:
```bash
cp .env.example .env
```
5. Generate an application key:
```bash
php artisan key:generate
```
6. Update the `.env` file with your database connection details. Set the `DB_CONNECTION` to `sqlite` and update the `DB_DATABASE` path to point to your SQLite database file:
```env
DB_CONNECTION=sqlite
DB_DATABASE=/path/to/database.sqlite
```
7. Make sure config for laravel reverb
```env
BROADCAST_CONNECTION=reverb

REVERB_APP_ID=565431 //define yourself
REVERB_APP_KEY=nxeswqsld1vdv00tsiev //define yourself
REVERB_APP_SECRET=9xd8zfpkesqg07gh9km9 //define yourself
REVERB_HOST="localhost"
REVERB_PORT=8080
REVERB_SCHEME=http

VITE_REVERB_APP_KEY="${REVERB_APP_KEY}"
VITE_REVERB_HOST="${REVERB_HOST}"
VITE_REVERB_PORT="${REVERB_PORT}"
VITE_REVERB_SCHEME="${REVERB_SCHEME}"
```
8. Create an empty SQLite database file:
```bash
touch database/database.sqlite
```
9. Run the database migrations and seed the database:
```bash
php artisan migrate
```
10. Install NPM dependency and Build asset
```bash
npm ci && npm run build
```
11. Serve the application:
```bash
php artisan serve
```
12. Serve the laravel reverb for websocket connection:
```bash
php artisan reverb:start
```
11. Access the application in your web browser at `http://localhost:8000`.



## Requirements

- PHP 8.3
- Composer
- SQLite
- Node.js >= 20

## Contributing

Contributions are welcome! If you find any issues or have suggestions for improvements, please open an issue or submit a pull request on GitHub.

## License

This is open-source software licensed under the [MIT license](LICENSE).
