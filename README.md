# Sygma-Web-Service

Welcome to Sygma-Web-Service project!

## Technology 

This architecture proposes a reutilisable code and easy to maintain. It also provides good practice like MVC layout and object oriented.

The Sygma-Web-Service application works with the symfony framework ( 5.0.5 ).

- Symfony
- Docker (Configure your environment)
- Ansible (Deploy with ansible folder)
- GitlabCI (CI/CD)

### Use this project 

-  clone this project on your environment 
-  configure your variable environment
-  run `composer install`
-  run `php bin/console d:d:c`
-  run `php bin/console d:m:m`
-  run `php bin/console d:f:l -n`

-  You can run this project with docker containers ( docker-compose included in this repository )

##### For Docker run :

run this project with docker containers (docker-compose included in this repository )
```
docker-compose up -d
```

## Deployment

##### For Ansible, create your ansible/hosts.ini and run:
```
ansible-playbook ansible/playbook.yml -i ansible/hosts.ini --ask-vault-pass
```

#### This website is available in "ozez.yohanndurand.fr"

## Testing 

For generate a coverage-html ( available in /public/data/index.html )

```
php bin/phpunit --coverage-html public/data 
```

Testing Symfony Website

```
php bin/phpunit
```

## Other information 

Standard :
1. PSR2 ( https://www.php-fig.org/psr/psr-2/ )