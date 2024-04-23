# EOS - members

## Installation & setup

Update the MAC hostfile:
```bash
sudo vi /etc/hosts

# and place APP_URL:
127.0.0.1 http://eos-members.test 
 ```

Install composer & copy the .env file & start the project:
```bash
composer install && cp .env.example .env && ./vendor/bin/sail up -d
```

Run the migrations and seeders & open the project:
```bash
./vendor/bin/sail artisan key:generate && ./vendor/bin/sail artisan migrate --seed && open http://eos-members.test/docs
```

## Tests
To run all tests:

```bash
./vendor/bin/sail test
```

## Documentation

```bash
open http://eos-members.test/docs

// Regenerate the docs
./vendor/bin/sail artisan scribe:generate
```
