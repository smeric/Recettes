<?php
/**
 * La configuration de base de votre installation WordPress.
 *
 * Ce fichier est utilisé par le script de création de wp-config.php pendant
 * le processus d’installation. Vous n’avez pas à utiliser le site web, vous
 * pouvez simplement renommer ce fichier en « wp-config.php » et remplir les
 * valeurs.
 *
 * Ce fichier contient les réglages de configuration suivants :
 *
 * Réglages MySQL
 * Préfixe de table
 * Clés secrètes
 * Langue utilisée
 * ABSPATH
 *
 * @link https://fr.wordpress.org/support/article/editing-wp-config-php/.
 *
 * @package WordPress
 */

// ** Réglages MySQL - Votre hébergeur doit vous fournir ces informations. ** //
/** Nom de la base de données de WordPress. */
define( 'DB_NAME', 'recettes' );

/** Utilisateur de la base de données MySQL. */
define( 'DB_USER', 'root' );

/** Mot de passe de la base de données MySQL. */
define( 'DB_PASSWORD', '' );

/** Adresse de l’hébergement MySQL. */
define( 'DB_HOST', 'localhost' );

/** Jeu de caractères à utiliser par la base de données lors de la création des tables. */
define( 'DB_CHARSET', 'utf8' );

/**
 * Type de collation de la base de données.
 * N’y touchez que si vous savez ce que vous faites.
 */
define( 'DB_COLLATE', '' );

/**#@+
 * Clés uniques d’authentification et salage.
 *
 * Remplacez les valeurs par défaut par des phrases uniques !
 * Vous pouvez générer des phrases aléatoires en utilisant
 * {@link https://api.wordpress.org/secret-key/1.1/salt/ le service de clés secrètes de WordPress.org}.
 * Vous pouvez modifier ces phrases à n’importe quel moment, afin d’invalider tous les cookies existants.
 * Cela forcera également tous les utilisateurs à se reconnecter.
 *
 * @since 2.6.0
 */
define('AUTH_KEY',         't(^ky1e|u68P=T-0 4N!{B`R21MS5`YVo.[Kuz-|3MN{}130 ]kf#822|vSnATk)');
define('SECURE_AUTH_KEY',  'AvazhB!`lF.O;Xd1my|jce^-i--P}n#pm2ts?(L/1}Xhq*j,|Dig+d^`O0ysu5P-');
define('LOGGED_IN_KEY',    'R,U, I(2N+@Vx=i&I8t(]QKMIS[+-Q#<UGftm2dbu!%zsmi%Ed7-5[S%@8]&grf9');
define('NONCE_KEY',        ')/76ve_+t/Y160V94,J+; 5ZXhq]h~FB<`Li<s=9nNK-ie!ic/AV:S+TYi&VTAu<');
define('AUTH_SALT',        ']~)1ZMZ=-w[401oK(@A-48{L8P-%-iCfHaDV7jo ktZ60yM|YJlq!3Y[/uYS`g9p');
define('SECURE_AUTH_SALT', '#^W9I#+|`~};3J^yn;$U],):m_ET@2BS(1=p$4ERfj+K:b$!xiLL|6, FPtq6g-U');
define('LOGGED_IN_SALT',   '3OFuU>PkA~_8N4-+Q{Ce8~95VB6~1ejR0/ 3g0VKBy(Pa)4u;0?)McF9{]Ay)Hv&');
define('NONCE_SALT',       '6$M|y(Kuz#YurUKF+<||q#96clk?qMZakJAdJ*L5.vP#BYE2B1`}2te{LJSo$!JB');
/**#@-*/

/**
 * Préfixe de base de données pour les tables de WordPress.
 *
 * Vous pouvez installer plusieurs WordPress sur une seule base de données
 * si vous leur donnez chacune un préfixe unique.
 * N’utilisez que des chiffres, des lettres non-accentuées, et des caractères soulignés !
 */
$table_prefix = 'wp_recettes_';

/**
 * Pour les développeurs : le mode déboguage de WordPress.
 *
 * En passant la valeur suivante à "true", vous activez l’affichage des
 * notifications d’erreurs pendant vos essais.
 * Il est fortement recommandé que les développeurs d’extensions et
 * de thèmes se servent de WP_DEBUG dans leur environnement de
 * développement.
 *
 * Pour plus d’information sur les autres constantes qui peuvent être utilisées
 * pour le déboguage, rendez-vous sur le Codex.
 *
 * @link https://fr.wordpress.org/support/article/debugging-in-wordpress/
 */
define( 'WP_DEBUG', true );

/* C’est tout, ne touchez pas à ce qui suit ! Bonne publication. */

/** Chemin absolu vers le dossier de WordPress. */
if ( ! defined( 'ABSPATH' ) )
  define( 'ABSPATH', dirname( __FILE__ ) . '/' );

/** Réglage des variables de WordPress et de ses fichiers inclus. */
require_once( ABSPATH . 'wp-settings.php' );
