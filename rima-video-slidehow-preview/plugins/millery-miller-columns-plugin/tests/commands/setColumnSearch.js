module.exports = {
    command: function(id, searchValue){
        return this.execute(function(id, searchValue){
            $(id + " .millery-column-search input").val(searchValue).trigger("input");
        }, [id, searchValue]);
    }
};