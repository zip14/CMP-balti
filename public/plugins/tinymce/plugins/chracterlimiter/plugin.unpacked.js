tinymce.PluginManager.add('chracterlimiter', function(editor) {
    var plugin = this, delay = tinymce.util.Delay, max = editor.getParam("max_chars", 0), allowedKeys = [8, 37, 38, 39, 40, 46], name = "characterlimit", unit = "cl" + (Date.now() * 1000 | 0);
    plugin.updateCounter = function(){
        editor.theme.panel.find('#'+ name).text(["Limit: {0}/" + max, plugin.getCount()])
    };
    plugin.getCount = function(){
        var body = editor.contentDocument.body, innerText = body.innerText
        if((innerText.length > max && innerText.charCodeAt(innerText.length - 1) === 10) || (innerText.length > 1 && innerText.charCodeAt(innerText.length - 1) === 10 &&  innerText.charCodeAt(innerText.length - 2) === 10)){
            innerText = innerText.slice(0, -1);
        } else if(innerText.length === 1 && innerText.charCodeAt(0) === 10){
            return 0;
        }

        return innerText.length;
    };

    editor.on("init", function() {
        var statusbar = editor.theme.panel && editor.theme.panel.find("#statusbar")[0];
        statusbar && delay.setEditorTimeout(editor, function() {
            statusbar.insert({
                type: "label",
                name: name,
                text: ["Limit: {0}/" + max, plugin.getCount()],
                classes: unit,
                disabled: editor.settings.readonly
            }, 0)
        });
    }, 0);
    editor.on("keyup setcontent beforeaddundo", plugin.updateCounter),
    editor.on('keydown', function (e) {
        if (allowedKeys.indexOf(e.keyCode) != -1) return true;
        if (plugin.getCount() + 1 > max) {
            e.preventDefault();
            e.stopPropagation();
            return false;
        }
        return true;
    }),
    editor.on("pastepreprocess", function (event) {
        var length = plugin.getCount(), pasteContent = event.content.replace(/<br\s?\/?>/gm, "\n"), pasteHTMLContent = $('<div>').append($.parseHTML(pasteContent)), pureText = pasteHTMLContent.text(), textLenght = pureText.length;

        if (length + textLenght > editor.settings.max_chars) {
            pasteContent = pasteContent.slice(0, editor.settings.max_chars - length);
            textLenght = pasteContent.length;
            pasteHTMLContent = $('<div>').append($.parseHTML(pasteContent.replace(/\n/gm, '<br>')));
            event.content = pasteHTMLContent.html();
        }

        plugin.updateCounter();
    }, 0);
});
