tinymce.PluginManager.add("chracterlimiter", function(a) {
    var b = this,
        c = tinymce.util.Delay,
        d = a.getParam("max_chars", 0),
        e = [8, 37, 38, 39, 40, 46],
        f = "characterlimit",
        g = "cl" + (1e3 * Date.now() | 0);
    b.updateCounter = function() {
        a.theme.panel.find("#" + f).text(["Limit: {0}/" + d, b.getCount()])
    }, b.getCount = function() {
        var b = a.contentDocument.body,
            c = b.innerText;
        if (c.length > d && 10 === c.charCodeAt(c.length - 1) || c.length > 1 && 10 === c.charCodeAt(c.length - 1) && 10 === c.charCodeAt(c.length - 2)) c = c.slice(0, -1);
        else if (1 === c.length && 10 === c.charCodeAt(0)) return 0;
        return c.length
    }, a.on("init", function() {
        var e = a.theme.panel && a.theme.panel.find("#statusbar")[0];
        e && c.setEditorTimeout(a, function() {
            e.insert({
                type: "label",
                name: f,
                text: ["Limit: {0}/" + d, b.getCount()],
                classes: g,
                disabled: a.settings.readonly
            }, 0)
        })
    }, 0), a.on("keyup setcontent beforeaddundo", b.updateCounter), a.on("keydown", function(a) {
        return e.indexOf(a.keyCode) != -1 || (!(b.getCount() + 1 > d) || (a.preventDefault(), a.stopPropagation(), !1))
    }), a.on("pastepreprocess", function(c) {
        var d = b.getCount(),
            e = c.content.replace(/<br\s?\/?>/gm, "\n"),
            f = $("<div>").append($.parseHTML(e)),
            g = f.text(),
            h = g.length;
        d + h > a.settings.max_chars && (e = e.slice(0, a.settings.max_chars - d), h = e.length, f = $("<div>").append($.parseHTML(e.replace(/\n/gm, "<br>"))), c.content = f.html()), b.updateCounter()
    }, 0)
});
