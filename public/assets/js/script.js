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

function setCustomer() {
    document.getElementById('customer').value = document.getElementsByClassName('peer')[0].value;
}

//modify aib total on aib select change after defined time
function setAIBInt() {
    setInterval(setAIB, 5000);
}

function setAIB() {
    if (document.getElementById('aib_type').value == 'AIB5') {
        document.getElementById('aib_total').value = document.getElementById('ttc_total').value * 0.05;
    }
    if (document.getElementById('aib_type').value == 'AIB1') {
        document.getElementById('aib_total').value = document.getElementById('ttc_total').value * 0.01;
    }
    if (document.getElementById('aib_type').value == 'AIB0') {
        document.getElementById('aib_total').value = document.getElementById('ttc_total').value * 0;
    }
}

function setAmountReturn() {
    document.getElementById('mt_a_rendre').value = document.getElementById('mt_percu').value - document.getElementById('ttc_total').value;
    document.getElementById('mt_rendu').value = document.getElementById('mt_percu').value - document.getElementById('ttc_total').value;
}

function setAmountRest() {
    document.getElementById('reliquat').value = document.getElementById('mt_a_rendre').value - document.getElementById('mt_rendu').value;
}