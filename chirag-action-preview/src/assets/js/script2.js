$(function () {

    let data = '';
    $.getJSON('data.json')
        .done(function (json) {
            data = json;
            $("#company-name").text(data.profile['name']);
            $("#img").attr('src' , data.profile['url']);
            start();
        });
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
        responsiveVoice.speak(msg);
    }

});






