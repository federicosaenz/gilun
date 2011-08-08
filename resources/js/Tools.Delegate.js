/*global namespace:true, Tools:true, $:true, window:true*/
namespace("Tools");

Tools.Delegate = function(context, func, args)
{
	this.context = context;
	this.func = func;
	this.args = args || [];
};

Tools.Delegate.prototype.execute = function()
{
	if(typeof this.func!="function"){
		throw new Error("Ha ocurrido un error al intentar ejecutar el delegate, la función no existe.");
	}
	var args = [];
	for(var i=0; i<arguments.length; i++){
		args.push(arguments[i]);
	}
	this.func.apply(this.context, this.args.concat(args));
};

Tools.Delegate.create = function(context, func)
{
	var delegate = new Tools.Delegate(context, func);
	var args = [];
	for(var i=2; i<arguments.length; i++){
		args.push(arguments[i]);
	}
	var r = function(){
		var newArgs = [];
		newArgs = newArgs.concat(args);
		for(var i=0; i<arguments.length; i++){
			newArgs.push(arguments[i]);
		}
		delegate.execute.apply(delegate, newArgs);
	};
	return r;
};

Tools.Delegate.createForEvent = function(context, func)
{
	var delegate = new Tools.Delegate(context, func);
	var args = [];
	for(var i=2; i<arguments.length; i++){
		args.push(arguments[i]);
	}
	var r = function(e)	{
		var newArgs = [];
		newArgs.push(window.event || e);
		newArgs = newArgs.concat(args);
		delegate.execute.apply(delegate, newArgs);
	};
	return r;
};