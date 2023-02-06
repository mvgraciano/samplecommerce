<?php $this->layout('_template'); ?>

<div class="row">
    <div class="container col-md-10">
        <div class="row py-2">
            <h2>Minha caixinha</h2>
        </div>
        <div class="row row-cols-1 row-cols-md-3 g-4 p-4 mb-5">
            <div class="col-md-12">
                <div class="mb-4">
                    <p>Você tem <span class="cart-item-count">0</span> itens na sua caixinha de joias atualmente.</p>
                </div>

                <div id="divCartProducts">
                </div>
                <div id="divCheckoutFooter" class="d-none justify-content-between">
                    <button id="bntConfirmCheckout" type="button" class="btn btn-warning text-white disabled">
                        <i class="bi bi-bag-plus me-2 fs-4"></i>Finalizar pedido
                    </button>
                    <h3 id="checkoutTotalAmount">Total: </h3>
                </div>
            </div>
        </div>
    </div>