var menu_items = document.getElementById("menu-items");

menu_items.style.maxHeight = "0px";

function menutoggle() {
    if (menu_items.style.maxHeight == "0px") {
        menu_items.style.maxHeight = "200px";
    } else {
        menu_items.style.maxHeight = "0px";
    }
}

