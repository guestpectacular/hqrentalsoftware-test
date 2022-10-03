# API Requirement Test

# Before to start, migrate and seed db
```bash
php artisan migrate --seed
```

# Available routes
Resource index:
```bash
curl http://hqrentaltest.test/api/products
```

Filtered by category:
```bash
curl "http://hqrentaltest.test/api/products?category=insurance"
curl "http://hqrentaltest.test/api/products?category=vehicle"
```

Filter all products with price equals to 890:
```bash
curl "http://hqrentaltest.test/api/products?price=890&limit=eq"
```
Filter all products with price lower than to 891:
```bash
curl "http://hqrentaltest.test/api/products?price=891"
```
Filter all products with price greater than to 199:
```bash
curl "http://hqrentaltest.test/api/products?price=199&limit=gt"
```

# Licences
I'm using BelongsToMany instead BelongsTo with Categories, to give more flexibility to the code.