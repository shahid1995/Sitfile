#!/usr/bin/env bash
# Freebuff preview bootstrap for Sitfile (Laravel 5.5 / PHP 7.4 / MariaDB).
# Idempotent: safe to run on every preview start. Installs the runtime pieces
# the app needs (PHP 7.4 + Composer 1.x + MariaDB), provisions .env, and
# prepares the database schema so `php artisan serve` can boot.
set -e

export DEBIAN_FRONTEND=noninteractive

echo "==> [1/7] PHP 7.4 runtime"
if ! command -v php7.4 >/dev/null 2>&1; then
  apt-get update -qq
  apt-get install -y -qq software-properties-common >/dev/null 2>&1 || true
  add-apt-repository -y ppa:ondrej/php >/dev/null 2>&1 || true
  apt-get update -qq
  apt-get install -y -qq php7.4-cli php7.4-mysql php7.4-mbstring php7.4-xml php7.4-curl php7.4-zip php7.4-gd php7.4-bcmath
  update-alternatives --set php /usr/bin/php7.4 || true
fi
php -v | head -1

echo "==> [2/7] Composer 1.x (Laravel 5.5 needs the legacy installed.json format)"
if ! command -v composer >/dev/null 2>&1 || php -r 'exit(version_compare(PHP_VERSION, "8.0.0", ">=") ? 1 : 0);'; then
  curl -sSL https://getcomposer.org/download/1.10.27/composer.phar -o /usr/local/bin/composer
  chmod +x /usr/local/bin/composer
fi
composer --version | head -1

echo "==> [3/7] MariaDB server"
if ! command -v mariadbd >/dev/null 2>&1 && ! command -v mysqld >/dev/null 2>&1; then
  apt-get update -qq
  apt-get install -y -qq mariadb-server
fi
service mariadb start >/dev/null 2>&1 || true
mysql -e "CREATE DATABASE IF NOT EXISTS homestead CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
CREATE USER IF NOT EXISTS 'homestead'@'localhost' IDENTIFIED BY 'secret';
CREATE USER IF NOT EXISTS 'homestead'@'127.0.0.1' IDENTIFIED BY 'secret';
GRANT ALL PRIVILEGES ON homestead.* TO 'homestead'@'localhost';
GRANT ALL PRIVILEGES ON homestead.* TO 'homestead'@'127.0.0.1';
FLUSH PRIVILEGES;"

echo "==> [4/7] .env (from .env.example, with APP_KEY)"
if [ ! -f .env ]; then
  cp .env.example .env
fi

echo "==> [5/7] Base tables + composer install (AppServiceProvider reads cms_settings on boot, so it must exist before any artisan command)"
mysql homestead <<'SQL'
CREATE TABLE IF NOT EXISTS migrations (
  id INT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
  migration VARCHAR(255) NOT NULL,
  batch INT NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
CREATE TABLE IF NOT EXISTS cms_settings (
  id INT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
  name VARCHAR(255) NULL,
  content TEXT NULL,
  content_input_type VARCHAR(255) NULL,
  dataenum VARCHAR(255) NULL,
  helper VARCHAR(255) NULL,
  created_at TIMESTAMP NULL,
  updated_at TIMESTAMP NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
INSERT INTO migrations (migration, batch)
SELECT '2016_08_07_152320_add_table_cms_settings', 1
WHERE NOT EXISTS (SELECT 1 FROM migrations WHERE migration = '2016_08_07_152320_add_table_cms_settings');
SQL
composer install --no-interaction --prefer-dist --no-progress

echo "==> [6/7] APP_KEY + schema + CRUDBooster seed"
if ! grep -q "^APP_KEY=base64:" .env; then
  php artisan key:generate --force
fi
php artisan migrate --force
php artisan db:seed --class=CBSeeder --force

echo "==> [7/7] Empty content tables so the public pages render without a DB dump"
mysql homestead <<'SQL'
CREATE TABLE IF NOT EXISTS client_says (
  id INT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
  name VARCHAR(255) NULL,
  designation VARCHAR(255) NULL,
  review TEXT NULL,
  status TINYINT NOT NULL DEFAULT 1,
  created_at TIMESTAMP NULL,
  updated_at TIMESTAMP NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
CREATE TABLE IF NOT EXISTS static_page (
  id INT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
  title VARCHAR(255) NULL,
  seo_url VARCHAR(255) NULL,
  status VARCHAR(20) DEFAULT 'ACTIVE',
  paid INT NULL,
  created_at TIMESTAMP NULL,
  updated_at TIMESTAMP NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
CREATE TABLE IF NOT EXISTS static_page_details (
  id INT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
  page_id INT NULL,
  page_title VARCHAR(255) NULL,
  lang_id INT NULL,
  title VARCHAR(255) NULL,
  description LONGTEXT NULL,
  image VARCHAR(255) NULL,
  created_at TIMESTAMP NULL,
  updated_at TIMESTAMP NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
CREATE TABLE IF NOT EXISTS membership_packages (
  id INT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
  title VARCHAR(255) NULL,
  price DECIMAL(10,2) NULL,
  description TEXT NULL,
  status TINYINT NOT NULL DEFAULT 1,
  created_at TIMESTAMP NULL,
  updated_at TIMESTAMP NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
CREATE TABLE IF NOT EXISTS services (
  id INT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
  service_name VARCHAR(255) NULL,
  image VARCHAR(255) NULL,
  description TEXT NULL,
  status VARCHAR(20) DEFAULT '1',
  created_at TIMESTAMP NULL,
  updated_at TIMESTAMP NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
CREATE TABLE IF NOT EXISTS manage_machine_type (
  id INT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
  name VARCHAR(255) NULL,
  status VARCHAR(20) DEFAULT '1',
  created_at TIMESTAMP NULL,
  updated_at TIMESTAMP NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
CREATE TABLE IF NOT EXISTS shielding_requirement (
  id INT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
  name VARCHAR(255) NULL,
  status VARCHAR(20) DEFAULT '1',
  created_at TIMESTAMP NULL,
  updated_at TIMESTAMP NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
INSERT INTO language (language_name, language_code, language_flag)
SELECT 'English', 'en', ''
WHERE NOT EXISTS (SELECT 1 FROM language WHERE language_code = 'en');
SQL

echo "==> Preview environment ready. Start it with: APP_ENV=local php artisan serve --host=0.0.0.0 --port=\${PORT:-8000}"
