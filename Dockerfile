# Utiliser une image de base Ubuntu
FROM ubuntu:24.04

# Mettre à jour les paquets et installer les dépendances nécessaires
RUN apt-get update && apt-get upgrade -y && \
    mkdir -p /etc/apt/keyrings && \
    apt-get install -y gnupg gosu curl ca-certificates software-properties-common && \
    curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer && \
    apt-get clean && rm -rf /var/lib/apt/lists/*

# Définir une variable d'environnement pour le groupe WWW
ENV WWWGROUP=1001

# Définir le répertoire de travail
WORKDIR /var/www/html

# Copier les fichiers du projet dans le conteneur
COPY . .

# Installer les dépendances Composer (sans dépendances de développement et optimisation de l'autoloader)
RUN composer install --no-dev --optimize-autoloader

# Créer un groupe et un utilisateur pour une exécution non root
RUN groupadd -g $WWWGROUP sail && \
    useradd -u 1001 -g $WWWGROUP -m sail

# Changer les permissions pour les dossiers de stockage et de cache
RUN chown -R sail:$WWWGROUP /var/www/html/storage /var/www/html/bootstrap/cache && \
    chmod -R 770 /var/www/html/storage /var/www/html/bootstrap/cache

# Passer à l'utilisateur non-root pour une meilleure sécurité
USER sail

# Exposer le port 9000 pour PHP-FPM
EXPOSE 9000

# Démarrer PHP-FPM
CMD ["php-fpm"]
