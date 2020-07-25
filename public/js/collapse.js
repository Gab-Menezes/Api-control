(() =>
{

let elements = document.querySelectorAll('[collapse-button]');
elements.forEach(element => 
{
    element.addEventListener("click", (event) => 
    {
        event.preventDefault();
        let ApiId = element.id.split("-")[1];
        let div = document.getElementById(`div-textarea-${ApiId}`);
        div.hidden = !div.hidden
    });

});

})()
