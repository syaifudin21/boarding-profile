### Installation

cloning project
```
git clone https://github.com/syaifudin21/boarding-profile.git
```

masuk ke folder project
```
cd boarding-profile
```

install composer
```
composer install
```

copy .env.example to .env
```
cp .env.example .env
```

migrate database
```
php artisan migrate
```

generate key
```
php artisan key:generate
```

run server
```
php artisan serve
```

### Credential 
credential dapat diambil melalui dashboard seuaikan pada .env terdiri dari 
```
BOARDING_SCHOOL_BASE=""
BOARDING_SCHOOL_KEY= "" 
BOARDING_SCHOOL_SECRET="" 
BOARDING_SCHOOL_CODE="" 
```


### Untuk test api sudah diberikan contoh pada file route

contoh get profile
```
/example/profile
```

contoh get album
```
/example/album
```

contoh get album detail
```
/example/album/uuid
```

