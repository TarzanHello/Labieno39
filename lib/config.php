<?php

// Minimal configuration.
// Most settings are editable from the admin panel and stored in /data/store.json.

return [
  'timezone' => 'Europe/Rome',
  'default_lang' => 'it',

  // Debug: when true, PHP errors may be displayed. Keep false in production.
  'debug' => false,

  // Security: restrict which Host headers we consider valid when generating absolute URLs
  // (Stripe redirects, canonical URLs, emails). Adjust if you use a different domain.
  //
  // Dominio ufficiale di Labieno 39: www.labieno39.it (registrato su Aruba).
  'allowed_hosts' => [
    'labieno39.it',
    'www.labieno39.it',
  ],
  // Canonical host used for absolute URLs (recommended)
  // IMPORTANT (SEO): keep this aligned with the domain you want indexed.
  // We target the www version as canonical.
  'canonical_host' => 'www.labieno39.it',
  // Always generate https:// URLs even if the request reaches PHP via a proxy
  'force_https' => true,

  // Safety: if your hosting blocks outbound HTTP requests, Booking iCal sync won't work.
  'curl_timeout_seconds' => 10,

  // iCal: allow plain http feeds (not recommended). Booking feeds are usually https.
  'allow_insecure_ical_http' => false,
];
