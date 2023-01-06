// datatables linking with tables
$(document).ready(function () {
    $('#prod_group').DataTable(
        { 'aaSorting': [] }
    );
    $('#provider').DataTable(
        { 'aaSorting': [] }
    );
    $('#cli').DataTable(
        { 'aaSorting': [] }
    );
    $('#prod').DataTable(
        { 'aaSorting': [] }
    );
    $('#inv').DataTable(
        { 'aaSorting': [] }
    );
    $('#stal').DataTable(
        { 'aaSorting': [] }
    );
    $('#stent').DataTable(
        { 'aaSorting': [] }
    );
    $('#stext').DataTable(
        { 'aaSorting': [] }
    );
    $('#stcur').DataTable(
        { 'aaSorting': [] }
    );
    $('#datatable_prod').DataTable(
        { 'aaSorting': [] }
    );
    $('#datatable_cli').DataTable(
        { 'aaSorting': [] }
    );
    $('#user').DataTable(
        { 'aaSorting': [] }
    );
    $('#det').DataTable(
        { 'aaSorting': [] }
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
                        id: item.id + '/' + item.PrixHT + '/' + item.AssujetisTVA
                    }
                })
            };
        },
        cache: true
    }
});


// function to add new row where creating invoince

var i = 0,
    tax_val = 1,
    hta_total = 0,
    htb_total = 0,
    htc_total = 0,
    htd_total = 0,
    hte_total = 0,
    htf_total = 0,
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
                    rm_prod = (selvalue_array[1] * document.getElementsByName('remise')[0].value) / 100;

                    // display ttc price in table
                    prix_ft_qte_prod = parseInt((selvalue_array[1] - rm_prod) * document.getElementsByClassName('qte_product')[index].value);
                    // price ft taxe
                    if (document.getElementsByName('tax')[0].options[document.getElementsByName('tax')[0].selectedIndex].text == 'A') {
                        hta_total += prix_ft_qte_prod;
                        document.getElementsByClassName('product_ttc')[index].value = parseInt(selvalue_array[1] * document.getElementsByClassName('qte_product')[index].value);
                    }

                    if (document.getElementsByName('tax')[0].options[document.getElementsByName('tax')[0].selectedIndex].text == 'B') {
                        tax_val = 1 + 0.18;
                        htb_total += prix_ft_qte_prod;
                        tva_btotal = parseInt(htb_total * 0.18);
                        document.getElementsByClassName('product_ttc')[index].value = parseInt(selvalue_array[1] * tax_val * document.getElementsByClassName('qte_product')[index].value);
                    }

                    if (document.getElementsByName('tax')[0].options[document.getElementsByName('tax')[0].selectedIndex].text == 'C') {
                        htc_total += prix_ft_qte_prod;
                        document.getElementsByClassName('product_ttc')[index].value = parseInt(selvalue_array[1] * document.getElementsByClassName('qte_product')[index].value);
                    }

                    if (document.getElementsByName('tax')[0].options[document.getElementsByName('tax')[0].selectedIndex].text == 'D') {
                        tax_val = 1 + 0.18;
                        htd_total += prix_ft_qte_prod;
                        tva_dtotal = parseInt(htd_total * 0.18);
                        document.getElementsByClassName('product_ttc')[index].value = parseInt(selvalue_array[1] * tax_val * document.getElementsByClassName('qte_product')[index].value);
                    }

                    if (document.getElementsByName('tax')[0].options[document.getElementsByName('tax')[0].selectedIndex].text == 'E') {
                        hte_total += prix_ft_qte_prod;
                        document.getElementsByClassName('product_ttc')[index].value = parseInt(selvalue_array[1] * document.getElementsByClassName('qte_product')[index].value);
                    }

                    if (document.getElementsByName('tax')[0].options[document.getElementsByName('tax')[0].selectedIndex].text == 'F') {
                        htf_total += prix_ft_qte_prod;
                        document.getElementsByClassName('product_ttc')[index].value = parseInt(selvalue_array[1] * document.getElementsByClassName('qte_product')[index].value);
                    }

                    check++;
                }
            }
        }

        if (check == 0) {
            var rowCnt = empTab.rows.length;    // get the number of rows.
            var tr = empTab.insertRow(rowCnt); // table row.
            tr = empTab.insertRow(rowCnt);
            // for naming cell's input
            i++;

            for (var c = 0; c < 7; c++) {
                var td = document.createElement('td');          // TABLE DEFINITION.
                td = tr.insertCell(c);

                if (c == 0) {   // if its the first column of the table.
                    // add a button control.
                    var button = document.createElement('button');

                    // set the attributes.
                    button.setAttribute('type', 'button');
                    button.setAttribute('class', "flex items-center justify-between px-2 py-2 text-sm font-medium leading-5 text-purple-600 rounded-lg dark:text-gray-400 focus:outline-none focus:shadow-outline-gray");
                    button.innerHTML = '<img style="height: 20px; width: 20px" src="/assets/img/delete.svg"/>';
                    // add button's "onclick" event.
                    button.setAttribute('onclick', 'removeRow(this)');

                    td.appendChild(button);
                }
                if (c == 1) {
                    // the 2nd column, will have designation.
                    var input = document.createElement('input');

                    input.setAttribute('name', 'product' + i);
                    input.setAttribute('type', 'text');
                    input.setAttribute('disabled', 'disabled');
                    input.setAttribute('class', 'product_name w-80 ml-1 mr-1 text-sm text-gray-700 dark:focus:shadow-outline-gray border-0 dark:text-gray-200 focus:bg-white focus:border-purple-300 focus:outline-none focus:shadow-outline-purple form-input');
                    input.setAttribute('value', document.getElementById('liste').options[document.getElementById('liste').selectedIndex].text);

                    td.appendChild(input);
                }
                if (c == 2) {
                    // the 3rd column, will have tax.
                    var input = document.createElement('input');

                    input.setAttribute('name', 'tax' + i);
                    input.setAttribute('type', 'text');
                    input.setAttribute('disabled', 'disabled');
                    input.setAttribute('class', 'product_tax w-12 ml-1 mr-1 text-sm text-gray-700 dark:focus:shadow-outline-gray border-0 dark:text-gray-200 focus:bg-white focus:border-purple-300 focus:outline-none focus:shadow-outline-purple form-input');
                    input.setAttribute('value', document.getElementsByName('tax')[0].options[document.getElementsByName('tax')[0].selectedIndex].text);

                    td.appendChild(input);
                }
                if (c == 3) {
                    // the 4th column, will have qte.
                    var input = document.createElement('input');

                    input.setAttribute('name', 'qte' + i);
                    input.setAttribute('type', 'number');
                    input.setAttribute('class', 'qte_product w-24 ml-1 mr-1 text-sm text-gray-700 dark:focus:shadow-outline-gray border-0 dark:text-gray-200 focus:bg-white focus:border-purple-300 focus:outline-none focus:shadow-outline-purple form-input');
                    input.setAttribute('value', document.getElementsByName('qte')[0].value);

                    td.appendChild(input);
                }
                if (c == 4) {
                    // the 5th column, will have unit price.
                    var input = document.createElement('input');

                    input.setAttribute('name', 'pu' + i);
                    input.setAttribute('type', 'text');
                    input.setAttribute('disabled', 'disabled');
                    input.setAttribute('class', 'w-24 ml-1 mr-1 text-sm text-gray-700 dark:focus:shadow-outline-gray border-0 dark:text-gray-200 focus:bg-white focus:border-purple-300 focus:outline-none focus:shadow-outline-purple form-input');
                    input.setAttribute('value', parseInt(selvalue_array[1]));

                    td.appendChild(input);
                }
                if (c == 5) {
                    // the 6th column, will have ttc price.
                    var input = document.createElement('input');

                    input.setAttribute('name', 'ttc' + i);
                    input.setAttribute('type', 'text');
                    input.setAttribute('disabled', 'disabled');
                    input.setAttribute('class', 'product_ttc w-28 ml-1 mr-1 text-sm text-gray-700 dark:focus:shadow-outline-gray border-0 dark:text-gray-200 focus:bg-white focus:border-purple-300 focus:outline-none focus:shadow-outline-purple form-input');

                    // calcul remise
                    rm_prod = (selvalue_array[1] * document.getElementsByName('remise')[0].value) / 100;
                    net_a_payer = selvalue_array[1] - rm_prod;

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

                    if (document.getElementsByName('tax')[0].options[document.getElementsByName('tax')[0].selectedIndex].text == 'C') {
                        htc_total += parseInt(net_a_payer * document.getElementsByName('qte')[0].value);
                        input.setAttribute('value', parseInt(net_a_payer) * document.getElementsByName('qte')[0].value);
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

                    if (document.getElementsByName('tax')[0].options[document.getElementsByName('tax')[0].selectedIndex].text == 'F') {
                        htf_total += parseInt(net_a_payer * document.getElementsByName('qte')[0].value);
                        input.setAttribute('value', parseInt(net_a_payer) * document.getElementsByName('qte')[0].value);
                    }

                    td.appendChild(input);
                }
                if (c == 6) {
                    // the 5th column, will have discount.
                    var input = document.createElement('input');

                    input.setAttribute('name', 'remise' + i);
                    input.setAttribute('type', 'text');
                    input.setAttribute('disabled', 'disabled');
                    input.setAttribute('class', 'w-24 ml-1 mr-1 text-sm text-gray-700 dark:focus:shadow-outline-gray border-0 dark:text-gray-200 focus:bg-white focus:border-purple-300 focus:outline-none focus:shadow-outline-purple form-input');
                    input.setAttribute('value', parseInt(rm_prod));

                    td.appendChild(input);
                }

                document.getElementById('total').classList.remove('hidden');
            }
        }
        // calcul de la remise total
        rm_total += rm_prod;

        // calcul de AIB
        var aib_value = document.getElementsByName('aib')[0].value.split("/");
        aib_total = (hta_total + htb_total + htc_total + htd_total + hte_total + htf_total) * parseFloat(aib_value[0]);

        // calcul de ttc
        ttc_total = hta_total + htb_total + htc_total + htd_total + hte_total + htf_total + tva_btotal + tva_dtotal + aib_total;

        // affecter les != totaux a la vue
        document.getElementById('hta_total').value = hta_total;
        document.getElementById('htb_total').value = htb_total;
        document.getElementById('htc_total').value = htc_total;
        document.getElementById('htd_total').value = htd_total;
        document.getElementById('hte_total').value = hte_total;
        document.getElementById('htf_total').value = htf_total;
        document.getElementById('tva_btotal').value = tva_btotal;
        document.getElementById('tva_dtotal').value = tva_dtotal;
        document.getElementById('aib_total').value = parseInt(aib_total);
        document.getElementById('ttc_total').value = parseInt(ttc_total);
        document.getElementById('t_remise').value = parseInt(rm_total);
    }
}

// ft pour calculer l'aib lors du changement du combobox aib
function aib_calcul() {
    var aib_value = document.getElementsByName('aib')[0].value.split("/");
    document.getElementById('aib_total').value =
        (parseInt(document.getElementById('hta_total').value) +
            parseInt(document.getElementById('htb_total').value) +
            parseInt(document.getElementById('htc_total').value) +
            parseInt(document.getElementById('htd_total').value) +
            parseInt(document.getElementById('hte_total').value) +
            parseInt(document.getElementById('htf_total').value)) *
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
    empTab.deleteRow(oButton.parentNode.rowIndex); // buttton -> td -> tr
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
