#!/bin/bash

echo "🛠 Verificando diretório do projeto..."
cd /home/ubuntu/projetos/spassu_test

# Detecta a ref atual (tag ou branch) via $1 (parâmetro passado)
CURRENT_REF=$1 # Nome da referência é o 1º argumento

echo "🔄 Fazendo checkout da tag ou branch '${CURRENT_REF}'..."
git fetch --all --tags
git checkout ${CURRENT_REF}
git pull origin ${CURRENT_REF}

# Verificar se .env existe, senão copiar de .env.example
if [ ! -f .env ]; then
  cp .env.example .env
fi

echo "🛑 Parando e removendo containers antigos..."
docker-compose down

echo "📦 Construindo a imagem Docker..."
docker-compose build

echo "🔄 Subindo os containers..."
docker-compose up -d --remove-orphans

echo "🚀 Executando migrations e seeders..."
docker-compose exec laravel-app php artisan migrate --seed --force

echo "⚡ Limpando e otimizando cache..."
docker-compose exec laravel-app php artisan optimize:clear
docker-compose exec laravel-app php artisan optimize

echo "✅ Deploy finalizado com sucesso!"
