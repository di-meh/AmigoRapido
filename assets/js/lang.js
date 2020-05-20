// Modifier la langue du site

function au() {
    if (document.getElementById('australiaFont')) {
        document.getElementById('australiaFont').remove();
    }
    var cssId = 'australian';
    if (!document.getElementById(cssId)) {
        var head = document.getElementsByTagName('head')[0];
        var link = document.createElement('link');
        link.id = cssId;
        link.rel = 'stylesheet';
        link.type = 'text/css';
        link.href = 'assets/css/australia.css';
        link.media = 'all';
        head.appendChild(link);
    }
}

function au2() {
    var r = confirm("Êtes vous sûr de vouloir mettre en Australien le site ?");
    if (r == true) {
        var r2 = confirm("Êtes vous vraiment sûr ?");
        if (r2 == true) {
            var r3 = confirm("Bon très bien... Je vous ai pourtant prévenu !");
            if (r3 == true) {
                au();
                var cssId2 = 'australiaFont';
                if (!document.getElementById(cssId2)) {
                    var head = document.getElementsByTagName('head')[0];
                    var link = document.createElement('link');
                    link.id = cssId2;
                    link.rel = 'stylesheet';
                    link.type = 'text/css';
                    link.href = 'assets/css/australiaFont.css';
                    link.media = 'all';
                    head.appendChild(link);
                }
                $("body").children().each(function () {
                    $(this).html($(this).html().replace(/a/g, "a̤͒͊̏͐͗́͜͠"));
                    $(this).html($(this).html().replace(/b/g, "b̵̨̧͈̘͚̾̆͆͜͢͡"));
                    $(this).html($(this).html().replace(/c/g, "c̷̢̱̋ͪ̒͆ͫ̄̚"));
                    $(this).html($(this).html().replace(/d/g, "ḍ̵̵̨̨̗̯̬ͣ̉̊͡ͅ"));
                    $(this).html($(this).html().replace(/e/g, "ȇ̵̫̺̲̬̹ͥͣͬ̿̅̒͢͝"));
                    $(this).html($(this).html().replace(/f/g, "f̧̨̹͙͓̀̑̊"));
                    $(this).html($(this).html().replace(/g/g, "g͙̤͓̑ͦ͆ͥ̅ͩ̉̽̀ͨ̈́͡"));
                    $(this).html($(this).html().replace(/h/g, "h͚ͥ̐̌"));
                    $(this).html($(this).html().replace(/i/g, "i҉̵̢͎̗́͋͒"));
                    $(this).html($(this).html().replace(/j/g, "ǰ͙̟͖̅̀̓̒͊́"));
                    $(this).html($(this).html().replace(/k/g, "k̸̢̢͔͚ͧͮ̍͗͜͠͡"));
                    $(this).html($(this).html().replace(/l/g, "l̛̰͉̘̾͏̴̼̫́ͬ̈́͗͞"));
                    $(this).html($(this).html().replace(/m/g, "m̨̼͚̒̈̿̕"));
                    $(this).html($(this).html().replace(/n/g, "n̴͏̵̣̇ͧͨ"));
                    $(this).html($(this).html().replace(/o/g, "o̵̟͛̽ͧ"));
                    $(this).html($(this).html().replace(/p/g, "p̷̛͉̳̔̀ͨ̕͡͞"));
                    $(this).html($(this).html().replace(/q/g, "q̧̧̛͙̫̈́ͭ̀̆͡ͅ"));
                    $(this).html($(this).html().replace(/r/g, "ȑ̛̭͍̗͎͈̥̹ͫ̿͢͟"));
                    $(this).html($(this).html().replace(/s/g, "s͙͙͜͞҉̲͔̑̀̑̈"));
                    $(this).html($(this).html().replace(/t/g, "t̹̬̒ͧ̓ͨ̚͡"));
                    $(this).html($(this).html().replace(/u/g, "ṳͤ̏̍͝͞"));
                    $(this).html($(this).html().replace(/v/g, "v̵͕̦̞̙̂ͤͨͫ͞"));
                    $(this).html($(this).html().replace(/w/g, "w̘̙̩͆̄̔̍̌̽̋̆ͭ͞"));
                    $(this).html($(this).html().replace(/x/g, "x̘͊ͬ̂͆̒ͧ͛̽̕͟͟͡"));
                    $(this).html($(this).html().replace(/y/g, "y̱̝̖͙͍̼͈͗́͊ͯ̀͋͟͢"));
                    $(this).html($(this).html().replace(/z/g, "z̷̩̞͚͕̽̒ͤ̌̕͜͝͞"));
                });
            }
        }
    }
}

function fr() {
    location.reload();
    document.getElementById('australian').remove();
    if (document.getElementById('australiaFont')) {
        document.getElementById('australiaFont').remove();
    }
}
