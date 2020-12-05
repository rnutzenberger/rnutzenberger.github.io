//generic ajax request helper 
function AjaxRequest(url, requestType, data, dataType, SuccessFunction, ErrorFunction) {
    $.ajax(url, {
        type: requestType,
        data: data,
        dataType: dataType,
        success: SuccessFunction,
        error: ErrorFunction
    });
}

function ErrorHandler(reqObj, textStatus, errorThrown) {
    console.log(textStatus);
    console.log(errorThrown);
    console.log(reqObj);
}


function SuccessHandler(data, ajaxStatus) {
    console.log(data);
    console.log(ajaxStatus);
}