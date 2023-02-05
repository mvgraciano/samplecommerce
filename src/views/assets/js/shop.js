$(document).ready(function () {

    $(document).on('show.bs.modal', '#modalAddItem', function (event) {

        const productCard = $(event.relatedTarget).closest(".product-card");
        const productName = productCard.find('.product-name').text();
        const productLink = productCard.find('.product-image').attr('src');
        const productRef = productCard.find('.product-ref').text();
        const productStock = parseInt(productCard.find('.product-stock').text());
        const productPrice = productCard.find('.product-price').text();

        $("#modalProductImage").attr('src', productLink);
        $("#modalProductName").text(productName);
        $("#modalProductRef").text(val_or_default(productRef));
        $("#modalProductPrice").text(productPrice);
        $("#modalProductStock").text(productStock);

        if (productStock < 1)
            $("#btnAddItem").addClass('disabled');
    });

    $(document).on('hide.bs.modal', '#modalAddItem', function (event) {
        $("#btnAddItem").removeClass('disabled');
        $("#quantity").val('0');
    });

    $(document).on('keyup', '#quantity', function (event) {

        const pressed = parseInt(event.key);

        if (!Number.isInteger(pressed)) {
            $(this).val('');
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
            price = price.split(" ").pop().replaceAll('.', '').replaceAll(',', '.');
        else
            price = 0;

        const totalAmount = price * quantity;
        $("#modalTotalAmount").text(
            totalAmount.toLocaleString('pt-BR', {
                currency: 'BRL',
                minimumFractionDigits: 2
            })
        );
    });

    const val_or_default = (value, defValue = '--') => value ? value : defValue;
});