$(function () {
    $.ajax({
        type: "POST",
        url: 'classes/AjaxPoreceipt.php',
        data: {
            action: 'getVendor'
        },
        success: function(data){
            if (data != 'error') {

                var vendors = JSON.parse(data);

                $.each(vendors, function( key, value){

                    $('#vendorlist').append($('<option>', {

                        value: value.id,
                        text : value.vname

                    }));
                })

            } else {
                var msg = 'Sorry something went wrong, care to try again?';
            }
        }
    });

    /**
     * Fill location select box
     */
    getLocations();

    /**
     * Get Purchase Order Data
     */
    $('.find-po').click( function () {

        if ($('#vendorlist').val() == "") {
            alert('Please select a vendor');
            return;
        }

        var po_number = $('#po-number').val();
        var vendor = $('#vendorlist').val()
        $('.msg-po-number').html('');

        $(this).html('Please Wait');
        $.ajax({
            type: "POST",
            url: 'classes/AjaxPoreceipt.php',
            async: false,
            data: {
                action: 'findPo',
                vendor: vendor,
                po_number: po_number
            },
            success: function(data){

                $('.find-po').html('Find');

                if (data != 'error') {

                    if ( data == "not found" ) {

                        $('.msg-po-number').html(' Purchase Order Number not found.')

                    } else {
                        var po_data = JSON.parse(data);

                        $('#po-date').val(po_data.adddate);
                        $('#po-whcode').val(po_data.warehousecode);

                        getPoDetails( po_number );
                    }

                } else {
                    var msg = 'Sorry something went wrong, care to try again?';
                }

            },
            error: function() {
                $('.find-po').html('Find');
            }
        });
    });


    function getPoDetails( po_number ) {
        $.ajax({
            type: "POST",
            url: 'classes/AjaxPoreceipt.php',
            data: {
                action: 'getPoDetails',
                po_number: po_number
            },
            success: function(data){
                if (data != 'error') {

                    var po_details = JSON.parse(data);

                    $('#po-details').find('tbody').empty();

                    $.each(po_details, function( key, value){

                        var tdata = '<td class="td-podid">'+  value.podid +'</td>';
                        tdata += '<td class="td-part-number">'+ value.partnumber +'</td>';
                        tdata += '<td class="td-location">'+ value.location +'</td>';
                        tdata += '<td class="td-req-qty">'+ value.quantity +'</td>';
                        tdata += '<td class="td-res-qty">'+ value.receptquantity +'</td>';
                        tdata += '<td class="td-res-date">'+ value.receiveddate +'</td>';

                        $('#po-details').find('tbody').append('<tr class="poid-'+ value.podid +'">'+ tdata +'</tr>')

                        if ( parseFloat(value.quantity) > parseFloat(value.receptquantity) ) {

                            $('#po-details tbody').find('.poid-'+ value.podid).addClass('qty_n');

                        } else if ( parseFloat(value.quantity) == parseFloat(value.receptquantity) ){

                            $('#po-details tbody').find('.poid-'+ value.podid).addClass('qty_y');

                        }

                    });

                } else {
                    var msg = 'Sorry something went wrong, care to try again?';
                }
            }
        });
    }

    function getLocations() {
        $.ajax({
            type: "POST",
            url: 'classes/AjaxPoreceipt.php',
            data: {
                action: 'getLocations'
            },
            success: function(data){
                if (data != 'error') {

                    var locations = JSON.parse(data);

                    $.each(locations, function( key, value){

                        $('#locationlist').append($('<option>', {

                            value: value.code,
                            text : value.name

                        }));
                    })

                } else {
                    var msg = 'Sorry something went wrong, care to try again?';
                }
            }
        });
    }


    $("#po-details tbody").on("click", "tr", function( event ) {


        $('#hd-td-podid').val( $(this).find('.td-podid').html() );
        $('#po-partnumber').val( $(this).find('.td-part-number').html() );
        $('#locationlist').val( $(this).find('.td-location').html() );
        $('#po-req-qty').val( $(this).find('.td-req-qty').html() );
        $('#po-res-qty').val( $(this).find('.td-res-qty').html() );
        $('#po-res-date').val( $(this).find('.td-res-date').html() );

        $('.edit-row').show();

    });

    $(".po-done-edit").click(function(){

        var poid = $('#hd-td-podid').val();

        if ( parseFloat($('#po-req-qty').val()) < parseFloat($('#po-res-qty').val()) ) {

            alert("Received quantity can't be more that requested quantity.");
            return;

        } else if ( parseFloat($('#po-req-qty').val()) > parseFloat($('#po-res-qty').val()) ) {

            $('#po-details tbody').find('.poid-'+ poid).addClass('qty_n');

        } else if ( parseFloat($('#po-req-qty').val()) == parseFloat($('#po-res-qty').val()) ){

            $('#po-details tbody').find('.poid-'+ poid).addClass('qty_y');

        }

        $('#po-details tbody').find('.poid-'+ poid + ' > .td-part-number').html( $('#po-partnumber').val() );
        $('#po-details tbody').find('.poid-'+ poid + ' > .td-location').html( $('#locationlist').val() );
        $('#po-details tbody').find('.poid-'+ poid + ' > .td-req-qty').html( $('#po-req-qty').val() );
        $('#po-details tbody').find('.poid-'+ poid + ' > .td-res-qty').html( $('#po-res-qty').val() );
        $('#po-details tbody').find('.poid-'+ poid + ' > .td-res-date').html( $('#po-res-date').val() );

        $('#po-partnumber').val('');
        $('#po-locationlist').val('');
        $('#po-req-qty').val('');
        $('#po--res-qty').val('');
        $('#po-res-date').val('');

        $('.edit-row').hide();

    });


    $("#po-res-date").datepicker({
        changeMonth: true,
        changeYear: true,
        dateFormat: "dd/mm/yy",
        minDate: 0,
        theme: "base"
    }).datepicker("setDate", new Date());

    $('.calendar-select-start').click(function () {
        $('#po-res-date').datepicker('show');
    });

    $('.po-save').click( function() {

        var data = [];


        $('#po-details tbody > tr').each(function (i, row) {
            data.push({});
            data[i].podid   = $(row).find('.td-podid').html();
            data[i].pid     = $('#po-number').val();
            data[i].location= $(row).find('.td-location').html();
            data[i].receptquantity = $(row).find('.td-res-qty').html();
            data[i].receiveddate = $(row).find('.td-res-date').html();
            data[i].linestatus = getLineStatus($(row).find('.td-res-qty').html(), $(row).find('.td-req-qty').html());

        });


        $.ajax({
            type: "POST",
            url: 'classes/AjaxPoreceipt.php',
            data: {
                action: 'save',
                data:  JSON.stringify(data)
            },
            success: function(data){
                if (data != 'error') {
                    $('.po-message').html('Purchase order updated successfully.');
                    Clear();
                } else {
                    $('.po-message').html('Sorry something went wrong, care to try again?');
                }
            }
        });

    });

    $('.po-cancel').click( function(){
        Clear();
    });

    /**
     * Get Line Status
     * @param res_qty
     * @param req_qty
     * @returns {*}
     */

    function getLineStatus(res_qty, req_qty) {

        if ( parseFloat(req_qty) == parseFloat(res_qty) ) {

            return 'Y';

        } else if ( parseFloat(req_qty) > parseFloat(res_qty) ) {

            return 'N';

        } else {

            return '';

        }
    }

    function Clear() {

        $('.poreceitpsForm :input').val('');
        $('#po-details tbody').empty();

        setTimeout(function(){
            $('.po-message').html('');
        },1000);
    }

});
