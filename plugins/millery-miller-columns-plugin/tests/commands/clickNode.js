module.exports = {
    command: function(id, column, node){
        return this.execute(function(id, column, node){
            $(id + " .millery-column:nth-child("+column+") .millery-node:visible").eq(node - 1).trigger("click");
        }, [id, column, node]).pause(200)
    }
};