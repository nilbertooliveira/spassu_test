#!/bin/bash
set -e  # O script para imediatamente se ocorrer qualquer erro.

echo "🛠 Verificando diretório do projeto..."
cd /home/ubuntu/projetos/spassu_test || exit 1

echo "📥 Fazendo pull do código mais recente..."
git pull origin dev --rebase

# Verificar se o arquivo .env existe. Caso contrário, copia de .env.example
if [ ! -f .env ]; then
  echo "⚠️ Arquivo .env ausente. Copiando de .env.example..."
  cp .env.example .env
fi

echo "🛑 Parando containers antigos..."
docker-compose down

echo "📦 Construindo as imagens Docker..."
docker-compose build

echo "🔄 Subindo os containers..."
docker-compose up -d --remove-orphans

echo "⚙️ Instalando dependências do PHP com Composer..."
docker-compose exec laravel-app composer install

echo "⚙️ Instalando e construindo o frontend com npm..."
docker-compose exec laravel-app npm install
docker-compose exec laravel-app npm run build

echo "🔒 Ajustando permissões para storage e bootstrap/cache..."
sudo chmod -R 777 storage bootstrap/cache

echo " Criando link do storage..."
docker-compose exec laravel-app php artisan storage:link

echo "🚀 Executando migrations e seeders..."
docker-compose exec laravel-app php artisan migrate --seed --force

echo "⚡ Limpando e otimizando caches..."
docker-compose exec laravel-app php artisan optimize:clear
docker-compose exec laravel-app php artisan optimize

echo "✅ Deploy finalizado com sucesso!"
