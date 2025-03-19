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
    docker exec app composer install
    docker exec app npm run build
    sudo chmod -R 777 storage/
    ```

4. Configurar a base de dados
    ```
    docker exec app php artisan migrate
    docker exec app php artisan db:seed
    ```
5. Executar testes
    ```
    docker exec app php artisan test
    ```

##### Usuário:
```
Host: http://0.0.0.0
Email: test@spassu.com.br
Password: 123456
```
