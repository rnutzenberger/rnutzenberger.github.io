var testData = {data: [{userID: "123", username:"Kirk", password:"NCC1701"},
    {userID: "667", username: "Spock", password: "Fascinating"}],
    status: "Passed"
};

$(document).ready(function(){
    CreateTable(testData);
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

