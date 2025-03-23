## Ambiente Docker

Foi utlizado a arquitetura abaixo para concepção do projeto.


Estilo arquitetural: Hexagonal com DDD

1. Clonar o repositório:
     ```
    git clone https://github.com/nilbertooliveira/spassu_test.git
     ```

2. Rodar o comando abaixo para fazer o build do projeto, pulling das images, criar rede externa e hosts:
   ```
   docker-compose up -d
   ```
3. Instalar as dependências e permissões:
    ```
   docker-compose exec laravel-app composer install
   docker-compose exec laravel-app npm install
   
   docker-compose exec laravel-app npm run build
   docker-compose exec laravel-app php artisan storage:link
   
   sudo chmod -R 777 storage/ bootstrap/cache
    ```

4. Configurar a base de dados
    ```
   docker-compose exec laravel-app php artisan migrate --seed --force
    ```
5. Executar testes
    ```
   docker-compose exec laravel-app php artisan test
    ```
   
6. Processar o Relatório
    ```
    docker-compose exec laravel-app php artisan queue:work
    ```

##### Usuário:
```
Host: http://0.0.0.0
Email: test@spassu.com.br
Password: 123456
```
