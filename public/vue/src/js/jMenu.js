export class jMenu{
    static init(){
        let navToggler = document.getElementById("navToggler")
        let navTogglerIcon = document.getElementById("navTogglerIcon")
        let sideNav = document.getElementsByClassName("sidenav")[0]
        navToggler.onchange = function(){
            if(navToggler.checked){
                sideNav.className = "sidenav opened"
                navTogglerIcon.className = "menuButton icon-arrow-right rotated"
            }else{
                sideNav.className = "sidenav"
                navTogglerIcon.className = "menuButton icon-menu"
            }
        }
    }
}
