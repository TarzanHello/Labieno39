<?php
// Guides / articles (Oct 2026).
// Each article lives in /i18n/articles/{dir}/{lang}.php and exists only in VIA_ARTICLE_LANGS:
// the languages from which the neighbourhood guide already gets Google impressions.
// Visitors on other languages are sent to the English version (like the Cinecittà page).
//
// URLs: /guide (hub) and /guide/{slug}; other languages /{lang}/guide and /{lang}/guide/{slug}.

const VIA_ARTICLE_LANGS = ['it', 'en', 'fr', 'de', 'es', 'pt', 'ru'];

function via_articles() {
  return [
    'art_arrival' => [
      'dir' => 'arrivo',
      'image' => 'living_wide',
      'published' => '2026-10-19',
      'slugs' => [
        'it' => 'come-arrivare-cinecitta-subaugusta',
        'en' => 'how-to-get-to-cinecitta-subaugusta',
        'fr' => 'comment-aller-cinecitta-subaugusta',
        'de' => 'anreise-cinecitta-subaugusta',
        'es' => 'como-llegar-cinecitta-subaugusta',
        'pt' => 'como-chegar-cinecitta-subaugusta',
        'ru' => 'kak-dobratsya-chinechitta-subaugusta',
      ],
    ],
    'art_aqueducts' => [
      'dir' => 'acquedotti',
      'image' => 'terrazzo_2',
      'published' => '2026-10-19',
      'slugs' => [
        'it' => 'parco-degli-acquedotti',
        'en' => 'parco-degli-acquedotti-guide',
        'fr' => 'parc-des-aqueducs-rome',
        'de' => 'park-der-aquaedukte-rom',
        'es' => 'parque-de-los-acueductos-roma',
        'pt' => 'parque-dos-aquedutos-roma',
        'ru' => 'park-akvedukov-rim',
      ],
    ],
    'art_quadraro' => [
      'dir' => 'quadraro',
      'image' => 'terrazzo_1',
      'published' => '2026-10-19',
      'slugs' => [
        'it' => 'quadraro-street-art',
        'en' => 'quadraro-street-art-walk',
        'fr' => 'street-art-quadraro',
        'de' => 'street-art-quadraro',
        'es' => 'arte-urbano-quadraro',
        'pt' => 'arte-urbana-quadraro',
        'ru' => 'strit-art-kvadraro',
      ],
    ],
  ];
}

function is_article_route($route) {
  $route = (string)$route;
  $all = via_articles();
  return isset($all[$route]);
}

function is_guides_route($route) {
  $route = (string)$route;
  return $route === 'guides' || is_article_route($route);
}

// Route for a slug (any language). Returns '' if unknown.
function article_route_for_slug($slug) {
  $slug = strtolower(trim((string)$slug, '/'));
  if ($slug === '') return '';
  foreach (via_articles() as $route => $a) {
    foreach ($a['slugs'] as $s) {
      if ($s === $slug) return $route;
    }
  }
  return '';
}

function article_slug($route, $lang) {
  $all = via_articles();
  if (!isset($all[$route])) return '';
  $slugs = $all[$route]['slugs'];
  return (string)($slugs[$lang] ?? $slugs['en'] ?? reset($slugs));
}

// Article texts for a language (falls back to English). Returns [] if missing.
function article_content($route, $lang) {
  $all = via_articles();
  if (!isset($all[$route])) return [];
  $dir = preg_replace('/[^a-z0-9_-]/', '', (string)$all[$route]['dir']);
  $lang = in_array($lang, VIA_ARTICLE_LANGS, true) ? $lang : 'en';
  $file = __DIR__ . '/../i18n/articles/' . $dir . '/' . $lang . '.php';
  if (!file_exists($file)) $file = __DIR__ . '/../i18n/articles/' . $dir . '/en.php';
  if (!file_exists($file)) return [];
  $c = require $file;
  return is_array($c) ? $c : [];
}

// Last change of an article (any language file), for sitemap and dateModified.
function article_mtime($route) {
  $all = via_articles();
  if (!isset($all[$route])) return 0;
  $dir = preg_replace('/[^a-z0-9_-]/', '', (string)$all[$route]['dir']);
  $m = 0;
  foreach (glob(__DIR__ . '/../i18n/articles/' . $dir . '/*.php') ?: [] as $f) {
    $m = max($m, (int)@filemtime($f));
  }
  return $m;
}

// Interface strings for the guide pages (hub, call to action…), only in VIA_ARTICLE_LANGS.
function guides_ui($key, $lang = null) {
  static $ui = null;
  if ($ui === null) {
    $f = __DIR__ . '/../i18n/articles/_ui.php';
    $ui = file_exists($f) ? (require $f) : [];
    if (!is_array($ui)) $ui = [];
  }
  if ($lang === null) $lang = function_exists('current_lang') ? current_lang() : 'it';
  if (!isset($ui[$lang])) $lang = 'en';
  $v = $ui[$lang][$key] ?? ($ui['en'][$key] ?? '');
  return $v;
}
