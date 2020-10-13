$(function () {

    let data = '';
    let voiceType = 'UK English Female';
    $.getJSON('data.json?version=7')
        .done(function (json) {
            data = json;
            console.log(data);
            $(".cName").text(data.profile['name']);
            $(".img").attr('src' , data.profile['url']);
            (data.profile['voice'] !== '') ? voiceType = data.profile['voice'] : null;
            fillVoice();
            start();
            pTbl();
            dTbl();
            queTbl();
            keywordTbl();
        });

    let voicelist = responsiveVoice.getVoices();

    function fillVoice(){
        $.each(voicelist , function (key , value) {
            $('#voice')
                .append($("<option></option>")
                    .attr("value" , value.name)
                    .text(value.name));
        });
        $("#voice>option[value='" + voiceType + "']").prop("selected" , true);
        $("#voice").select2();
    }

    $("#voice").on('change',function () {
        let value = $(this).val();
        voiceType = value;
        data.profile['voice'] = value;

        $.ajax({
            url: 'save.php',
            method: 'post',
            data: {
                type: 'voice',
                voice:value
            }
        });

    });

    // var saveData = (function () {
    //     var a = document.createElement("a");
    //     document.body.appendChild(a);
    //     a.style = "display: none";
    //     return function (data , fileName) {
    //         var json = JSON.stringify(data) ,
    //             blob = new Blob([json] , {type: "octet/stream"}) ,
    //             url = window.URL.createObjectURL(blob);
    //         a.href = url;
    //         a.download = fileName;
    //         a.click();
    //         window.URL.revokeObjectURL(url);
    //     };
    // }());
    // let fileName = "data.json";

    $("#form").submit(function (e) {
        e.preventDefault();
        $("#msend").trigger("click");
        return false;
    });

    $(".status").html("last seen today at " + getTime());

    let receivedMsg = "";
    let originalMsg = "";
    let tick = "<svg style='position: absolute;transition: .5s ease-in-out;' xmlns='http://www.w3.org/2000/svg' width='16'height='15' id='msg-dblcheck-ack' x='2063' y='2076'><path d='M15.01 3.316l-.478-.372a.365.365 0 0 0-.51.063L8.666 9.88a.32.32 0 0 1-.484.032l-.358-.325a.32.32 0 0 0-.484.032l-.378.48a.418.418 0 0 0 .036.54l1.32 1.267a.32.32 0 0 0 .484-.034l6.272-8.048a.366.366 0 0 0-.064-.512zm-4.1 0l-.478-.372a.365.365 0 0 0-.51.063L4.566 9.88a.32.32 0 0 1-.484.032L1.892 7.77a.366.366 0 0 0-.516.005l-.423.433a.364.364 0 0 0 .006.514l3.255 3.185a.32.32 0 0 0 .484-.033l6.272-8.048a.365.365 0 0 0-.063-.51z' fill='#4fc3f7'/></svg>";


    $("#msend").click(function () {
        // console.log(data);
        let scroll = ($(".conversation-container").scrollTop()) + 1550;

        let msg = $("#val").val().trim();
        let res = "<div class='message sent'>" + msg + "<span class='metadata'> <span class='time'>" + getTime() + "</span><span class='tick'>" + tick + "</span></span></div>";

        msg == "" ? $("#val").focus() : ($("#ap").append(res),
            $("#form")[0].reset(), setTimeout(function () {
            $(".status").html("online ")
        } , 900), setTimeout(function () {
            $(".status").html("typing... ")
        } , 1000), receivedMsg = msg.toUpperCase().trim(), originalMsg = msg.trim(), $(".conversation-container").scrollTop(scroll), send());
    });

    // saveData(response, fileName);
    function findQue(que) {
        return que.toUpperCase() === receivedMsg;
    }

    let support = false;
    function send() {
        let scroll = ($(".conversation-container").scrollTop()) + 1550;
        let resMsg = '';
        let speakMsg = '';
        let flag = false;
        if (receivedMsg.substring(0 , 6) == "SEARCH") {
            speakMsg = "This are the top results.";
            resMsg = "<b align='center'>This are the top results </b><nav class='back'  onclick='history.back()'>&larr;</nav><nav class='forword' onclick='history.forward()'>&rarr;</nav><iframe style = 'z-index:1;overflow-x:scroll; overflow-y:scroll;' scrolling='yes' height='300px' width='100%' src='https://www.bing.com/search?q=" + receivedMsg.slice(7) + "'></iframe>";
            flag = true;
        } else if (receivedMsg === 'QUESTIONS' || receivedMsg === 'QUESTION'){
            sendQues(1000);
            return;
            flag = true;
        } else if (receivedMsg === 'DEPARTMENTS' || receivedMsg === 'DEPARTMENT'){
            showDepartment();
            return;
        } else if (receivedMsg === 'KEYWORDS' || receivedMsg === 'KEYWORD'){
            showKeywords();
            return;
        } else if (receivedMsg === 'SUPPORT' || receivedMsg === 'SUPORRTS'){
            speakMsg = "Okay, You require support, Please enter your message";
            resMsg = 'Please enter your Message.';
            support = true;
            flag = true;
        } else if (support){
            support = false;
            showDepartment(false,true);
            return;
        } else {
            if (flag === false) {
                for (let res in data['keywords']) {
                    if (typeof data['keywords'][res][0].find(findQue) === 'string') {
                        speakMsg = resMsg = data['keywords'][res][1][0];
                        flag = true;
                        break;
                    }
                }
            }
            if(flag === false){
                for (let res in data['question']) {
                    if (typeof data['question'][res][0].find(findQue) === 'string') {
                        speakMsg = resMsg = data['question'][res][1][0];
                        flag = true;
                        break;
                    }
                }
            }
            if(flag === false){
                for (let res in data['department']) {
                    if (typeof data['department'][res][0].find(findQue) === 'string') {
                        speakMsg = "Contact to the department.";
                        resMsg = "Contact Department Through : <a href='https://api.whatsapp.com/send?phone=" + data['department'][res][1] + "' target='_blank'>" + data['department'][res][0] + " Department</a>";
                        flag = true;
                        break;
                    }
                }
            }
        }
        if (flag === false) {
            speakMsg = "Sorry, I didn't understand. To search,  type  Search Your keyword  for example type : Search Sololearn For list of Keywords type keywords or if you have another question then type questions or Contact to the department.";
            resMsg = "Sorry, I didn't understand, please explain it with proper spellings or  If you say so I can search for you. To search, <br> type <q><b> Search Your keyword </b></q> for example type : <b>Search Sololearn</b> <br>For list of Keywords type <b>KEYWORDS</b> or if you have another question then type <b>QUESTIONS</b>"
            showDepartment(false);
        }

        let res = "<div class='message received'>" + resMsg + "<span class='metadata'> <span class='time'>" + getTime() + "</span></span></div>";
        setTimeout(function () {
            $('#ap').append(res);
            $(".status").html("online");
            $(".conversation-container").scrollTop(scroll);
        } , 1100);
        speak(speakMsg);

    }

    function start() {
        let scroll = ($(".conversation-container").scrollTop()) + 1550;
        let resMsg = "Hello, hope your good. I can provide any assistance.";
        let res = "<div class='message received'>" + resMsg + "<span class='metadata'> <span class='time'>" + getTime() + "</span></span></div>";

        $('#ap').append(res);
        $(".status").html("online");

        resMsg = "Choose from the menu or type your question to get started. <br><hr>";
        resMsg += '<a href="javascript:void(0)" class="que-link" data-que="question">Questions</a>';
        resMsg += '<a href="javascript:void(0)" class="que-link" data-que="keywords">Keywords</a>';
        resMsg += '<a href="javascript:void(0)" class="que-link" data-que="support">Support</a>';
        res = "<div class='message received'>" + resMsg + "<span class='metadata'> <span class='time'>" + getTime() + "</span></span></div>";
        setTimeout(function () {
            $('#ap').append(res);
            $(".status").html("online");
            $(".conversation-container").scrollTop(scroll);

            $(".que-link").on('click', function () {
                let que = $(this).data('que');
                if (que === 'question'){
                    sendQues();
                    return;
                } else if (que === 'keywords'){
                    showKeywords();
                    return;
                } else {
                    speakMsg = "Okay, You require support, Please enter your message";
                    resMsg = 'Please enter your Message.';
                    support = true;
                }
                res = "<div class='message received'>" + resMsg + "<span class='metadata'> <span class='time'>" + getTime() + "</span></span></div>";
                setTimeout(function () {
                    $('#ap').append(res);
                    $(".status").html("online");
                    $(".conversation-container").scrollTop(scroll);
                } , 1100);
                speak(speakMsg);
            });

        } , 1100);
        let speakMsg = "Hello, hope your good. I can provide any assistance. Choose from the menu or type your question to get started.";
        speak(speakMsg);
    }

    function showKeywords(flag = true,key=null,page=0) {
        let scroll = ($(".conversation-container").scrollTop()) + 1550;
        let resMsg = '';
        if (flag) {
            let speakMsg = "Following are all supported keywords";
            resMsg = 'Following are all supported keywords  <br><hr><span data-key="' + Math.floor((Math.random() * 100) + 1) + '">';
            speak(speakMsg);
        }
        let len = data.keywords.length;
        let lastKey = ((len > page+10) ? page+10 : len);
        for (let key = page; key < lastKey; key++) {
            resMsg += '<a href="javascript:void(0)" data-key="' + key + '" class="key-link">' + data.keywords[key][0][0] + ((key!==(lastKey-1))? ', ' : '');
        }
        if (len > page+10) {
            resMsg += '<a href="javascript:void(0)" data-key="' + Math.floor((Math.random() * 100) + 1) + '" data-page="' + (page + 10) + '" class="more-link">...MORE</a></span>';
        }

        setTimeout(function () {
            if (flag) {
                let res = "<div class='message received'>" + resMsg + "<span class='metadata'> <span class='time'>" + getTime() + "</span></span></div>";
                $('#ap').append(res);
            } else {
                $('span[data-key="' + key + '"]').append(', '+resMsg);
            }
            $(".status").html("online");
            $(".conversation-container").scrollTop(scroll);

            $(".key-link").on('click',function () {
                let key = $(this).data('key');
                let res = "<div class='message sent'>" + data.keywords[key][0][0] + "<span class='metadata'> <span class='time'>" + getTime() + "</span><span class='tick'>" + tick + "</span></span></div>";
                $('#ap').append(res);
                $(".conversation-container").scrollTop(scroll);
                receivedMsg = data.keywords[key][0][0].toUpperCase().trim();
                send();
            });

            $(".more-link").on('click',function () {
                key = $(this).parent('span').data('key');
                page = $(this).data('page');
                showKeywords(false,key,page);
                $(this).remove();
            })
        } , ((flag) ? 1100 : 0));
    }

    function sendQues(){
        let scroll = ($(".conversation-container").scrollTop()) + 1550;

        let msg = 'Select Question to get started. <br><hr>';

        for (let que in data.question) {
            msg += '<a href="javascript:void(0)" class="que-link" data-que="' + que + '">' + data.question[que][0] + '</a>';
        }

        let res = "<div class='message received'>" + msg + "<span class='metadata'> <span class='time'>" + getTime() + "</span></span></div>";
        setTimeout(function () {
            $('#ap').append(res);
            $(".status").html("online");
            $(".conversation-container").scrollTop(scroll);

            $(".que-link").on('click', function () {
                let key = $(this).data('que');
                let res = "<div class='message sent'>" + data.question[key][0] + "<span class='metadata'> <span class='time'>" + getTime() + "</span><span class='tick'>" + tick + "</span></span></div>";
                $('#ap').append(res);
                $(".conversation-container").scrollTop(scroll);
                res = "<div class='message received'>" + data.question[key][1] + "<span class='metadata'> <span class='time'>" + getTime() + "</span></span></div>";
                setTimeout(function () {
                    $('#ap').append(res);
                    $(".status").html("online");
                    $(".conversation-container").scrollTop(scroll);
                } , 1100);
                speak(data.question[key][1][0]);
            });

        } , 1100);
        msg = "Select Question to get started";
        speak(msg);

    }

    function showDepartment(flag = true,department = false){
        let scroll = ($(".conversation-container").scrollTop()) + 1550;
        let delay = (flag==true||department==true) ? 1100 : 2000;
        let msg;
        if (department)
            msg = 'Select Department Link :  <br><hr>';
        else
            msg = 'Contact Department through Link :  <br><hr>';

        for (let que in data.department) {
            msg += '<a href="https://api.whatsapp.com/send?phone=' + data['department'][que][1] + ((department === true) ? '&text='+ encodeURI(originalMsg) : '') + '" target="_blank" class="que-link">' + data.department[que][0] + ' department </a>';
        }

        let res = "<div class='message received'>" + msg + "<span class='metadata'> <span class='time'>" + getTime() + "</span></span></div>";
        setTimeout(function () {
            $('#ap').append(res);
            $(".status").html("online");
            $(".conversation-container").scrollTop(scroll);
        } , delay);
        if (flag)
            speak("Following are our the department.");
        if (department)
            speak("okay, please click a department link");
    }

    $("#save").on('click' , function () {
        let dName = $(".dName");
        let dNo = $(".dNo");
        let que = $(".que");
        let Qans = $(".Qans");
        let keyword = $(".keyword");
        let Kans = $(".Kans");

        if ((dName.length + data.department.length > 10) && ($(dName[0]).val() != '')) {
            alert("You can only add 10 questions");
            return false;
        }
        //Department
        let department = [];
        let dLen = dName.length;
        dName.each(function (a , ele) {
            if ($(ele).val() != '' && $(dNo[a]).val() != '') {
                department.push([$(ele).val()] , [$(dNo[a]).val()]);
                data.department.push([[$(ele).val()] , [$(dNo[a]).val()]]);
            }
            if (dLen === a+1){
                $(ele).val('');
                $(dNo[a]).val('');
            } else {
                $(ele).closest('.form-inline').remove();
            }
        });
        //Questions
        let question = [];
        let qLen = que.length;
        que.each(function (a , ele) {
            if ($(ele).val() != '' && $(Qans[a]).val() != '') {
                question.push([$(ele).val()] , [$(Qans[a]).val()]);
                data.question.push([[$(ele).val()] , [$(Qans[a]).val()]]);
                $(ele).val('');
                $(Qans[a]).val('');
            }
            if (qLen === a+1){
                $(ele).val('');
                $(Qans[a]).val('');
            } else {
                $(ele).closest('.form-inline').remove();
            }
        });

        //Keywords
        let keywords = [];
        let wLen = keyword.length;
        keyword.each(function (a , ele) {
            if ($(ele).val() != '' && $(Kans[a]).val() != '') {
                keywords.push($(ele).val().toUpperCase().split(",") , [$(Kans[a]).val()]);
                data.keywords.push([$(ele).val().toUpperCase().split(",") , [$(Kans[a]).val()]]);
                $(ele).val('');
                $(Kans[a]).val('');
            }
            if (wLen === a+1){
                $(ele).val('');
                $(Kans[a]).val('');
            } else {
                $(ele).closest('.form-inline').remove();
            }
        });
        // console.log(data);

        $.ajax({
            url: 'save.php',
            method: 'post',
            data: {
                type: 'details',
                department:department,
                question:question,
                keywords:keywords
            },
            success:function (res) {
                if (res == true){
                    alert("Details are saved Successfully");
                }
            },
            error:function (e) {
                console.log(e);
            }
        });
        dTbl();
        queTbl();
        keywordTbl();
        // notify();
        // saveData(data , fileName);
    })

    $("#submitProfile").on('click' , async function () {
        let cName = $("#cName").val();
        let search = $('#profile').val();
        let type = $('#type').val();

        if (cName == '' || profile == ''){
            alert("Please fill the Details");
            return false;
        }

        if (type == 'twitter') {
            $.ajax({
                url: "twitter.php",
                type: 'POST',
                data: {
                    username: search
                },
                success: function(res) {
                    if (res !== "Not Found") {
                        $(".img").attr('src' , res);
                        saveProfile(cName,res)
                    } else {
                        let msg = confirm("Username not found \nWant to Continue???");
                        if (msg){
                            saveProfile(cName,'assets/img/default.jpg')
                        }
                    }
                }
            });

        }else if (type == 'insta') {
            await $.instagramFeed({
                'username': search,
                'callback': function(data){
                    $(".img").attr('src' , data.profile_pic_url_hd);
                    saveProfile(cName,data.profile_pic_url_hd)
                },
                on_error: function () {
                    let msg = confirm("Username not found \nWant to Continue???");
                    if (msg){
                        saveProfile(cName,'assets/img/default.jpg')
                    }
                }
            });
        }else if (search != '') {

            $.ajax({
                url: "ajax.php",
                type: 'POST',
                data: {
                    action: type,
                    username: search
                },
                success: function(data) {

                    if (data !== "Username not found") {
                        $(".img").attr('src' , data);
                        saveProfile(cName,data)
                    } else {
                        let msg = confirm("Username not found \nWant to Continue???");
                        if (msg){
                            saveProfile(cName,'assets/img/default.jpg')
                        }
                    }
                }
            });
        }
    });

    function saveProfile(cName,profile){
        $.ajax({
            url: 'save.php' ,
            method: 'post' ,
            data: {
                type: 'profile' ,
                cName: cName ,
                profile: profile
            } ,
            success: function (res) {
                if (res == true) {
                    alert("Details are saved Successfully");
                }
            } ,
            error: function (e) {
                console.log(e);
            }
        });
        data.profile.name = cName;
        data.profile.url = profile;
        $("#cName").val('');
        $("#profile").val('');
        $(".cName").text(data.profile['name']);
        $(".img").attr('src' , data.profile['url']);
    }

    $("#saveProject").on('click',function () {
        let pName = $(".pName");
        let pUrl = $(".pUrl");
        let pDesc = $(".pDesc");

        let len = pName.length;
        let projects = [];
        pName.each(function (a , ele) {
            if ($(ele).val() != '' && $(pUrl[a]).val() != '' && $(pDesc[a]).val() != '' ) {
                projects.push([$(ele).val()] , [$(pUrl[a]).val()] , [$(pDesc[a]).val()]);
                data.projects.push([[$(ele).val()] , [$(pUrl[a]).val()] , [$(pDesc[a]).val()]]);
            }
            if (len === a+1){
                $(ele).val('');
                $(pUrl[a]).val('');
                $(pDesc[a]).val('');
            } else {
                $(ele).closest('.form-inline').remove();
            }
        });

        $.ajax({
            url: 'save.php',
            method: 'post',
            data: {
                type: 'projects',
                projects:projects
            },
            success:function (res) {
                if (res == true){
                    alert("Details are saved Successfully");
                }
            },
            error:function (e) {
                console.log(e);
            }
        });
        pTbl();
    });

    $("#delete").on('click', function () {
        data.profile.name = "Your Name";
        data.profile.url = "assets/img/profile.png";
        $.ajax({
            url: 'save.php',
            method: 'post',
            data: {
                type: 'profile',
                cName:"Your Name",
                profile:"assets/img/profile.png"
            },
            success:function (res) {
                if (res == true){
                    alert("Details removed Successfully");
                }
            },
            error:function (e) {
                console.log(e);
            }
        });
        $(".cName").text(data.profile['name']);
        $(".img").attr('src' , data.profile['url'])
    });

    $("#updateDepartment").on('click', function () {
        let updatedDName = $("#updatedDName").val();
        let updatedDno = $("#updatedDno").val();
        let updateId = $("#updateId").val();

        if (updatedDName == '' || updatedDno == '' ){
            alert("Please Fill the proper details.");
            return false;
        }

        data.department[updateId][0] = [updatedDName];
        data.department[updateId][1] = [updatedDno];
        $.ajax({
            url: 'save.php',
            method: 'post',
            data: {
                type: 'updateDepartment',
                updateId:updateId,
                updatedDName:updatedDName,
                updatedDno:updatedDno
            },
            success:function (res) {
                if (res == true){
                    alert("Details are saved Successfully");
                }
            },
            error:function (e) {
                console.log(e);
            }
        });
        // console.log(data);
        // saveData(data , fileName);
        // notify();
        $("#departmentModal").modal('toggle');
        dTbl();
    });

    $("#updateQuestion").on('click', function () {
        let updatedQue = $("#updatedQue").val();
        let updatedQans = $("#updatedQans").val();
        let updateId = $("#updateId").val();

        if (updatedQue == '' || updatedQans == '' ){
            alert("Please Fill the proper details.");
            return false;
        }

        data.question[updateId][0] = [updatedQue];
        data.question[updateId][1] = [updatedQans];
        $.ajax({
            url: 'save.php',
            method: 'post',
            data: {
                type: 'updateQuestion',
                updateId:updateId,
                updatedQue:updatedQue,
                updatedQans:updatedQans
            },
            success:function (res) {
                if (res == true){
                    alert("Details are saved Successfully");
                }
            },
            error:function (e) {
                console.log(e);
            }
        });
        // console.log(data);
        // saveData(data , fileName);
        // notify();
        $("#questionModal").modal('toggle');
        queTbl();
    });

    $("#updateKeyword").on('click', function () {
        let updatedKeyword = $("#updatedKeyword").val().toUpperCase().split(",");
        let updatedKans = $("#updatedKans").val();
        let updateId = $("#updateId").val();

        if (updatedKeyword == '' || updatedKans == '' ){
            alert("Please Fill the proper details.");
            return false;
        }

        data.keywords[updateId][0] = updatedKeyword;
        data.keywords[updateId][1] = [updatedKans];
        $.ajax({
            url: 'save.php',
            method: 'post',
            data: {
                type: 'updateKeywords',
                updateId:updateId,
                updatedKeyword:updatedKeyword,
                updatedKans:updatedKans
            },
            success:function (res) {
                if (res == true){
                    alert("Details are saved Successfully");
                }
            },
            error:function (e) {
                console.log(e);
            }
        });
        // console.log(data);
        // saveData(data , fileName);
        // notify();
        $("#keywordModal").modal('toggle');
        keywordTbl();
    });

    function pTbl() {

        var dataTable = $('#pTbl').DataTable({
            "processing" : true,
            "serverSide" : true,
            "order" : [],
            "ajax" : {
                url:"fetch.php",
                type:"POST"
            }
        });
    }
    $(document).on('DOMSubtreeModified', '.update', function(){
        var id = $(this).data("id");
        $(".save[data-id='" + id + "']").removeClass('d-none');
    });
    $(document).on('click', '.save', function(){

        let id = $(this).data("id");
        let column_0 = $("div[data-id=" + id + "][data-column=0]").text();
        let column_1 = $("div[data-id=" + id + "][data-column=1]").text();
        let column_2 = $("div[data-id=" + id + "][data-column=2]").text();

        $.ajax({
            url:"update.php",
            method:"POST",
            data: {id: id , project_name: column_0 , url: column_1 , desc: column_2},
            success:function(data)
            {
                $('#pTbl').DataTable().destroy();
                pTbl();
            }
        });

        $(".save[data-id='" + id + "']").addClass('d-none');
    });
    $(document).on('click', '.delete', function(){
        var id = $(this).attr("id");
        if(confirm("Are you sure you want to remove this?")) {
            $.ajax({
                url: "delete.php" ,
                method: "POST" ,
                data: {id: id} ,
                success: function (data) {
                    alert(data);
                    $('#pTbl').DataTable().destroy();
                    pTbl();
                }
            });
        }
    });

    function update_data(id, column_name, value) {

    }

    function dTbl() {
        let html = '';

        for (let key in data.department) {
            html += '<tr>' +
                '<td>' + data.department[key][0] + '</td>' +
                '<td>' + data.department[key][1] + '</td>' +
                '<td><button type="button" class="btn btn-success edit-department" data-id="' + key + '" data-toggle="modal" data-target="#departmentModal"><span class="glyphicon glyphicon-pencil"></span></button>&nbsp;<button type="button" class="btn btn-danger delete-department" data-id="' + key + '"><span class="glyphicon glyphicon-remove"></span></td>' +
                '</tr>';
        }

        $("#dTblBody").html(html);
    }

    function queTbl() {
        let html = '<table class="table table-bordered table-striped">' +
            '<tr>' +
            '<th>Question</th>' +
            '<th>Answer</th>' +
            '<th></th>' +
            '</tr>';

        for (let key in data.question) {
            html += '<tr>' +
                '<td>' + data.question[key][0] + '</td>' +
                '<td>' + data.question[key][1] + '</td>' +
                '<td><button type="button" class="btn btn-success edit-question" data-id="' + key + '" data-toggle="modal" data-target="#questionModal"><span class="glyphicon glyphicon-pencil"></span></button>&nbsp;<button type="button" class="btn btn-danger delete-question" data-id="' + key + '"><span class="glyphicon glyphicon-remove"></span></td>' +
                '</tr>';
        }

        html += '</table>';
        $("#queTbl").html(html);

        $(".edit-question").on('click', function () {
            let id = $(this).data('id');
            $("#updateId").val(id);
            $("#updatedQue").val(data.question[id][0]);
            $("#updatedQans").val(data.question[id][1]);
        });

        $(".delete-question").on('click', function () {
            let id = $(this).data('id');
            data.question = $.grep(data.question, function(value,key) {
                return key != id;
            });
            $.ajax({
                url: 'save.php',
                method: 'post',
                data: {
                    type: 'removeQuestion',
                    id:id
                },
                success:function (res) {
                    if (res == true){
                        alert("Details are removed Successfully");
                    }
                },
                error:function (e) {
                    console.log(e);
                }
            });
            // console.log(data);
            // saveData(data , fileName);
            // notify();
            queTbl();
        });
    }

    function keywordTbl() {
        let html = '<table class="table table-bordered table-striped">' +
            '<tr>' +
            '<th>Keyword</th>' +
            '<th>Answer</th>' +
            '<th></th>' +
            '</tr>';

        for (let key in data.keywords) {
            html += '<tr>' +
                '<td>' + data.keywords[key][0] + '</td>' +
                '<td>' + data.keywords[key][1] + '</td>' +
                '<td><button type="button" class="btn btn-success edit-keyword" data-id="' + key + '" data-toggle="modal" data-target="#keywordModal"><span class="glyphicon glyphicon-pencil"></span></button>&nbsp;<button type="button" class="btn btn-danger delete-keyword" data-id="' + key + '"><span class="glyphicon glyphicon-remove"></span></button></td>' +
                '</tr>';
        }

        html += '</table>';
        $("#keywordTbl").html(html);

        $(".edit-keyword").on('click', function () {
            let id = $(this).data('id');
            $("#updateId").val(id);
            $("#updatedKeyword").val(data.keywords[id][0]);
            $("#updatedKans").val(data.keywords[id][1]);
        });

        $(".delete-keyword").on('click', function () {
            let id = $(this).data('id');
            data.keywords = $.grep(data.keywords, function(value,key) {
                return key != id;
            });
            $.ajax({
                url: 'save.php',
                method: 'post',
                data: {
                    type: 'removeKeywords',
                    id:id
                },
                success:function (res) {
                    if (res == true){
                        alert("Details are removed Successfully");
                    }
                },
                error:function (e) {
                    console.log(e);
                }
            });
            // console.log(data);
            // saveData(data , fileName);
            // notify();
            keywordTbl();
        });
    }

    function getTime() {
        let dt = new Date();
        let hr = dt.getHours();
        let min = dt.getMinutes();
        10 > hr ? hr = "0" + hr : hr;
        10 > min ? min = "0" + min : min;
        12 > hr ? time = hr + ":" + min + " am" : time = (hr - 12) + ":" + min + " pm";

        return time;
    }

    function speak(msg) {
        responsiveVoice.speak(msg,voiceType);
    }
});
