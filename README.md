# Dojo testes unitários

## Objetivo

O objetivo deste dojo é praticar a implementação de testes unitários em php.

## Ambiente

Para rodar o ambiente você precisa ter o docker e docker-compose instalados.

```bash
git clone git@github.com:marcelofabianov/dojo-tests-unit.git
```

```bash
cd dojo-tests-unit
```

```bash
docker compose up -d
```

```bash
docker exec -it app bash
```

### Rodando os testes

```bash
./vendor/bin/phpunit tests
```

ou 

```bash
composer test
```
