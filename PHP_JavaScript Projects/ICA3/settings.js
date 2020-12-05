var testData = {data: [{userID: "123", username:"Kirk", password:"NCC1701"},
    {userID: "667", username: "Spock", password: "Fascinating"}],
    status: "Passed"
};

$(document).ready(function(){

    GetUsers();
    $("#btnBack").click(function(){
        window.history.back();
    });

})

//function creates a table for the settings page
function CreateTable(object)
{
    //empty the table area
    let tbody = $("table#tblUsers tbody");
    $(tbody).empty();

    //for as many values in the object being passed(testData for now)
    for(let user of object.data)
    {
        //create corresponding table elments and append
        let tr = document.createElement('tr');
        let td = document.createElement('td');

        tr.appendChild(td);
        
        //for every property in user
        for(let prop in user)
        {
            //set and append the elements
            let td = document.createElement('td');
            $(td).html(user[prop]);
            tr.appendChild(td);
        }
        $(tbody).append(tr);

    }

    //will return a "passed" if the table is succesfully made
    $("#status").html("Page Status: " +object.status);
}

//sends a GET request to the webservice.php to get the users from the DB
function GetUsers(response)
{
    //pack the data and send the get users request to get all users
    let data = { 'action' : 'GetUsers'};
    AjaxRequest('webservice.php','GET',data,'json',ShowUsers,ErrorHandler);
}

//calls the create table function to display a table
function ShowUsers(response, ajaxStatus)
{
    $('#status').html('Retrieved: ' + response.status);
    CreateTable(response);
}

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
