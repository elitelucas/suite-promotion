var app = new Vue({
  el: "#app",
  data: {
    method: "create", //crete or edit
    currentIndex: 0,
    currentlink: {
      id: "",
      banner: "",
      imageURL: "",
      networks: [],
      actions: [],
    },
    links: [
      // {
      //   id: "facebook",
      //   banner: "<h1>this is banner</h1>",
      //   imageURL: "http://localhost/promo/images/banner_facebook.jpg",
      //   networks: ["Facebook", "Twitter", "Pinterest"],
      //   actions: ["Play then share", "Record and Share"],
      // },     
    ],
    allNetworks: ["Facebook", "Twitter", "Pinterest"],
    search: "",
    checkedLinks: []
  },
  computed: {
    isNextPossible: function () {
      return this.nextUrl != null;
    },
  },
  methods: {
    modalTitle: function () {
      if (this.method == "create") return "Create Link";
      else if (this.method == "edit")
        return `Edit Link(id=${this.currentlink.id})`;
    },
    getStringFromArray: function (arr) {
      var str = "";
      for (var x in arr) {
        if (x == arr.length - 1) {
          str += arr[x];
        } else {
          str += arr[x] + ", ";
        }
      }
      return str;
    },
    getLinkFromId: function (linkid) {
      return `http://localhost/promo/client/widget.php?id=${linkid}`;
    },
    editLink: function (linkid) {
      for (var x in this.links) {
        if (this.links[x].id == linkid) {
          this.currentlink = JSON.parse(JSON.stringify(this.links[x]));
          setFormFromCurrentLink();
          this.method = "edit";
          this.currentIndex = x;
          $("html, body").animate({ scrollTop: 0 }, "slow");
          return;
        }
      }
    },
    updateLink: function () {
      var newlinks = [];
      for (var x in this.links) {
        if (x == this.currentIndex) {
          newlinks.push(this.currentlink);
        } else {
          newlinks.push(this.links[x]);
        }
      }
      this.links = JSON.parse(JSON.stringify(newlinks));
      saveDataToDatabase();
      this.showClear();
      alert("Link Updated Successfully!")
    },
    deleteLink: function (linkid) {
      if (confirm(`Do you want to delete [${linkid}] link?`)) {
        for (var x in this.links) {
          if (this.links[x].id == linkid) {
            this.links.splice(x, 1);
            saveDataToDatabase();
            return;
          }
        }
      }
    },
    createLink: function () {
      this.links.push(this.currentlink);
      saveDataToDatabase();
      this.showClear();
      alert("Link Created Successfully!")
    },
    showClear: function () {
      this.method = "create";
      this.currentlink = {
        id: "",
        banner: "",
        imageURL: "",
        networks: [],
        actions: [],
      };
      setFormFromCurrentLink();
      this.checkedLinks = [];
      $("html, body").animate({ scrollTop: 0 }, "slow");
    },
    btnDelSelected: function () {

      if (confirm(`Do you want to delete selected links?`)) {
        var newLinks = [];
        for (var x in this.links) {
          if (this.checkedLinks.indexOf(Number(x)) == -1) { //not in selected array           
            newLinks.push(this.links[x]);
          }
        }
        this.links = JSON.parse(JSON.stringify(newLinks))
        saveDataToDatabase();
        this.showClear();
      }
    },
    searched: function (index) {
      var link = this.links[index];
      var r1 = link['id'].includes(this.search);
      var r2;
      for (var x in link['networks'])
        if (link['networks'][x].includes(this.search)) {
          r2 = true;
          break;
        }
      var r3;
      for (var x in link['actions'])
        if (link['actions'][x].includes(this.search)) {
          r3 = true;
          break;
        }
      return r1 || r2 || r3;
    },
    checkall: function (e) {
      if (e.target.checked) {
        this.checkedLinks = Array.from(Array(this.links.length).keys())
      } else {
        this.checkedLinks = []
      }
    }
  },
});

loadDataFromDatabase();

//load links from json
function loadDataFromDatabase() {
  $.ajax({
    type: "POST",
    url: "links_func.php",
    data: {
      type: "get",
    },
    success: function (data) {
      app.links = JSON.parse(data);
    },
  });


}

//save links to json
function saveDataToDatabase() {
  $.ajax({
    type: "POST",
    url: "links_func.php",
    data: {
      type: "set",
      links: app.links,
    },
    success: function (data) {
      console.log(data);
    },
  });
}
