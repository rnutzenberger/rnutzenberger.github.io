$(document).ready(function(){
    
    $('#btnSearch').click(function()
    {
        GetMessages($('#filter').val());
    });

    $('#btnSend').click(function(){
        AddMessage($('#message').val());
    });
    GetMessages('');
});

function ShowMessages(response,ajaxStatus)
{
    
    
    CreateTable(response);

}

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
            'value': user['msgID']
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

function GetMessages(filter)
{
    //pack the data and send the get users request to get all users
    
    var data;
    AjaxRequest('https://thor.net.nait.ca/~rnutz995/cmpe2500/icas/ICA5/svc/messages/'+filter,'GET',data,'json',ShowMessages,ErrorHandler);
}

function AddMessage(message)
{
    var data;
    data['message'] = message;
    AjaxRequest('https://thor.net.nait.ca/~rnutz995/cmpe2500/icas/ICA5/svc/messages/','POST',data,'json', ShowMessages,ErrorHandler);
}

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