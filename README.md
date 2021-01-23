<h1 align="center">
  Randomly priced games
</h1>
<p align="center">This is a gaming store API, which provides basic functionality for product management </p>

### Prerequisites
 - **Linux**
 - [**Git**](https://www.atlassian.com/git/tutorials/install-git)
 - [**Docker**](https://docs.docker.com/engine/installation/)

### Set up
1. Put your google key 
2. Copy `.env.dist` into `.env` and configure as you are wiling(better keep default values).
3. Run `docker-compose up` to bring up your containers. Or "sail up"
4. sail artisan migrate
5. sail artisan db:seed

You can now access the application here (by default): [http://localhost](http://localhost)

### Launching tests
- To launch tests tests run:
```
docker-compose exec php ./bin/phpunit
```
- To launch tests with code coverage you can use:
```
docker-compose exec php ./bin/phpunit --coverage-html coverage
```
this will create some coverage files, to see the report open: [coverage/index.xml](coverage/index.xml),

### Documentation
You can view the full API documentation here: [here](https://documenter.getpostman.com/view/273833/RWMHKmx1)

<h2 align="center"> Thank you! </h2>
<h3> Provided by Victor Timoftii </h3>
