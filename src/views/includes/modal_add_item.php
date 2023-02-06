<div class="modal fade" id="modalAddItem" tabindex="-1" aria-labelledby="modalAddItemLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalAddItemLabel">Adicionar à caixinha</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <img id="modalProductImage" src="src/views/assets/img/default-product.jpg" alt="Imagem do produto">
                </div>
                <div class="row">
                    <p class="fs-5 fw-bold" id="modalProductName">Produto X</p>
                </div>
                <div class="row mb-3">
                    <div class="col-md-12">
                        <label class="fw-bold">Ref:</label>
                        <span id="modalProductRef"></span>
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-md-12">
                        <label class="fw-bold">Cód. barras:</label>
                        <span id="modalProductBarCode"></span>
                    </div>
                </div>
                <div class="row my-3">
                    <div class="col-md-12">
                        <label class="fw-bold">Preço:</label>
                        <span id="modalProductPrice"></span>
                    </div>
                </div>
                <div class="row my-3">
                    <div class="col-md-12">
                        <label class="fw-bold">Quantidade disponível:</label>
                        <span id="modalProductStock"></span>
                    </div>
                </div>
                <div class="divider">
                    <div class="row justify-content-center">
                        <hr class="w-75">
                    </div>
                </div>
                <form>
                    <div class="mb-3 d-flex gap-2">
                        <label for="quantity" class=" col-form-label">Quantidade</label>
                        <div class="flex-grow-1">
                            <input type="text" class="form-control" id="quantity" value="0">
                            <div id="divErrorQuantity" class="div-error text-danger d-none">Informe a quantidade desejada</div>
                        </div>
                    </div>
                </form>
                <div class="d-flex justify-content-end ">
                    <p class=" text-success fs-5">R$<span id="modalTotalAmount" class="product-price mx-1 fs-2">0,00</span></p>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">
                    <i class="bi bi-x-circle-fill me-2 fs-4"></i>Cancelar
                </button>
                <button type="button" id="btnAddItem" class="btn btn-warning text-white">
                    <i class="bi bi-bag-plus-fill me-2 fs-4"></i>Adicionar
                </button>
            </div>
        </div>
    </div>
</div>