(function(global) {
	"use strict";

	var Calculator = function(number) {
        this.number = number;
        this.states = [number];
        this.redoStates = [];
    };

    Calculator.prototype = {
        toInt: function() {
            var _this = this;
//            this.states.forEach(function(state){
//               _this.number += state;
//            });

            return this.states.pop();
        },

        Add: function(numberToAdd) {
            this.number += numberToAdd;
            this.states.push(this.number);
            return this;
        },

        Minus: function(numberToDecreaseWith) {
            this.number -= numberToDecreaseWith;
            this.states.push(this.number);
            return this;
        },

        Undo: function() {
            this.redoStates.push(this.states.pop());
            return this;
        },

        Redo: function() {
            this.states.push(this.redoStates.pop());
            return this;
        }
    };


    Calculator.Calc = function(number) {
        return new Calculator(number);
    };


	global.Calculator = Calculator;
}(window));