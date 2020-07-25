(() => 
{

function validURL(str)
{
    let pattern = new RegExp('^(https?:\\/\\/)?'+ // protocol
        '((([a-z\\d]([a-z\\d-]*[a-z\\d])*)\\.)+[a-z]{2,}|'+ // domain name
        '((\\d{1,3}\\.){3}\\d{1,3}))'+ // OR ip (v4) address
        '(\\:\\d+)?(\\/[-a-z\\d%_.~+]*)*'+ // port and path
        '(\\?[;&a-z\\d%_.~+=-]*)?'+ // query string
        '(\\#[-a-z\\d_]*)?$','i'); // fragment locator
    return !!pattern.test(str);
}

let elements = document.querySelectorAll('[request-button]');
elements.forEach(element => 
{
    element.addEventListener("click", (event) => 
    {
        event.preventDefault();
        
        let ApiId = element.id.split("-")[1];
        let method = element.innerText;
        let url = document.getElementById(`FinalURL-${ApiId}`).value;
        if (validURL(url))
        {
            let parameters = {};
            let bodyDiv = document.getElementById(`div-body-${ApiId}`);
            if (!bodyDiv.hidden)
            {
                let body = bodyDiv.firstElementChild.value;
                parameters = { method: method,  body: body };
            }
            else
                parameters = {method: method};

            fetch(url, parameters)
            .then(response => 
            {
                console.log(response);
                return response.json();
            })
            .then(data => 
            {
                let json = JSON.stringify(data, null, "\t");
                let div = document.getElementById(`div-textarea-${ApiId}`);
                div.hidden = false;

                let textarea = div.firstElementChild;
                textarea.value = json;
            })
        }
        else
        {
            console.log("invalid url");
        }
    });
});

})()
