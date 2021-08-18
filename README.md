# Shopcart application

# How to run

## Install via docker-compose
- `docker-compose build`
- `docker-compose up -d`
- `docker-compose exec shop_app composer build:dev`

# Api usage

## Concepts

### Price
Package https://github.com/moneyphp/money and extension `bcmath` used to perform calculations

## Endpoints
Default Host&port - `http://localhost:5000`

### Carts
- `POST http://localhost:5000/api/carts` - create cart
- `GET http://localhost:5000/api/carts/{cartId}` - show cart details
- `POST http://localhost:5000/api/carts/{cartId}/products/{productId}` - add product to cart
- `DELETE http://localhost:5000/api/carts/{cartId}/products/{productId}` - remove product from cart

### Products
- `POST http://localhost:5000/api/products` - create product. Required fields: `title`, `price`
- `GET http://localhost:5000/api/products` - show products list
- `PUT http://localhost:5000/api/products/{productId}` - update product title/price. Optional fields: `title`, `price`
- `DELETE http://localhost:5000/api/products/{productId}` - delete product

# Tests

You can run all tests:

```bash
docker-compose exec shop_app composer tests
```

You can run only unit or integration tests:

```bash
docker-compose exec shop_app composer tests:unit
docker-compose exec shop_app composer tests:integration
```