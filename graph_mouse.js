function readMouseMove(e){
    var result = document.getElementById('mousepos');
    var x = e.clientX - 5000;
    var y = e.clientY - 180;
    var element = document.getElementById('graph');
    var rX = 0;
    var rY = 0;
    if (element.pageYOffset) {
        rX=element.pageXOffset;
        rY=element.pageYOffset;
    }
    if (document.body) {
        rX=document.body.scrollLeft;
        rY=document.body.scrollTop;
    }
    if (document.documentElement && document.documentElement.scrollTop) {
        rX=document.documentElement.scrollLeft;
        rY=document.documentElement.scrollTop;
    }
    x += rX;
    y += rY;
    x -= 9;
    y -= 9;
    if (x < 1) { var xtxt = (1 - x) + " BC"; }
    else { var xtxt = "AD " + x; }
    if (y < 0) { var ytxt = (-1 * y) + "&deg;E"; }
    else { var ytxt = y + "&deg;W"; }
    result.innerHTML = "Your mouse location: " + xtxt + ", " + ytxt;
}
document.onmousemove = readMouseMove;
