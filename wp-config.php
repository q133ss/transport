<?php
/**
 * Основные параметры WordPress.
 *
 * Скрипт для создания wp-config.php использует этот файл в процессе установки.
 * Необязательно использовать веб-интерфейс, можно скопировать файл в "wp-config.php"
 * и заполнить значения вручную.
 *
 * Этот файл содержит следующие параметры:
 *
 * * Настройки MySQL
 * * Секретные ключи
 * * Префикс таблиц базы данных
 * * ABSPATH
 *
 * @link https://ru.wordpress.org/support/article/editing-wp-config-php/
 *
 * @package WordPress
 */

// ** Параметры базы данных: Эту информацию можно получить у вашего хостинг-провайдера ** //
/** Имя базы данных для WordPress */
define( 'DB_NAME', 'perevozki' );

/** Имя пользователя базы данных */
define( 'DB_USER', 'root' );

/** Пароль к базе данных */
define( 'DB_PASSWORD', '' );

/** Имя сервера базы данных */
define( 'DB_HOST', 'localhost' );

/** Кодировка базы данных для создания таблиц. */
define( 'DB_CHARSET', 'utf8mb4' );

/** Схема сопоставления. Не меняйте, если не уверены. */
define( 'DB_COLLATE', '' );

/**#@+
 * Уникальные ключи и соли для аутентификации.
 *
 * Смените значение каждой константы на уникальную фразу. Можно сгенерировать их с помощью
 * {@link https://api.wordpress.org/secret-key/1.1/salt/ сервиса ключей на WordPress.org}.
 *
 * Можно изменить их, чтобы сделать существующие файлы cookies недействительными.
 * Пользователям потребуется авторизоваться снова.
 *
 * @since 2.6.0
 */
define( 'AUTH_KEY',         '@Z-uz`H({$;$c|VF~;+2n$ouOtK#7nrjRyx7WtWa)/8=0ZwQ:acgH/(q|F=xtHD,' );
define( 'SECURE_AUTH_KEY',  'x7=1Eg#&_]5!B`l,mY?O.At-^VUMU+!R}4=D/XdjRBA5KR)Bg19}}HO5}+-DV!_D' );
define( 'LOGGED_IN_KEY',    '|H2^_aKJ5tnp(p_B2.{XMs>NW64JmTV`8MNtx_F?8f;`N+ODVW!? >OrR$2.0> F' );
define( 'NONCE_KEY',        '_?5+$arj;q_>(,H $58GUkL*VNOBjNt;V`$^0V9,K;L:=!{(5ev_v bVO 2|]k2;' );
define( 'AUTH_SALT',        '0=(MF:A{>x{lU.,NCu>A#/9&pUzd&(n=g:7C9?a{es.^h3s1::)nW;V&-`!VA]}k' );
define( 'SECURE_AUTH_SALT', 'lyYCdA#f3=~(Cl`m^bGM.i${@Vo7]Q4-=onGAdNa~uFP?grSo`<<x5c(m=#1.K>#' );
define( 'LOGGED_IN_SALT',   '@N7?%Y@c$#n91]46t2f2be1*0!x&x[VJdpl(!J2+aJZ;]JSRuSANJiFS36kTF03E' );
define( 'NONCE_SALT',       '=a4r!3b}XDEnXwRr;*{cBAf1,oJBR-aK`;;sB1aZ9G+8^7l8O8?]#V]uk@$(sV!y' );

/**#@-*/

/**
 * Префикс таблиц в базе данных WordPress.
 *
 * Можно установить несколько сайтов в одну базу данных, если использовать
 * разные префиксы. Пожалуйста, указывайте только цифры, буквы и знак подчеркивания.
 */
$table_prefix = 'wp_';

/**
 * Для разработчиков: Режим отладки WordPress.
 *
 * Измените это значение на true, чтобы включить отображение уведомлений при разработке.
 * Разработчикам плагинов и тем настоятельно рекомендуется использовать WP_DEBUG
 * в своём рабочем окружении.
 *
 * Информацию о других отладочных константах можно найти в документации.
 *
 * @link https://ru.wordpress.org/support/article/debugging-in-wordpress/
 */
define( 'WP_DEBUG', false );

/* Произвольные значения добавляйте между этой строкой и надписью "дальше не редактируем". */



/* Это всё, дальше не редактируем. Успехов! */

/** Абсолютный путь к директории WordPress. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Инициализирует переменные WordPress и подключает файлы. */
require_once ABSPATH . 'wp-settings.php';
