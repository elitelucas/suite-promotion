module.exports.assertion = function(selector, count, message = null) {
  this.message =
    message ||
    `Asserting that there are "${count}" visible elements that match "${selector}"`;
  this.expected = count;
  this.pass = function(value) {
    return value === this.expected;
  };
  this.value = function(result) {
    return result.value;
  };

  this.command = function(callback) {
    const self = this;
    return this.api.execute(
      function(selector) {
        var count = 0;

        document.querySelectorAll(selector).forEach(function(node) {
          if (node.offsetHeight !== 0) {
            count++;
          }
        });

        return count;
      },
      [selector],
      function(result) {
        return callback.call(self, result);
      }
    );
  };
};
