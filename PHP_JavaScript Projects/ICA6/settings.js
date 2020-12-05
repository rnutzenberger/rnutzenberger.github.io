

$(document).ready(function(){

    GetUsers();
    $("#btnBack").click(function(){
        window.history.back();
    });

    $('#btnAddUser').click(function(){
        AddUser();
        $('#username').val("");
        $('#password').val("");
    });

});

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
        let deleteBtn = document.createElement('button');
        $(deleteBtn).attr({
            'class': 'DeleteBtn',
            'value': user['userID']
        });
        $(deleteBtn).html("Delete");

        //set the delete button onClick function to delete
        $(deleteBtn).on('click', function(){DeleteUser(this);});
        td.appendChild(deleteBtn);
        
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

//deletes userIDs from the table
function DeleteUser(object)
{
    //set the data to POST
    let id = $(object).val();
    var postData = {};
    postData['action'] = 'DeleteUser';
    postData['userID'] = id;
   
    AjaxRequest('webservice.php', 'POST', postData,'json',HandleStatus,ErrorHandler);

}

//adds a userID to the table
function AddUser()
{

    //set the data to POST
    var postData = {};
    postData['action'] = "AddUser";
    postData["username"] =  $('#username').val();
    postData["password"] = $('#password').val();
    AjaxRequest('webservice.php', 'POST', postData,'json', HandleStatus,ErrorHandler);
    
}

//
function HandleStatus(response,ajaxStatus)
{
    $('#status').html(response.status);
    GetUsers();
}

function GetUsers(response)
{
    //pack the data and send the get users request to get all users
    let data = { 'action' : 'GetUsers'};
    AjaxRequest('webservice.php','GET',data,'json',ShowUsers,ErrorHandler);
}

function ShowUsers(response, ajaxStatus)
{
    //$('#status').html('Retrieved: ' + response.status);
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
