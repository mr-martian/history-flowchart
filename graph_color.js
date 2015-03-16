var colorsDiv = document.getElementById("color");
colorsDiv.innerHTML += "<h4>colors</h4><div></div><button onclick='docolorchecks();'>update</button><button onclick='addline();'>add line</button>";
var entryList = colorsDiv.childNodes[1];

var set_color = function(cla, color) { //From http://stackoverflow.com/questions/566203/changing-css-values-with-javascript
    for (var i=0; i<document.styleSheets.length;i++) {//Loop through all styles
        //Try add rule
        try {
            document.styleSheets[i].insertRule("line." + cla + ' {stroke-color: #'+color+'}', document.styleSheets[i].cssRules.length);
            document.styleSheets[i].insertRule("circle." + cla + ' {fill: #'+color+'}', document.styleSheets[i].cssRules.length);
        }
        catch(err) {
            try {
                document.styleSheets[i].addRule("line." + cla, 'stroke-color: #'+color);
                document.styleSheets[i].addRule("circle." + cla, 'fill: #'+color);
            }
            catch(err) {}
        }//IE
    }
};
var addline = function() {
    entryList.innerHTML += "<div>Tag:<input type='text' maxlength='20'></input>R:<input type='number' min='0' max='255'></input>G:<input type='number' min='0' max='255'></input>B:<input type='number' min='0' max='255'></input></div>";
}
addline();
var docolorline = function(node) {
    var a = parseInt(node.childNodes[3].value).toString(16);
    var b = parseInt(node.childNodes[5].value).toString(16);
    var c = parseInt(node.childNodes[7].value).toString(16);
    set_color(node.childNodes[1].value, ((a.length === 2 && a) || '0'+a) +
                                        ((b.length === 2 && b) || '0'+b) +
                                        ((c.length === 2 && c) || '0'+c));
}
var docolorchecks = function() {
    for (var i = 0; i < entryList.childNodes.length; i++) {
        docolorline(entryList.childNodes[i]);
    }
}
