/*VALORIZA SCRIPTS*/

var BASE_PATH = "";

/**
 * Fetch address data by postal code
 */
function fetchAddressByCep(value) {
    var v = value.replace(".", "");
    var s = v.replace("-", "");
    var r = s.replace("_", "");
    if (r.length == 8) {
        var url = "http://api.geonames.org/postalCodeLookupJSON";
        var city = $('.city');
        var state = $('.state');
        var country = $('.country');
        $.ajax({
            url: url,
            dataType: "JSONP",
            data: {
                country: "BR",
                username: "acaciovilela",
                postalcode: r
            },
            success: function(data) {
                $.map(data.postalcodes, function(item) {
                    city.val(item.placeName.toUpperCase());
                    state.val(item.adminName1.toUpperCase());
                    country.val(item.countryCode);
                });
            }
        });
    }
}

function disableOff(value) {
    if (value === "INTEGRATED") {
        $('#proposalStatusBaseDate').attr('readonly', false);
        $('#proposalStatusParcelAmount').attr('readonly', 'required');
        $('#proposalStatusParcelValue').attr('readonly', 'required');
        $('#proposalStatusValue').attr('readonly', 'required');
    } else if ('APPROVED' === value) {
        $('#proposalStatusBaseDate').attr('readonly', 'readonly');
        $('#proposalStatusParcelAmount').attr('readonly', false);
        $('#proposalStatusParcelValue').attr('readonly', false);
        $('#proposalStatusValue').attr('readonly', false);
    } else {
        $('#proposalStatusBaseDate').attr('readonly', 'readonly');
        $('#proposalStatusParcelAmount').attr('readonly', 'readonly');
        $('#proposalStatusParcelValue').attr('readonly', 'readonly');
        $('#proposalStatusValue').attr('readonly', 'readonly');
    }
}

function calculateProposal(parcel) {
    if (parcel) {
        var url = BASE_PATH + "/admin/proposal/proposal/calculate";
        $.ajax({
            dataType: 'JSON',
            url: url,
            data: {
                parcelAmount: parcel,
                proposalValue: $('#proposalValue').val(),
                proposalTotalValue: $('#realtyProposalTotalValue').val()
            },
            success: function(data) {
                $('#proposalParcelValue').val(data.parcelValue);
                $('#proposalEndDate').val(data.endDate);
                $('#proposalStartDate').val(data.startDate);
                $('#realtyProposalInValue').val(data.inValue);
            }
        });
    }
}

/**
 * Formatted fields
 */

$(document).ready(function() {
    /**
     * Mask definitions
     */
    $('.cpf').mask("999.999.999-99");
    $('.cnpj').mask("99.999.999/9999-99");
    $('.cep').mask("99.999-999");
    $('.phone').mask("(99) 9999-9999");
    $('.validity').mask("99/99");
    $('.creditcard').mask("9999-9999-9999-9999");
    $('.porcent').priceFormat({
        prefix: '',
        thousandsSeparator: '',
        centsSeparator: ',',
        limit: 5
    });
    $(".currency").priceFormat({
        prefix: '',
        thousandsSeparator: '.',
        centsSeparator: ','
    });
});

/**
 * Calculate prices fields
 */
function calculatePrice(cost, markup, target) {
    var costIni = cost;
    var markupIni = markup;
    var a = costIni.replace("R$ ", "");
    var b = a.replace(".", "");
    var costFinal = b.replace(",", ".");
    var d = markupIni.replace("R$ ", "");
    var e = d.replace(".", "");
    var markupFinal = e.replace(",", ".");
    var url = BASE_PATH + "/admin/avr/price";
    $.ajax({
        url: url,
        dataType: "JSON",
        data: {
            cost: costFinal,
            markup: markupFinal
        },
        success: function(data) {
            target.val(data.price);
        }
    });
}
;

/**
 * Add Parcels
 */
function createParcels() {
    var parcelCount = $('#parcelCount').val();
    var accountValue = $('#accountValue').val();
    var firstExpiration = $('#firstExpiration').val();
    var url = BASE_PATH + '/admin/financial/account-parcel/create';
    $.ajax({
        url: url,
        dataType: "JSON",
        data: {
            count: parcelCount,
            value: accountValue,
            date: firstExpiration
        },
        success: function(data) {
            $('#fieldset#parcel_fieldset').append(data);
        }
    });
    return false;
}
;

function addParcel() {
    if (amount >= 1) {
        for (var i = 0; i < amount; i++) {
            var currentCount = $('fieldset#parcel_fieldset > fieldset > fieldset').length;
            var template = $('fieldset#parcel_fieldset > fieldset > span').data('template');
            template = template.replace(/__index__/g, currentCount);
            $('fieldset#parcel_fieldset > fieldset').append(template);
        }
        parcel.attr('readonly', 'readonly');
        $('#parcelButton').attr('disabled', ' disabled')
    }
}

/**
 *
 * Sale functionalities
 * 
 **/
function addProduct(productName) {
    var quantity = $('#quantity').val();
    $.ajax({
        url: BASE_PATH + "/admin/business/sale/addproduct",
        dataType: "JSON",
        data: {
            product: productName,
            quantity: quantity
        },
        success: function(data) {
            if (data.result == true) {
                $('#productList').load(BASE_PATH + '/admin/business/sale/listproducts');
                $('#quantity').val(1);
                calculateSale();
            }
        },
        error: function(data) {
            console.log(data);
        }
    });
}

function deleteFromList(url, item) {
    var x = window.confirm("Deseja realmente apagar este item? Esta ação é irreversível.");
    if (x) {
        $.ajax({
            url: url,
            dataType: 'JSON',
            data: {
                itemId: item
            },
            success: function(data) {
                if (data.result == true) {
                    $('#productList').load(BASE_PATH + '/admin/business/sale/listproducts');
                    calculateSale();
                }
            },
            error: function(msg) {
                console.log(msg);
            }
        });
    }
}

function calculateSale() {
    var addition = $('#orderAddition');
    var discount = $('#orderDiscount');
    var total = $('#orderTotal');
    $.ajax({
        url: BASE_PATH + '/admin/business/sale/calculate',
        dataType: 'JSON',
        data: {
            addition: addition.val(),
            discount: discount.val()
        },
        success: function(data) {
            total.val(data.result);
        },
        error: function(msg) {
            console.log(msg);
        }
    });
}

function updateProduct(item) {
    var quantity = $('#productQuantity' + item).val();
    $.ajax({
        url: BASE_PATH + '/admin/business/sale/updateproduct',
        dataType: 'JSON',
        data: {
            quantity: quantity,
            item: item
        },
        success: function(data) {
            if (data.result) {
                $('#productList').load(BASE_PATH + '/admin/business/sale/listproducts');
                calculateSale();
            }
        },
        error: function(data) {
            console.log(data);
        }
    });
}

/**
 *
 * Purchase functionalities
 * 
 **/

function addPurchaseProduct(productName) {
    var quantity = $('#quantity').val();
    $.ajax({
        url: BASE_PATH + "/admin/purchase/addproduct",
        dataType: "JSON",
        data: {
            product: productName,
            quantity: quantity
        },
        success: function(data) {
            if (data.result == true) {
                $('#productList').load(BASE_PATH + '/admin/purchase/listproducts');
                $('#quantity').val(1);
                calculatePurchase();
            }
        },
        error: function(data) {
            console.log(data);
        }
    });
}

function deletePurchaseProductFromList(url, item) {
    var x = window.confirm("Deseja realmente apagar este item? Esta ação é irreversível.");
    if (x) {
        $.ajax({
            url: url,
            dataType: 'JSON',
            data: {
                itemId: item
            },
            success: function(data) {
                if (data.result == true) {
                    $('#productList').load(BASE_PATH + '/admin/purchase/listproducts');
                    calculatePurchase();
                }
            },
            error: function(msg) {
                console.log(msg);
            }
        });
    }
}

function calculatePurchase() {
    var discount = $('#purchaseDiscount');
    var total = $('#purchaseTotal');
    $.ajax({
        url: BASE_PATH + '/admin/purchase/calculate',
        dataType: 'JSON',
        data: {
            discount: discount.val()
        },
        success: function(data) {
            total.val(data.result);
        },
        error: function(msg) {
            console.log(msg);
        }
    });
}

function updatePurchaseProduct(item) {
    var quantity = $('#productQuantity' + item).val();
    $.ajax({
        url: BASE_PATH + '/admin/purchase/updateproduct',
        dataType: 'JSON',
        data: {
            quantity: quantity,
            item: item
        },
        success: function(data) {
            if (data.result) {
                $('#productList').load(BASE_PATH + '/admin/purchase/listproducts');
                calculatePurchase();
            }
        },
        error: function(data) {
            console.log(data);
        }
    });
}


/**
 * 
 * Ajax to fill select fields 
 * 
 * @param {integer} id
 * @param {string} action_path
 * @param {string} object_id
 * @returns {boolean}
 */
function fillSelect(id, action_path, object_id) {
    var url = action_path;
    var object = $('#' + object_id);
    $.ajax({
        url: url,
        dataType: "JSON",
        data: {
            itemId: id
        },
        beforeSend: function() {
            object.empty();
            object.append('<option value="">Carregando...</option>');
        },
        success: function(data) {
            object.empty();
            object.append('<option value="">Selecione</option>');
            object.append(data.options);
            return true;
        }
    });
}

/******************************************************************************* 
 * 
 * Vehicle Type Functions
 * 
 * @param {integer} vehicle_brand_id
 * @returns {string}
 */
function vehicleTypeList(vehicle_brand_id) {
    if (vehicle_brand_id) {
        $('.vehicle-type-list').load(BASE_PATH + "/admin/vehicle/vehicle-type/list/" + vehicle_brand_id);
    } else {
        $('.vehicle-type-list').empty();
    }
    $('#vehicle_type_name').val('');
    $('#vehicle_type_name').focus();
}
function vehicleTypePost() {
    var url = BASE_PATH + "/admin/vehicle/vehicle-type/post";
    $.ajax({url: url, dataType: 'JSON', data: {vehicle_brand_id: $('#vehicle_brand_id').val(), vehicle_type_name: $('#vehicle_type_name').val()}, success: function(data) {
            vehicleTypeList($('#vehicle_brand_id').val());
        }});
}
function vehicleTypeDelete(id, vehicle_brand_id) {
    var url = BASE_PATH + "/admin/vehicle/vehicle-type/delete";
    var x = window.confirm("Deseja realmente apagar este item? Esta ação é irreversível.");
    if (x) {
        $.ajax({url: url, data: {vehicle_type_id: id}, dataType: 'JSON', success: function(data) {
                if (data.result === true) {
                    vehicleTypeList(vehicle_brand_id);
                }
            }});
    } else {
        return void(0);
    }
}

/**
 * 
 * Vehicle Model Functions
 * 
 * @param {integer} vehicle_type_id
 * @returns {undefined}
 */
function vehicleModelList(vehicle_type_id) {
    if (vehicle_type_id) {
        $('.vehicle-model-list').load(BASE_PATH + "/admin/vehicle/vehicle-model/list/" + vehicle_type_id);
    } else {
        $('.vehicle-model-list').empty();
    }
    $('#vehicle_model_name').val('');
    $('#vehicle_model_name').focus();
}
function vehicleModelPost() {
    var url = BASE_PATH + "/admin/vehicle/vehicle-model/post";
    $.ajax({url: url, dataType: 'JSON', data: {vehicle_type_id: $('#vehicle_type_id').val(), vehicle_model_name: $('#vehicle_model_name').val()}, success: function(data) {
            vehicleModelList($('#vehicle_type_id').val());
        }});
}
function vehicleModelDelete(id, vehicle_type_id) {
    var url = BASE_PATH + "/admin/vehicle/vehicle-model/delete";
    var x = window.confirm("Deseja realmente apagar este item? Esta ação é irreversível.");
    if (x) {
        $.ajax({url: url, data: {vehicle_model_id: id}, dataType: 'JSON', success: function(data) {
                if (data.result === true) {
                    vehicleModelList(vehicle_type_id);
                }
            }});
    } else {
        return void(0);
    }
}

/**
 * Vehicle Versions functions
 * 
 * @param {integer} vehicle_model_id
 * @returns {string}
 */
function vehicleVersionList(vehicle_model_id) {
    if (vehicle_model_id) {
        $('.vehicle-version-list').load(BASE_PATH + "/admin/vehicle/vehicle-version/list/" + vehicle_model_id);
    } else {
        $('.vehicle-version-list').empty();
    }
    $('#vehicle_model_name').val('');
    $('#vehicle_model_name').focus();
}
function vehicleVersionPost() {
    var url = BASE_PATH + "/admin/vehicle/vehicle-version/post";
    $.ajax({url: url, dataType: 'JSON', data: {vehicle_model_id: $('#vehicle_model_id').val(), vehicle_version_name: $('#vehicle_version_name').val()}, success: function() {
            vehicleVersionList($('#vehicle_model_id').val());
        }});
}
function vehicleVersionDelete(id, vehicle_model_id) {
    var url = BASE_PATH + "/admin/vehicle/vehicle-version/delete";
    var x = window.confirm("Deseja realmente apagar este item? Esta ação é irreversível.");
    if (x) {
        $.ajax({url: url, data: {vehicle_version_id: id}, dataType: 'JSON', success: function(data) {
                if (data.result === true) {
                    vehicleVersionList(vehicle_model_id);
                }
            }});
    } else {
        return void(0);
    }
}


/******************************************************************************* 
 * Customer Patrimony functions
 * 
 * @param {integer} customer_id
 * @returns {string}
 */
function customerPatrimonyList(customer_id) {
    $('.customer-patrimony-list').load(BASE_PATH + "/admin/customer/1/customer-patrimony/list/" + customer_id);
}
function customerPatrimonyPost() {
    var url = BASE_PATH + "/admin/customer/1/customer-patrimony/post";
    $.ajax({url: url, dataType: 'JSON', data: {customer_id: $('#customer_id').val(), patrimony_name: $('#patrimony_name').val(), patrimony_value: $('#patrimony_value').val()}, success: function() {
            customerPatrimonyList($('#customer_id').val());
        }});
}
function customerPatrimonyDelete(id, customer_id) {
    var url = BASE_PATH + "/admin/customer/1/customer-patrimony/delete";
    var x = window.confirm("Deseja realmente apagar este item? Esta ação é irreversível.");
    if (x) {
        $.ajax({url: url, dataType: 'JSON', data: {patrimony_id: id}, success: function(data) {
                if (data.result === true) {
                    customerPatrimonyList(customer_id);
                }
            }});
    } else {
        return void(0);
    }
}


/*******************************************************************************
 * Customer Vehicle functions
 * 
 * @param {integer} customer_id
 * @returns {string}
 */
function customerVehicleList(customer_id) {
    $('.customer-vehicle-list').load(BASE_PATH + "/admin/customer/1/customer-vehicle/list/" + customer_id);
}
function customerVehiclePost() {
    var url = BASE_PATH + "/admin/customer/1/customer-vehicle/post";
    $.ajax({url: url, dataType: 'JSON',
        data: {
            customerId: $('#customer_id').val(),
            vehicleYear: $('#customerVehicleYear').val(),
            vehicleYearModel: $('#customerVehicleYearModel').val(),
            vehiclePlate: $('#customerVehiclePlate').val(),
            vehicleValue: $('#customerVehicleValue').val(),
            vehicleColor: $('#customerVehicleColor').val(),
            vehicleBrandId: $('#customerVehicleBrandId').val(),
            vehicleTypeId: $('#customerVehicleTypeId').val(),
            vehicleModelId: $('#customerVehicleModelId').val(),
            vehicleVersionId: $('#customerVehicleVersionId').val()
        }, success: function() {
            customerVehicleList($('#customer_id').val());
        }});
}
function customerVehicleDelete(id, customer_id) {
    var url = BASE_PATH + "/admin/customer/1/customer-vehicle/delete";
    var x = window.confirm("Deseja realmente apagar este item? Esta ação é irreversível.");
    if (x) {
        $.ajax({url: url, dataType: 'JSON', data: {vehicleId: id}, success: function(data) {
                if (data.result === true) {
                    customerVehicleList(customer_id);
                }
            }});
    } else {
        return void(0);
    }
}

/*******************************************************************************
 * Customer Account functions
 * 
 * @param {integer} customer_id
 * @returns {string}
 */
function customerBankAccountList(customer_id) {
    $('.customer-bank-account-list').load(BASE_PATH + "/admin/customer/1/customer-bank-account/list/" + customer_id);
}
function customerBankAccountPost() {
    var url = BASE_PATH + "/admin/customer/1/customer-bank-account/post";
    $.ajax({url: url, dataType: 'JSON',
        data: {
            customer_id: $('#customer_id').val(),
            bank_account_id: null,
            bank_account_type: $('#bank_account_type').val(),
            bank_account_bank: $('#bank_account_bank').val(),
            bank_account_agency: $('#bank_account_agency').val(),
            bank_account_account: $('#bank_account_account').val(),
            bank_account_since: $('#bank_account_since').val()
        }, success: function() {
            customerBankAccountList($('#customer_id').val());
        }});
}
function customerBankAccountDelete(id, customer_id) {
    var url = BASE_PATH + "/admin/customer/1/customer-bank-account/delete";
    var x = window.confirm("Deseja realmente apagar este item? Esta ação é irreversível.");
    if (x) {
        $.ajax({url: url, dataType: 'JSON', data: {bank_account_id: id}, success: function(data) {
                if (data.result === true) {
                    customerBankAccountList(customer_id);
                }
            }});
    } else {
        return void(0);
    }
}

/*******************************************************************************
 * Customer Reference functions
 * 
 * @param {integer} customer_id
 * @returns {string}
 */
function customerReferenceList(customer_id) {
    $('.customer-reference-list').load(BASE_PATH + "/admin/customer/1/customer-reference/list/" + customer_id);
}
function customerReferencePost() {
    var url = BASE_PATH + "/admin/customer/1/customer-reference/post";
    $.ajax({url: url, dataType: 'JSON',
        data: {
            customer_id: $('#customer_id').val(),
            reference_type: $('#reference_type').val(),
            reference_name: $('#reference_name').val(),
            reference_phone: $('#reference_phone').val()
        },
        success: function() {
            customerReferenceList($('#customer_id').val());
        }});
}
function customerReferenceDelete(id, customer_id) {
    var url = BASE_PATH + "/admin/customer/1/customer-reference/delete";
    var x = window.confirm("Deseja realmente apagar este item? Esta ação é irreversível.");
    if (x) {
        $.ajax({url: url, dataType: 'JSON', data: {reference_id: id}, success: function(data) {
                if (data.result === true) {
                    customerReferenceList(customer_id);
                }
            }});
    } else {
        return void(0);
    }
}


/*******************************************************************************
 *******************************************************************************
 *
 * PROPOSAL FUNCTIONS
 * 
 * Vehicles Proposal functions 
 * 
 * @returns {string}
 */
function vehicleProposalList() {
    $('.vehicle-proposal-list').load(BASE_PATH + "/admin/proposal/vehicle-proposal/1/listvehicles");
}
function vehicleProposalAdd() {
    var url = BASE_PATH + "/admin/proposal/vehicle-proposal/1/addvehicle";
    $.ajax({url: url, dataType: 'JSON',
        data: {
            vehicleId: null,
            vehicleBrandId: $('#vehicleBrandId').val(),
            vehicleTypeId: $('#vehicleTypeId').val(),
            vehicleModelId: $('#vehicleModelId').val(),
            vehicleVersionId: $('#vehicleVersionId').val(),
            vehicleYear: $('#vehicleYear').val(),
            vehicleYearModel: $('#vehicleYearModel').val(),
            vehiclePlate: $('#vehiclePlate').val(),
            vehiclePlateUf: $('#vehiclePlateUf').val(),
            vehicleColor: $('#vehicleColor').val(),
            vehicleStatus: $('#vehicleStatus').val(),
            vehicleValue: $('#vehicleValue').val(),
            vehicleFuel: $('#vehicleFuel').val(),
            vehicleOwnerType: $('#vehicleOwnerType').val(),
            vehicleFrame: $('#vehicleFrame').val(),
            vehicleRenavam: $('#vehicleRenavam').val(),
            vehicleLicenceUf: $('#vehicleLicenceUf').val(),
            vehicleNotes: $('#vehicleNotes').val()

        }, success: function() {
            vehicleProposalList();
        }});
}
function vehicleProposalDelete(id) {
    var url = BASE_PATH + "/admin/proposal/vehicle-proposal/1/deletevehicle";
    var x = window.confirm("Deseja realmente apagar este item? Esta ação é irreversível.");
    if (x) {
        $.ajax({url: url, dataType: 'JSON', data: {itemId: id}, success: function(data) {
                if (data.result === true) {
                    vehicleProposalList(id);
                }
            }});
    } else {
        return void(0);
    }
}

/**
 * Customer Bank Accounts Functions
 * 
 * @returns {undefined}
 */
function proposalCustomerBankAccountList() {
    $('.proposal-customer-bank-account-list').load(BASE_PATH + "/admin/proposal/proposal/listcustomerbankaccount");
}
function proposalCustomerBankAccountAdd() {
    var url = BASE_PATH + "/admin/proposal/proposal/addcustomerbankaccount";
    $.ajax({url: url, dataType: 'JSON',
        data: {
            bankAccountId: null,
            bankAccountBank: $('#bank_account_bank').val(),
            bankAccountType: $('#bank_account_type').val(),
            bankAccountAgency: $('#bank_account_agency').val(),
            bankAccountAccount: $('#bank_account_account').val(),
            bankAccountSince: $('#bank_account_since').val()
        }, success: function() {
            proposalCustomerBankAccountList();
        }});
}
function proposalCustomerBankAccountDelete(key, id) {
    var url = BASE_PATH + "/admin/proposal/proposal/deletecustomerbankaccount";
    var x = window.confirm("Deseja realmente apagar este item? Esta ação é irreversível.");
    if (x) {
        $.ajax({url: url, dataType: 'JSON', data: {itemId: key, dataId: id}, success: function(data) {
                if (data.result === true) {
                    proposalCustomerBankAccountList(key);
                }
            }});
    } else {
        return void(0);
    }
}

/**
 * Customer Reference Functions
 * 
 * @returns {undefined}
 */
function proposalCustomerReferenceList() {
    $('.proposal-customer-reference-list').load(BASE_PATH + "/admin/proposal/proposal/listcustomerreference");
}
function proposalCustomerReferenceAdd() {
    var url = BASE_PATH + "/admin/proposal/proposal/addcustomerreference";
    $.ajax({url: url, dataType: 'JSON',
        data: {
            referenceId: null,
            referenceType: $('#reference_type').val(),
            referenceName: $('#reference_name').val(),
            referencePhone: $('#reference_phone').val()
        }, success: function() {
            proposalCustomerReferenceList();
        }});
}
function proposalCustomerReferenceDelete(key, id) {
    var url = BASE_PATH + "/admin/proposal/proposal/deletecustomerreference";
    var x = window.confirm("Deseja realmente apagar este item? Esta ação é irreversível.");
    if (x) {
        $.ajax({url: url, dataType: 'JSON', data: {itemId: key, dataId: id}, success: function(data) {
                if (data.result === true) {
                    proposalCustomerReferenceList(key);
                }
            }});
    } else {
        return void(0);
    }
}

/**
 * Customer Patrimony Functions
 * 
 * @returns {undefined}
 */
function proposalCustomerPatrimonyList() {
    $('.proposal-customer-patrimony-list').load(BASE_PATH + "/admin/proposal/proposal/listcustomerpatrimony");
}
function proposalCustomerPatrimonyAdd() {
    var url = BASE_PATH + "/admin/proposal/proposal/addcustomerpatrimony";
    $.ajax({url: url, dataType: 'JSON',
        data: {
            patrimonyId: null,
            patrimonyName: $('#patrimony_name').val(),
            patrimonyValue: $('#patrimony_value').val(),
            patrimonyDebit: $('#patrimony_debit').val()
        }, success: function() {
            proposalCustomerPatrimonyList();
        }});
}
function proposalCustomerPatrimonyDelete(key, id) {
    var url = BASE_PATH + "/admin/proposal/proposal/deletecustomerpatrimony";
    var x = window.confirm("Deseja realmente apagar este item? Esta ação é irreversível.");
    if (x) {
        $.ajax({url: url, dataType: 'JSON', data: {itemId: key, dataId: id}, success: function(data) {
                if (data.result === true) {
                    proposalCustomerPatrimonyList(key);
                }
            }});
    } else {
        return void(0);
    }
}

/**
 * Customer Patrimony Functions
 * 
 * @returns {undefined}
 */
function proposalCustomerVehicleList() {
    $('.proposal-customer-vehicle-list').load(BASE_PATH + "/admin/proposal/proposal/listcustomervehicle");
}
function proposalCustomerVehicleAdd() {
    var url = BASE_PATH + "/admin/proposal/proposal/addcustomervehicle";
    $.ajax({url: url, dataType: 'JSON',
        data: {
            vehicleId: null,
            vehicleBrandId: $('#customerVehicleBrandId').val(),
            vehicleTypeId: $('#customerVehicleTypeId').val(),
            vehicleModelId: $('#customerVehicleModelId').val(),
            vehicleVersionId: $('#customerVehicleVersionId').val(),
            vehicleYear: $('#customerVehicleYear').val(),
            vehicleYearModel: $('#customerVehicleYearModel').val(),
            vehiclePlate: $('#customerVehiclePlate').val(),
            vehicleColor: $('#customerVehicleColor').val(),
            vehicleValue: $('#customerVehicleValue').val()
        }, success: function() {
            proposalCustomerVehicleList();
        }});
}
function proposalCustomerVehicleDelete(key, id) {
    var url = BASE_PATH + "/admin/proposal/proposal/deletecustomervehicle";
    var x = window.confirm("Deseja realmente apagar este item? Esta ação é irreversível.");
    if (x) {
        $.ajax({url: url, dataType: 'JSON', data: {itemId: key, dataId: id}, success: function(data) {
                if (data.result === true) {
                    proposalCustomerVehicleList(key);
                }
            }});
    } else {
        return void(0);
    }
}


function realtyProposalList() {
    $('.realty-proposal-list').load(BASE_PATH + "/admin/proposal/realty-proposal/1/listrealties");
}
function realtyProposalAdd() {
    var url = BASE_PATH + "/admin/proposal/realty-proposal/1/addrealty";
    $.ajax({type: 'POST', url: url, dataType: 'JSON',
        data: {
            realtyType: $('#realtyType').val(),
            realtyValue: $('#realtyValue').val(),
            addressName: $('#realtyAddressName').val(),
            addressNumber: $('#realtyAddressNumber').val(),
            addressComplement: $('#realtyAddressComplement').val(),
            addressQuarter: $('#realtyAddressQuarter').val(),
            addressCep: $('#realtyAddressCep').val(),
            addressCity: $('#realtyAddressCity').val(),
            addressState: $('#realtyAddressState').val(),
            addressCountry: $('#realtyAddressCountry').val(),
            realtyFeatureBuiltArea: $('.realtyFeatureBuiltArea').val(),
            realtyFeatureBalconyArea: $('.realtyFeatureBalconyArea').val(),
            realtyFeatureTotalArea: $('.realtyFeatureTotalArea').val(),
            realtyFeatureUsefulArea: $('.realtyFeatureUsefulArea').val(),
            realtyFeatureGroundArea: $('.realtyFeatureGroundArea').val(),
            realtyFeatureGroundWidth: $('.realtyFeatureGroundWidth').val(),
            realtyFeatureGroundLength: $('.realtyFeatureGroundLength').val(),
            realtyFeatureBedroomAmount: $('.realtyFeatureBedroomAmount').val(),
            realtyFeatureRoomAmount: $('.realtyFeatureRoomAmount').val(),
            realtyFeatureSuiteAmount: $('.realtyFeatureSuiteAmount').val(),
            realtyFeatureBathtubAmount: $('.realtyFeatureBathtubAmount').val(),
            realtyFeatureBathroomAmount: $('.realtyFeatureBathroomAmount').val(),
            realtyFeatureHallAmount: $('.realtyFeatureHallAmount').val(),
            realtyFeatureBathroomStall: $('.realtyFeatureBathroomStall').val(),
            realtyFeatureBathroomCabinet: $('.realtyFeatureBathroomCabinet').val(),
            realtyFeatureRoomCabinet: $('.realtyFeatureRoomCabinet').val(),
            realtyFeatureRestroom: $('.realtyFeatureRestroom').val(),
            realtyFeatureDoubleLiving: $('.realtyFeatureDoubleLiving').val(),
            realtyFeatureDiningRoom: $('.realtyFeatureDiningRoom').val(),
            realtyFeatureTvRoom: $('.realtyFeatureTvRoom').val(),
            realtyFeatureOffice: $('.realtyFeatureOffice').val(),
            realtyFeatureKitchen: $('.realtyFeatureKitchen').val(),
            realtyFeaturePlannedKitchen: $('.realtyFeaturePlannedKitchen').val(),
            realtyFeatureStoreRoom: $('.realtyFeatureStoreRoom').val(),
            realtyFeatureServiceArea: $('.realtyFeatureServiceArea').val(),
            realtyFeatureStoreHouse: $('.realtyFeatureStoreHouse').val(),
            realtyFeatureLiningSlab: $('.realtyFeatureLiningSlab').val(),
            realtyFeaturePvcLiner: $('.realtyFeaturePvcLiner').val(),
            realtyFeaturePlanking: $('.realtyFeaturePlanking').val(),
            realtyFeatureFinishPlaster: $('.realtyFeatureFinishPlaster').val(),
            realtyFeatureGasHeater: $('.realtyFeatureGasHeater').val(),
            realtyFeatureSolarHeater: $('.realtyFeatureSolarHeater').val(),
        }, success: function() {
            realtyProposalList();
        }});
}
function realtyProposalDelete(id) {
    var url = BASE_PATH + "/admin/proposal/realty-proposal/1/deleterealty";
    var x = window.confirm("Deseja realmente apagar este item? Esta ação é irreversível.");
    if (x) {
        $.ajax({url: url, dataType: 'JSON', data: {itemId: id}, success: function(data) {
                if (data.result === true) {
                    realtyProposalList(id);
                }
            }});
    } else {
        return void(0);
    }
}


function caixaProposalList() {
    $('.caixa-proposal-list').load(BASE_PATH + "/admin/proposal/caixa-proposal/1/listproducts");
}
function caixaProposalAdd() {
    var url = BASE_PATH + "/admin/proposal/caixa-proposal/1/addproduct";
    $.ajax({type: 'GET', url: url, dataType: 'JSON',
        data: {
            product: $('#productId').val()
        }, success: function() {
            caixaProposalList();
        }});
}
function caixaProposalDelete(id) {
    var url = BASE_PATH + "/admin/proposal/caixa-proposal/1/deleteproduct";
    var x = window.confirm("Deseja realmente apagar este item? Esta ação é irreversível.");
    if (x) {
        $.ajax({url: url, dataType: 'JSON', data: {itemId: id}, success: function(data) {
                if (data.result === true) {
                    caixaProposalList(id);
                }
            }});
    } else {
        return void(0);
    }
}

/**
 * *****************************************************************************
 * Various Functions 
 * 
 * @param {id} categoryId
 * @returns {string}
 */
function productList(categoryId) {
    $('.product-list').load(BASE_PATH + "/admin/product/1/list?id=" + categoryId);
}

function calculateArea() {
    var built = $('#realtyFeatureBuiltArea').val();
    var balcony = $('#realtyFeatureBalconyArea').val();
    $.ajax({type: 'GET', url: BASE_PATH + '/admin/realty-feature/calculatearea', dataType: 'JSON',
        data: {
            built: built,
            balcony: balcony
        }, success: function(data) {
            $('#realtyFeatureTotalArea').empty();
            $('#realtyFeatureTotalArea').val(data.total);
        }});
    return true;
}

function calculateGround() {
    var width = $('#realtyFeatureGroundWidth').val();
    var length = $('#realtyFeatureGroundLength').val();
    $.ajax({type: 'GET', url: BASE_PATH + '/admin/realty-feature/calculateground', dataType: 'JSON',
        data: {
            width: width,
            length: length
        }, success: function(data) {
            $('#realtyFeatureGroundArea').empty();
            $('#realtyFeatureGroundArea').val(data.total);
        }});
    return true;
}

/**
 * Change person type field (between Legal Person and Individual Person
 * 
 * @param {integer} type
 * @returns {string}
 */

function changePerson(type) {
    $('label[for=personDocument]').empty();
    if (type == 'MA==') {
        $('label[for=personDocument]').append('CPF');
        $('#personDocument').unmask();
        $('#personDocument').mask("999.999.999-99");
        $('#personDocument').attr('disabled', false);
    } else if (type == 'MQ==') {
        $('label[for=personDocument]').append('CNPJ');
        $('#personDocument').unmask();
        $('#personDocument').mask("99.999.999/9999-99");
        $('#personDocument').attr('disabled', false);
    } else {
        $('label[for=personDocument]').append('CPF/CNPJ');
        $('#personDocument').attr('disabled', 'disabled');
    }
}

/**
 * *****************************************************************************
 * JQUERY FUNCTIONS & BOOTSTRAP
 * 
 * Tooltip initialization
 * @param {type} $
 * @returns {undefined}
 */
!function($) {
    $(function() {
        $('.btn-group').tooltip({
            selector: "[data-toggle=tooltip]",
            container: "body"
        });

        $('.app-tooltip').tooltip({
            container: "body"
        });

        $('.datepicker').datepicker({
            changeMonth: true,
            changeYear: true,
            yearRange: "1900:2013"
        });
    });
}(window.jQuery);
