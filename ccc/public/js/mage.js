
var Base = function() {

};

Base.prototype = {
    url: null,
    params: {},
    method: 'post',

    setUrl: function(url) {
        if (!url == 'undefined') {
            if (!url.includes('http://127.0.0.1:8000')) {

                url = "http://127.0.0.1:8000" + url;

            }
        }
        this.url = url;
        return this;
    },

    getUrl: function() {
        return this.url;
    },

    setMethod: function(method) {
        this.method = method;
        return this;

    },

    getMethod: function() {
        return this.method;
    },

    resetParam: function() {
        this.params = {};
        return this;
    },

    setParams: function(params) {
        this.params = params;
        return this;

    },
    getParams: function(key) {
        if (typeof key === 'undefined') {
            return this.params;
        }
        if (typeof this.params[key] == 'undefined') {
            return null;
        }

        return this.params[key];
    },
    addParam: function(key, value) {
        this.params[key] = value;
        return this;
    },
    removeParam: function(key) {
        if (typeof this.params[key] != 'undefined') {
            delete this.params[key];
        }
        return this;
    },
    setForm: function(form) {

        this.setMethod($(form).attr('method'));
        this.setUrl($(form).attr('action'));
        this.setParams($(form).serializeArray());

        return this;

    },
    
    uploadFile: function() {
        var formData = new FormData();
        var csrftoken = document.getElementsByName('_token')[0].value;
        var file = $("#file")[0].files;
        formData.append('file', file[0]);
        formData.append('_token', csrftoken);

        this.setParams(formData);
        self = this;


        var request = $.ajax({
            method: this.getMethod(),
            url: this.getUrl(),
            contentType: false,
            processData: false,
            data: this.getParams(),
            success: function(response) {
                self.manageHtml(response);
            }
        });

        return this;
    },
    load: function() {

        var self = this;
        // console.log(self);
        $.ajax({
            method: this.getMethod(),
            url: this.getUrl(),
            data: this.getParams(),
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function(response) {
                self.manageHtml(response);

            }
        });
    },

    manageHtml: function(response) {

        // console.log(jQuery.type(response.error));
        if(response.error  === undefined){
            if (typeof response.element == 'object') {
                 $(response.element).each(function(i, element) {

                    $(element.selector).html(element.html);
                });
            }
        } else {
            this.printErrorMsg(response.error);
            $(response.element.selector).html(response.element.html);
        }
        if (typeof response.element == 'undefined') {
            return false;
        }
         
    },
    printErrorMsg:function(msg) {
            $(".print-error-msg").find("ul").html('');
            $(".print-error-msg").css('display','block');
            $.each( msg, function( key, value ) {
                $(".print-error-msg").find("ul").append('<li>'+value+'</li>');
            });
        },
    changeAction:function (form,value) {
        var str = '#';
        var id = str+form;
        $(id).attr('action',value);
        this.setForm(form);
    },
}


var object = new Base();