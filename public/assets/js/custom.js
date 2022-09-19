
function DropDown(el) {
    this.a = el;
    this.placeholder = this.a.children('span');
    this.opts = this.a.find('ul.dropdown > li');
    this.val = '';
    this.index = -1;
    this.initEvents();
}
DropDown.prototype = {
    initEvents: function () {
        var obj = this;

        obj.a.on('click', function (event) {
            $(this).toggleClass('active');
            return false;
        });

        obj.opts.on('click', function () {
            var opt = $(this);
            obj.val = opt.text();
            obj.index = opt.index();
            obj.placeholder.text(obj.val);
        });
    },
    getValue: function () {
        return this.val;
    },
    getIndex: function () {
        return this.index;
    }
}

$(function () {

    var a = new DropDown($('#a'));

    $(document).click(function () {
        // all dropdowns
        $('.wrapper-dropdown-a').removeClass('active');
    });

});

function DropDown(el) {
    this.b = el;
    this.placeholder = this.b.children('span');
    this.opts = this.b.find('ul.dropdown > li');
    this.val = '';
    this.index = -1;
    this.initEvents();
}
DropDown.prototype = {
    initEvents: function () {
        var obj = this;

        obj.b.on('click', function (event) {
            $(this).toggleClass('active');
            return false;
        });

        obj.opts.on('click', function () {
            var opt = $(this);
            obj.val = opt.text();
            obj.index = opt.index();
            obj.placeholder.text(obj.val);
        });
    },
    getValue: function () {
        return this.val;
    },
    getIndex: function () {
        return this.index;
    }
}

$(function () {

    var b = new DropDown($('#b'));

    $(document).click(function () {
        // all dropdowns
        $('.wrapper-dropdown-b').removeClass('active');
    });

});


function DropDown(el) {
    this.c = el;
    this.placeholder = this.c.children('span');
    this.opts = this.c.find('ul.dropdown > li');
    this.val = '';
    this.index = -1;
    this.initEvents();
}
DropDown.prototype = {
    initEvents: function () {
        var obj = this;

        obj.c.on('click', function (event) {
            $(this).toggleClass('active');
            return false;
        });

        obj.opts.on('click', function () {
            var opt = $(this);
            obj.val = opt.text();
            obj.index = opt.index();
            obj.placeholder.text(obj.val);
        });
    },
    getValue: function () {
        return this.val;
    },
    getIndex: function () {
        return this.index;
    }
}

$(function () {

    var c = new DropDown($('#c'));

    $(document).click(function () {
        // all dropdowns
        $('.wrapper-dropdown-c').removeClass('active');
    });

});

function DropDown(el) {
    this.d = el;
    this.placeholder = this.d.children('span');
    this.opts = this.d.find('ul.dropdown > li');
    this.val = '';
    this.index = -1;
    this.initEvents();
}
DropDown.prototype = {
    initEvents: function () {
        var obj = this;

        obj.d.on('click', function (event) {
            $(this).toggleClass('active');
            return false;
        });

        obj.opts.on('click', function () {
            var opt = $(this);
            obj.val = opt.text();
            obj.index = opt.index();
            obj.placeholder.text(obj.val);
        });
    },
    getValue: function () {
        return this.val;
    },
    getIndex: function () {
        return this.index;
    }
}

$(function () {

    var d = new DropDown($('#d'));

    $(document).click(function () {
        // all dropdowns
        $('.wrapper-dropdown-d').removeClass('active');
    });

});

function DropDown(el) {
    this.e = el;
    this.placeholder = this.e.children('span');
    this.opts = this.e.find('ul.dropdown > li');
    this.val = '';
    this.index = -1;
    this.initEvents();
}
DropDown.prototype = {
    initEvents: function () {
        var obj = this;

        obj.e.on('click', function (event) {
            $(this).toggleClass('active');
            return false;
        });

        obj.opts.on('click', function () {
            var opt = $(this);
            obj.val = opt.text();
            obj.index = opt.index();
            obj.placeholder.text(obj.val);
        });
    },
    getValue: function () {
        return this.val;
    },
    getIndex: function () {
        return this.index;
    }
}

$(function () {

    var e = new DropDown($('#e'));

    $(document).click(function () {
        // all dropdowns
        $('.wrapper-dropdown-e').removeClass('activee');
    });

});

var coll = document.getElementsByClassName("collapsible");
var i;

for (i = 0; i < coll.length; i++) {
    coll[i].addEventListener("click", function () {
        this.classList.toggle("activee");
        var content = this.nextElementSibling;
        if (content.style.maxHeight) {
            content.style.maxHeight = null;
        } else {
            content.style.maxHeight = content.scrollHeight + "px";
        }
    });
}

$(document).ready(function () {
    $('.acc-head').click(function () {
        $(this).next().slideToggle(500);
        $(this).toggleClass('active');
    })
})

$(".video-thumbs").click(function () {
    /* var name = $("#name").val(); 
    var marks = $("#marks").val(); 
    var str = "You Have Entered "  
        + "Name: " + name  
        + " and Marks: " + marks; 
    $("#modal_body").html(str);  */
    var judul = $(this).data('judul');
    var subjudul = $(this).data('subjudul');
    var link_media = $(this).data('vidlink');

    $(".modal-body #vid_video").attr("src", link_media);
    $("#vid_judul").html(judul);
    $("#vid_subjudul").html(subjudul);

    $('.modalvideo').modal('show');
});


$(".modalvideo").on('hidden.bs.modal', function (e) {
    $(".modalvideo iframe").attr("src", $(".modalvideo iframe").attr("src"));

    //$('.modalvideo .modal-body').empty();
    //$('.modalvideo .modal-body').show();
});



