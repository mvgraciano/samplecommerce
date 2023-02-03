<?php $this->layout('_template'); ?>

<div class="row">
    <div class="container col-md-10">
        <div class="row py-2">
            <h2>Produtos</h2>
        </div>
        <div class="row row-cols-1 row-cols-md-3 g-4 p-4 mb-5">
            <?php foreach ($products as $product) :
                $hasPrice = !empty($product->tipo_preco);
            ?>
                <div class="col">
                    <div class="card h-100">
                        <img src="<?= $product->imagem ?? 'src/views/assets/img/default-product.jpg' ?>" class="card-img-top" alt="...">
                        <div class="card-body">
                            <h5 class="card-title h-25 mb-3"><?= $product->descricao ?></h5>
                            <?php if ($product->descricao_completa) : ?>
                                <p class="card-text"><span class="fw-bold">Descrição:</span> <?= $product->descricao_completa ?></p>
                            <?php endif; ?>
                            <p class="card-text"><span class="fw-bold">Ref:</span> <?= $product->referencia ?></p>
                            <p class="card-text"><span class="fw-bold">Código barras:</span> <?= $product->codigo_barras ?></p>
                            <p class="card-text"><span class="fw-bold">Quantidade estoque:</span> <?= $product->quantidade ?></p>

                        </div>
                        <div class="card-footer d-flex justify-content-between bg-white border-0">
                            <button class="btn btn-warning text-white">Comprar</button>   
                            <span class="card-text product-price fs-4 <?= $hasPrice ? 'text-success' : 'text-danger' ?>">
                                <?= $hasPrice ? "R$ " . to_money($product->tipo_preco[0]?->preco) : 'Sem estoque' ?>
                            </span>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</div>