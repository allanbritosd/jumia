# Iniciando o Projeto
```
cd app
composer install
```


# Utilizando Docker (Caso deseje)
```
cd docker
docker build -t jumia .
docker run -it --rm --name jumia jumia
```

# Rodando testes
```
./vendor/bin/phpunit --bootstrap ./bootstrap.php tests
```