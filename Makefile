.DEFAULT_GOAL := help

# Executables (local)
DOCKER_COMP = docker-compose

# Executables
DOCKER_EXEC = $(DOCKER_COMP) exec

# Executables docker containers
BACKEND = $(DOCKER_EXEC) backend
MYSQL = $(DOCKER_EXEC) mysql

help: ## Help message
	@echo "Please choose a task:"
	@grep -E '(^[a-zA-Z_-]+:.*?##.*$$)|(^##)' $(MAKEFILE_LIST) | awk 'BEGIN {FS = ":.*?## "}; {printf "\033[32m%-30s\033[0m %s\n", $$1, $$2}' | sed -e 's/\[32m##/[33m/'

PROJECT_DIR=$(shell dirname $(realpath $(MAKEFILE_LIST)))

install: build start composer-install migrate ## Spin-up the project with minimal data

build: ## Build docker containers
	$(DOCKER_COMP) build
	@echo ">>> Base build done!"

start: ## Start all services
	${DOCKER_COMP} up -d
	@echo ">>> Containers started!"

stop: ## Stop all services
	${DOCKER_COMP} stop
	@echo ">>> Containers stopped!"

composer-install: ## Install all dependencies with composer
	${BACKEND} composer install --no-interaction
	@echo ">>> Composer installation done!"

migrate: ## Start all migrations
	${BACKEND} php artisan migrate:fresh --seed
	@echo ">>> Migrations done!"

queue: ## Queue
	${BACKEND} php artisan queue:work
	@echo ">>> worker done!"
