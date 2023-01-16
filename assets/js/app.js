$(function mailingAddress() {

    //
    var mailingAddressObj = {};
    var mailingAddressObjStandard = {};
    //
    var xhr = null;
    //
    $('.jsErrorArea').hide(0);
    $('.jsErrorAreaConfirm').hide(0);

    //
    $('#jsMailingAddressForm').submit(function (event) {
        //
        event.preventDefault();
        //
        $('.jsErrorArea').hide(0);
        $('.jsErrorAreaConfirm').hide(0);
        // Default the mailing address
        setMailingAddressObject();
        //
        mailingAddressObj.country = $('#jsCountry').val();
        mailingAddressObj.state = $('#jsState').val();
        mailingAddressObj.city = $('#jsCity').val().trim();
        mailingAddressObj.zipcode = $('#jsZipCode').val().trim();
        mailingAddressObj.address_1 = $('#jsAddress').val().trim();
        mailingAddressObj.address_2 = $('#jsAddress2').val().trim();
        //
        let errorsArray = [];
        // Validation
        if (!mailingAddressObj.country) {
            errorsArray.push("Country is missing.");
        }
        if (!mailingAddressObj.state || mailingAddressObj.state == 0) {
            errorsArray.push("State is missing.");
        }
        if (!mailingAddressObj.city) {
            errorsArray.push("City is missing.");
        }
        if (!mailingAddressObj.zipcode) {
            errorsArray.push("ZipCode is missing.");
        }
        if (!mailingAddressObj.address_1) {
            errorsArray.push("Address is missing.");
        }
        //
        if (errorsArray.length) {
            return loadError(errorsArray);
        }
        //
        startAddressVerificationProcess();
    });

    //
    $('.jsPage').click(function (event) {
        //
        event.preventDefault();
        //
        mailingAddressObjStandard = {};
        //
        pageShifter($(this).data('page'));
    });

    //
    $('.jsSaveAddress').click(function (event) {
        //
        event.preventDefault();
        //
        $('.jsErrorAreaConfirm').hide(0);
        //
        let option = $('input[name="mailingAddressType"]:checked').val();
        //
        if (option === undefined) {
            return loadError(['Please select an option'], '.jsErrorAreaConfirm');
        }
        //
        if (Object.keys(mailingAddressObjStandard).length === 0) {
            return loadError(['Please run the address validation first.'], '.jsErrorAreaConfirm');
        }
        //
        saveAddress(option == 'standard' ? mailingAddressObjStandard : mailingAddressObj);
    });

    /**
     * Start address verification process
     */
    function startAddressVerificationProcess() {
        // Check if already an ajax is in process
        if (xhr !== null) {
            return;
        }
        //
        $('#jsMailingAddressForm').find('button[type="submit"]').text('Submitting..');
        //
        xhr = $.post(
            window.location.href + 'mailing-address/', {
            action: 'add',
            data: mailingAddressObj
        }
        )
            .done(function (response) {
                //
                xhr = null;
                //
                $('#jsMailingAddressForm').find('button[type="submit"]').text('Submit');
                //
                if (response.errors) {
                    //
                    let errorsArray = [];
                    for (let index in response.errors) {
                        errorsArray.push(response.errors[index][0]);
                    }
                    return loadError(errorsArray)
                }

                // set original ones
                $('#jsOMACountry').text(mailingAddressObj.country);
                $('#jsOMACity').text(mailingAddressObj.city);
                $('#jsOMAState').text(mailingAddressObj.state);
                $('#jsOMAZipCode').text(mailingAddressObj.zipcode);
                $('#jsOMAAddress').text(mailingAddressObj.address_1);
                $('#jsOMAAddress2').text(mailingAddressObj.address_2);

                // set original ones
                $('#jsSMACountry').text(mailingAddressObj.country);
                $('#jsSMACity').text(response.success.Address.City);
                $('#jsSMAState').text(response.success.Address.State);
                $('#jsSMAZipCode').text(response.success.Address.Zip4 + ' / ' + response.success.Address.Zip5);
                $('#jsSMAAddress').text(response.success.Address.Address2);
                $('#jsSMAAddress2').text(response.success.Address.Address1 || '');

                //
                mailingAddressObjStandard = {
                    country: mailingAddressObj.country,
                    state: response.success.Address.State,
                    city: response.success.Address.City,
                    zipcode: response.success.Address.Zip4,
                    zipcode5: response.success.Address.Zip5,
                    address_1: response.success.Address.Address2,
                    address_2: response.success.Address.Address1 || ''
                }

                //
                pageShifter('confirm');
            })
            .fail(function () {
                xhr = null;
            });
    }

    /**
     * Start address verification process
     */
    function saveAddress(finalMailingAddressObj) {
        // Check if already an ajax is in process
        if (xhr !== null) {
            return;
        }
        //
        $('.jsSaveAddress').text('Submitting..');
        //
        xhr = $.post(
            window.location.href + 'mailing-address/save', {
            finalMailingAddressObj
        }
        )
            .done(function (response) {
                //
                xhr = null;
                //
                $('.jsSaveAddress').text('Submit');
                //
                if (response.error) {

                    return loadError(['Failed to add mailing address.'], '.jsErrorAreaConfirm');
                }

                alert('Your mailing address has been added,');
                window.location.reload();

            })
            .fail(function () {
                xhr = null;
            });
    }

    /**
     * Shifts to selected page
     *
     * @param {string} toPage 
     */
    function pageShifter(toPage) {
        $('.csPage').addClass('visually-hidden');
        $('.csPage[data-tag="' + (toPage) + '"]').removeClass('visually-hidden');
    }

    /**
     * Load the error
     *
     * @param {array} errorsArray 
     * @param {string} target 
     */
    function loadError(errorsArray, target) {
        $(target || '.jsErrorArea').html(errorsArray.join('<br />')).show();
    }

    /**
     * Sets the mailing address object to
     * default
     */
    function setMailingAddressObject() {
        //
        mailingAddressObj = {
            country: '',
            state: '',
            city: '',
            zipcode: '',
            address_1: '',
            address_2: ''
        };
        //
        mailingAddressObjStandard = {};
    }
});