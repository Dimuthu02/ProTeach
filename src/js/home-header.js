window.onscroll = function () { scrollFunction() };

function scrollFunction() {
    if (document.body.scrollTop > 50 || document.documentElement.scrollTop > 50) {
        document.getElementById("header").style.fontSize = "11px";
        document.getElementById("header").style.height = "55px";
        document.getElementById("logo").style.height = "100px";
    } else {
        document.getElementById("header").style.fontSize = "18px";
        document.getElementById("header").style.height = "90px";
        document.getElementById("logo").style.height = "180px";
  
    }
}

