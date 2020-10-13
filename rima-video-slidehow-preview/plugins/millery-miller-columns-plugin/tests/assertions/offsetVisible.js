module.exports.assertion = function(selector, message = null) {
    this.message = message || `Asserting that "${selector}" is visible in the container`;
    this.expected = 0;
    this.pass = function(value) {
        return value > this.expected;
    };
    this.value = function(result) {
        return result.value;
    };
    this.command = function(callback) {
        const self = this;
        return this.api.execute(
            function(selector) {
                var node = document.querySelector(selector);
                if(node){
                    var bbox = node.getBoundingClientRect();
                    var pbox = node.parentNode.getBoundingClientRect();
                    return bbox.right - pbox.left;
                } else {
                    return -Infinity;
                }
            },
            [selector],
            function(result) {
                return callback.call(self, result);
            }
        );
    };
};
