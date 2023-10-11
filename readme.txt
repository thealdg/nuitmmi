Si vous pouvez lire ceci, c'est que vous avez réussi jusque là les instructions que je vous ai données sur Discord.

Maintenant, dans un terminal je vous invite à vous rendre dans ce dossier ci-présent, qui s'appelle normalement "nuitmmi".
Vous taperez la commande "php artisan serve", vous aurez alors deux cas de figure:
1) Tout se passe bien, pas de messages d'erreur, et on vous confirme l'ouverture du serveur du site avec quelque chose du genre "127.0.0.1:8000", vous n'avez pas besoin
de lire le bloc qui suit.
2) Vous avez un message d'erreur, pas d'inquétude ! Je vous invite alors à lire le bloc qui suit.

DANS LE CAS D'UN MESSAGE D'ERREUR:
-> Tapez la commande suivante: composer install
	-> Si vous n'avez pas de message d'erreur, laissez les composants s'installer et réassayez la commande au dessus
	-> Si vous avez un message d'erreur, composer n'est pas installé sur votre ordinateur:
		-> Si vous avez un fichier appellé "composer.phar" quelque part, mettez le dans ce dossier "nuitmmi" puis tapez la commande suivante: composer.phar install
		-> Sinon réinstallez / installez composer

--------------------------------------------

Maintenant, tout le monde devrait avoir encore une fois deux cas de figure:
-> Un fichier .env est présent dans le dossier "nuitmmi", dans ces cas là aucun problème, mais je vous invite FORTEMENT à mettre quand même celui sur discord.
-> Vous n'avez pas de fichier .env dans le dossier "nuitmmi", alors vous mettez celui que je vous envoie sur discord.

BASE DE DONNEES (Obligatoire)
-> Vous devez créer une base de données, de préférence appellée "nuitmmi", dans votre phpmyadmin.
-> Après vous être rendu sur la base de données précédemment crée, cliquez sur l'onglet en haut de votre fenêtre qui vous permets d'IMPORTER.
-> Normalement, on vous demandera de sélectionner un fichier: vous sélectionnerez le fichier nuitmmi.sql dans le dossier "nuitmmi".
-> N'oubliez pas de cliquer sur le bouton en dessous pour confirmer votre importation : des lignes vertes d'ajout devraient alors apparaître.

LE FICHIER .env (Obligatoire)
Je vous invite FORTEMENT à copier coller le contenu du fichier .env sur discord, si celà n'est pas déjà fait.
-> Vous devrez pour certains modifier les champs "DB_" (surtout ceux sur Mac), veuillez remplir ces champs selon votre cas de figure.

Si la commande "php artisan serve" a fonctionné correctement, vous devriez maintenant tous pouvoir accéder au site. Si ce n'est pas le cas, n'hésitez pas à me contacter.

--------------------------------------------

INFORMATIONS GENERALES

-> J'ai mis en place un compte administrateur pour vous, voici son identifiant / mot de passe:
	Email: admin@lanuitmmi.fr
	Mot de passe: admin

-> Si les images ne se chargent pas sur les mails que vous recevrez, c'est normal. La raison est que le site n'est pas encore en ligne.

-> Lorsque vous posterez une oeuvre, il est normal que le temps de chargement soit long dans certains cas, surtout si les fichiers envoyés sont lourds.
Je prévois de mettre à ce moment là un chargement animé avec l'animation de Yanis.

-> Je n'ai pas reçu d'instructions pour les différentes animations du site, ce sera donc un point sur lequel certains devront certainement réfléchir.

-> Les caroussels ne sont pas encore 100% au point, donc ne vous étonnez pas d'y apercevoir des bugs graphiques.

-> Je souhaiterais que vous essayez avec tout votre possible de "foutre la merde" sur le site. Le but premier est avant tout qu'il soit sécurisé, et plus je trouverai de 
failles et mieux ce sera.

-> Je vous invite fortement à télécharger un logiciel qui vous permets de lire les QR Code sur ordinateur, afin de vérifier la bonne fonctionnalité des billets pour
les administrateurs.

-------------------------------------------

Je pense avoir dit le principal. Je vous souhaite bon courage dans l'exploration du site, en espérant qu'il soit conforme à vos attentes.
Bonne journée, et merci d'avoir lu !
	
