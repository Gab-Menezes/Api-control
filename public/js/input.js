(() =>
{

function makeURL(tableRows, ApiId)
{
    let baseUrl = document.getElementById(`baseURL-${ApiId}`).innerText;
    let addToUrl = "";
    let isFirstToBeAdded = true;
    for (let j = 0; j < tableRows.length; j++)
    {
        let checkbox = tableRows[j].firstElementChild.firstElementChild;
        let param = tableRows[j].querySelector(`#param-${ApiId}-${j}`).value;
        let value = tableRows[j].querySelector(`#value-${ApiId}-${j}`).value;
        let isParamTyped = param === "" ? false : true;
        let isValueTyped = value === "" ? false : true;

        if (isParamTyped && isValueTyped)
        {
            if (checkbox.checked && isFirstToBeAdded)
            {
                addToUrl += `?${param}=${value}`;
                isFirstToBeAdded = false;
            }
            else if (checkbox.checked)
            {
                addToUrl += `&${param}=${value}`;
            }
        }
    }
    let url = baseUrl + addToUrl;
    document.getElementById(`FinalURL-${ApiId}`).value = url;
}

function inputEvent(tableInput, ApiId, element)
{
    let rowId = tableInput.id.split("-")[2];

    let paramTyped = element.querySelector(`#param-${ApiId}-${rowId}`).value;
    let valueTyped = element.querySelector(`#value-${ApiId}-${rowId}`).value;
    let isParamTyped = paramTyped === "" ? false : true;
    let isValueTyped = valueTyped === "" ? false : true;

    let url = document.getElementById(`FinalURL-${ApiId}`).value;
    let tableRows = element.getElementsByTagName('tbody')[0].getElementsByTagName('tr');
    if (tableInput.type == "checkbox")
        makeURL(tableRows, ApiId);
    else if (tableInput.type == "text")
    {
        let inputId = tableInput.id;
        if (inputId.includes("param") || inputId.includes("value"))
        {
            
            if (rowId == tableRows.length - 1)
            {
                let row = element.insertRow(tableRows.length + 1);
                let cell = [];
                for (let j = 0; j < 4; j++)
                {
                    cell[j] = row.insertCell(j);
                    let input = "";
                    switch (j)
                    {
                        case 0:
                            cell[j].style = "height: 30px; text-align: center; vertical-align: middle";
                            input = `<input id="checkbox-${ApiId}-${tableRows.length - 1}" type="checkbox" style="height: 17px; width: 17px;">`;
                            break;

                        case 1:
                            cell[j].style = "height: 30px";
                            input= `<input id="param-${ApiId}-${tableRows.length - 1}" type="text" class="form-control" style="background: #3e444a; height: 30px !important; color: #f0f0f0">`;
                        break;

                        case 2:
                            cell[j].style = "height: 30px";
                            input= `<input id="value-${ApiId}-${tableRows.length - 1}" type="text" class="form-control" style="background: #3e444a; height: 30px !important; color: #f0f0f0">`;
                        break;

                        case 3:
                            cell[j].style = "height: 30px";
                            input= `<input type="text" class="form-control" style="background: #3e444a; height: 30px !important; color: #f0f0f0">`;
                        break;

                        default:
                            break;
                    }
                    cell[j].innerHTML = input;
                    let newInput = cell[j].firstElementChild;
                    newInput.addEventListener("input", () => 
                    {
                        inputEvent(newInput, ApiId, element)
                    });
                }
            }

            makeURL(tableRows, ApiId);
        }
    }
}

let elements = document.querySelectorAll('[api-table]');
elements.forEach(element => 
{
    let ApiId = element.id.substr(10);
    let tableInput = element.getElementsByTagName('input');
    for (let i = 0; i < tableInput.length; i++) 
    {
        tableInput[i].addEventListener("input", () => 
        {
            inputEvent(tableInput[i], ApiId, element);
        });
    }
});

})()
