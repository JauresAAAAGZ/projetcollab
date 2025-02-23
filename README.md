
Fonctionnalités
•	Authentification des utilisateurs (Administrateurs et utilisateurs)
•	Gestion des projets et des tâches
•	Rôles sur les projets
•	Téléversement et téléchargement de fichiers pour les tâches
•	Notifications par mail pour les nouveaux collaborateurs et le nouvel assignement de tâche
•	Contrôle d'accès basé sur les rôles
________________________________________
Prérequis
Assurez-vous d'avoir les éléments suivants installés :
•	PHP >= 8.0
•	Composer
•	Node.js et NPM
•	MySQL ou une autre base de données compatible
•	Git
________________________________________
Installation
Étape 1 : Cloner le Dépôt
git clone https://github.com/JauresAAAAGZ/projetcollab.git
Étape 2 : Installer les Dépendances
composer install
npm install
npm run build
Étape 3 : Configuration de l'Environnement
1.	Copier le fichier .env.example et le renommer en .env
cp .env.example .env
2.	Générer la clé de l'application :
php artisan key:generate

Étape 4 : Configuration de la Base de Données
Modifiez le fichier .env avec les informations de votre base de données :
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=projet_collabo(vous retrouvez le fichié sur la racine du projet)
DB_USERNAME=utilisateur_bd
DB_PASSWORD=mot_de_passe_bd
Étape 5 : Migration et Peuplement de la Base de Données si nécessaire
php artisan migrate --seed
________________________________________
Configuration de l'Envoi d'Emails
Pour activer les notifications par email, configurez les paramètres suivants dans le fichier .env :
MAIL_MAILER=smtp
MAIL_HOST=smtp.gmail.com
MAIL_PORT=587
MAIL_USERNAME=votre_email@gmail.com(voirmail)
MAIL_PASSWORD=votre_mot_de_passe_app(voirmail)
MAIL_ENCRYPTION=tls
MAIL_FROM_ADDRESS=votre_email@gmail.com(voirmail)
MAIL_FROM_NAME="${APP_NAME}"
Assurez-vous d'utiliser un mot de passe d'application Gmail (via la validation en 2 étapes).
________________________________________
Configuration du Stockage
Pour gérer le téléversement de fichiers, liez le dossier de stockage avec la commande suivante :
php artisan storage:link
________________________________________
Lancement de l'Application
Démarrer le Serveur de Développement Local
php artisan serve(assurez vous de lancer votre server local)



Compiler les Ressources Front-End
npm run dev
Accédez à l'application à l'adresse http://localhost:8000
________________________________________
Identifiants Admin (Pour Tests)
Après avoir peuplé la base de données, vous pouvez utiliser les identifiants suivants pour vous connecter en tant qu'administrateur :
•	Email: admin@example.com
•	Mot de passe: password
________________________________________

Identifiants utilisateurs (Pour Tests)
Après avoir peuplé la base de données, vous pouvez utiliser les identifiants suivants pour vous connecter en tant qu'administrateur :
•	Email: gz.gozo@gmail.com
•	Mot de passe: ThePassword
________________________________________
Commandes Artisan Utiles
•	Vider le cache :
php artisan cache:clear
php artisan config:clear
php artisan view:clear
php artisan route:clear
•	Mettre en cache la configuration :
php artisan config:cache
•	Rafraîchir les migrations :
php artisan migrate:refresh --seed
________________________________________


Remarques Supplémentaires
•	Assurez-vous de bien configurer vos informations d'identification email pour éviter les erreurs SMTP.
•	Vérifiez les permissions des dossiers /storage et /bootstrap/cache.

