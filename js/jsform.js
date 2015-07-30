
function addHiddenButton(name) {
    var button = document.createElement("button");
    button.setAttribute("type", "hidden");
    button.setAttribute("name", name);
    button.click();
    return button;
}

function addHiddenField(name, value) {
    var field = document.createElement("input");
    field.setAttribute("type", "hidden");
    field.setAttribute("name", name);
    field.setAttribute("value", value);

    return field;
}
