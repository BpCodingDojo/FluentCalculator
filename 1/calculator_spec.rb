require 'rspec'

class Calculator
  def calc(number)
    ArithmeticExpressionElement.new number
  end
end


class ArithmeticExpressionElement

  attr_reader :previous_element, :following_element



  def initialize(number, previous_element = nil)
    @number, @previous_element = number, previous_element
  end



  def plus(number)
    create_following_element { to_i + number }
  end



  def minus(number)
    create_following_element { to_i - number }
  end



  def undo
    previous_element or self
  end



  def redo
    @following_element or self
  end



  def save
    self.class.new @number
  end



  def to_i
    @number
  end



  private

  def create_following_element(&block)
    @following_element = self.class.new block.call, self
  end

end


describe Calculator do
  describe "#calc" do
    it "should return an object representing the input as an integer" do
      expect(subject.calc(10).to_i).to eq 10
    end
  end

  describe "#plus" do
    it "should add the argument to the number" do
      expect(subject.calc(10).plus(5).to_i).to eq 15
    end
  end

  describe "#minus" do
    it "should subtract the argument from the number" do
      expect(subject.calc(10).minus(5).to_i).to eq 5
    end
  end

  describe "#undo" do
    it "should return the value of the previous element" do
      expect(subject.calc(10).minus(5).undo.to_i).to eq 10
    end

    it "should return the same element if there was no previous one in the expression" do
      expect(subject.calc(10).undo.to_i).to eq 10
    end
  end

  describe "#redo" do
    it "should return the element if there was no undo before" do
      expect(subject.calc(10).redo.to_i).to eq 10
    end

    it "should revoke the last undo operation" do
      expect(subject.calc(10).plus(5).undo.redo.to_i).to eq 15
    end
  end

  describe "#save" do
    it "should create a checkpoint so that undo and redo operations have no effect" do
      expect(subject.calc(10).plus(5).save.undo.to_i).to eq 15
    end
  end

  describe "complex expressions" do
    test_cases = [
      ["Calculator.new.calc(10).plus(5).minus(2).undo.redo.undo.plus(5)", 20],
      ["Calculator.new.calc(10).plus(5).minus(2).undo.undo.redo.redo.redo", 13],
      ["Calculator.new.calc(10).plus(5).minus(2).save.undo.redo.undo.plus(5)", 18]
    ]

    test_cases.each do |(expression, expected_result)|
      it "should evaluate #{expression} to #{expected_result}" do
        expect(eval(expression).to_i).to eq expected_result
      end
    end
  end
end
