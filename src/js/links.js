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
    allNetworks:["Facebook", "Twitter", "Pinterest"]
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
      if (confirm(`Do you want to remove [${linkid}] link?`)) {
        for (var x in this.links) {
          if (this.links[x].id == linkid) {
            this.links.splice(x, 1);
            saveDataToDatabase();
            alert("Link Deleted Successfully!")
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
      $("html, body").animate({ scrollTop: 0 }, "slow");
    },
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
