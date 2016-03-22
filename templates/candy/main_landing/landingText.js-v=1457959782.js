var LandingText = function LandingText(params){
    this.id = params.id;
    this.items = params.items;
    this.init();
};

LandingText.prototype.init = function(){
    //var container = jq_144('#' + this.id + ' .slides-container');
    var that = this;
    jq_144('span.landingText').each(function(){
        that.setText(this);
    });

};

LandingText.prototype.getItem = function(name){
    var i = 0;
    while(i < this.items.length){
        if(this.items[i].name == name){
            return this.items[i];
        }
        i++;
    }
    return null;
};

LandingText.prototype.getValue = function(item){
    var match = location.href.match(new RegExp("(\\?|&)"+item.param+"=([^&]*)"));
    if(!match || !match[2]){
        return null;
    }
    var value = decodeURIComponent(match[2]);

    if(item.style == 'up'){
        value = value.toUpperCase();
    } else if(item.style == 'lo'){
        value = value.toLowerCase();
    } else if(item.style == 'ca'){
        value = value.substr(0,1).toUpperCase() + value.substr(1).toLowerCase();
    }
    return value;
};

LandingText.prototype.setText = function(element){
    var name = element.getAttribute('data-name');
    if(!name){return;}
    var item = this.getItem(name);
    if(!item){return;}
    var value = this.getValue(item);
    if(!value){return;}
    element.innerHTML = value;
};

widget.init('landingText', LandingText);