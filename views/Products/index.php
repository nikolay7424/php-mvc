<h1>PRODUCTS</h1>

<a href="/products/new">New product</a>

<p>total amount or products: <?= $total ?></p>

<?php foreach ($products as $product) : ?>
    <a href="/products/<?= $product['id'] ?>/show">
        <h2><?= htmlspecialchars($product['name']) ?></h2>
    </a>
<?php endforeach; ?>

</body>
</html>
