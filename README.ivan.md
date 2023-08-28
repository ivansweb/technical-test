# Technical Test: [Cyberhawk] - [by Ivan Pereira]

In this repository you will find my solution for the proposed technical test.

## Running the Application

### Steps

1. Clone the repository to your local environment:

```bash
git clone https://github.com/ivansweb/technical-test
cd technical-test
```

2. Launch containers using Laravel Sail:

```bash
./vendor/bin/sail up -d
```

3. Run database migrations to create the tables:

```bash
./vendor/bin/sail artisan migrate

```

4. Run seeders to populate the database with sample data:

```bash
./vendor/bin/sail artisan db:seed

```

5. Access the application at http://localhost:

## Technologies involved

- Development pattern used: MVC with SRP (Service Repository Pattern).
- MySQL database
- Laravel 9
- PHP 8
- Docker
- Tailwind CSS
- VueJS 3
- Laravel Sail
## The features

- User authentication.
  - User registration.
  - Login with email and password.
- Wind farms.
  - Registration and editing.
  - Registration and editing of turbines for each wind farm.
- Inspections.
  - Create turbine inspections per wind farm.
  - View the inspections already carried out.

## Future plans

Here are some ideas for future app growth:

- Add Form Requests for data validation throughout the app.
- Add automated tests.
- Add pagination to lists.
- Add filters to listings (mainly by date).
- Improve the interface for inspections.
- Allows you to register components for each turbine. (This is generically - same components for all).
- Create a dashboard to view data in a more user-friendly way.
  - Graphs to visualize the data.
  - Map to visualize the wind farms.
  - Allow a dynamic dashboard for each wind farm.
