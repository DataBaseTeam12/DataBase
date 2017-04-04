// shorthand for addEventListener
function tag(name) {
    return document.getElementsByTagName(name);
}
function id(name) {
    return document.getElementById(name);
}
function handle(object, event, fn) {
    object.addEventListener(event, fn);
}

// handle splits
function Split(elem, left, right) {
    this.elem = elem;
    this.l = left;
    this.lclient = left.clientWidth;
    this.loffset = left.offsetWidth;
    this.r = right;
    this.rclient = right.clientWidth;
    this.roffset = right.offsetWidth;
};
var splits = [];
function process_splits() {
    function fix() {
        var split = document.getElementsByClassName("split");
        for (n = 0; n < split.length; ++n) {
            // get left and right elements
            var l = split[n].getElementsByClassName("split-l")[0];
            var r = split[n].getElementsByClassName("split-r")[0];
            // fix the HTML
            var t = split[n].innerHTML;
            var arr = ["", "", "", "", ""]
            if (l.scrollWidth > 0) {
                t = t.split(l.innerHTML);
                arr[0] = t[0];
                arr[1] = l.innerHTML;
                t = t[1];
            }
            if (r.scrollWidth > 0) {
                t = t.split(r.innerHTML);
                arr[3] = r.innerHTML;
                arr[4] = t[1];
                arr[2] = t[0].replace(new RegExp("[^\\S ]", "g"), "");
            } else {
                arr[2] = t;
            }
            split[n].innerHTML = arr[0] + arr[1] + arr[2] + arr[3] + arr[4];
        }
        //alert("fix");
    }
    function separate() {
        var split = document.getElementsByClassName("split");
        for (n = 0; n < split.length; ++n) {
            // add to splits array
            splits.push(new Split(
                split[n],
                split[n].getElementsByClassName("split-l")[0],
                split[n].getElementsByClassName("split-r")[0])
            );
        }
        //alert("separate");
    }
    fix();
    separate();
    update_splits();
}
function update_splits() {
    for (n = 0; n < splits.length; ++n) {
        // get widths for elements
        var s = window.getComputedStyle(splits[n].elem, null).getPropertyValue("width").replace("px", "");
        var w = s - splits[n].loffset - splits[n].roffset + splits[n].rclient;
        //splits[n].r.style.width = Math.max(splits[n].rclient, w) + "px";
        splits[n].r.style.width = w + "px";

        //alert(
        //    "l" + "\n" +
        //    "client: " + l.clientWidth + "\n" +
        //    "offset: " + l.offsetWidth + "\n" +
        //    "scroll: " + l.scrollWidth + "\n" +
        //    "r" + "\n" +
        //    "client: " + r.clientWidth + "\n" +
        //    "offset: " + r.offsetWidth + "\n" +
        //    "scroll: " + r.scrollWidth + "\n" +
        //    "s" + "\n" +
        //    "width: " + sw + "\n" +
        //    "padding: " + sp
        //);

        //alert(
        //    "l" + "\n" +
        //    "client: " + l.clientWidth + "\n" +
        //    "offset: " + l.offsetWidth + "\n" +
        //    "scroll: " + l.scrollWidth + "\n" +
        //    "r" + "\n" +
        //    "client: " + r.clientWidth + "\n" +
        //    "offset: " + r.offsetWidth + "\n" +
        //    "scroll: " + r.scrollWidth + "\n" +
        //    "s" + "\n" +
        //    "width: " + sw + "\n" +
        //    "padding: " + sp
        //);        
    }
    //alert("update_splits");
}