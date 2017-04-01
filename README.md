# Budgeit

- [Project Summary](#summary)
- [Changelog](CHANGELOG.md)
- [Features](#features)
- [Setup](#setup)
- [License](LICENSE.md)
- [Testing](#testing)

<a name="summary"></a>
## Project Summary
Budgets should not be difficult but I have been finding it harder and harder now-a-days to find a budget app that does not overcomplicate things. With Budgeit you can create a feasible plan and next steps to addressing debt, planning for the future and getting your finances under control. Budgeit is great for everyone but works especially well for students and people with roomates. This app is still currently in development and is a way for me to get some practice in with Laravel 5.4 and Vue.js v2.

<a name="features"></a>
## Features
- Simple budget creator
- Planning for tackling debt
- Split budget items with other users. Great for users with roomates.

<a name="setup"></a>
## Setup
Clone the repo and run the following:
```bash
php artisan migrate
php artisan db:seed
```
This will setup the DB, add a default user and default groups.

<a name="testing"></a>
## Testing
This project uses Laravel Dusk for browser testing.
```bash
php artisan dusk
```

To run browser, feature and unit tests run:
```bash
composer test-all
```

