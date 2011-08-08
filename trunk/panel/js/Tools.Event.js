/*global namespace:true, Tools:true, $:true*/
namespace("Tools");

Tools.Event = function() {
	this.delegates = [];
};

Tools.Event.prototype.add = function(delegate)
{
	this.delegates.push(delegate);
	return this.delegates.length - 1;
};

Tools.Event.prototype.remove = function(index) {
	this.delegates.splice(index, 1);
};

Tools.Event.prototype.clear = function() {
	for(var i=0; i<this.delegates.length; i++) {
		this.remove(i);
	}
};

Tools.Event.prototype.execute = function() {
	for(var i=0; i<this.delegates.length; i++) {
		this.delegates[i].execute.apply(this.delegates[i], arguments);
	}
};

Tools.Event.stop = function(e) {
	if(e.stopPropagation){
		e.stopPropagation();
	}else{
		e.cancelBubble = true;
		e.returnValue = null;
	}
};

Tools.Event.attach = function(target, eventName, callback) {
	var element = target;
	if(typeof target!="object") {
		element = $(target);
	}
	if( element.addEventListener ) {
		eventName = eventName.replace(/^on(.+)$/,"$1");
		element.addEventListener( eventName, callback, true);
	}else if ( element.attachEvent ) {
		element.attachEvent( eventName, callback );
	}
	element = null;
};

Tools.Event.detach = function(target, eventName, callback) {
  var element = target;
  if(typeof target!="object") {
    element = $(target);
  }
  if( element.removeEventListener ) {
    eventName = eventName.replace(/^on(.+)$/,"$1");
    element.removeEventListener( eventName, callback, true);
  }else if ( element.detachEvent ) {
    element.detachEvent( eventName, callback );
  }
  element = null;
};