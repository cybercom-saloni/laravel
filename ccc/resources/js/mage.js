alert('hi');
var Base = function()
{

};
Base.prototype ={
    alert:function()
    {

    },
    url : null,
    params :{},
    method : 'post',

    setUrl : function(url)
    {
        $this.url = url;
        return $this;
    },
    getUrl : function(){
        return this.url;
    },
    setMethod : function(method){
        this.method = method;
        return $this;
    },
    getMethod : function()
    {
        return this.method;
    },
    resetParams : function()
    {
        this.params = params;
        return this;
    },
    getParams : function(key)
    {
        if(typeof key === 'undefined')
        {
            return this.params;
        }
        if(typeof this.params[key] == 'undefined')
        {
            return null;
        }
        return this.params[key];
    },
    addParam : function(key,value)
    {
        this.params[key] = value;
        return this;
    },
    removeParams : function(key)
    {
        if(typeof this.paramsms[key] != 'undefined')
        {
            delete this.params[key];
        }
        return this;
    },
    setForm : function(form)
    {
        this.setMethod($(form))
    }
}