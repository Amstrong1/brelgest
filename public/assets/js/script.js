// datatables linking with tables
$(document).ready(function () {
    $('#prod_group').DataTable(
        {
            'aaSorting': [],
            "pageLength": 50
        }
    );
    $('#provider').DataTable(
        {
            'aaSorting': [],
            "pageLength": 50
        }
    );
    $('#cli').DataTable(
        {
            'aaSorting': [],
            "pageLength": 50
        }
    );
    $('#prod').DataTable(
        {
            'aaSorting': [],
            "pageLength": 50
        }
    );
    $('#inv').DataTable(
        {
            'aaSorting': [],
            "pageLength": 50
        }
    );
    $('#stal').DataTable(
        {
            'aaSorting': [],
            "pageLength": 50
        }
    );
    $('#stent').DataTable(
        {
            'aaSorting': [],
            "pageLength": 50
        }
    );
    $('#stext').DataTable(
        {
            'aaSorting': [],
            "pageLength": 50
        }
    );
    $('#stcur').DataTable(
        {
            'aaSorting': [],
            "pageLength": 50
        }
    );
    $('#datatable_prod').DataTable(
        {
            'aaSorting': [],
            "pageLength": 50
        }
    );
    $('#datatable_cli').DataTable(
        {
            'aaSorting': [],
            "pageLength": 50
        }
    );
    $('#user').DataTable(
        {
            'aaSorting': [],
            "pageLength": 50
        }
    );
    $('#det').DataTable(
        {
            'aaSorting': [],
            "pageLength": 50
        }
    );
});


// livesearch function
$('.livesearch').select2({
    placeholder: '',
    ajax: {
        url: '/ajax-autocomplete-search',
        dataType: 'json',
        delay: 250,
        processResults: function (data) {
            return {
                results: $.map(data, function (item) {
                    return {
                        text: item.LibProd,
                        id: item.id + '/' + item.PrixHT + '/' + item.AssujetisTVA + '/' + item.IDt_ProduitPK
                    }
                })
            };
        },
        cache: true
    }
});


// function to add new row where creating invoice

var i = -1,
    tax_val = 1,
    hta_total = 0,
    htb_total = 0,
    htd_total = 0,
    hte_total = 0,
    tva_btotal = 0,
    tva_dtotal = 0,
    rm_total = 0,
    aib_total = 0,
    ttc_total = 0;
function addRow() {
    var empTab = document.getElementById('formTable'),
        check = 0,
        selvalue_array = document.getElementById('liste').options[document.getElementById('liste').selectedIndex].value.split("/");

    // check if some product was choose
    if (selvalue_array !== null) {
        // check if products was alredy added
        for (let index = 0; index < document.getElementsByClassName('product_name').length; index++) {
            var cell_check = document.getElementsByClassName('product_name')[index].value;
            if (cell_check == document.getElementById('liste').options[document.getElementById('liste').selectedIndex].text) {

                // check if taxe change
                if (document.getElementsByClassName('product_tax')[index].value != document.getElementsByName('tax')[0].options[document.getElementsByName('tax')[0].selectedIndex].text) {
                    alert('Vérifier le type de taxe');
                }

                else {
                    document.getElementsByClassName('qte_product')[index].value = parseInt(document.getElementsByClassName('qte_product')[index].value) + parseInt(document.getElementsByName('qte')[0].value);

                    // calcul de la remise
                    // rm_prod = (selvalue_array[1] * document.getElementsByName('remise')[0].value) / 100;

                    // display prices in table
                    prix_ft_qte_prod = parseInt((selvalue_array[1]) * document.getElementsByClassName('qte_product')[index].value);
                    // price ft taxe
                    if (document.getElementsByName('tax')[0].options[document.getElementsByName('tax')[0].selectedIndex].text == 'A') {
                        hta_total = prix_ft_qte_prod;
                        document.getElementsByClassName('sub_total')[index].value = parseInt(selvalue_array[1] * document.getElementsByClassName('qte_product')[index].value);
                        document.getElementsByClassName('product_ttc')[index].value = parseInt(selvalue_array[1] * document.getElementsByClassName('qte_product')[index].value);
                    }

                    if (document.getElementsByName('tax')[0].options[document.getElementsByName('tax')[0].selectedIndex].text == 'B') {
                        tax_val = 1 + 0.18;
                        htb_total = prix_ft_qte_prod;
                        document.getElementsByClassName('sub_total')[index].value = parseInt(selvalue_array[1] * document.getElementsByClassName('qte_product')[index].value);
                        tva_btotal = parseInt(htb_total * 0.18);
                        document.getElementsByClassName('product_ttc')[index].value = parseInt(selvalue_array[1] * tax_val * document.getElementsByClassName('qte_product')[index].value);
                    }

                    if (document.getElementsByName('tax')[0].options[document.getElementsByName('tax')[0].selectedIndex].text == 'D') {
                        tax_val = 1 + 0.18;
                        htd_total = prix_ft_qte_prod;
                        document.getElementsByClassName('sub_total')[index].value = parseInt(selvalue_array[1] * document.getElementsByClassName('qte_product')[index].value);
                        tva_dtotal = parseInt(htd_total * 0.18);
                        document.getElementsByClassName('product_ttc')[index].value = parseInt(selvalue_array[1] * tax_val * document.getElementsByClassName('qte_product')[index].value);
                    }

                    if (document.getElementsByName('tax')[0].options[document.getElementsByName('tax')[0].selectedIndex].text == 'E') {
                        hte_total = prix_ft_qte_prod;
                        document.getElementsByClassName('sub_total')[index].value = parseInt(selvalue_array[1] * document.getElementsByClassName('qte_product')[index].value);
                        document.getElementsByClassName('product_ttc')[index].value = parseInt(selvalue_array[1] * document.getElementsByClassName('qte_product')[index].value);
                    }

                    check++;
                }
            }
        }

        if (check == 0) {
            var rowCnt = empTab.rows.length;    // get the number of rows.
            var tr = empTab.insertRow(rowCnt); // table row.
            i++;

            for (var c = 0; c < 10; c++) {
                var td = document.createElement('td');          // TABLE DEFINITION.
                td = tr.insertCell(c);

                if (c == 0) {   // if its the first column of the table.
                    // add a button control.
                    var button = document.createElement('button');

                    // set the attributes.
                    button.setAttribute('type', 'button');
                    button.setAttribute('class', "del_btn flex items-center justify-between px-2 py-2 text-sm font-medium leading-5 text-purple-600 rounded-lg dark:text-gray-400 focus:outline-none focus:shadow-outline-gray");
                    button.innerHTML = '<img style="height: 20px; width: 20px" src="/assets/img/delete.svg"/>';
                    button.setAttribute('value', i);
                    // add button's "onclick" event.
                    button.setAttribute('onclick', 'removeRow(this)');

                    td.appendChild(button);
                }
                if (c == 1) {
                    // the 2nd column, will have designation.
                    var input = document.createElement('input');

                    input.setAttribute('name', 'product[]');
                    input.setAttribute('type', 'text');
                    input.setAttribute('readonly', 'readonly');
                    input.setAttribute('class', 'product_name w-80 ml-1 mr-1 text-sm text-gray-700 dark:focus:shadow-outline-gray border-0 dark:text-gray-200 focus:bg-white focus:border-purple-300 focus:outline-none focus:shadow-outline-purple form-input');
                    input.setAttribute('value', document.getElementById('liste').options[document.getElementById('liste').selectedIndex].text);

                    td.appendChild(input);
                }
                if (c == 2) {
                    // the 3rd column, will have tax.
                    var input = document.createElement('input');

                    input.setAttribute('name', 'tax[]');
                    input.setAttribute('type', 'text');
                    input.setAttribute('readonly', 'readonly');
                    input.setAttribute('class', 'product_tax w-12 ml-1 mr-1 text-sm text-gray-700 dark:focus:shadow-outline-gray border-0 dark:text-gray-200 focus:bg-white focus:border-purple-300 focus:outline-none focus:shadow-outline-purple form-input');
                    input.setAttribute('value', document.getElementsByName('tax')[0].options[document.getElementsByName('tax')[0].selectedIndex].text);

                    td.appendChild(input);
                }
                if (c == 3) {
                    // the 4th column, will have qte.
                    var input = document.createElement('input');

                    input.setAttribute('name', 'qte[]');
                    input.setAttribute('type', 'number');
                    input.setAttribute('class', 'qte_product w-24 ml-1 mr-1 text-sm text-gray-700 dark:focus:shadow-outline-gray border-0 dark:text-gray-200 focus:bg-white focus:border-purple-300 focus:outline-none focus:shadow-outline-purple form-input');
                    input.setAttribute('value', document.getElementsByName('qte')[0].value);
                    input.setAttribute('onchange', 'new_price_ft_qte(this)');

                    td.appendChild(input);
                }
                if (c == 4) {
                    // the 5th column, will have unit price.
                    var input = document.createElement('input');

                    input.setAttribute('name', 'pu[]');
                    input.setAttribute('type', 'text');
                    input.setAttribute('readonly', 'readonly');
                    input.setAttribute('class', 'w-24 ml-1 mr-1 text-sm text-gray-700 dark:focus:shadow-outline-gray border-0 dark:text-gray-200 focus:bg-white focus:border-purple-300 focus:outline-none focus:shadow-outline-purple form-input');
                    input.setAttribute('value', parseInt(selvalue_array[1]));

                    td.appendChild(input);
                }
                if (c == 5) {
                    // the 6th column, will have sub price.
                    var input = document.createElement('input');

                    input.setAttribute('name', 'sub_price_total[]');
                    input.setAttribute('type', 'text');
                    input.setAttribute('readonly', 'readonly');
                    input.setAttribute('class', 'sub_total w-28 ml-1 mr-1 text-sm text-gray-700 dark:focus:shadow-outline-gray border-0 dark:text-gray-200 focus:bg-white focus:border-purple-300 focus:outline-none focus:shadow-outline-purple form-input');

                    // calcul remise
                    // rm_prod = (selvalue_array[1] * document.getElementsByName('remise')[0].value) / 100;
                    net_a_payer = selvalue_array[1];
                    input.setAttribute('value', parseInt(net_a_payer) * document.getElementsByName('qte')[0].value);

                    td.appendChild(input);
                }
                if (c == 6) {
                    // the 5th column, will have ttc.
                    var input = document.createElement('input');

                    input.setAttribute('name', 'ttc[]');
                    input.setAttribute('type', 'text');
                    input.setAttribute('readonly', 'readonly');
                    input.setAttribute('class', 'product_ttc w-28 ml-1 mr-1 text-sm text-gray-700 dark:focus:shadow-outline-gray border-0 dark:text-gray-200 focus:bg-white focus:border-purple-300 focus:outline-none focus:shadow-outline-purple form-input');

                    net_a_payer = selvalue_array[1];

                    if (document.getElementsByName('tax')[0].options[document.getElementsByName('tax')[0].selectedIndex].text == 'A') {
                        hta_total += parseInt(net_a_payer * document.getElementsByName('qte')[0].value);
                        input.setAttribute('value', parseInt(net_a_payer) * document.getElementsByName('qte')[0].value);
                    }

                    if (document.getElementsByName('tax')[0].options[document.getElementsByName('tax')[0].selectedIndex].text == 'B') {
                        tax_val = 1 + 0.18;
                        htb_total += parseInt(net_a_payer * document.getElementsByName('qte')[0].value);
                        tva_btotal = parseInt(htb_total * 0.18);
                        input.setAttribute('value', parseInt(net_a_payer * tax_val) * document.getElementsByName('qte')[0].value);
                    }

                    if (document.getElementsByName('tax')[0].options[document.getElementsByName('tax')[0].selectedIndex].text == 'D') {
                        tax_val = 1 + 0.18;
                        htd_total += parseInt(net_a_payer * document.getElementsByName('qte')[0].value);
                        tva_dtotal = parseInt(htd_total * 0.18);
                        input.setAttribute('value', parseInt(net_a_payer * tax_val) * document.getElementsByName('qte')[0].value);
                    }

                    if (document.getElementsByName('tax')[0].options[document.getElementsByName('tax')[0].selectedIndex].text == 'E') {
                        hte_total += parseInt(net_a_payer * document.getElementsByName('qte')[0].value);
                        input.setAttribute('value', parseInt(net_a_payer) * document.getElementsByName('qte')[0].value);
                    }

                    td.appendChild(input);
                }
                if (c == 7) {
                    // the hidden 6th column, will have product ID.
                    var input = document.createElement('input');

                    input.setAttribute('name', 'id[]');
                    input.setAttribute('type', 'hidden');
                    input.setAttribute('value', selvalue_array[3]);

                    td.appendChild(input);
                }

                if (c == 8) {
                    // the hidden 7th column, will have line sub total.
                    var input = document.createElement('input');

                    input.setAttribute('name', 'check_sub[]');
                    input.setAttribute('type', 'hidden');
                    input.setAttribute('value', parseInt(net_a_payer) * document.getElementsByName('qte')[0].value);

                    td.appendChild(input);
                }

                if (c == 9) {
                    // the hidden 8th column, will have line ttc.
                    var input = document.createElement('input');

                    input.setAttribute('name', 'check_ttc[]');
                    input.setAttribute('type', 'hidden');
                    net_a_payer = selvalue_array[1];

                    if (document.getElementsByName('tax')[0].options[document.getElementsByName('tax')[0].selectedIndex].text == 'A') {
                        hta_total += parseInt(net_a_payer * document.getElementsByName('qte')[0].value);
                        input.setAttribute('value', parseInt(net_a_payer) * document.getElementsByName('qte')[0].value);
                    }

                    if (document.getElementsByName('tax')[0].options[document.getElementsByName('tax')[0].selectedIndex].text == 'B') {
                        tax_val = 1 + 0.18;
                        htb_total += parseInt(net_a_payer * document.getElementsByName('qte')[0].value);
                        tva_btotal = parseInt(htb_total * 0.18);
                        input.setAttribute('value', parseInt(net_a_payer * tax_val) * document.getElementsByName('qte')[0].value);
                    }

                    if (document.getElementsByName('tax')[0].options[document.getElementsByName('tax')[0].selectedIndex].text == 'D') {
                        tax_val = 1 + 0.18;
                        htd_total += parseInt(net_a_payer * document.getElementsByName('qte')[0].value);
                        tva_dtotal = parseInt(htd_total * 0.18);
                        input.setAttribute('value', parseInt(net_a_payer * tax_val) * document.getElementsByName('qte')[0].value);
                    }

                    if (document.getElementsByName('tax')[0].options[document.getElementsByName('tax')[0].selectedIndex].text == 'E') {
                        hte_total += parseInt(net_a_payer * document.getElementsByName('qte')[0].value);
                        input.setAttribute('value', parseInt(net_a_payer) * document.getElementsByName('qte')[0].value);
                    }

                    td.appendChild(input);
                }

                document.getElementById('total').classList.remove('hidden');
            }
        }
        // calcul de la remise total
        // rm_total += rm_prod;

        // calcul de AIB
        var aib_value = document.getElementsByName('aib')[0].value.split("/");
        aib_total = (hta_total + htb_total + htd_total + hte_total) * parseFloat(aib_value[0]);

        // calcul de ttc
        ttc_total = hta_total + htb_total + htd_total + hte_total + tva_btotal + tva_dtotal + aib_total;

        // affecter les != totaux a la vue
        document.getElementById('hta_total').value = hta_total;
        document.getElementById('htb_total').value = htb_total;
        document.getElementById('htd_total').value = htd_total;
        document.getElementById('hte_total').value = hte_total;
        document.getElementById('tva_btotal').value = tva_btotal;
        document.getElementById('tva_dtotal').value = tva_dtotal;
        document.getElementById('aib_total').value = parseInt(aib_total);
        document.getElementById('ttc_total').value = parseInt(ttc_total);
    }
}

// ft pour calculer les totaux lors du changement de la qte dans le tableau

function new_price_ft_qte(obj) {
    if (obj.parentNode.previousSibling.getElementsByTagName('input')[0].value == 'A' || obj.parentNode.previousSibling.getElementsByTagName('input')[0].value == 'E') {
        new_price = obj.value * obj.parentNode.nextSibling.getElementsByTagName('input')[0].value;
        obj.parentNode.nextSibling.nextSibling.getElementsByTagName('input')[0].value = new_price;
        obj.parentNode.nextSibling.nextSibling.nextSibling.getElementsByTagName('input')[0].value = new_price;

        soustotal_line = obj.parentNode.nextSibling.nextSibling.nextSibling.nextSibling.nextSibling.getElementsByTagName('input')[0].value;

        hta_total = hta_total - soustotal_line + new_price;
        document.getElementById('hta_total').value = hta_total;
        
        soustotal_line = new_price;
    }
    if (obj.parentNode.previousSibling.getElementsByTagName('input')[0].value == 'B' || obj.parentNode.previousSibling.getElementsByTagName('input')[0].value == 'D') {
        new_price = obj.value * obj.parentNode.nextSibling.getElementsByTagName('input')[0].value;
        obj.parentNode.nextSibling.nextSibling.getElementsByTagName('input')[0].value = new_price;
        obj.parentNode.nextSibling.nextSibling.nextSibling.getElementsByTagName('input')[0].value = parseInt(new_price * 1.18);

        // htb_total += parseInt(net_a_payer * document.getElementsByName('qte')[0].value);
        // tva_btotal = parseInt(htb_total * 0.18);
    }
}

// ft pour calculer l'aib lors du changement du combobox aib
function aib_calcul() {
    var aib_value = document.getElementsByName('aib')[0].value.split("/");
    document.getElementById('aib_total').value =
        (parseInt(document.getElementById('hta_total').value) +
            parseInt(document.getElementById('htb_total').value) +
            parseInt(document.getElementById('htd_total').value) +
            parseInt(document.getElementById('hte_total').value)) *
        parseFloat(aib_value[0]);
}

// ft pour calculer l'mt rendu et reliquat du client
function reste_calcul() {
    document.getElementById('mt_rendu').value =
        parseInt(document.getElementById('mt_percu').value) - parseInt(document.getElementById('ttc_total').value);
    console.log(parseInt(document.getElementById('mt_percu').value) - parseInt(document.getElementById('ttc_total').value));

    document.getElementById('reliquat').value =
        parseInt(document.getElementById('mt_percu').value) - parseInt(document.getElementById('ttc_total').value) - parseInt(document.getElementById('mt_rendu').value);
}

// function to delete a row.
function removeRow(oButton) {
    var empTab = document.getElementById('formTable');
    // getting the row
    var r = empTab.rows[parseInt(oButton.value)]; // buttton -> td -> tr

    // change totals after rows delete & send new values in view
    if (r.cells[2].getElementsByTagName('input')[0].value == 'A') {
        hta_total -= r.cells[5].getElementsByTagName('input')[0].value;
        document.getElementById('hta_total').value = hta_total;
    };

    if (r.cells[2].getElementsByTagName('input')[0].value == 'B') {
        htb_total -= r.cells[5].getElementsByTagName('input')[0].value;
        document.getElementById('htb_total').value = htb_total;

        tva_btotal = parseInt(htb_total * 0.18);
        document.getElementById('tva_btotal').value = tva_btotal;
    };

    if (r.cells[2].getElementsByTagName('input')[0].value == 'D') {
        htd_total -= r.cells[5].getElementsByTagName('input')[0].value;
        document.getElementById('htd_total').value = htd_total;

        tva_dtotal = parseInt(htd_total * 0.18);
        document.getElementById('tva_dtotal').value = tva_dtotal;
    };

    if (r.cells[2].getElementsByTagName('input')[0].value == 'E') {
        hte_total -= r.cells[5].getElementsByTagName('input')[0].value;
        document.getElementById('hte_total').value = hte_total;
    };

    var aib_value = document.getElementsByName('aib')[0].value.split("/");
    aib_total = (hta_total + htb_total + htd_total + hte_total) * parseFloat(aib_value[0]);
    document.getElementById('aib_total').value = parseInt(aib_total);

    ttc_total = hta_total + htb_total + htd_total + hte_total + tva_btotal + tva_dtotal + aib_total;
    document.getElementById('ttc_total').value = parseInt(ttc_total);

    empTab.deleteRow(oButton.value); // buttton -> td -> tr
    i -= 1;

    for (let index = 0; index < document.getElementsByClassName('del_btn').length; index++) {
        document.getElementsByClassName('del_btn')[index].value = index;
    }

}


// print function
function print() {
    document.getElementById('entete').classList.remove('hidden');
    var element = document.getElementById('for_print');
    var opt = {
        margin: .5,
        filename: 'myfile.pdf',
        // html2canvas: { scale: 2 },
        jsPDF: { unit: 'in', format: 'letter', orientation: 'portrait' }
    };
    html2pdf().set(opt).from(element).save();

    setTimeout(() => {
        document.getElementById('entete').classList.add('hidden');
    }, 5000);
}

document.getElementsByName('new_name')[0].disabled = true;
document.getElementsByName('new_ifu')[0].disabled = true;
document.getElementsByName('new_contact')[0].disabled = true;
function active_form() {
    document.getElementsByName('new_name')[0].disabled = false;
    document.getElementsByName('new_ifu')[0].disabled = false;
    document.getElementsByName('new_contact')[0].disabled = false;
    document.getElementById('form').removeChild(document.getElementById('client_div'));
}