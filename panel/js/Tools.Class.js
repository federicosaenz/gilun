/*global namespace:true, Tools:true, $:true*/
namespace("Tools");

Tools.Extend = function(){
    var a = arguments;
    if (a.length == 1) a = [this, a[0]];
    for (var p in a[1]){ a[0][p] = a[1][p]; }
    return a[0];
};

Tools.Class = function() {};

Tools.Class.prototype.constructor = function() {};

Tools.Class.prototype.parent = function (){};

Tools.Class.Extend = function(objDefinition) {
	var selfPrototype = new this(Tools.Class);
    var classDefinition = function() {
        return this.constructor.apply(this, arguments);
    };
    Tools.Extend(selfPrototype, objDefinition);

    classDefinition.prototype = selfPrototype;
    classDefinition.Extend = this.Extend;

    return classDefinition;
};

Function.prototype.scope = function() {
	var __method = this, args = Tools.toArray(arguments), obj = args.shift();
	return function() { return __method.apply(obj,args.concat(Tools.toArray(arguments))); };
};

Function.prototype.scopeEvent = function() {
  	var __method = this, args = Tools.toArray(arguments), object = args.shift();
  	return function(e) {
  	e = e || window.event;
  	if(e.target) { var target = e.target; } else { var target =  e.srcElement };
	  	return __method.apply(object, [e,target].concat(args) );
	};
};