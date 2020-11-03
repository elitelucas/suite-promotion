var app = new Vue({
  el: "#app",
  data: {
    method: "create", //crete or edit
    currentIndex: 0,
    currentDatum: {
      name: "",
      iframe: "",
      url: "",
      image: "",   
      preview: "",   
    },
    data: [],
    search: "",
    checkedTools: []
  },
  computed: {
    
  },
  methods: {
    pageTitle: function () {
      if (this.method == "create") return "Create Tool";
      else if (this.method == "edit")
        return `Edit Tool(name=${this.currentDatum.name})`;
    },
    btnCreateTool: function () {
      console.log(this.currentDatum)
      // this.data.push(this.currentDatum);
      // saveDataToDatabase();
      // this.showClear();
      // alert("Tool Created Successfully!")
    },
    btnEditTool: function () {
      var newtools = [];
      for (var x in this.data) {
        if (x == this.currentIndex) {
          newtools.push(this.currentDatum);
        } else {
          newtools.push(this.data[x]);
        }
      }//replace update object
      this.data = JSON.parse(JSON.stringify(newtools));
      saveDataToDatabase();
      this.showClear();
      alert("Tool Updated Successfully!")
    },
    btnCancel: function () {
      this.showClear()
    },
    btnEditonRow: function (index) {
      this.setcurrentDatum(JSON.parse(JSON.stringify(this.data[index])));
      this.method = "edit";
      this.currentIndex = index;
      $("html, body").animate({ scrollTop: 0 }, "slow");
    },
    btnDeleteonRow: function (index) {
      if (confirm(`Do you want to delete [${this.data[index]['name']}] Tool?`)) {
        this.data.splice(index, 1);
        saveDataToDatabase();
      }
    },
    btnDelSelected: function () {
      if (confirm(`Do you want to delete selected tools?`)) {
        var newTools = [];
        for (var x in this.data) {
          if (this.checkedTools.indexOf(Number(x)) == -1) { //not in selected array           
            newTools.push(this.data[x]);
          }
        }
        this.data = JSON.parse(JSON.stringify(newTools))
        saveDataToDatabase();
        this.showClear();
      }
    },
    setcurrentDatum: function (tool) {
      this.currentDatum = tool;
      //set form data manually
      $('#description').summernote('code', app.currentDatum.description); //description 
    },
    showClear: function () {
      this.method = "create";
      this.setcurrentDatum({
        name: "",
        iframe: "",
        url: "",
        image: "",   
        preview: "",   
      });
      this.checkedTools = [];
      $("html, body").animate({ scrollTop: 0 }, "slow");
    },

    searched: function (index) {
      var datum = this.data[index];
      var r1 = datum['name'].includes(this.search);    
      return r1;
    },
    checkall: function (e) {
      if (e.target.checked) {
        this.checkedTools = Array.from(Array(this.data.length).keys())
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
    url: "games_func.php",
    data: {
      type: "get",
    },
    success: function (data) {
      app.data = JSON.parse(data);
    },
  });
}

//save tools to json
function saveDataToDatabase() {
  console.log(app.data)
  $.ajax({
    type: "POST",
    url: "games_func.php",
    data: {
      type: "set",
      data: app.data,
    },
    success: function (data) {
      console.log(data);
    },
  });
}
