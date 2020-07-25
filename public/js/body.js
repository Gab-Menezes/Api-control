(() =>
{

let elements = document.querySelectorAll('[body-checkbox]');
elements.forEach(element => 
{
    element.addEventListener("input", () => 
    {
        let ApiId = element.id.split("-")[2];
        let div = document.getElementById(`div-body-${ApiId}`);
        div.hidden = !div.hidden;
    });
});

})()
