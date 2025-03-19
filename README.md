## Ambiente Docker

Foi utlizado a arquitetura abaixo para concepção do projeto.


Estilo arquitetural: Hexagonal com DDD

1. Clonar o repositório:
     ```
    git clone https://github.com/nilbertooliveira/spassu_test.git
     ```

2. Rodar o comando abaixo para fazer o build do projeto, pulling das images, criar rede externa e hosts:
   ```
   ./vendor/bin/sail up -d
   ```
3. Instalar as dependências e permissões:
    ```
    ./vendor/bin/sail composer install
    ./vendor/bin/sail npm run build
    sudo chmod -R 777 storage/
    ```

4. Configurar a base de dados
    ```
    ./vendor/bin/sail php artisan migrate
    ./vendor/bin/sail php artisan db:seed
    ```
5. Executar testes
    ```
    ./vendor/bin/sail php artisan test
    ```

##### Usuário:
```
Host: http://0.0.0.0
Email: test@spassu.com.br
Password: 123456
```
