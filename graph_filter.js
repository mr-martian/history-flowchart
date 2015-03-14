var set_style = function(cla, vis) { //From http://stackoverflow.com/questions/566203/changing-css-values-with-javascript
    var v;
    if (vis) {
        v = "visible";
    }
    else {
        v = "hidden";
    }
    for (var i=0; i<document.styleSheets.length;i++) {//Loop through all styles
        //Try add rule
        try { document.styleSheets[i].insertRule("." + cla + ' {visibility: '+v+'}', document.styleSheets[i].cssRules.length);
        } catch(err) {try { document.styleSheets[i].addRule("." + cla, 'visibility: '+v);} catch(err) {}}//IE
    }
};
var dochecks = function() {
    var sec = document.getElementById("hide");
    for (var i = 0; i < sec.childNodes.length; i++) {
        set_style(sec.childNodes[i].value, true);
    }
    for (var i = 0; i < sec.childNodes.length; i++) {
        if (sec.childNodes[i].checked) {
            set_style(sec.childNodes[i].value, false);
        }
    }
}
