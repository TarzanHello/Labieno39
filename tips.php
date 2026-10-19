<?php
require_once __DIR__ . '/lib/lib.php';
include __DIR__ . '/partials/header.php';

$pageHero = [
  'title' => t('tips.hero.title'),
  'lead' => t('tips.hero.lead'),
  'image' => '/assets/images/gallery/cucina.jpg',
  'actions' => [
    ['href' => i18n_url('neighborhood'), 'label' => t('tips.hero.cta_neighborhood'), 'class' => 'btn secondary'],
    ['href' => i18n_url('booking'), 'label' => t('tips.hero.cta_book'), 'class' => 'btn'],
  ]
];
include __DIR__ . '/partials/page-hero.php';
?>


<main class="site-main">
<section class="section-pad section-muted">
  <div class="container">
    <?php
      $tipSections = i18n_get('tips.sections');
      if (!is_array($tipSections)) $tipSections = [];
      $tipsMaps = function ($q, $search) {
        return 'https://www.google.com/maps/search/?api=1&query=' . rawurlencode((string)$q);
      };
    ?>
    <div class="panel-grid">
      <?php foreach ($tipSections as $ts): if (!is_array($ts)) continue; ?>
        <div class="card panel">
          <h2 style="margin:0 0 10px;"><?php echo e((string)($ts['h'] ?? '')); ?></h2>
          <ul class="list">
            <?php foreach ((array)($ts['items'] ?? []) as $it): if (!is_array($it)) continue; ?>
              <li>
                <div class="title"><?php echo e((string)($it['title'] ?? '')); ?></div>
                <?php if (!empty($it['meta'])): ?><div class="meta"><?php echo e((string)$it['meta']); ?></div><?php endif; ?>
                <a class="link" href="<?php echo e($tipsMaps($it['q'] ?? ($it['title'] ?? ''), !empty($it['search']))); ?>" target="_blank" rel="noopener"><?php echo e(!empty($it['search']) ? t('tips.search_maps') : t('tips.open_maps')); ?></a>
              </li>
            <?php endforeach; ?>
          </ul>
        </div>
      <?php endforeach; ?>
    </div>

    <div class="notice" style="margin-top:18px;">
      <?php echo e(t('tips.note')); ?> <?php echo e(t('tips.good_stay')); ?>
    </div>
  </div>
</section>

</main>

<?php include __DIR__ . '/partials/footer.php'; ?>
