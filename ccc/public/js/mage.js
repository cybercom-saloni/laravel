
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
    setForm: function (obj = null) {
        if (obj) {
            formId = '#'+jQuery(obj).closest('form').attr('id');
        }else{
            formId = '#'+jQuery('form').attr('id');
        }
        formData = jQuery(formId).serializeArray();
        // console.log(formData);
        result = this.validateForm(formId);
        if (result==true) {
            this.setParams(formData);
            this.setUrl(jQuery(formId).attr('action'));
            this.setMethod(jQuery(formId).attr('method'));
            this.load();    
        }else{
            jQuery('#messageHtml').html("Please fill this value "+result);
        }
    },
    validateForm: function(formId){
        var count = 0;
        var emptyField = '';
        jQuery.each(jQuery(formId).serializeArray(),function(i,field){
            var input = jQuery("input[name=\""+String(field.name)+"\"]");
            field.value = jQuery.trim(field.value);
            if (document.getElementsByName(field.name)[0].required) {
                if (field.value == '') {
                    count++;
                    emptyField+=field.name+', ';
                }
            }
        });
        if (!count) {
            return true;
        }
        return emptyField;
    },
    
    uploadFile: function() {
        var formData = new FormData();
        var csrftoken = document.getElementsByName('_token')[0].value;
        var file = $("#image")[0].files;
        formData.append('image', file[0]);
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


        if (typeof response.element == 'undefined') {
            return false;
        }
        if (typeof response.element == 'object') {
            $(response.element).each(function(i, element) {

                $(element.selector).html(element.html);
            })
        } else {

            $(response.element.selector).html(response.element.html);
        }
    }
}


var object = new Base();