$(document).ready(function () {

    if (cart = JSON.parse(localStorage.getItem('cart')))
        update_item_count(cart)

    const page = window.location.pathname.split('/').filter(val => val != '').pop();

    $(document).on('show.bs.modal', '#modalAddItem', function (event) {

        const productCard = $(event.relatedTarget).closest(".product-card");
        const productName = productCard.find('.product-name').text();
        const productLink = productCard.find('.product-image').attr('src');
        const productRef = productCard.find('.product-ref').text();
        const productStock = parseInt(productCard.find('.product-stock').text());
        const productBarCode = productCard.find('.product-barcode').text();
        const productPrice = productCard.find('.product-price').text();

        $("#modalProductImage").attr('src', productLink);
        $("#modalProductName").text(productName);
        $("#modalProductRef").text(val_or_default(productRef));
        $("#modalProductBarCode").text(productBarCode);
        $("#modalProductPrice").text(productPrice);
        $("#modalProductStock").text(productStock);

        if (productStock < 1)
            $("#btnAddItem").addClass('disabled');
    });

    $(document).on('hide.bs.modal', '#modalAddItem', () => {
        $("#btnAddItem").removeClass('disabled');
        $("#divErrorQuantity").addClass('d-none');
        $("#quantity").val('0');
        $("#modalTotalAmount").text("0,00");
    });

    $(document).on('keyup', '#quantity', function (event) {

        const pressed = parseInt(event.key);

        if (!Number.isInteger(pressed)) {
            $(this).val('');
            $("#modalTotalAmount").text("0,00");
            return;
        }

        const productStock = $("#modalProductStock").text();
        let quantity = parseInt($(this).val());

        if (productStock < quantity) {
            $(this).val(productStock);
            quantity = productStock;
        }

        let price = $("#modalProductPrice").text().trim();
        if (price != 'Indisp.')
            price = money_to_float(price);
        else
            price = 0;

        const totalAmount = price * quantity;
        $("#modalTotalAmount").text(
            float_to_money(totalAmount)
        );
    });

    $(document).on('click', '#btnAddItem', function (event) {

        const quantity = $("#quantity").val();

        if (quantity == '' || quantity == 0) {
            $("#divErrorQuantity").removeClass('d-none');
            return;
        } else {
            $("#divErrorQuantity").addClass('d-none');
        }

        const item = {
            name: $("#modalProductName").text(),
            barCode: $("#modalProductBarCode").text(),
            ref: $("#modalProductRef").text(),
            price: money_to_float($("#modalProductPrice").text()),
            image: $("#modalProductImage").attr('src'),
            quantity: parseInt(quantity),
        };

        let cart = [];
        if (storageCart = JSON.parse(get_storage('cart'))) {
            let update = false;
            storageCart.map(data => {
                if (data.barCode == item.barCode) {
                    cart.push(item);
                    update = true;
                } else {
                    cart.push(data);
                }
            })

            if (!update) {
                cart.push(item)
            }
        } else {
            cart.push(item);
        }

        set_storage('cart', JSON.stringify(cart));

        $('#modalAddItem').modal('hide');

        update_item_count(cart);

        toastr.success('Produto adicionado com sucesso!');
    });

    if (page == 'caixinha') {
        let html = '';
        let totalAmount = 0;

        if (cart.length > 0) {
            cart.forEach(item => {
                let totalItem = float_to_money(item.quantity * item.price);
                totalAmount += item.quantity * item.price;
                html +=
                    `<div class="card mb-3" data-code="${item.barCode}">
                        <div class="card-body">
                            <div class="d-flex justify-content-between">
                                <div class="d-flex flex-row align-items-center">
                                    <div>
                                        <img src="${item.image}" class="img-fluid rounded-3" alt="Item" style="width: 100px;">
                                    </div>
                                    <div class="ms-3">
                                        <h5>${item.name}</h5>
                                        <p class="small mb-0"><label class="fw-bold">Ref:</label> ${item.ref}</p>
                                        <p class="small mb-0"><label class="fw-bold">Código de barras:</label> ${item.barCode}</p>
                                        <p class="small mb-0"><label class="fw-bold">Preço unit.:</label> ${item.price}</p>
                                    </div>
                                </div>
                                <div class="d-flex flex-row align-items-center">
                                    <div class="d-flex flex-column align-items-center mx-5">
                                        <p class="small mb-0"><label class="fw-bold">Quantidade</p>
                                        <p class="fw-normal mb-0">${item.quantity}</p>
                                    </div>
                                    <div class="d-flex flex-column align-items-center mx-5">
                                        <p class="small mb-0"><label class="fw-bold">Total</p>
                                        <p class="fw-normal mb-0">R$${totalItem}</p>
                                    </div>
                                    <button class="btn btn-danger remove-item">
                                        <i class="bi bi-bag-dash"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>`;
            });

            $("#divCartProducts").html(html);
            $("#checkoutTotalAmount").text(`Total: R$${float_to_money(totalAmount)}`).addClass('text-success');
            $("#divCheckoutFooter").addClass("d-flex").removeClass("d-none");

        } else {
            $("#divCheckoutFooter").addClass("d-none").removeClass("d-flex");
        }
    }

    $(document).on('click', '.remove-item', function (event) {
        const card = $(this).closest('.card');
        const barCode = card.data('code');

        let cart = JSON.parse(get_storage('cart')).filter((item) =>
            item.barCode != barCode
        );

        set_storage('cart', JSON.stringify(cart));

        update_item_count(cart);
        $("#checkoutTotalAmount").text(`Total: R$${get_cart_total_amount(cart)}`)

        card.remove();
    });

    $(document).on('click', '#bntConfirmCheckout', async function (event) {
        const url = urlBase + '/checkout';

        const req = {
            method: 'POST',
            headers: {
                "ContentType": "application/json;"
            }
        };

        body = {
            items: JSON.parse(localStorage.getItem('cart'))
        }

        req.body = JSON.stringify(body);

        let res = await fetch(url, req);
    });

    $(document).on('click', '#btnSearch', async function (event) {
        event.preventDefault();

        const term = $("#inputSearch").val();

        const url = `${urlBase}/products?search=${term}`

        const products = await fetch(url)
            .then(response => response.json());

        buildProductsList(products);
    });

    const val_or_default = (value, defValue = '--') => value ? value : defValue;

    const get_storage = key => localStorage.getItem(key);
    const set_storage = (key, value) => localStorage.setItem(key, value);

    const money_to_float = amount =>
        parseFloat(amount.trim().replaceAll('R$ ', '').replaceAll('.', '').replaceAll(',', '.'));

    function float_to_money(amount) {
        return amount.toLocaleString('pt-BR', { currency: 'BRL', minimumFractionDigits: 2 })
    }

    function update_item_count(cart) {
        $("#cartItemCount, .cart-item-count").text(cart.reduce((total, item) => {
            total += item.quantity;
            return total;
        }, 0))
    };

    function get_cart_total_amount(cart) {
        return cart.reduce((total, item) => {
            total += item.quantity * item.price;
            return total;
        }, 0);
    }

    function buildProductsList(list) {
        let html = '';
        if (list.length > 0) {
            html = list.reduce((html, product) => {
                const hasPrice = product.tipo_preco.length > 0;

                html += `
                <div class="col">
                    <div class="card h-100 product-card">
                        <img src="${product.imagem ?? 'src/views/assets/img/default-product.jpg'}" class="card-img-top product-image" alt="Imagem do produto">
                        <div class="card-body">
                            <h5 class="card-title h-20 mb-3 product-name">${product.descricao}</h5>
                            ${product.descricao_completa ? `<p class="card-text"><span class="fw-bold">Descrição:</span>${product.descricao_completa}</p>` : ''}
                            <p class="card-text">
                                <label class="fw-bold">Ref:</label>
                                <span class="product-ref">${product.referencia ?? '--'}</span>
                            </p>
                            <p class="card-text">
                                <label class="fw-bold">Código barras:</label>
                                <span class="product-barcode">${product.codigo_barras}</span>
                            </p>
                            <p class="card-text">
                                <label class="fw-bold">Quantidade estoque:</label>
                                <span class="product-stock">${product.quantidade}</span>
                            </p>

                        </div>
                        <div class="card-footer d-flex justify-content-between bg-white border-0">
                            <button class="btn btn-warning text-white" data-bs-toggle="modal" data-bs-target="#modalAddItem">Comprar</button>
                            <span class="card-text product-price fs-4 ${hasPrice ? 'text-success' : 'text-danger'}">
                                ${hasPrice ? "R$ " + float_to_money(product.tipo_preco[0].preco) : 'Indisp.'}
                            </span>
                        </div>
                    </div>
                </div>
                `;
                return html;
            }, '')
        } else {
            html += '<div class="text-primary fs-4">Nenhum produto encontrado</div>'
        }
        $("#divProductsList").html(html);
    }

});