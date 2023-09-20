up:
	docker-compose up -d
down:
	docker-compose down
build:
	docker-compose up -d --build
test:
	docker exec -it localbrandx php artisan test
migrate:
	docker exec -it localbrandx php artisan migrate
mysql:
	docker exec -it mysql mysql -u root -ppassword
env:
	docker exec -it localbrandx cat .env
route:
	docker exec -it localbrandx php artisan route:list --path=api
import-log:
	docker exec -it localbrandx cat storage/logs/import_failed.log
migrate-fresh:
	docker exec -it localbrandx php artisan migrate:fresh
