var app = new Vue({
  el: "#app",
  data: {
    method: "create", //crete or edit
    currentIndex: 0,
    currentTool: {
      toolname: "",
      category: "",
      method: "",
      link: "",
      description: "",
      filename: "",
    },
    tools: [],
    search: "",
    checkedTools: []
  },
  computed: {
    showLink: function () {
      if (this.currentTool.method == "New Tab" || this.currentTool.method == "Iframe" || this.currentTool.method == "Popup") return true;
      else return false;
    },
    showDescription: function () {
      if (this.currentTool.method == "HTML") return true;
      else return false;
    },
  },
  methods: {
    pageTitle: function () {
      if (this.method == "create") return "Create Tool";
      else if (this.method == "edit")
        return `Edit Tool(name=${this.currentTool.toolname})`;
    },
    btnCreateTool: function () {
      this.tools.push(this.currentTool);
      saveDataToDatabase();
      this.showClear();
      alert("Tool Created Successfully!")
    },
    btnEditTool: function () {
      var newtools = [];
      for (var x in this.tools) {
        if (x == this.currentIndex) {
          newtools.push(this.currentTool);
        } else {
          newtools.push(this.tools[x]);
        }
      }//replace update object
      this.tools = JSON.parse(JSON.stringify(newtools));
      saveDataToDatabase();
      this.showClear();
      alert("Tool Updated Successfully!")
    },
    btnCancel: function () {
      this.showClear()
    },
    btnEditonRow: function (index) {
      this.setCurrentTool(JSON.parse(JSON.stringify(this.tools[index])));
      this.method = "edit";
      this.currentIndex = index;
      $("html, body").animate({ scrollTop: 0 }, "slow");
    },
    btnDeleteonRow: function (index) {
      if (confirm(`Do you want to delete [${this.tools[index]['toolname']}] Tool?`)) {
        this.tools.splice(index, 1);
        saveDataToDatabase();
      }
    },
    btnDelSelected: function () {
      if (confirm(`Do you want to delete selected tools?`)) {
        var newTools = [];
        for (var x in this.tools) {
          if (this.checkedTools.indexOf(Number(x)) == -1) { //not in selected array           
            newTools.push(this.tools[x]);
          }
        }
        this.tools = JSON.parse(JSON.stringify(newTools))
        saveDataToDatabase();
        this.showClear();
      }
    },
    setCurrentTool: function (tool) {
      this.currentTool = tool;
      //set form data manually
      $('#description').summernote('code', app.currentTool.description); //description 
    },
    showClear: function () {
      this.method = "create";
      this.setCurrentTool({
        category: "",
        toolname: "",
        method: "",
        link: "",
        description: "",
        filename: "",
      });
      this.checkedTools = [];
      $("html, body").animate({ scrollTop: 0 }, "slow");
    },

    searched: function (index) {
      var tool = this.tools[index];
      var r1 = tool['toolname'].includes(this.search);
      var r2 = tool['category'].includes(this.search);
      var r3 = tool['method'].includes(this.search);
      return r1 || r2 || r3;
    },
    checkall: function (e) {
      if (e.target.checked) {
        this.checkedTools = Array.from(Array(this.tools.length).keys())
      } else {
        this.checkedTools = []
      }
    }
  },
});

loadDataFromDatabase();

//load tools from json
function loadDataFromDatabase() {
  $.ajax({
    type: "POST",
    url: "tools_func.php",
    data: {
      type: "get",
    },
    success: function (data) {
      app.tools = JSON.parse(data);
    },
  });


}

//save tools to json
function saveDataToDatabase() {
  $.ajax({
    type: "POST",
    url: "tools_func.php",
    data: {
      type: "set",
      tools: app.tools,
    },
    success: function (data) {
      console.log(data);
    },
  });
}
