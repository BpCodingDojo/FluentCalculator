describe("Calculator", function() {
	"use strict";

    describe('Calc', function() {

        describe('toInt', function() {

            it('should return the initial number', function() {
                expect(Calculator.Calc(10).toInt()).toBe(10);
            });
        });

        describe('Add', function() {
            it('should add the argument to the initial number', function(){
               expect(Calculator.Calc(10).Add(5).toInt()).toBe(15);
            });
        });

        describe('Minus', function() {
            it('should decrease the initial number with the argument', function(){
               expect(Calculator.Calc(10).Minus(5).toInt()).toBe(5);
            });
        });

        describe('Undo', function() {
            it('should undo a command', function(){
               expect(Calculator.Calc(10).Add(5).Minus(5).Undo().toInt()).toBe(15);
            });
        });

        describe('Redo', function() {
            it('should redo a command', function(){
               expect(Calculator.Calc(10).Add(5).Minus(5).Undo().Redo().toInt()).toBe(10);
            });

            it('should undo and redo some command', function(){
               expect(Calculator.Calc(10).Add(10).Add(5).Minus(5).Undo().Undo().Redo().Undo().toInt()).toBe(20);
            });
        });

    });


});