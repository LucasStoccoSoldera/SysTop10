const { find } = require("lodash");

function showParcelas(id)
{
    var table_parcelas = $('#tb_parcelas').DataTable({
        paging: true,
        searching: false,
        processing: true,
        serverside: true,
        ajax: {
            type: 'GET',
            url: '/admin/List_Parcelas/' + id,
            data: conta,
        },
        columns: [{
                data: "par_conta",
                className: "text-center"
            },
            {
                data: "par_numero",
                className: "text-center"
            },
            {
                data: "par_valor",
                className: "text-right",
                render: DataTable.render.number('.', ',', 2, 'R$')
            },
            {
                data: "par_status",
                className: "text-center"
            },
            {
                data: "par_data_pagto",
                className: "text-center"
            },
        ]
    });
        $("#modalShowParcelas").modal('toggle');
}

function showItemCompra(id)
{
    var table_item_compra = $('#tb_item_compra').DataTable({
        paging: true,
        searching: false,
        processing: true,
        serverside: true,
        ajax: '/admin/List_ItemCompra/' + id,
        columns: [{
                data: "cde_produto"
            },
            {
                data: "cde_qtde"
            },
            {
                data: "dim_id"
            },
            {
                data: "cor_id"
            },
            {
                data: "cde_valoritem",
                className: "text-right"
            },
            {
                data: "cde_valortotal",
                className: "text-right"
            },
            {
                data: "action",
                className: "text-right"
            },
        ]
    });
}

function showItemVenda(id)
{
    var table_item_venda = $('#tb_item_venda').DataTable({
        paging: true,
        searching: false,
        processing: true,
        serverside: true,
        ajax: '/admin/List_ItemVenda/' + id,
        columns: [{
                data: "id",
                className: "text-center"
            },
            {
                data: "pro_id"
            },
            {
                data: "det_qtde"
            },
            {
                data: "det_valor_total",
                className: "text-right",
                render: DataTable.render.number('.', ',', 2, 'R$')
            },
        ]
    });
    if(document.find('#modalShowItemVenda')){
    $("#modalShowItemVenda").modal('toggle');
    }
}
