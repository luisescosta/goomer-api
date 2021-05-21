<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400"></a></p>

## Goomer - API


#### Baixar projeto

```
git clone https://github.com/luiseduardosilva/goomer-api.git
```

#### Docker-compose

```
docker-compose up -d
```


#### Instalar dependencias

```
docker exec -it goomer-php composer install
```

#### Chave Laravel
```
docker exec -it goomer-php php artisan key:generate
```

#### Copiar `.env`

```
cp .env.example .env
```

#### Configurar Banco de dados
```
DB_CONNECTION=pgsql
DB_HOST=goomer-postgres
DB_PORT=5432
DB_DATABASE=goomer
DB_USERNAME=goomer
DB_PASSWORD=goomer
```

#### Migrations
```
docker exec -it goomer-php php artisan migrate
```


# Rotas

#### Criar Restaurante

Url:`localhost:8000/api/v1/restaurants`

Method: `POST`

body:
```json
{
	"name": "Luis Food",
	"photo": "www.url.photo.com.br",
	"street": "Rua Goomer",
	"number": "33",
	"neighborhood": "Goomer",
	"hours" : [{
				"day": 1,
				"from": 11,
				"to": 14
			},
			{
				"day": 2,
				"from": 11,
				"to": 14
			}]
}
```



#### Listar restaurante e seus produtos por `:ID`

Url: `localhost:8000/api/v1/restaurants/1`

Method: `GET`



#### Listar todos os restaurantes e seus produtos

Url: `localhost:8000/api/v1/restaurants`

Method: `GET`


#### Alterar restaurante por `:ID`

Url: `localhost:8000/api/v1/restaurants/1`

Method: `PUT`

Body:

```json
{
	"name": "Goomer Food",
	"photo": "www.url2.photo.com.br",
	"street": "Rua da Goomer API",
	"number": "32",
	"neighborhood": "Goomer",
	"hours" : [{
				
				"day": 4,
				"from": 9,
				"to": 14
			},
			{
				"day": 5,
				"from": 12,
				"to": 14
			}, 
            {
				"day": 6,
				"from": 12,
				"to": 22
			}]
}
```

#### Remover restaurante por `:ID`

Url: `localhost:8000/api/v1/restaurants/1`

Method: `DELETE`


#### Criar Produto

Url: `localhost:8000/api/v1/products`

Method: `POST`

Body:

```json
{
    "name": "Suco de Uva",
    "photo": "url.photo.com.br",
    "category" : "Suco",
    "price": 3.60,
    "promotional_price": 3.0,
    "promotional_description" : "Suco do DIA!",
    "active_promotion" : true,
    "hours_promotion" : [{
        "day": 1,
        "from": "12:15",
        "to": "13:17"
    },
        {
            "day": 4,
            "from": "11:10",
            "to": "11:25"
        }],
    "restaurant_id": 5
}
```
#### Alterar produto por `:ID`

Url: `localhost:8000/api/v1/products/1`

Method: `PUT`

Body:

```json
{
    "name": "Suco de Uva Update",
    "photo": "url.update.photo.com.br",
    "category" : "Suco",
    "price": 5.10,
    "promotional_price": 3.0,
    "promotional_description" : "Suco do DIA!",
    "active_promotion" : false,
    "hours_promotion" : [{
        "day": 1,
        "from": "12:15",
        "to": "13:17"
        },
        {
            "day": 4,
            "from": "11:10",
            "to": "11:25"
        }
    ],
    "restaurant_id": 1
}
```


#### Listar produto por `:ID`

Url: `localhost:8000/api/v1/products/1`

Method: `GET`



#### Listar todos os produtos

Url: `localhost:8000/api/v1/products`

Method: `GET`



#### Remover produto por `:ID`

Url: `localhost:8000/api/v1/products/1`

Method: `DELETE`


#### Arquivo de requisições para Insomnia
`/docs/request.json`
