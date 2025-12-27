<?php
$images = !empty($bien['image']) ? explode(',', $bien['image']) : [];
$firstImagePath = !empty($images) ? trim($images[0]) : '';
$fullImagePath = UPLOAD_PATH . $firstImagePath;
$imageExists = !empty($firstImagePath) && file_exists($fullImagePath);
?>

<div class="bien-card max-w-sm w-full bg-white rounded-xl overflow-hidden shadow-md transform transition hover:scale-105"
    data-titre="<?= strtolower(htmlspecialchars($bien['titre'])) ?>"
    data-ville="<?= strtolower(htmlspecialchars($bien['ville'])) ?>"
    data-type="<?= htmlspecialchars($bien['type']) ?>"
    data-prix="<?= $bien['prix'] ?>">

    <?php if ($imageExists): ?>
        <img src="<?= $fullImagePath ?>" alt="<?= htmlspecialchars($bien['titre']) ?>" class="w-full h-48 object-cover">
    <?php else: ?>
        <div class="w-full h-48 bg-gray-200 flex items-center justify-center">
            <i class="fas fa-image text-4xl text-gray-400"></i>
        </div>
    <?php endif; ?>

    <div class="p-6">
        <h3 class="text-xl font-bold mb-2"><?= htmlspecialchars($bien['titre']) ?></h3>
        <p class="text-gray-600">
            <?= htmlspecialchars($bien['ville']) ?> -
            <?= htmlspecialchars($bien['surface']) ?>m² -
            <?= htmlspecialchars($bien['pieces']) ?> pièces
        </p>
        <div class="flex justify-between items-center mt-4">
            <span class="text-primary font-semibold">
                <?= number_format($bien['prix'], 0, ',', ' ') ?>€
                <?= ($bien['statut'] == 'location') ? '/mois' : '' ?>
            </span>
            <a href="details.php?id=<?= $bien['id'] ?>"
                class="text-white bg-primary hover:bg-secondary px-4 py-2 rounded-full transition">
                Détails
            </a>
        </div>
        <?php if (!empty($bien['visite_virtuelle_url'])): ?>
            <a href="<?= htmlspecialchars($bien['visite_virtuelle_url']) ?>" target="_blank"
                class="block mt-3 text-primary text-sm hover:underline">
                <i class="fas fa-vr-cardboard mr-1"></i> Visite Virtuelle
            </a>
        <?php endif; ?>
    </div>
</div>